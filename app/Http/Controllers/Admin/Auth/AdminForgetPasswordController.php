<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Auth\AdminForgetPasswordRepositoryInterface;
use Illuminate\Http\Request;

class AdminForgetPasswordController extends Controller
{
    private $Admin;
    public function __construct(AdminForgetPasswordRepositoryInterface $Admin ){
        $this->Admin = $Admin;
    }
public function create()
{
    return $this->Admin->create();
}
public function sendPasswordRestLink(Request $request)
{
    return $this->Admin->sendPasswordRestLink($request);
}
public function resetPassword(Request $request,$token)
{
    return $this->Admin->resetPassword($request,$token);
}
public function resetPasswordHandler(Request $request, $token)
{
        return $this->Admin->resetPasswordHandler($request,$token);
}
}
