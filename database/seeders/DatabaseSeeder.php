<?php

namespace Database\Seeders;

use App\Domain\Cart\Actions\AddCartItem;
use App\Domain\Cart\Actions\InitializeCart;
use App\Domain\Coupon\Coupon;
use App\Domain\Customer\Customer;
use App\Domain\Product\Product;
use App\Domain\Product\ProductAttribute;
use App\Domain\Product\ProductAttributeValue;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $products = Product::factory(500)->create();

        $category = ProductAttribute::create([
            'name' => 'Категории',
            'code' => 'category',
            'type' => 'text',
        ]);

        $city = ProductAttribute::create([
            'name' => 'Города',
            'code' => 'city',
            'type' => 'text',
        ]);

        ProductAttributeValue::factory(3000)->create();
        ProductAttributeValue::factory(1000)->setCityValueText()->create();

        Coupon::factory()->create();

        /** @var \App\Models\User $user */
        $user = User::factory()->create([
            'email' => 'admin@shop.com',
            'name' => 'Admin',
        ]);

        $customer = Customer::create([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id,
            'street' => 'Street',
            'number' => '101',
            'postal' => '2000',
            'city' => 'City',
            'country' => 'Belgium',
        ]);

        $cart = (new InitializeCart)($customer);

        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);
        (new AddCartItem)($cart, $products->random(1)[0], 1);
    }

//    public function run()
//    {
//        $products = Product::factory(50)->create();
//
//        $category = ProductAttribute::create([
//            'name' => 'Категории',
//            'code' => 'category',
//            'type' => 'text',
//        ]);
//
//        $city = ProductAttribute::create([
//            'name' => 'Города',
//            'code' => 'city',
//            'type' => 'text',
//        ]);
//
//        ProductAttributeValue::factory(300)->create();
//        ProductAttributeValue::factory(100)->setCityValueText()->create();
//    }

//    public function run(): void
//    {
//        $products = Product::factory(100)->create();
//
//        Coupon::factory()->create();
//
//        /** @var \App\Models\User $user */
//        $user = User::factory()->create([
//            'email' => 'admin@shop.com',
//            'name' => 'Admin',
//        ]);
//
//        $customer = Customer::create([
//            'name' => $user->name,
//            'email' => $user->email,
//            'user_id' => $user->id,
//            'street' => 'Street',
//            'number' => '101',
//            'postal' => '2000',
//            'city' => 'City',
//            'country' => 'Belgium',
//        ]);
//
//        $cart = (new InitializeCart)($customer);
//
//        (new AddCartItem)($cart, $products->random(1)[0], 1);
//        (new AddCartItem)($cart, $products->random(1)[0], 1);
//        (new AddCartItem)($cart, $products->random(1)[0], 1);
//    }
}
