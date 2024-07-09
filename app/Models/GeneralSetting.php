<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['site_favicon'];
    public function getLogoAttribute($value)
    {
        if ($value) {
            return asset('images/site/' . $value);
        } else {
            return asset('images/site/deskapp-logo.svg');
        }
    }
    public function getSiteFaviconAttribute($value)
    {
        if ($value) {
            return asset('images/site/' . $value);
        } else {
            return asset('images/site/default-icon.png');
        }
    }
}
