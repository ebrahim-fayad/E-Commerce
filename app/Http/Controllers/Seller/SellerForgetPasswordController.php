<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Interfaces\Seller\Auth\SellerForgetPasswordRepositoryInterface;
use Illuminate\Http\Request;

class SellerForgetPasswordController extends Controller
{
    private $Seller;
    public function __construct(SellerForgetPasswordRepositoryInterface  $Seller) {
        $this->Seller =$Seller ;
    }
    public function create()
    {
        return $this->Seller->create();
    }
    public function sendPasswordRestLink(Request $request)
    {
        return $this->Seller->sendPasswordRestLink($request);
    }
    public function resetPassword($email,$token)
    {
        return $this->Seller->resetPassword($email,$token);
    }
    public function resetPasswordHandler(Request $request, $token)
    {
        return $this->Seller->resetPasswordHandler($request,$token);
    }
}
