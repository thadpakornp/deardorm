<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    protected $table = 'invoice';
    protected $fillable = ['invoice', 'contract', 'due', 'year', 'ref', 'service', 'water', 'power', 'type', 'status'];

}
