<?php
namespace App\Interfaces\Seller\Auth;

interface SellerForgetPasswordRepositoryInterface {
    public function create();
    public function sendPasswordRestLink($request);
    public function resetPassword($request,$token);
    public function resetPasswordHandler($request,$token);
}
