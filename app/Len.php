<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Len extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lens';

public function scopeSubcategories($query){
    return $query->where('id', '!=' , null);
}

}