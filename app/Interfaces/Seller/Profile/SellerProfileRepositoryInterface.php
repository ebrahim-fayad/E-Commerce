<?php
namespace App\Interfaces\Seller\Profile;

interface SellerProfileRepositoryInterface
{
    public function profileView();
    public function shopSetting();
    public function changeProfilePicture($request);
    public function shopSetup($request);
}
