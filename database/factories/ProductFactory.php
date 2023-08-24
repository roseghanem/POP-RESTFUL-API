<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph(1),
            'image' => $this->faker->randomElement(['6.jpg','7.jpg','8.jpg']),
            'quantity' => $this->faker->numberBetween(1,10),
            'status' => $this->faker-> randomElement([Product::AVAILABLE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
            'seller_id' => User::all()->random()->id,
       ];
    }


}
