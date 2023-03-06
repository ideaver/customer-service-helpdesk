<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Thread;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now('Asia/Jakarta');

        $today_chats = Chat::whereDate('created_at', $now->format('Y-m-d'))->get();
        $new_chats = Chat::with('created_by_user')->orderBy('created_at', 'desc')->take(5)->get();
        $threads = Thread::with('topic', 'user1', 'user1.role', 'user2')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $data = [
            "module" => "Dashboard",
            "title" => "Dashboard",
            "today_chats" => $today_chats,
            "new_chats" => $new_chats,
            "threads" => $threads,
        ];
        return view('dashboard', $data);
    }
    public function view()
    {
        $data = [
            "module" => "Dashboard",
            "title" => "Dashboard Muhammad Razzaki",
        ];
        return view('dashboard_view', $data);
    }
}
