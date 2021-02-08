<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $timestamps = false;
    protected $fillable = ['fname', 'lname','email','mobile','time','product_id','payment_status','RefId','saleReferenceId','order_read','total_price','price','date','address',
    'zip_code'];
}