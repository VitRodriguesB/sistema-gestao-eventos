<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar suas definições para o compartilhamento de
    | recursos de origem cruzada ou "CORS". Isso determina quais operações
    | de origem cruzada podem ser executadas em navegadores da web.
    | Sinta-se à vontade para ajustar essas configurações conforme necessário.
    |
    | Para saber mais: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000', // <-- URL do seu frontend React
        // 'http://localhost:5173', // <-- Adicione esta se usar o Vite, que roda em outra porta
        // 'https://seu-dominio-de-producao.com', // <-- Quando for para produção, adicione a URL final aqui
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];