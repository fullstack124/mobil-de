<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $users = new User();
        $validation = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $users = User::where('email', $request->email)->first();
            if ($users) {
                if (Hash::check($request->password, $users->password)) {
                    $token = $users->createToken('token')->plainTextToken;
                    return response()->json([
                        'success' => true,
                        'token' => $token,
                        'message' => 'Login Successfully',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid email and password',
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email not found',
                ]);
            }
        }
    }
}
