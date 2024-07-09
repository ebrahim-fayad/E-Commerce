<?php
namespace App\Repository\Admin\Settings;
use App\Interfaces\Admin\Settings\SettingRepositoryInterface;


class SettingRepository implements SettingRepositoryInterface
{
    public function index(){
        return view('Back.pages.Admin.Settings.setting');
    }
}
