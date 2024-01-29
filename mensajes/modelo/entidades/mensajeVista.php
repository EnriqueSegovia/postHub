<?php

class MensajeVista
{
    public int $id;
    public string $nombreUsuario;
    public string $textoMensaje;
    public string $tipoUsuario;
    public DateTime $fecha;

    function __construct(int $id, string $nombreUsuario, string $textoMensaje, string $tipoUsuario, DateTime $fecha)
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->textoMensaje = $textoMensaje;
        $this->tipoUsuario = $tipoUsuario;
        $this->fecha = $fecha;
    }

    public static function fromBody()
    {
        $fecha = new DateTime();
        if (isset($_POST["nombreUsuario"]) && isset($_POST["textoMensaje"]) && isset($_POST["tipoUsuario"])) {
            return new MensajeVista(0, $_POST["nombreUsuario"], $_POST["textoMensaje"], $_POST["tipoUsuario"], $fecha);
        } else {
            return new MensajeVista(0, "", "", "nopago", $fecha);
        }
    }
}
