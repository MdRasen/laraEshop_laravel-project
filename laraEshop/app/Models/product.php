<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\category;

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

    public function category(){
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
}