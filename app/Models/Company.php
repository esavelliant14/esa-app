<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    //
    protected $table = 'table_companies';
    protected $guarded = [
        'id',
    ];
    public function login(): HasMany
    {
        return $this->hasMany(Login::class);
    }
    public function privilege(): HasMany
    {
        return $this->hasMany(Privilege::class);
    }
}
