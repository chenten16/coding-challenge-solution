<?php

namespace App\Http\Controllers;

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
}
