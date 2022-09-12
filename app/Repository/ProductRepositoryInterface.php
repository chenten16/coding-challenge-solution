<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface ProductRepositoryInterface
{
  /**
   * Get all models.
   *
   * @param array $columns
   * @param array $relations
   * @return Builder|Collection
   */
  public function all(array $columns = ['*'], array $relations = [], bool $isQuery = false);

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

  /**
   * Sort products
   *
   * @return string
   */
  public function sort(Builder $query, string $field, string $direction): Builder;

  /**
   * Filter by category
   *
   * @return string
   */
  public function filterByCategory(Builder $query, int $categoryId): Builder;
}
