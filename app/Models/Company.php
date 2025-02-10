<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'table_companies';
    protected $guarded = [
        'id',
    ];
}
