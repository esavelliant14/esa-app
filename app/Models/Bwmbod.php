<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bwmbod extends Model
{
    use HasFactory;
    protected $table = 'table_bwm_bod';
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
