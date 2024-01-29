<?php

class ServicioMensajes
{

    private static function getApiUrl()
    {
        $url = ApiHelper::getApiUrl();
        $url .= "mensajes.php";

        return $url;
    }

    public static function insertarMensaje($mensaje)
    {
        $url = self::getApiUrl();

        $mensajeDto = MensajeDto::fromMensajeVista($mensaje);

        $respuesta = ApiHelper::solicitar($url, "POST", $mensajeDto);
        if ($respuesta->codigoRespuesta != 200) {
            // TODO logs
        }
    }

    public static function obtenerMensajes()
    {
        $url = self::getApiUrl();

        $respuesta = ApiHelper::solicitar($url, "GET");

        $listado = json_decode($respuesta->cuerpo, true);

        $retorno = array();
        foreach ($listado as $mensajeJson) {
            $mensajeDto = MensajeDto::fromJson($mensajeJson);
            array_push($retorno, $mensajeDto->toMensajeVista());
        }

        return $retorno;
    }

    public static function actualizarMensaje($mensaje)
    {
        $url = self::getApiUrl();

        $mensajeDto = MensajeDto::fromMensajeVista($mensaje);

        $respuesta = ApiHelper::solicitar($url, "PUT", $mensajeDto);
        if ($respuesta->codigoRespuesta != 200) {
            // TODO logs
        }
    }
    public static function eliminarMensaje($id)
    {
        $url = self::getApiUrl();
        $url .= "?id=" . $id;

        $respuesta = ApiHelper::solicitar($url, "DELETE");
        if ($respuesta->codigoRespuesta != 200) {
            // TODO logs
        }
    }

    public static function buscarMensaje($id)
    {
        $url = self::getApiUrl();
        $url .= "?id=" . $id;

        $respuesta = ApiHelper::solicitar($url, "GET");

        $mensajeDto = MensajeDto::fromJson(json_decode($respuesta->cuerpo, true));

        return $mensajeDto->toMensajeVista();
    }
}
