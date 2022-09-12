<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

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
            $model->categories()->syncWithPivotValues($payload['categories'],[]);
        }

        return $model->fresh();
    }
    public function upload(UploadedFile $file): string
    {
        $filename = uniqid() . '.' . $file->extension();
        $file->storeAs('public/uploads', $filename);
        return 'uploads/' . $filename;
    }
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }
}
