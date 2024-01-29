<?php

class Autenticacion
{

    const claveUsuario = "usuario";
    const cookieUsuario = "usuario";

    public static function estaAutenticado()
    {
        return isset($_SESSION[self::claveUsuario]);
    }

    public static function obtenerNombreUsuario()
    {
        if (self::estaAutenticado()) {
            return $_SESSION[self::claveUsuario];
        }
        return '';
    }

    public static function autenticar($usuario, $password)
    {
        if (ServicioAutenticacion::validarUsuarioPassword($usuario, $password)) {
            $_SESSION[self::claveUsuario] = $usuario;

            setcookie(self::cookieUsuario, $usuario);

            return true;
        }
        return false;
    }

    public static function obtenerCookieUsuario()
    {
        if (isset($_COOKIE[self::cookieUsuario])) {
            return $_COOKIE[self::cookieUsuario];
        } else {
            return '';
        }
    }
}
