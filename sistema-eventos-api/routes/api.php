<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventoController;
use App\Models\User; // <-- Importamos o modelo User

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ROTAS PÚBLICAS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/eventos', [EventoController::class, 'index']);
Route::get('/eventos/{evento}', [EventoController::class, 'show']);


// ROTAS PARA VERIFICAÇÃO DE E-MAIL (CÓDIGO CORRIGIDO)
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuário não encontrado.'], 404);
    }

    if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return response()->json(['message' => 'Link de verificação inválido.'], 400);
    }

    if ($user->hasVerifiedEmail()) {
        return response()->json(['message' => 'E-mail já verificado.']);
    }

    $user->markEmailAsVerified();

    return response()->json(['message' => 'E-mail verificado com sucesso!']);
})->middleware(['signed'])->name('verification.verify'); // O middleware 'signed' já protege contra manipulação do link

// Rota para reenviar o e-mail de verificação
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Link de verificação reenviado!']);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');


// ROTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // GRUPO DE ROTAS RESTRITAS PARA ORGANIZADORES
    Route::middleware('perfil:Organizador')->group(function () {
        Route::post('/eventos', [EventoController::class, 'store']);
        Route::put('/eventos/{evento}', [EventoController::class, 'update']);
        Route::delete('/eventos/{evento}', [EventoController::class, 'destroy']);
    });
    
});