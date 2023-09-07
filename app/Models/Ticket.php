<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    const STATUS = [
        'Abierto' => 'Abierto',
        'Cerrado' => 'Cerrado',
        'Archivado' => 'Archivado'
    ];

    const PRIORITY = [
        'Baja' => 'Baja',
        'Media' => 'Media',
        'Alta' => 'Alta'
    ];

    protected $fillable = [
       
        'title',
        'description',
        'priority',
        'status',
        'is_resolved',
        'comment',
        'assigned_by',
        'assigned_to'

    ];


    public function assignedBy() {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments() :HasMany {
        return $this->hasMany(Comment::class);
    }

}
