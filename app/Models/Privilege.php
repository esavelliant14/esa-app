<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class , 'id_company');
    }
}

