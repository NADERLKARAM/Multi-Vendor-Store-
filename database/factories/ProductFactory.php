<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->productName;
        return [
            'store_id' => 1, // Replace with actual store ID
            'category_id' => null, // Replace with actual category ID if needed
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'compare_price' => $this->faker->randomFloat(2, 1, 100),
            'options' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            'rating' => $this->faker->numberBetween(1, 5),
            'featured' => $this->faker->boolean(50),
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}