<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSell extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'popular_brand',
        'brand_id',
        'model_id',
        'first_id',
        'mileage',
        'doors',
        'fuel_type',
        'power',
        'is_registered',
        'type_of_sale',
        'plan_to_sell',
        'country',
        'postal_code',
    ];
}
