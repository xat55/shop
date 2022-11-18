<?php

namespace App\Domain\Product;

use Database\Factories\ProductAttributeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
    ];

    protected static function newFactory(): ProductAttributeFactory
    {
        return new ProductAttributeFactory();
    }

    public function products()
    {
        return $this
            ->belongsToMany(Product::class, 'product_attribute_values', 'attribute_id', 'product_id')
            ->withPivot('value_text');
    }
}
