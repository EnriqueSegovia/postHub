<?php

class ServicioAutenticacion
{

    public static function validarUsuarioPassword($usuario, $password)
    {
        try {
            $url = ApiHelper::getApiUrl();
            $url .= "autenticacion.php";

            $loginDto = new LoginDto($usuario, $password);

            $respuesta = ApiHelper::solicitar($url, "POST", $loginDto);

            return $respuesta->codigoRespuesta == 200;
        } catch (Exception) {
            throw new Exception("Ha ocurrido algo");
        }
    }
}
