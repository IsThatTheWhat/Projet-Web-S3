<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'photo', 'available', 'stock', 'type_id'
    ];

    public function types(){
        return $this->belongsTo(TypeProduct::class, 'type_id', 'id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function allows(){
        return $this->belongsToMany(User::class, 'allows', 'product_id', 'user_id');
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }
}
