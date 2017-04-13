<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'user_id', 'product_id',
    ];

    public function products() {
        return $this->belongsTo(Product::class);
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCreatedAtAttribute($value){
        return date('F j, Y, g:i a', strtotime($value));
    }
}
