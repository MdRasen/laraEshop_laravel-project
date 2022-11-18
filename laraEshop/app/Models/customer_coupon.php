<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\coupon;

class customer_coupon extends Model
{
    use HasFactory;

    public function coupon(){
        return $this->belongsTo(coupon::class, 'coupon_id', 'id');
    }
}
