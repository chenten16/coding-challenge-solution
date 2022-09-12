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
    public function index()
    {
        return response()->json($this->productRepository->all(), 200);
    }
    public function store(StoreProductRequest $request)
    {
        $payload = $request->validated();
        $path = $this->productRepository->upload($request->file('image'));

        $payload['image'] = $path;

        return $this->productRepository->create($payload);
    }
}
