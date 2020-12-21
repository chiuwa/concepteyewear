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
}