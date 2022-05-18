<?php
// Se configura el autoload de 
spl_autoload_register(function ($class) {
    // Directorios en la carpeta config
    $baseDir = __DIR__;

    // Cambio la diagonal por el slash
    $class = str_replace('\\', '/', $class);

    // Se busca la clase en cada directorio
    $path = $baseDir . '/' . $class . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});
