<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'short_description',
        'date',
        'slug',
        'banner_image',

        'seo_title',
        'meta_description',
        'meta_keywords',
        'seo_schema'
    ];
}
