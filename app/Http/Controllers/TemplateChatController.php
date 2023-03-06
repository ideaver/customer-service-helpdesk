<?php

namespace App\Http\Controllers;

use App\Models\ChatTemplate;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class TemplateChatController extends Controller
{

    function list() {
        $data = [
            "module" => "Template Chat",
            "title" => "Template Chat List",
        ];
        return view('template_chat', $data);
    }

    public function create()
    {
        $data = [
            "module" => "Template Chat",
            "title" => "Template Chat Create",
        ];

        return view('template_chat_create', $data);
    }

    public function getDatatables(Request $request)
    {
        $list_data = ChatTemplate::query();

        return Datatables::of($list_data)
            ->make(true);
    }

    public function actionCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:App\Models\ChatTemplate,title',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            $item = new ChatTemplate;
            $item->title = $request->title;
            $item->content = $request->content;

            $item->save();

            return redirect('template-chat')->with('message-success', 'Data berhasil ditambahkan');
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
            $item = ChatTemplate::where('chat_template_id', $request->id)->first();
            $item->title = $request->title;
            $item->content = $request->content;

            $item->save();

            return redirect()->back()->with('message-success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // DB::rollback();

            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    public function update(Request $request, $id = null)
    {
        $item = ChatTemplate::where('chat_template_id', $id)->first();

        $data = [
            "module" => "Template Chat",
            "title" => "Template Chat " . $item->fullname,
            "item" => $item,
        ];
        return view('template_chat_update', $data);
    }
}
