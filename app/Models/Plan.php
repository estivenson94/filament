<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'download_speed',
        'upload_speed',
        'price',
    ];

    protected $primaryKey = 'plans_id';

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function installations(): HasMany
    {
        return $this->HasMany(Installation::class);
    }

    
}


