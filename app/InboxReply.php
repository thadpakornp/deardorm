<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InboxReply extends Model {

    protected $table = 'inbox_reply';
    protected $fillable = ['id', 'email', 'inbox'];

}
