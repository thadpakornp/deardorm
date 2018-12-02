<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sending extends Model {

    protected $table = 'sending';
    protected $fillable = ['mobile', 'gateway', 'texts'];

}
