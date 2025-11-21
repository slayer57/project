<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'comments',
        'status',
        'user_id',
        'product_id',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
