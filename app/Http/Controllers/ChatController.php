<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatTemplate;
use App\Models\Thread;
use App\Models\ThreadTopic;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use OneSignal;
use Validator;

class ChatController extends Controller
{
    public function chat(Request $request, $target_thread_id = null)
    {
        $query_search = null;
        if (isset($request->q) && !empty($request->q)) {
            $query_search = $request->q;
        }

        $query_status = null;
        if (isset($request->status) && !empty($request->status)) {
            $query_status = $request->status;
        }else{
            $query_status = 'open';
        }

        $user = Auth::user();
        $threads = Thread::with('topic', 'user1', 'user1.role', 'user2')
            ->with(['non_read_chat' => function ($q) use ($user) {$q->where('created_by', '<>', $user->user_id);}])
            ->when($query_status, function ($q) use ($query_status) {
                if($query_status == 'close'){
                    $q->where('status', 2);
                }else{
                    $q->whereIn('status', [0,1]);
                }
            })
            ->where(function ($q) use ($user) {
                // $q->whereNull('user_id_2')
                //     ->orWhere('user_id_2', $user->user_id);
            })
            ->when($query_search, function ($q) use ($query_search) {
                $q->where(function($q) use ($query_search){
                    $q->whereHas('topic', function ($q) use ($query_search) {
                        $q->where('title', 'LIKE', '%' . $query_search . '%');
                    })->orWhereHas('user1', function ($q) use ($query_search) {
                        $q->where('fullname', 'LIKE', '%' . $query_search . '%')
                            ->orWhere('phone', 'LIKE', '%' . $query_search . '%');
                    })->orWhereHas('user2', function ($q) use ($query_search) {
                        $q->where('fullname', 'LIKE', '%' . $query_search . '%')
                            ->orWhere('phone', 'LIKE', '%' . $query_search . '%');
                    })->orwhere('thread_no', 'LIKE', '%' . $query_search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $threads->sortBy(function ($item) {
            $priority_1 = 1;
            $priority_2 = 2;

            if ($item->non_read_chat->first()) {
                return $priority_1 . $item->non_read_chat->first()->created_at;
            } else {
                return $priority_2 . $item->created_at;
            }
        });

        $target_thread = Thread::with('topic', 'user1', 'user1.role')->where('thread_id', $target_thread_id)->first();
        $chats = Chat::with('created_by_user')->where('thread_id', $target_thread_id)->orderBy('created_at', 'asc')->get();

        $data = [
            "module" => "Chat",
            "title" => "Chat",
            "threads" => $threads,
            "target_thread_id" => $target_thread_id,
            "target_thread" => $target_thread,
            "chats" => $chats,
            "chat_templates" => ChatTemplate::get(),
        ];

        return view('chat', $data);
    }

    public function actionGetTopic()
    {
        $list_data = ThreadTopic::get();
        return response()->json([
            'data' => [
                'topics' => $list_data,
            ],
        ]);
    }

    public function actionGetThread(Request $request)
    {
        $user_action = User::where('uuid', $request->created_by)->first();

        $list_data = Thread::with('topic', 'user1', 'user1.role', 'user2', 'last_chat', 'last_chat.created_by_user')
            ->where('user_id_1', $user_action->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => [
                'threads' => $list_data,
            ],
        ]);
    }

    public function actionGetChat(Request $request)
    {
        $list_data = Chat::with('created_by_user')->where('thread_id', $request->thread_id)->orderBy('created_at', 'asc')->get();

        return response()->json([
            'data' => [
                'chats' => $list_data,
            ],
        ]);
    }

    public function actionSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'topic' => 'required|exists:App\Models\ThreadTopic,thread_topic_id',
            'created_by' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 201, 'message' => $validator->errors()->first()]);
        }

        /*
        thread_id  *nullable
        topic *nullable
        created_by *not null
        image_id *nullable
        message *not null
         */

        DB::beginTransaction();
        try {
            $user_action = User::where('uuid', $request->created_by)->first();

            if (!empty($request->thread_id)) {
                $thread = Thread::find($request->thread_id);

                if (empty($thread->user_id_2) && $thread->user_id_1 != $user_action->user_id) {
                    $thread->user_id_2 = $user_action->user_id;
                    $thread->status = 1;
                    $thread->save();
                }
            } else {
                $thread = new Thread;
                $thread->thread_topic_id = $request->topic;
                $thread->user_id_1 = $user_action->user_id;
                $thread->thread_no = 'CH' . time();
                $thread->save();
            }

            $chat = new Chat;
            $chat->thread_id = $thread->thread_id;
            $chat->message = $request->message;
            if ($request->hasFile('image_file')) {
                $image_file = $request->file('image_file');

                $filename = pathinfo($image_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($image_file->getClientOriginalName(), PATHINFO_EXTENSION);

                $filename_new = time() . '_' . $filename . '.' . $ext;

                $path = $image_file->move(public_path('uploads'), $filename_new);
                $chat->image_url = '/uploads/' . $filename_new;
            }
            $chat->created_by = $user_action->user_id;
            $chat->save();

            DB::commit();

            $chat = Chat::with('created_by_user')->where('chat_id', $chat->chat_id)->first();
            $chat->updated_at_message = $chat->updated_at->format('H:i');

            $user_send_id = $thread->user_id_1 == $user_action->user_id ? $thread->user_id_2 : $thread->user_id_1;

            if (!empty($user_send_id)) {
                $data_array = [
                    'chat' => $chat,
                    'routing_app' => '/chatRoom',
                ];

                $url_redirect = url('chat/' . $thread->thread_id);
                $user_send_notif = User::where('user_id', $user_send_id)->first();
                if ($user_send_notif) {
                    $user_devices = UserDevice::where('user_id', $user_send_notif->user_id)->get();
                    foreach($user_devices as $user_device){
                        $one_signal_id = $user_device->one_signal_id;
                        if (!empty($one_signal_id)) {
                            try {
                                $result = OneSignal::sendNotificationToUser(
                                    $chat->message,
                                    $one_signal_id,
                                    $url_redirect,
                                    $data_array,
                                    $buttons = null,
                                    $schedule = null
                                );
                            } catch (\Exception $e) {
    
                            }
                        }
                    }
                }
            }

            return response()->json(['status_code' => 200, 'message' => 'Success to save message',
                'data' => [
                    'thread' => $thread,
                    'chat' => $chat,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }

    public function actionUploadChat(Request $request, $thread_id)
    {
        /*
        thread_id  *nullable
        created_by *not null
        image_id *nullable
         */

        DB::beginTransaction();
        try {
            $thread = Thread::find($request->thread_id);

            $user_action = User::where('uuid', $request->created_by)->first();

            if (empty($thread->user_id_2) && $thread->user_id_1 != $user_action->user_id) {
                $thread->user_id_2 = $user_action->user_id;
                $thread->status = 1;
                $thread->save();
            }

            $chat = new Chat;
            $chat->thread_id = $thread->thread_id;
            if ($request->hasFile('image_file')) {
                $image_file = $request->file('image_file');

                $filename = pathinfo($image_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($image_file->getClientOriginalName(), PATHINFO_EXTENSION);

                $filename_new = time() . '_' . $filename . '.' . $ext;

                $path = $image_file->move(public_path('uploads'), $filename_new);
                $chat->image_url = '/uploads/' . $filename_new;
            }
            $chat->created_by = $user_action->user_id;
            $chat->save();

            DB::commit();

            $chat = Chat::with('created_by_user')->where('chat_id', $chat->chat_id)->first();
            $chat->updated_at_message = $chat->updated_at->format('H:i');

            return response()->json(['status_code' => 200, 'message' => 'Success to save message',
                'data' => [
                    'thread' => $thread,
                    'chat' => $chat,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }

    public function actionRead(Request $request)
    {
        DB::beginTransaction();
        try {
            $thread = Thread::find($request->thread_id);
            $user_action = User::where('uuid', $request->created_by)->first();

            $chats = Chat::where('thread_id', $thread->thread_id)->whereNull('read_at')->where('created_by', '<>', $user_action->user_id)->get();
            foreach ($chats as $chat) {
                $chat->read_at = now();
                $chat->save();
            }

            DB::commit();

            return response()->json(['status_code' => 200, 'message' => 'Success to read message']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }

    public function actionDone(Request $request)
    {
        // DB::beginTransaction();
        try {
            $thread = Thread::find($request->thread_id);
            $thread->status = 2;
            $thread->save();

            // DB::commit();

            return response()->json(['status_code' => 200, 'message' => 'Success to close message']);
        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }

    public function actionRating(Request $request)
    {
        // DB::beginTransaction();
        try {
            $thread = Thread::find($request->thread_id);
            $thread->rating = $request->rating;
            $thread->save();

            // DB::commit();

            return response()->json(['status_code' => 200, 'message' => 'Success to rating message']);
        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }
}
