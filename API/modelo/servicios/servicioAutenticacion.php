<?php

class ServicioAutenticacion
{

    public static function validarUsuarioPassword($usuario, $password)
    {
        $resultado = MySqlDB::consultaLectura("SELECT contrasena FROM usuarios WHERE nombre = ?", $usuario);

        $hash = hash('sha256', $password);

        return count($resultado) == 1 && $resultado[0]["contrasena"] == $hash;
    }

    public static function validarApiKey($apiKey)
    {
        return $apiKey == "abcd1234";
    }
}
