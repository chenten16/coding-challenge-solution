<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductRepository  implements ProductRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * ProductRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function create(array $payload): ?Product
    {
        $model = $this->model->create($payload);

        if (count($payload['categories'])) {
            $model->categories()->syncWithPivotValues($payload['categories'], []);
        }

        return $model->fresh();
    }
    public function upload(UploadedFile $file): string
    {
        $filename = uniqid() . '.' . $file->extension();
        return Storage::disk('public')->putFileAs(null, $file, $filename);
    }
    public function all(array $columns = ['*'], array $relations = [], bool $isQuery = false)
    {
        $query = $this->model->with($relations);

        if ($isQuery) return $query;

        return $query->get($columns);
    }
    public function sort(Builder $query, string $field, string $direction): Builder
    {
        return $query->orderBy($field, $direction);
    }
    public function filterByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->whereHas('categories', function ($query) use ($categoryId) {
            return $query->where('id', $categoryId);
        });
    }
}
