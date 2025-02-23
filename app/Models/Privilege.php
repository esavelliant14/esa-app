<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class , 'id_group');
    }

    public function permission(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class , 'table_privilege_permissions' , 'id_privilege' , 'id_permission');
    }


}

