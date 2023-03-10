<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Validator;

class UserController extends Controller
{

    public function view()
    {
        $data = [
            "module" => "User",
            "title" => "User People B",
        ];
        return view('user_view', $data);
    }

    public function actionSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ch_name' => 'required',
            'ch_email' => 'required',
            'ch_phone' => 'required',
            'ch_as' => 'required|exists:App\Models\Role,role_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message-error', $validator->errors()->first());
        }

        // DB::beginTransaction();
        try {
            if (!empty($request->uuid)) {
                $user = User::where('uuid', $request->uuid)->first();
            } else {
                $user = new User;
                $user->uuid = Uuid::uuid4();
                $user->password = Hash::make(uniqid());
                $user->is_active = 1;
            }
            $user->role_id = $request->ch_as;

            if($user->role_id == 3){
                $user->image_profile = 'https://api.dicebear.com/5.x/fun-emoji/png?seed=Loki';
            }else if($user->role_id == 4){
                $user->image_profile = 'https://api.dicebear.com/5.x/fun-emoji/png?seed=Felix';
            }

            $user->fullname = $request->ch_name;
            $user->email = $request->ch_email;
            $user->email = $request->ch_phone;

            $user->save();

            return response()->json(['status_code' => 200, 'message' => 'Success to save-update User',
                'data' => [
                    'user' => $user,
                ],
            ]);
        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json(['status_code' => 200, 'message' => 'message-error', $e->getMessage()]);
        }
    }

    public function actionSaveToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'required',
            'one_signal_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 200, 'message' => $validator->errors()->first()]);
        }

        // DB::beginTransaction();
        try {
            $user = User::where('uuid', $request->created_by)->first();
            $user->one_signal_id = $request->one_signal_id;
            $user->save();

            $user_device = new UserDevice;
            $user_device->user_id = $user->user_id;
            $user_device->one_signal_id = $request->one_signal_id;
            $user_device->user_agent = request()->userAgent();
            $user_device->save();

            return response()->json(['status_code' => 200, 'message' => 'Success to save-update User',
                'data' => [
                    'user' => $user,
                ],
            ]);
        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json(['status_code' => 200, 'message' => 'message-error', $e->getMessage()]);
        }
    }
}
