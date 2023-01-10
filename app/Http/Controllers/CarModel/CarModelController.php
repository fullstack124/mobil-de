<?php

namespace App\Http\Controllers\CarModel;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        try {
            $car_models = CarModel::latest()->get();
            return response()->json([
                'success' => true,
                'car_models' => $car_models
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
