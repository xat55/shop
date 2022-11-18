<?php

use App\Domain\Cart\Projections\CartItem;
use App\Domain\Product\Product;
use App\Domain\Product\ProductAttribute;
use App\Domain\Product\ProductAttributeValue;
use App\Http\Controllers\Cart\AddCartItemController;
use App\Http\Controllers\Cart\CartDetailController;
use App\Http\Controllers\Cart\CheckoutController;
use App\Http\Controllers\Cart\RemoveCartItemController;
use App\Http\Controllers\Cart\RemoveCouponController;
use App\Http\Controllers\Cart\UseCouponController;
use App\Http\Controllers\Orders\OrderDetailController;
use App\Http\Controllers\Orders\OrderIndexController;
use App\Http\Controllers\Orders\OrderPdfController;
use App\Http\Controllers\Orders\OrderPdfPreviewController;
use App\Http\Controllers\Payment\FailController;
use App\Http\Controllers\Payment\PayController;
use App\Http\Controllers\Products\ProductIndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/query', function () {
    $count = ProductAttributeValue::where('value_text', 'category-43')->count();

    dump($count);
});

Route::get('/create', function () {

//    $id = ProductAttribute::insertGetId([
//        'name' => 'Тест',
//        'code' => 'test',
//        'type' => 'text',
//    ]);
//    dump($id);

//    ProductAttribute::create([
//        'name' => 'Категории',
//        'code' => 'category',
//        'type' => 'text',
//    ]);
//
//    ProductAttribute::create([
//        'name' => 'Города',
//        'code' => 'city',
//        'type' => 'text',
//    ]);

});

Route::get('/truncate', function () {
    $collection = Product::all();
//    $collection = ProductAttribute::all();
    $counter = 0;

    foreach ($collection as $item) {
        if($item->delete()) {
            $counter++;
        }
    }

    return "Таблица '{$collection[0]->getTable()}' успешно очищена! Удалено $counter записей";

////    $class = app(ProductAttribute::class);
//    $class = app(ProductAttributeValue::class);
////    $class = app(Product::class);
//    $class::truncate();
//
//    $tableName = $class->getTable();
//
//    return "Таблица '$tableName' успешно очищена!";

});

Route::get('/test', function () {

    dump(ProductAttribute::create([
        'name' => 'Категории',
        'code' => 'category',
        'type' => 'text',
    ])->id);

//    $firstId = Product::oldest('id')->value('id');
//    dump($firstId);
//    $endId = $firstId + 99999;
//    dump($endId);

//    $product = Product::find(1);
//
//    foreach ($product->categories as $item) {
//        dump($item->pivot->value_text);
//    }

//    $category = ProductAttribute::find(2);
//
//    foreach ($category->products as $product) {
//        dump($product->pivot->value_text);
//    }

//    $categories = ProductAttribute::all();
//
//    foreach ($categories as $category) {
//        dump($category->name);
//
//        $products = $category->products/*->groupBy('value_text')->flatten()*/;
//        dump($products);
//
//        $options = [];
//
//        foreach ($products as $product) {
//            dump($product->pivot->value_text);
//            $options[] = $product->pivot->value_text;
//        }
//        dump(array_unique($options));
//    }
});

Route::get('/', ProductIndexController::class);

Route::prefix('cart')->group(function () {
    Route::get('/', CartDetailController::class);
    Route::get('/add/{product}', AddCartItemController::class);
    Route::get('/remove/{cartItem}', RemoveCartItemController::class);

    Route::post('/checkout', CheckoutController::class);

    Route::post('/coupon/use', UseCouponController::class);
    Route::get('/coupon/remove', RemoveCouponController::class);
});

Route::prefix('orders')->group(function () {
    Route::get('/', OrderIndexController::class);
    Route::get('/{order}', OrderDetailController::class);
    Route::get('/{order}/pdf', OrderPdfController::class);
    Route::get('/{order}/pdf/preview', OrderPdfPreviewController::class);
});

Route::prefix('payments')->group(function () {
    Route::get('/pay/{payment}', PayController::class);
    Route::get('/fail/{payment}', FailController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
