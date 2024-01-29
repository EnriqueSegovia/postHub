<?php

class LoginDto
{
    public string $usuario;
    public string $contrasena;

    function __construct(string $usuario, string $contrasena)
    {
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }

    public static function fromJson($json)
    {
        $objeto = json_decode($json);


        $usuario = isset($objeto->usuario) ? $objeto->usuario : "";
        $contrasena = isset($objeto->contrasena) ? $objeto->contrasena : "";

        return new LoginDto(
            $usuario,
            $contrasena,
        );
    }
}
