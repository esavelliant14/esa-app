<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivilegePermission extends Model
{
    protected $table = 'table_privilege_permissions';
    protected $guarded = [
        'id',
    ];
    public function privilege(): BelongsTo
    {
        return $this->belongsTo(Privilege::class , 'id_privilege');
    }   
    
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class , 'id_permission');
    }
}
