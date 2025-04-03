<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    protected $table = 'table_loggings';
    protected $guarded = [
        'id',
    ];
}
