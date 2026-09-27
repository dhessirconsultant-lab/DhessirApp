<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SolicitudController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Solo se vuelve a páginas propias que contienen el formulario
        $volver = route($request->input('origen') === 'contacto' ? 'contacto' : 'inicio').'#agenda';

        // Campo trampa: si viene lleno es un bot. Respondemos como si todo saliera bien.
        if ($request->filled('sitio_web')) {
            return redirect()->to($volver)->with('solicitud_enviada', true);
        }

        $validador = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'min:3', 'max:120'],
            'correo' => ['required', 'email:rfc', 'max:160'],
            'whatsapp' => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s\-()]{7,20}$/'],
            'punto' => ['required', Rule::in(array_keys(Solicitud::PUNTOS))],
            'consentimiento' => ['accepted'],
        ], [
            'nombre.required' => 'Escribe tu nombre completo.',
            'nombre.min' => 'Escribe tu nombre completo.',
            'nombre.max' => 'El nombre no puede tener más de 120 caracteres.',
            'correo.required' => 'Escribe tu correo electrónico.',
            'correo.email' => 'Escribe un correo válido, por ejemplo tucorreo@ejemplo.com.',
            'correo.max' => 'El correo no puede tener más de 160 caracteres.',
            'whatsapp.required' => 'Escribe tu número de WhatsApp.',
            'whatsapp.regex' => 'Escribe solo números, por ejemplo +57 315 000 0000.',
            'whatsapp.max' => 'El número no puede tener más de 20 caracteres.',
            'punto.required' => 'Elige en qué punto te estás quedando.',
            'punto.in' => 'Elige una de las opciones de la lista.',
            'consentimiento.accepted' => 'Necesitamos tu autorización para tratar tus datos y contactarte.',
        ]);

        // Con errores se vuelve al formulario (no al inicio de la página) conservando lo escrito
        if ($validador->fails()) {
            return redirect()->to($volver)->withErrors($validador)->withInput($request->except('sitio_web'));
        }

        $datos = $validador->validated();

        Solicitud::create([
            'nombre' => $datos['nombre'],
            'correo' => $datos['correo'],
            'whatsapp' => $datos['whatsapp'],
            'punto' => $datos['punto'],
            'consentimiento_at' => now(),
        ]);

        return redirect()->to($volver)->with('solicitud_enviada', true);
    }
}
