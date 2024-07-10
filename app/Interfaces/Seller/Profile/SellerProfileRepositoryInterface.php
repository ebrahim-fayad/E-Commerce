<?php
namespace App\Interfaces\Seller\Profile;

interface SellerProfileRepositoryInterface
{
    public function profileView();
    public function changeProfilePicture($request);
}
