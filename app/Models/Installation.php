<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installation extends Model
{
    use HasFactory;

    protected $fillable = [
        'installation_date',
        'speed',
        'plan_id',
        'address',
        'neighborhood',
        'client_id',
        'wifi',
        'wifi_password',
        'ppoe',
        'ppoe_password',
        'ip',
        'device_id'
    ];

    public function devices(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'device_id');
    }


    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }

    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
