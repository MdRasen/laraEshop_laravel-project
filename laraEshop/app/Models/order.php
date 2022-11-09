<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =
    [
        'order_number',
        'customer_id',
        'status',
        'payment_method',
        'payment_status',
        'delivery_address',
        'coupon_id',
        'total_payment'
    ];
}
