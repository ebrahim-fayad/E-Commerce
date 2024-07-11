<?php

namespace App\Http\Controllers\Seller\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerProductRequest;
use App\Interfaces\Seller\Products\SellerProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Rules\ValidatePrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    public function __construct(SellerProductRepositoryInterface $product) {
        $this->product = $product;
    }
    public function allProducts()
    {
        return $this->product->allProducts();
    }
    public function addProduct()
    {
        return $this->product->addProduct();
    }
    public function getProductCategory(Request $request)
    {
        return $this->product->getProductCategory($request);
    } //End Method
    public function createProduct(SellerProductRequest $request)
    {
        return $this->product->createProduct($request);
    } //End Method
}
