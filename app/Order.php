<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

public function order_detail()
{
    return $this->hasMany('App\OrderDetail');
}
public function product()
{
    return $this->hasManyThrough('App\OrderDetail','App\Product');
}

public function customer()
{
    return $this->hasOne('App\User','id','user_id');
}

public function user()
{
    return $this->hasOne('App\User','id','follow_up_user_id');
}
}