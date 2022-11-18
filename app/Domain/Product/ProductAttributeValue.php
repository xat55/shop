<?php

namespace App\Domain\Product;

use Database\Factories\ProductAttributeValueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    /**
     * Указывает, что идентификаторы модели являются автоинкрементными.
     *
     * @var bool
     */
    public $incrementing = true;

    protected static function newFactory(): ProductAttributeValueFactory
    {
        return new ProductAttributeValueFactory();
    }

}
