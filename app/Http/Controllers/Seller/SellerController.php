<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Interfaces\Seller\Auth\SellerAuthRepositoryInterface;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    private $Seller;
    public function __construct(SellerAuthRepositoryInterface $Seller) {
        $this->Seller = $Seller;
    }
    public function index()
    {
        return $this->Seller->index();
    }
    public function register()
    {
        return $this->Seller->register();
    }
    public function create()
    {
        return $this->Seller->create();
    }
    public function createSeller(SellerRequest $sellerRequest)
    {
        return $this->Seller->createSeller($sellerRequest);
    }
    public function registerSuccess()
    {
        return view('Back.pages.Sellers.Auth.register-success');
    }
    public function verify($token,$email)
    {
        return $this->Seller->verify($token,$email);
    }

}
