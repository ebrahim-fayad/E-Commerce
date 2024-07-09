<?php
namespace App\Repository\Seller\Auth;

use App\Interfaces\Seller\Auth\SellerForgetPasswordRepositoryInterface;


class SellerForgetPasswordRepository implements SellerForgetPasswordRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create() {
    }

    /**
     * @inheritDoc
     */
    public function resetPassword($request, $token) {
    }

    /**
     * @inheritDoc
     */
    public function resetPasswordHandler($request, $token) {
    }

    /**
     * @inheritDoc
     */
    public function sendPasswordRestLink($request) {
    }
}
