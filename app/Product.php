<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    public $timestamps = false;
    protected $fillable=['title','url','content','date','img','price','order_number','download','files_size',
        'files_time','number_files','tag','View','state'];

    public function Comment()
    {
        return $this->hasMany('App\Comment');
    }
}
