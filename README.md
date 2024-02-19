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

Comentar las lineas del archivo Kernel.php

-   // \App\Http\Middleware\VerifyCsrfToken::class

Y reiniciar el servidor

Y ejecutar las migraciones con los seeders

-   php artisan migrate:fresh --seed
