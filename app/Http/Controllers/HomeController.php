<?php

namespace App\Http\Controllers;

use App\Models\CarSell;
use App\Models\ParkedCar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $car_sells = CarSell::latest()->get();
            return response()->json([
                'success' => true,
                'car_sells' => $car_sells
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function isParkedCar($id)
    {
        try {
            $is_parked_car = ParkedCar::where(['user_id' => auth()->id(), 'car_id' => $id])->first();
            if ($is_parked_car) {
                return response()->json([
                    'status' => 'parked',
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'status' => 'not_parked',
                    'success' => false,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function parkedCar($id)
    {
        try {
            $parked_car = new ParkedCar();
            $parked_car->car_id = $id;
            $parked_car->user_id = auth()->id();
            $result = $parked_car->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Car Parked Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some problem'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function parkedCarsList()
    {
        try {
            $parked_cars = ParkedCar::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
            if (count($parked_cars) > 0) {
                return response()->json([
                    'success' => true,
                    'parked_cars' => $parked_cars,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Record not found",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function carSellDetail($id)
    {
        try {
            $car_sell = CarSell::findOrFail($id);
            return response()->json([
                'success' => true,
                'car_sell' => $car_sell
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function sort_by_z_a()
    {
        try {
            $parked_cars = ParkedCar::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
            if (count($parked_cars) > 0) {
                return response()->json([
                    'success' => true,
                    'parked_cars' => $parked_cars,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Record not found",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function sort_by_a_z()
    {
        try {
            $parked_cars = ParkedCar::where('user_id', auth()->id())->orderBy('id', 'asc')->get();
            if (count($parked_cars) > 0) {
                return response()->json([
                    'success' => true,
                    'parked_cars' => $parked_cars,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Record not found",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function sort_by_newest()
    {
        try {
            $parked_cars = ParkedCar::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
            if (count($parked_cars) > 0) {
                return response()->json([
                    'success' => true,
                    'parked_cars' => $parked_cars,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Record not found",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function sort_by_oldest()
    {
        try {
            $parked_cars = ParkedCar::where('user_id', auth()->id())->orderBy('created_at', 'asc')->get();
            if (count($parked_cars) > 0) {
                return response()->json([
                    'success' => true,
                    'parked_cars' => $parked_cars,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Record not found",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
