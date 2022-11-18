<?php

namespace Database\Factories;

use App\Domain\Product\Product;
use App\Domain\Product\ProductAttribute;
use App\Domain\Product\ProductAttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeValueFactory extends Factory
{
    protected $model = ProductAttributeValue::class;

    public function definition(): array
    {
        return [
            'value_text' => 'category-' . rand(1, 100),
            'value_integer' => null,
            'value_boolean' => null,
            'value_float' => null,
            'value_date' => null,
            'attribute_id' => $this->getCategoryId(),
            'product_id' => $this->getRandomId(),
        ];
    }

    public function setCityValueText(): ProductAttributeValueFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'value_text' => 'city-' . rand(1, 30),
                'attribute_id' => $this->getCityId(),
                'product_id' => $this->getRandomId(),
            ];
        });
    }

    public function unverified(): ProductAttributeValueFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    private function getRandomId(): int
    {
        $firstId = Product::oldest('id')->value('id');
        $endId = $firstId + 49;

        return rand($firstId, $endId);
    }

    private function getCityId()
    {
        return ProductAttribute::where('code', 'city')->value('id');
    }

    private function getCategoryId()
    {
        return ProductAttribute::where('code', 'category')->value('id');
    }

}
