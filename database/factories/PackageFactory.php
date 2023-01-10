<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'package_name'=>fake()->sentence(2),
           'package_duration'=>rand(10,30),
           'package_gallery'=>rand(5,10),
           'package_visibility'=>fake()->sentence(3),
           'package_statistics'=>"no",
           'package_highlighted'=>"no",
           'package_ad_in_first_page'=>"no",
           'package_price_per_ad'=>rand(200,300),
        ];
    }
}
