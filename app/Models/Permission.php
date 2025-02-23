<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    protected $table = 'table_permissions';
    protected $guarded = [
        'id',
    ];

    public function privilege(): BelongsToMany
    {
        return $this->belongsToMany(Privilege::class , 'table_privilege_permission' , 'id_privilege' , 'id_permission');
    }
}
