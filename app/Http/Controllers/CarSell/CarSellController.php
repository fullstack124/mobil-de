<?php

namespace App\Http\Controllers\CarSell;

use App\Http\Controllers\Controller;
use App\Models\CarDetails;
use App\Models\CarSell;
use App\Models\Draft;
use App\Models\EquipmentColor;
use App\Models\EquipmentComfort;
use App\Models\EquipmentExtras;
use App\Models\EquipmentInfotainment;
use App\Models\EquipmentSafety;
use App\Models\FirstRegistration;
use App\Models\SelectPackage;
use App\Models\VehicleData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class CarSellController extends Controller
{
    public function index()
    {
        try {
            $car_sells = CarSell::where('user_id', auth()->id())->get();
            return response()->json([
                'success' => true,
                'car_sells' => $car_sells
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $car_sells = new CarSell();
            $validation = Validator::make($request->all(), [
                'popular_brand' => 'required',
                'brand_id' => 'required',
                'model_id' => 'required',
                'first_id' => 'required',
                'mileage' => 'required',
                'doors' => 'required',
                'fuel_type' => 'required',
                'power' => 'required',
                'is_registered' => 'required',
                'type_of_sale' => 'required',
                'plan_to_sell' => 'required',
                'country' => 'required',
                'postal_code' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $car_sells->fill($request->all());
                $car_sells->user_id = auth()->id();
                $result = $car_sells->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'id' => $car_sells->id,
                        'message' => 'Car add Successfully'
                    ]);
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

    public function edit($id)
    {
        try {
            $car_sells = CarSell::findOrFail($id);
            return response()->json([
                'success' => true,
                'car_sells' => $car_sells
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }


    public function update(Request $request, $id)
    {
    }


    public function drafts(Request $request, $id)
    {
        $is_drafts = Draft::where('car_id', $id)->first();
        if ($is_drafts) {
            $is_drafts->drafts_name = $request->drafts_name;
            $is_drafts->save();
        } else {
            $draft = new Draft();
            $draft->car_id = $id;
            $draft->drafts_name = $request->drafts_name;
            $draft->save();
        }
    }

    public function seller_type(Request $request, $id)
    {
        $is_drafts = Draft::where('car_id', $id)->first();
        if ($is_drafts) {
            $is_drafts->drafts_name = $request->drafts_name;
            $is_drafts->save();
        } else {
            $draft = new Draft();
            $draft->car_id = $id;
            $draft->drafts_name = $request->drafts_name;
            $draft->save();
        }
    }


    public function select_package(Request $request, $id)
    {
        $is_select_package = SelectPackage::where('car_id', $id)->first();
        if ($is_select_package) {
            $is_select_package->package_id = $request->package_id;
            $is_select_package->save();
        } else {
            $select_package = new SelectPackage();
            $select_package->package_id = $request->package_id;
            $select_package->car_id = $id;
            $select_package->save();
        }
    }


    public function vehicle_data(Request $request, $id)
    {
        $is_first_registration = FirstRegistration::where('car_id', $id)->first();
        if ($is_first_registration) {
            $is_first_registration->year = $request->year;
            $is_first_registration->month = $request->month;
            $is_first_registration->save();
        }

        $is_car = CarSell::findOrFail($id);
        $is_car->doors = $request->doors;
        $is_car->milage = $request->milage;
        $is_car->fuel_type = $request->fuel_type;
        $is_car->power = $request->power;
        $is_car->save();

        $is_vehicle = VehicleData::where('car_id', $id)->first();
        if ($is_vehicle) {
            $is_vehicle->category = $request->category;
            $is_vehicle->sliding_door = $request->sliding_door;
            $is_vehicle->number_of_seats = $request->number_of_seats;
            $is_vehicle->save();
        } else {
            $vehicle = new VehicleData();
            $vehicle->category = $request->category;
            $vehicle->sliding_door = $request->sliding_door;
            $vehicle->number_of_seats = $request->number_of_seats;
            $vehicle->cubic_capacity = $request->cubic_capacity;
            $vehicle->gear_box = $request->gear_box;
            $vehicle->paddle_shifters = $request->paddle_shifters;
            $vehicle->four_wheel_drive = $request->four_wheel_drive;
            $vehicle->emission_class = $request->emission_class;
            $vehicle->emission_sticker = $request->emission_sticker;
            $vehicle->particulate_filter = $request->particulate_filter;
            $vehicle->start_stop_system = $request->start_stop_system;
            $vehicle->comb = $request->comb;
            $vehicle->urban = $request->urban;
            $vehicle->extra_urban = $request->extra_urban;
            $vehicle->emission_comb = $request->emission_comb;
            $vehicle->sub_category = $request->sub_category;
            $vehicle->vehicle_owner = $request->vehicle_owner;
            $vehicle->damage_vehicle = $request->damage_vehicle;
            $vehicle->accident_damage_vehicle = $request->accident_damage_vehicle;
            $vehicle->road_worthy = $request->road_worthy;
            $vehicle->non_smoking_vehicle = $request->non_smoking_vehicle;
            $vehicle->valid_until = $request->valid_until;
            $vehicle->full_service_history = $request->full_service_history;
            $vehicle->warranty_factory = $request->warranty_factory;
            $vehicle->save();
        }
    }


    public function equipment_color(Request $request, $id)
    {
        $is_equipment_color = EquipmentColor::where('car_id', $id)->first();
        if ($is_equipment_color) {
            $is_equipment_color->exterior_color = $request->exterior_color;
            $is_equipment_color->metallic = $request->metallic;
            $is_equipment_color->material = $request->material;
            $is_equipment_color->color = $request->color;
            $is_equipment_color->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $equipment_color = new EquipmentColor();
            $equipment_color->exterior_color = $request->exterior_color;
            $equipment_color->metallic = $request->metallic;
            $equipment_color->material = $request->material;
            $equipment_color->color = $request->color;
            $equipment_color->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function equipment_safeties(Request $request, $id)
    {
        $is_equipment_safeties = EquipmentSafety::where('car_id', $id)->first();
        if ($is_equipment_safeties) {
            $is_equipment_safeties->assistance_system = json_encode($request->assistance_system);
            $is_equipment_safeties->cruise_control = $request->cruise_control;
            $is_equipment_safeties->speed_limit_control = $request->speed_limit_control;
            $is_equipment_safeties->distance_warning_system = $request->distance_warning_system;
            $is_equipment_safeties->air_bags = $request->air_bags;
            $is_equipment_safeties->isofix = $request->isofix;
            $is_equipment_safeties->passenger_seat = $request->passenger_seat;
            $is_equipment_safeties->head_light_type = $request->head_light_type;
            $is_equipment_safeties->washer_system = $request->washer_system;
            $is_equipment_safeties->full_beam = json_encode($request->full_beam);
            $is_equipment_safeties->day_time_runing_light = $request->day_time_runing_light;
            $is_equipment_safeties->adaptive_lighting = $request->adaptive_lighting;
            $is_equipment_safeties->fog_lamp = $request->fog_lamp;
            $is_equipment_safeties->theft_protection = json_encode($request->theft_protection);
            $is_equipment_safeties->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $equipment_safeties = new EquipmentSafety();
            $equipment_safeties->assistance_system = json_encode($request->assistance_system);
            $equipment_safeties->cruise_control = $request->cruise_control;
            $equipment_safeties->speed_limit_control = $request->speed_limit_control;
            $equipment_safeties->distance_warning_system = $request->distance_warning_system;
            $equipment_safeties->air_bags = $request->air_bags;
            $equipment_safeties->isofix = $request->isofix;
            $equipment_safeties->passenger_seat = $request->passenger_seat;
            $equipment_safeties->head_light_type = $request->head_light_type;
            $equipment_safeties->washer_system = $request->washer_system;
            $equipment_safeties->full_beam = json_encode($request->full_beam);
            $equipment_safeties->day_time_runing_light = $request->day_time_runing_light;
            $equipment_safeties->adaptive_lighting = $request->adaptive_lighting;
            $equipment_safeties->fog_lamp = $request->fog_lamp;
            $equipment_safeties->theft_protection = json_encode($request->theft_protection);
            $equipment_safeties->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function equipment_comforts(Request $request, $id)
    {
        $is_equipment_comfort = EquipmentComfort::where('car_id', $id)->first();
        if ($is_equipment_comfort) {
            $is_equipment_comfort->climate_control = json_encode($request->climate_control);
            $is_equipment_comfort->parking_sensor = $request->parking_sensor;
            $is_equipment_comfort->acoustic_parking_assistant = json_encode($request->acoustic_parking_assistant);
            $is_equipment_comfort->visual_parking_assistant = json_encode($request->visual_parking_assistant);
            $is_equipment_comfort->heated_seats = json_encode($request->heated_seats);
            $is_equipment_comfort->electric_adjustable_seats = json_encode($request->electric_adjustable_seats);
            $is_equipment_comfort->other_features = json_encode($request->other_features);
            $is_equipment_comfort->other_comfort_equipment = json_encode($request->other_comfort_equipment);
            $is_equipment_comfort->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $equipment_comfort = new EquipmentComfort();
            $equipment_comfort->climate_control = json_encode($request->climate_control);
            $equipment_comfort->parking_sensor = $request->parking_sensor;
            $equipment_comfort->acoustic_parking_assistant = json_encode($request->acoustic_parking_assistant);
            $equipment_comfort->visual_parking_assistant = json_encode($request->visual_parking_assistant);
            $equipment_comfort->heated_seats = json_encode($request->heated_seats);
            $equipment_comfort->electric_adjustable_seats = json_encode($request->electric_adjustable_seats);
            $equipment_comfort->other_features = json_encode($request->other_features);
            $equipment_comfort->other_comfort_equipment = json_encode($request->other_comfort_equipment);
            $equipment_comfort->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function equipment_infotainments(Request $request, $id)
    {
        $is_equipment_infrotainments = EquipmentInfotainment::where('car_id', $id)->first();
        if ($is_equipment_infrotainments) {
            $is_equipment_infrotainments->multimedia = json_encode($request->multimedia);
            $is_equipment_infrotainments->handing_and_control = json_encode($request->handing_and_control);
            $is_equipment_infrotainments->connectivity_and_interfaces = json_encode($request->connectivity_and_interfaces);
            $is_equipment_infrotainments->cockpit_display = json_encode($request->cockpit_display);
            $is_equipment_infrotainments->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $equipment_infrotainments = new EquipmentInfotainment();
            $equipment_infrotainments->multimedia = json_encode($request->multimedia);
            $equipment_infrotainments->handing_and_control = json_encode($request->handing_and_control);
            $equipment_infrotainments->connectivity_and_interfaces = json_encode($request->connectivity_and_interfaces);
            $equipment_infrotainments->cockpit_display = json_encode($request->cockpit_display);
            $equipment_infrotainments->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function equipment_extras(Request $request, $id)
    {
        $is_equipment_extras = EquipmentExtras::where('car_id', $id)->first();
        if ($is_equipment_extras) {
            $is_equipment_extras->tires_and_rims = json_encode($request->tires_and_rims);
            $is_equipment_extras->break_down_service = json_encode($request->break_down_service);
            $is_equipment_extras->special_features = json_encode($request->special_features);
            $is_equipment_extras->trailer_coupling = json_encode($request->trailer_coupling);
            $is_equipment_extras->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $equipment_extras = new EquipmentExtras();
            $equipment_extras->tires_and_rims = json_encode($request->tires_and_rims);
            $equipment_extras->break_down_service = json_encode($request->break_down_service);
            $equipment_extras->special_features = json_encode($request->special_features);
            $equipment_extras->trailer_coupling = json_encode($request->trailer_coupling);
            $equipment_extras->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function car_details(Request $request, $id)
    {
        $is_car_details = CarDetails::where('car_id', $id)->first();
        if ($is_car_details) {
            $is_car_details->pictures = json_encode($request->pictures);
            $is_car_details->video_cdn = $request->video_cdn;
            $is_car_details->title = $request->title;
            $is_car_details->vehicle_description = $request->vehicle_description;
            $is_car_details->price = $request->price;
            $is_car_details->price_type = $request->price_type;
            $is_car_details->save();
            return response()->json([
                'success' => true,
            ]);
        } else {
            $car_details = new CarDetails();
            $car_details->pictures = json_encode($request->pictures);
            $car_details->video_cdn = $request->video_cdn;
            $car_details->title = $request->title;
            $car_details->vehicle_description = $request->vehicle_description;
            $car_details->price = $request->price;
            $car_details->price_type = $request->price_type;
            $car_details->save();
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
