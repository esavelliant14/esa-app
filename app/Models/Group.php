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
        return $this->hasMany(privilege::class);
    }
    public function bwmbw(): HasMany
    {
        return $this->hasMany(Bwm::class);
    }
    public function bwmrtr(): HasMany
    {
        return $this->hasMany(Bwmrtr::class);
    }
    public function bwmclient(): HasMany
    {
        return $this->hasMany(Bwmclient::class);
    }

    public function bwmbod(): HasMany
    {
        return $this->hasMany(Bwmbod::class);
    }

    public function logging(): HasMany
    {
        return $this->hasMany(Logging::class);
    }
}
