<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'name', 'address', 'phone',  'email', 'vat_id', 'status',
    ];
}
