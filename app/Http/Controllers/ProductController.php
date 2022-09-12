<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index(Request $request)
    {
        $sortDirection = $request->has('sort') ? $request->query('sort') : '';
        $category = $request->has('category') ? $request->query('category') : '';

        $query = $this->productRepository->all(['*'],  [], true);
        if (!empty($category))
            $query = $this->productRepository->filterByCategory($query, $category);
        if (!empty($sortDirection))
            $query = $this->productRepository->sort($query, 'price', $sortDirection);

        $products = $query->get();
        return response()->json($products, 200);
    }
    public function store(StoreProductRequest $request)
    {
        $payload = $request->validated();
        $path = $this->productRepository->upload($request->file('image'));

        $payload['image'] = $path;

        return $this->productRepository->create($payload);
    }
}
