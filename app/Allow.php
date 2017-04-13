<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allow extends Model
{
    protected $fillable = [
        'user_id', 'product_id',
    ];
}
