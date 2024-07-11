<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerShopRequest;
use App\Interfaces\Seller\Profile\SellerProfileRepositoryInterface;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    private $sellerProfile;
    public function __construct(SellerProfileRepositoryInterface $sellerProfile) {
        $this->sellerProfile = $sellerProfile;
    }
    public function profileView()
    {
        return $this->sellerProfile->profileView();
    }
    public function changeProfilePicture(Request $request)
    {
        return $this->sellerProfile->changeProfilePicture($request );
    }
    public function shopSetting()
    {
        return $this->sellerProfile->shopSetting();
    }

    public function shopSetup(Request $request)
    {
        return $this->sellerProfile->shopSetup($request);
    }
}
