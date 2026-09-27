<?php

use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'paginas.inicio')->name('inicio');
Route::view('/metodo', 'paginas.metodo')->name('metodo');
Route::view('/planes', 'paginas.planes')->name('planes');
Route::view('/nosotros', 'paginas.nosotros')->name('nosotros');
Route::view('/contacto', 'paginas.contacto')->name('contacto');
Route::view('/politica-de-datos', 'paginas.politica')->name('politica');

// Máximo 5 envíos por minuto desde una misma IP
Route::post('/solicitudes', [SolicitudController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('solicitudes.store');
