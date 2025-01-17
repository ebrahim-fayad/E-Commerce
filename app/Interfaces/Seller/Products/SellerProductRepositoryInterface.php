<?php
namespace App\Interfaces\Seller\Products;

interface SellerProductRepositoryInterface
{
    public function addProduct();
    public function allProducts();
    public function getProductCategory($request);
    public function createProduct($request);
    public function editProduct($id);
    public function updateProduct($request,$id);

}
