<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    protected $table = 'setting';
    protected $fillable = [
        'iddorm', 'name_en', 'name_th', 'address', 'email', 'phone', 'rate_water', 'rate_elec', 'vat', 'due', 'die', 'pay', 'pay_limit', 'bank', 'contract', 'logo'
    ];

}
