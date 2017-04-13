<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'type_products';

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }

}
