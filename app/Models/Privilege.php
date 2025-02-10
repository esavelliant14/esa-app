<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Privilege extends Model
{
    //
    protected $table = 'table_privileges';
    protected $guarded = [
        'id',
    ];

    public function login(): HasMany
    {
        return $this->hasMany(Login::class);
    }
}

