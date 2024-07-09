<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Interfaces\Seller\Auth\SellerAuthRepositoryInterface;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    // private $Seller;
    // public function __construct(SellerAuthRepositoryInterface $Seller) {
    //     $this->Seller = $Seller;
    // }
    public function index()
    {
        // return $this->Seller->index();
        return 'test';
    }
}
