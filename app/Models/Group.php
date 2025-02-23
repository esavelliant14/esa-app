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
}
