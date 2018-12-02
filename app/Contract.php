<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model {

    protected $table = 'contract';
    protected $fillable = ['id', 'room', 'contract', 'term', 'start', 'end', 'cancel', 'status'];

    public function user() {
        return $this->hasOne(User::class, 'id');
    }
    
    public function profiles() {
        return $this->hasOne(Profiles::class, 'id');
    }

}
