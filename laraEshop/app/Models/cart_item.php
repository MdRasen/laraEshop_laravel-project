<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class cart_item extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
}
