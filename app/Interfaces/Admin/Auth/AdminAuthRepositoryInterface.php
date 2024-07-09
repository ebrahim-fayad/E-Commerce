<?php
namespace App\Interfaces\Admin\Auth;
interface AdminAuthRepositoryInterface {
    public function index();
    public function create();
    public function store($request);
    public function destroy($request);
}
