<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'ticket_id',
        // 'user_id',
        'comment',
        
    ];

    // protected $primaryKey = 'id_comment';

    public function tickets() :BelongsTo {
        return $this->belongsTo(Ticket::class);
    }
}

