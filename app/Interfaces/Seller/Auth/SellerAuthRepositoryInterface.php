<?php
namespace App\Interfaces\Seller\Auth;
interface SellerAuthRepositoryInterface {
    public function index();
    public function create();
    public function register();
    public function verify($token, $email);
    public function createSeller($sellerRequest);
    public function store($request);
    public function destroy($request);
}
