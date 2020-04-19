<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'igst', 'cgst','sgst','net_amount','last_date','order_id','receipent_id','payment_date','payment_status','transaction_id'
    ];
}
