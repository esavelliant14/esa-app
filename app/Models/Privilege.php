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

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class , 'id_company');
    }

    public function permission(): HasMany
    {
        return $this->hasMany(User::class , 'id_privilege');
    }


}

