<?php

namespace App\Http\Controllers\FristRegistration;

use App\Http\Controllers\Controller;
use App\Models\FirstRegistration;
use Illuminate\Http\Request;

class FirstRegistrationController extends Controller
{
    public function index()
    {
        try {
            $first_registration_year = FirstRegistration::latest()->get();
            return response()->json([
                'success' => true,
                'first_registration_years' => $first_registration_year
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
