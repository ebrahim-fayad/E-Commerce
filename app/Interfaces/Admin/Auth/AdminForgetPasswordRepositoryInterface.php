<?php
namespace App\Interfaces\Admin\Auth;

interface AdminForgetPasswordRepositoryInterface {
    public function create();
    public function sendPasswordRestLink($request);
    public function resetPassword($request,$token);
    public function resetPasswordHandler($request,$token);
}
