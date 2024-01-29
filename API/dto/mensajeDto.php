<?php

class MensajeDto
{
    public string $id;
    public string $nombreUsuario;
    public string $textoMensaje;
    public string $tipoUsuario;
    public string $fecha;

    function __construct(
        int $id,
        string $nombreUsuario,
        string $textoMensaje,
        string $tipoUsuario,
        string $fecha
    ) {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->textoMensaje = $textoMensaje;
        $this->tipoUsuario = $tipoUsuario;
        $this->fecha = $fecha;
    }

    public static function fromMensaje($mensaje)
    {
        return new MensajeDto(
            $mensaje->id,
            $mensaje->nombreUsuario,
            $mensaje->textoMensaje,
            $mensaje->tipoUsuario,
            $mensaje->fecha->format("c")
        );
    }

    public function toMensaje()
    {
        $fecha = $this->fecha ? new DateTime($this->fecha) : new DateTime();

        return new Mensaje(
            (int)$this->id,
            $this->nombreUsuario,
            $this->textoMensaje,
            $this->tipoUsuario,
            $fecha
        );
    }

    public static function fromJson($json)
    {
        $objeto = json_decode($json);

        $id = isset($objeto->id) ? $objeto->id : "0";
        $nombreUsuario = isset($objeto->nombreUsuario) ? $objeto->nombreUsuario : "";
        $textoMensaje = isset($objeto->textoMensaje) ? $objeto->textoMensaje : "";
        $tipoUsuario = isset($objeto->tipoUsuario) ? $objeto->tipoUsuario : "";
        $fecha = isset($objeto->fecha) ? $objeto->fecha : "";

        return new MensajeDto(
            $id,
            $nombreUsuario,
            $textoMensaje,
            $tipoUsuario,
            $fecha
        );
    }
}
