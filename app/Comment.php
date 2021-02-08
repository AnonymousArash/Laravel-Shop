<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    public $timestamps = false;
    protected $fillable=['name','email','comment','product_id','state','time','parent_id'];

    public function product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
