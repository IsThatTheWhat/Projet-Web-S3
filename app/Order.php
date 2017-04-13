<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'price', 'user_id', 'state_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function states(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }
}
