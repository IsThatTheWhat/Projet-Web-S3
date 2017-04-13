<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastName', 'address', 'about', 'email', 'password', 'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function allows(){
        return $this->belongsToMany(Product::class, 'allows', 'user_id', 'product_id');
    }

    /**
     * Retourne l'attribut name avec une majuscule
     * @param $value
     * @return string
     */
    public function getNameAttribute($value){
        return ucfirst($value);
    }
}
