<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='orders';
    protected $fillable=[
        'voucher_no',
        'total',
        'qty',
        'payment_slip',
        'status',
        'note',
        'item_id',
        'payment_id',
        'user_id'
    ];
}
