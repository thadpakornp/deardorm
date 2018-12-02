<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

    protected $table = 'booking';
    protected $fillable = ['name', 'room', 'checkin', 'status', 'booking', 'paid', 'price', 'mobile'];

    public function users() {
        return $this->hasOne(User::class, 'id');
    }

}
