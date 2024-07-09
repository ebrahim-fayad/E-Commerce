<?php

use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;

if (!function_exists('general_setting')) {
    function general_setting()
    {
        $general_setting = GeneralSetting::findOrFail(1);
        return $general_setting;
    }
}
if (!function_exists('social_network')) {
    function social_network()
    {
        $social_network = SocialNetwork::findOrFail(1);
        return $social_network;
    }
}
if (!function_exists('categories')) {
    function categories()
    {
        $categories =Category::orderBy('ordering', 'asc')->get();
        return $categories;
    }
}
