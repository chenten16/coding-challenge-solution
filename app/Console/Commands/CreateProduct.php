<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    private $productRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $id = rand(1, 500);
        $payload = [
            'name' => 'Product ' . $id,
            'description' => 'Product description',
            'price' => 12,
            'categories' => [],
            'image' => 'uploads/631f35b3e27a0.jpg'
        ];
        $this->productRepository->create($payload);
    }
}
