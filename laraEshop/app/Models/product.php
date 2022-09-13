<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable =
    [
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'stock',
        'meta_description',
        'meta_keywords',
        'thumbnail',
        'visibility'
    ];
}
