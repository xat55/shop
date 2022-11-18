<?php

namespace App\Http\Controllers\Products;

use App\Domain\Product\Filter;
use App\Domain\Product\Product;
use App\Domain\Product\ProductAttribute;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductIndexController
{
    /**
     * @param Request $request
     * @param Filter  $filter
     *
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, Filter $filter): View|Factory|Application
    {
        $params = $request->toArray();

        $products = $this->getProducts($params, $filter);

        $attributes = ProductAttribute::all();

        return view('products.index', [
            'products' => $products,
            'attributes' => $attributes,
        ]);
    }

    private function getProducts($params, $filter): LengthAwarePaginator
    {
        $filterProducts = $filter->run($params);

        if ($filterProducts) {
            return $filterProducts->withQueryString();
        }

        return Product::paginate();
    }

}
