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

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }

    /**
     * Gets all the product's types for the option inputs
     *
     * @return mixed
     */
    public function getAllTypesForInput(){
        $types = TypeProduct::all();
        $attributes['default'] = 'By Category';
        foreach ($types as $type) {
            $attributes[$type->id] = $type->name;
        }
        return $attributes;
    }

}
