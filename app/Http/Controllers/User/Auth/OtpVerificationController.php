<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function verifyOtp(Request $request)
    {
        try {
            $users = User::findOrFail(auth()->id());
            if ($users->otp == $request->otp) {
                $users->email_verified_at = now();
                $users->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Email verified Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Otp'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
