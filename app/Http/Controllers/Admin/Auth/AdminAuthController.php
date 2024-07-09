<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Auth\AdminAuthRepositoryInterface;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private $Admin;
    public function index()
    {
        return $this->Admin->index();
    }
    public function __construct(AdminAuthRepositoryInterface $Admin) {
        $this->Admin = $Admin;
    }
    public function create()
    {
        return $this->Admin->create();
    }
    public function store(Request $request)
    {
        return $this->Admin->store($request);
    }
    public function destroy(Request $request)
    {
        return $this->Admin->destroy($request);
    }
}
