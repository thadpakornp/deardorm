<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_invoice extends Model {

    protected $table = 'invoices';
    protected $fillable = ['id', 'name', 'price'];

}
