<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence,
            'image_path'=>$this->faker->imageUrl(640, 480),
            'description'=>$this->faker->paragraph,
            'price'=>$this->faker->randomElement([58.99,125.00,38.50,102.50, 300.50]),
            'secondary_images' => json_encode([$this->faker->imageUrl(640, 480), $this->faker->imageUrl(640, 480), $this->faker->imageUrl(640, 480)]),      
        ];
    }
}
