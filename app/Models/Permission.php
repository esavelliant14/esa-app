<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    protected $table = 'table_permissions';
    protected $guarded = [
        'id',
    ];

    public function privilege(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
