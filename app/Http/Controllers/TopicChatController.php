<?php

namespace App\Http\Controllers;

use App\Models\ThreadTopic;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class TopicChatController extends Controller
{

    function list() {
        $data = [
            "module" => "Topic Chat",
            "title" => "Topic Chat List",
        ];
        return view('topic_chat', $data);
    }

    public function create()
    {
        $data = [
            "module" => "Topic Chat",
            "title" => "Topic Chat Create",
        ];

        return view('topic_chat_create', $data);
    }

    public function getDatatables(Request $request)
    {
        $list_data = ThreadTopic::query();

        return Datatables::of($list_data)
            ->make(true);
    }

    public function actionCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:App\Models\ThreadTopic,title',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            $item = new ThreadTopic;
            $item->title = $request->title;

            $item->save();

            return redirect('topic-chat')->with('message-success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // DB::rollback();

            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    public function actionUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            $item = ThreadTopic::where('thread_topic_id', $request->id)->first();
            $item->title = $request->title;

            $item->save();

            return redirect()->back()->with('message-success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // DB::rollback();

            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    public function update(Request $request, $id = null)
    {
        $item = ThreadTopic::where('thread_topic_id', $id)->first();

        $data = [
            "module" => "Topic Chat",
            "title" => "Topic Chat " . $item->fullname,
            "item" => $item,
        ];
        return view('topic_chat_update', $data);
    }
}
