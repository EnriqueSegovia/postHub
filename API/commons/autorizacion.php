<?php

class Autorizacion
{
    public static function verificarApiKEy()
    {
        $UnauthorizedCode = 401;

        $headers = getallheaders();
        if (!isset($headers["ApiKey"]) || !ServicioAutenticacion::validarApiKey($headers["ApiKey"])) {
            http_response_code($UnauthorizedCode);
            exit();
        }
    }
}

Autorizacion::verificarApiKEy();
