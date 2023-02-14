<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function view(){
        $data = [
            "module" => "User",
            "title" => "User People B",
        ];
        return view('user_view', $data);
    }

}
