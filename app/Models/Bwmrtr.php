<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bwmrtr extends Model
{
    /** @use HasFactory<\Database\Factories\BwmFactory> */
    use HasFactory;
    protected $table = 'table_bwm_rtr';
    protected $guarded = [
        'id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class , 'id_group');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'id_user');
    }
}
