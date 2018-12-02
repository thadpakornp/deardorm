<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model {

    protected $table = 'rooms';
    protected $fillable = [
        'name', 'price', 'floor', 'type', 'status'
    ];

}
