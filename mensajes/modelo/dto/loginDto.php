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
}
