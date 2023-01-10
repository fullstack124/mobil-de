<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function register(Request $request)
    {
        try {
            $users = new User();
            $validation = Validator::make($request->all(), [
                'email' => 'required | email | unique:users',
                'password' => 'required'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $random = rand(9999, 1000);
                $users->name = "";
                $users->email = $request->email;
                $users->otp = $random;
                $users->password = Hash::make($request->password);
                $result = $users->save();
                if ($result) {
                    $details = [
                        "otp" => $random
                    ];
                    $mail = \Mail::to($request->email)->send(new UserRegistrationMail($details));
                    if ($mail) {
                        $token = $users->createToken('token')->plainTextToken;
                        return response()->json([
                            'success' => true,
                            'token' => $token,
                            'message' => 'Account Create Successfully. Check mail and activate your account'
                        ]);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Server problem'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
