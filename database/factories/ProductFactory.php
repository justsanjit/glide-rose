<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4, true),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomNumber(4),
            'preview_image' => 'https://picsum.photos/256'
        ];
    }

    public function configure()
    {
        $setStockCallback = function (Product $product) {
            $product->setStock(random_int(1, 200));
        };

        return $this->afterCreating($setStockCallback);
    }
}
