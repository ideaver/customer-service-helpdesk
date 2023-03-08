<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (isset($request->date)) {
            $date_filter = Carbon::parse($request->date);
            $yesterday_date_filter = Carbon::parse($request->date)->subDays(1);
            $end_date_filter = Carbon::parse($request->date)->subDays(7);
        } else {
            $date_filter = Carbon::now('Asia/Jakarta');
            $yesterday_date_filter = Carbon::now('Asia/Jakarta')->subDays(1);
            $end_date_filter = Carbon::now('Asia/Jakarta')->subDays(7);
        }

        $today_chats = Chat::whereDate('created_at', $date_filter->format('Y-m-d'))->get();
        $yesterday_chats = Chat::whereDate('created_at', $yesterday_date_filter->format('Y-m-d'))->get();
        $new_chats = Chat::with('created_by_user')->whereDate('created_at', $date_filter->format('Y-m-d'))->orderBy('created_at', 'desc')->take(5)->get();
        $threads = Thread::with('topic', 'user1', 'user1.role', 'user2')
            ->whereDate('created_at', $date_filter->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $percentage_moving = $yesterday_chats->count() > 0 ? $today_chats->count() >= 0 ? round(($today_chats->count() - $yesterday_chats->count()) / $yesterday_chats->count(), 4) : 1 : 0;

        $data = [
            "module" => "Dashboard",
            "title" => "Dashboard",
            "date_filter" => $date_filter,
            "today_chats" => $today_chats,
            "new_chats" => $new_chats,
            "threads" => $threads,
            "percentage_moving" => $percentage_moving,
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
