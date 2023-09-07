<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'plan_id',
        'apply_invoice',
        'state',
        'discount',
    ];

    public function clients(): BelongsTo
{
    return $this->belongsTo(Client::class,'client_id');
}

public function plans(): BelongsTo
{
    return $this->belongsTo(Plan::class,'plan_id');
}
}

