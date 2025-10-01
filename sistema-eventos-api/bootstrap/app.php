<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // AQUI ESTÁ A CORREÇÃO:
        // Registramos o apelido 'perfil' para a nossa classe CheckPerfil.
        $middleware->alias([
            'perfil' => \App\Http\Middleware\CheckPerfil::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();