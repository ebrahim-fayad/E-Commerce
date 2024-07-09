<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory,Sluggable;
    protected $guarded=['id'];

    /**
     * @inheritDoc
     */
    public function sluggable(): array
    {
        return [
            'subcategory_slug' => [
                'source' => 'subcategory_name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(SubCategory::class, 'is_child_of', 'id')->orderBy('ordering', 'asc');
    }
}
