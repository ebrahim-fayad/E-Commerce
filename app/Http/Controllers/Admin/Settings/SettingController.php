<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\Settings\SettingRepositoryInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $Settings;
    public function __construct(SettingRepositoryInterface $Settings) {
        $this->Settings = $Settings;
    }
    public function index()
    {
        return $this->Settings->index();
    }
}
