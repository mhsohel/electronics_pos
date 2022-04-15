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
            'brand_id' => $this->faker->randomDigitNot(0),
            'category_id' => $this->faker->randomDigitNot(0),
            'unit_id' => $this->faker->randomDigitNot(0),
            'name' => $this->faker->word,
            'model' => $this->faker->word,
            'size' => $this->faker->word,
            'color' => $this->faker->safeColorName,
            'product_code' => $this->faker->word,
            'photo' => $this->faker->imageUrl(150, 150, 'cats', true, 'Faker'),
        ];
    }
}
