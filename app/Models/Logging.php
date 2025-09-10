<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logging extends Model
{
    protected $table = 'table_loggings';
    protected $guarded = [
        'id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class , 'id_group');
    }

}
