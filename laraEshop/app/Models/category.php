<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable =
    [
        'name',
        'slug',
        'description',
        'thumbnail',
        'visibility'
    ];
}
