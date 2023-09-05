<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'period',
        'price',
        'plan_plans_id',
        'state',
        'price',
        'url_pdf'
    ];

    protected $primaryKey = 'invoice_id';

    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class,'plan_plans_id');
    }

    
}
