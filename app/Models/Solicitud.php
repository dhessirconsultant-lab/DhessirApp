<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Solicitud de sesión diagnóstica enviada desde el formulario de agendamiento.
 */
class Solicitud extends Model
{
    protected $table = 'solicitudes';

    /** Opciones del campo "¿En qué punto te estás quedando?" */
    public const PUNTOS = [
        'hv' => 'Mi hoja de vida no pasa los filtros',
        'entrevista' => 'Llego a la entrevista y me quedo ahí',
        'ruta' => 'No sé para qué debería estar aplicando',
        'otro' => 'Todavía no lo tengo claro',
    ];

    protected $fillable = [
        'nombre',
        'correo',
        'whatsapp',
        'punto',
        'consentimiento_at',
    ];

    protected function casts(): array
    {
        return [
            'consentimiento_at' => 'datetime',
        ];
    }
}
