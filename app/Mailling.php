<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailling extends Model {

    protected $table = 'mailling';
    protected $fillable = ['topic', 'email', 'gateways', 'texts'];

}
