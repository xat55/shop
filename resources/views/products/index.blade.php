@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Domain\Product\Product[] $products */
    /** @var App\Domain\Product\ProductAttribute $attributes */
@endphp

<x-app-layout title="Products">
    <div class="grid grid-cols-3 gap-12">
        <form method="get">
            <div class="form-group">
                @foreach($attributes as $attribute)
                    <x-filter
                        :label="$attribute->name"
                        :code="$attribute->code"
                        :products="$attribute->products{{--->groupBy('attribute_id')--}}"
                    />
                @endforeach

                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">Искать!</button>
                </span>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-3 gap-12">
        @foreach($products as $product)
            <x-product
                :title="$product->name"
                :price="format_money($product->getItemPrice()->pricePerItemIncludingVat())"
                :actionUrl="action(\App\Http\Controllers\Cart\AddCartItemController::class, [$product])"
                class="mt-4"
            />
        @endforeach
    </div>

    <div class="mx-auto mt-12">
        {{ $products->links() }}
    </div>
</x-app-layout>
