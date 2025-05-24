<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactApiController;

// Ruta pública para consulta o creación del contacto
Route::post('/lookup-or-create-contact', [ContactApiController::class, 'lookupOrCreate']);

// Ruta protegida por Sanctum (ejemplo por defecto)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
