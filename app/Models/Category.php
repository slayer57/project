<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'order',
        'is_featured',
        'parent_id',
        'banner_image',
        'image',
        'description',
        'short_description',
        'slug',

        'seo_title',
        'meta_description',
        'meta_keywords'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
