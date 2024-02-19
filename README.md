App de prueba de desarrollo para tiendapp

# Inforamación General

-   MySQL: 5.7.36
-   PHP: 7.4.0
-   Laravel: 8.75

# Instalación

-   Wampserver: 3.2.6

Teniendo instalado composer ejecutar el siguiente comando

-   create-project laravel/tiendapp tiendapp

Verificar que el modulo: headers_module esté activado
y en el httpd.conf del servidor agregar este codigo

    <IfModule mod_headers.c>
        Header set Access-Control-Allow-Origin: *
    </IfModule>

Instalar el paquete fruitcake

-   composer require fruitcake/laravel-cors

Comentar las lineas del archivo Kernel.php

-   // \App\Http\Middleware\VerifyCsrfToken::class

y agregar

-   \Fruitcake\Cors\HandleCors::class,

Ejecutar

-   php artisan vendor:publish --tag="cors"

Modificar el archivo cors.php ubicado en: vendor/fruitcake/laravel-cors/conig

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:3000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

Limpiar cache

-   php artisan config:cache

Y ejecutar las migraciones con los seeders

-   php artisan migrate:fresh --seed
