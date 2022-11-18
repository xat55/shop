<?php

namespace Database\Factories;

use App\Domain\Product\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    protected $model = ProductAttribute::class;

    public function definition()
    {
        $category = $this->faker->numerify('Category-##');

        return [
            'name' => $category,
            'code' => $category,
            'type' => 'text',
        ];
    }
}
