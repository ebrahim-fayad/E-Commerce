<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Profile\AdminProfileRepositoryInterface;
use Illuminate\Http\Request;


class AdminProfileController extends Controller
{
    private $AdminProfile;
    public function __construct(AdminProfileRepositoryInterface $AdminProfile) {
        $this->AdminProfile = $AdminProfile;
    }
    public function profileView()
    {
        return $this->AdminProfile->profileView();
    }
    public function changeProfilePicture(Request $request)
    {
        return $this->AdminProfile->changeProfilePicture($request );
    }
}
