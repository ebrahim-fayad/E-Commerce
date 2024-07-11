<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'user_type',
        'seller_id',
        'name',
        'slug',
        'summary',
        'category',
        'subcategory',
        'price',
        'compare_price',
        'product_image',
        'visibility',
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getProductImageAttribute($value)
    {
        if ($value) {
            return asset("images/products/$value");
        } else {
            return asset('images/default-avatar.png');
        }

    }
}
