<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table='discounts';
    public $timestamps = false;
    protected $fillable=['discounts_name','discounts_value'];
}
