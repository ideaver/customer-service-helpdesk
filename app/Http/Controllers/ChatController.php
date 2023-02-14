<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(){
        $data = [
            "module" => "Chat",
            "title" => "Chat",
        ];
        return view('chat', $data);
    }
}
