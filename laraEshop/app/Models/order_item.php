<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable =
    [
        'order_number',
        'product_id',
        'quantity'
    ];
}
