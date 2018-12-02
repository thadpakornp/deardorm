<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model {

    protected $table = 'uploads';
    protected $fillable = ['num', 'files'];

}
