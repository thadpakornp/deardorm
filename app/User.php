<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profiles() {
        return $this->hasOne(Profiles::class, 'id');
    }

    public function point() {
        return $this->belongsTo(Point::class);
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function contract() {
        return $this->belongsTo(contract::class);
    }


}
