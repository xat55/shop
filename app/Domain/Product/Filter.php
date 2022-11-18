<?php

namespace App\Domain\Product;

use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Filter
{
    private const MODEL = ProductAttributeValue::class;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Application
     */
    protected Application $app;

    /**
     * @param Application $app
     *
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make Model instance
     *
     * @return Model
     * @throws Exception
     *
     */
    public function makeModel(): Model
    {
        $class = self::MODEL;
        $model = $this->app->make($class);

        if (!$model instanceof Model) {
            throw new Exception("Class $class must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Get filter products collection
     *
     * @param $params
     *
     * @return false|LengthAwarePaginator
     */
    public function run($params): LengthAwarePaginator|bool
    {
        $params = $this->removeAttributePage($params);

        if (empty($params) || (1 == count($params) && empty(current($params)))) {
            return false;
        }

        $productIds = collect([]);

        foreach ($params as $text) {
            if ($text) {
                if (is_array($text)) {
                    foreach ($text as $item) {
                        $productIds = $this->getProductIds($productIds, $item);
                    }
                } else {
                    $productIds = $this->getProductIds($productIds, $text);
                }
            }
        }
        $productIds = $productIds->toArray();

        return Product::whereIn('id', $productIds)->paginate(5);
    }

    private function getProductIds($productIds, $text): Collection
    {
        $query = $this->model->query();
        $query->where('value_text', $text);
        $collection = $query->pluck('product_id');

        if ($productIds->isNotEmpty()) {
            $productIds = $collection->intersect($productIds);
        } else {
            $productIds = $collection;
        }

        return $productIds;
    }

    private function removeAttributePage($params)
    {
        if (isset($params['page'])) {
            unset($params['page']);
        }

        return $params;
    }

}
