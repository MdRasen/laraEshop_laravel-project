<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable =
    [
        'coupon_code',
        'discount_amount',
        'description',
        'expiry_date',
        'visibility'
    ];
}
