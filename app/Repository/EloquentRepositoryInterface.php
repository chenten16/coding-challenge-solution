<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Create a model.
     *
     * @return Model
     */
    public function create(array $payload): ?Model;

      /**
     * Upload an image
     *
     * @return string
     */
    public function upload(UploadedFile $file): string;
}
