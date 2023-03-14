<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class UserDeviceController extends Controller
{

    function list() {
        $data = [
            "module" => "Devices",
            "title" => "Devices List",
        ];
        return view('devices', $data);
    }

    public function getDatatables(Request $request)
    {
        $list_data = UserDevice::query();

        return Datatables::of($list_data)
            ->editColumn('created_at', function($item){
                return $item->created_at->format('d M Y H:i');
            })
            ->make(true);
    }
}
