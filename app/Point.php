<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model {

    protected $table = 'point';
    protected $fillable = [
        'id', 'point', 'event'
    ];
    
    public function user() {
       return $this->hasOne(User::class, 'id');
    }

}
