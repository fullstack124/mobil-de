<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{    
    /**
     * users
     *
     * @return void
     */
    public function users()
    {
        try {
            $users = User::findOrFail('id', auth()->id());
            return response()->json([
                'users' => $users,
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function logout(Request $request)
    {
        $id = $request->user()->id;
        auth()->user()->tokens()->where('tokenable_id', $id)->delete();
    }
}
