<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familys extends Model {

    protected $table = 'familys';
    protected $fillable = ['id', 'name', 'relationship', 'mobile'];

}
