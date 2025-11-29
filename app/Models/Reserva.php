<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    /**
     * @return BelongsTo Me devuelve la mesa a la que pertenece la reserva
     */
    public function sala(): BelongsTo{
        return $this->belongsTo(Sala::class);
    }

    /**
     * @return BelongsTo Me devuelve el usuario que ha hecho la reserva
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
