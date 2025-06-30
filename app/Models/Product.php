<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category', 'name', 'description', 'image_url', 'is_redeemable', 'points_required'
    ];

    protected $casts = [
        'is_redeemable' => 'boolean',
    ];
}