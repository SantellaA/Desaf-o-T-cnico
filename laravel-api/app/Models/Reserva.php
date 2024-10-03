<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';

    protected $fillable = [
        'hora',
        'fecha'
    ];

    public function espacio(): BelongsTo{
        return $this->belongsTo(Espacio::class);
    }

    public function role(): BelongsTo{
        return $this->belongsTo(Role::class);
    }
}
