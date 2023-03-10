<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Validator;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{

    public function login()
    {
        $data = [
            "module" => "Admin",
            "title" => "Admin Login",
        ];
        return view('admin_login', $data);
    }

    public function actionSignin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        $user = User::where(['email' => $request->email])->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('dashboard');
            } else {
                return redirect()->back()->with('message-error', 'Password Anda tidak match');
            }
        } else {
            return redirect()->back()->with('message-error', 'Email Anda tidak ditemukan');
        }
    }

    public function actionSaveToken(Request $request)
    {
        $item = Auth::user();

        $item->one_signal_id = $request->one_signal_id;
        $item->save();

        $user_device = new UserDevice();
        $user_device->user_id = $item->user_id;
        $user_device->one_signal_id = $request->one_signal_id;
        $user_device->user_agent = request()->userAgent();
        $user_device->save();

        return response()->json(['message' => 'Success save token']);
    }

    public function actionSignOut(Request $request)
    {
        $user = Auth::user();

        $user_devices = UserDevice::where('user_id', $user->user_id)->get();
        foreach($user_devices as $user_device){
            $user_device->delete();
        }
        Auth::logout();
        return redirect('/')->with('message-error', 'Anda berhasil keluar');
    }

    public function admin()
    {
        $data = [
            "module" => "Admin",
            "title" => "Admin List",
        ];
        return view('admin', $data);
    }

    public function create()
    {
        $roles = Role::get();

        $data = [
            "module" => "Admin",
            "title" => "Admin Create",
            "roles" => $roles,
        ];

        return view('admin_create', $data);
    }

    public function getDatatablesAdmin(Request $request)
    {
        $list_data = User::with('role');

        return Datatables::of($list_data)
            ->addColumn('status_to_text', function ($item) {
                return $item->statusToText();
            })
            ->make(true);
    }

    public function actionCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:App\Models\Role,role_id',
            'fullname' => 'required',
            'email' => 'required|unique:App\Models\User,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            $user = new User;
            $user->uuid = Uuid::uuid4();
            $user->role_id = $request->role_id;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_active = $request->is_active;

            $user->save();

            return redirect('admin')->with('message-success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // DB::rollback();

            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    public function actionUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'fullname' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            $user = User::where('uuid', $request->uuid)->first();
            $user->role_id = $request->role_id;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->is_active = $request->is_active;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with('message-success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // DB::rollback();

            return redirect()->back()->with('message-error', $e->getMessage());
        }
    }

    public function update(Request $request, $uuid = null)
    {
        $roles = Role::get();
        $item = User::where('uuid', $uuid)->first();

        $data = [
            "module" => "Admin",
            "title" => "Admin " . $item->fullname,
            "roles" => $roles,
            "item" => $item,
        ];
        return view('admin_update', $data);
    }

    public function password()
    {
        $data = [
            "module" => "Admin",
            "title" => "Admin Password",
        ];
        return view('admin_password', $data);
    }
}
