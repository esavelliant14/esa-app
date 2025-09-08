<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    //
    protected $table = 'table_groups';
    protected $guarded = [
        'id',
    ];
    public function user(): HasMany
    {
        return $this->hasMany(user::class);
    }
    public function privilege(): HasMany
    {
        return $this->hasMany(Privilege::class);
    }
    public function bwmbw(): HasMany
    {
        return $this->hasMany(bwm::class);
    }
    public function bwmrtr(): HasMany
    {
        return $this->hasMany(bwmrtr::class);
    }
    public function bwmclient(): HasMany
    {
        return $this->hasMany(bwmclient::class);
    }
}
