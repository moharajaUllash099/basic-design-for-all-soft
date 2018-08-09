<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $timestamps = true;

    protected $fillable = [
        'name','uid', 'role', 'msg',  'status',
    ];
}
