<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Thread;
use App\Models\ThreadCategory;
use Auth;
use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request, $target_thread_id = null)
    {
        $user = Auth::user();
        $threads = Thread::with('category', 'user1', 'user1.role')->with(['non_read_chat' => function ($q) use ($user) {$q->where('created_by', '<>', $user->user_id);}])->whereNull('user_id_2')->orWhere('user_id_2', $user->user_id)->get();

        $target_thread = Thread::with('category', 'user1', 'user1.role')->where('thread_id', $target_thread_id)->first();
        $chats = Chat::with('created_by_user')->where('thread_id', $target_thread_id)->orderBy('created_at', 'asc')->get();

        $data = [
            "module" => "Chat",
            "title" => "Chat",
            "threads" => $threads,
            "target_thread_id" => $target_thread_id,
            "target_thread" => $target_thread,
            "chats" => $chats,
        ];

        return view('chat', $data);
    }

    public function actionGetCategory()
    {
        $list_data = ThreadCategory::get();
        return response()->json([
            'data' => [
                'categories' => $list_data,
            ],
        ]);
    }

    public function actionSubmit(Request $request)
    {
        /*
        thread_id  *nullable
        category *nullable
        created_by *not null
        image_id *nullable
        message *not null
         */

        DB::beginTransaction();
        try {
            if (!empty($request->thread_id)) {
                $thread = Thread::find($request->thread_id);

                if (empty($thread->user_id_2) && $thread->user_id_1 != $request->created_by) {
                    $thread->user_id_2 = $request->created_by;
                    $thread->status = 1;
                    $thread->save();
                }
            } else {
                $thread = new Thread;
                $thread->thread_category_id = $request->category;
                $thread->user_id_1 = $request->created_by;
                $thread->thread_no = 'CH' . time();
                $thread->save();
            }

            $chat = new Chat;
            $chat->thread_id = $thread->thread_id;
            $chat->message = $request->message;
            $chat->created_by = $request->created_by;
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

            $chats = Chat::where('thread_id', $thread->thread_id)->whereNull('read_at')->where('created_by', '<>', $request->created_by)->get();
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

            return response()->json(['status_code' => 200, 'message' => 'Success to read message']);
        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json(['status_code' => 201, 'message' => 'Failed to save message ' . $e->getMessage()]);
        }

    }

    public function actionRating(Request $request)
    {
        /*
    thread_id  *not null
    rating  *not null
     */

    }
}
