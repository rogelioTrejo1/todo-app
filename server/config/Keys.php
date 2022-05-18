<?php

namespace config;

use Symfony\Component\Dotenv\Dotenv;

/**
 * Configuracion de variables de entorno para el uso de la
 * aplicacion en produccion y desarrollo
 */
class Keys
{
    /**
     * Rotorna la variable de entorno correspondiente
     * @param string $key Nombre de la variable de entorno
     * @return string Valor de la variable de entorno
     */
    public static function getKey($key): string
    {
        // Se crea una instancia de Dotenv y la carga de las variables de entorno
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.env');

        // Se crean los entonros de variables
        $modes = [
            "dev" => "DEV",
            "test" => "TEST"
        ];

        // Obtengo el entorno de la aplicacion
        $enviroment = isset($_ENV['APP_ENV']) ? $_ENV['APP_ENV'] : "prod";

        // Se retorna la variable de entorno
        return isset($modes[$enviroment]) ? $_ENV["{$key}_{$modes[$enviroment]}"] : $_ENV[$key];
    }
}
