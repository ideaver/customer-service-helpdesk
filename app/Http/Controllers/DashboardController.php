<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $data = [
            "module" => "Dashboard",
            "title" => "Dashboard",
        ];
        return view('dashboard', $data);
    }
    public function view(){
        $data = [
            "module" => "Dashboard",
            "title" => "Dashboard Muhammad Razzaki",
        ];
        return view('dashboard_view', $data);
    }
}
