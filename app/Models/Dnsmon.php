<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dnsmon extends Model
{
    /** @use HasFactory<\Database\Factories\DnsmonFactory> */
    use HasFactory;
    protected $table = 'table_dns_mon';
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
