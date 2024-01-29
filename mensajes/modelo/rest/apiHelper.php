<?php

class RespuestaHTTP
{
    public string $cuerpo;
    public int $codigoRespuesta;
}

class ApiHelper
{

    private static function getApiKey()
    {
        static $config = null;
        if (!$config) {
            $config = parse_ini_file(__DIR__ . "/../../config.ini");
        }
        return $config["apiKey"];
    }

    public static function getApiUrl()
    {
        static $config = null;
        if (!$config) {
            $config = parse_ini_file(__DIR__ . "/../../config.ini");
        }
        return $config["apiUrl"];
    }

    public static function solicitar($url, $metodo, $cuerpo = null)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $metodo);

        $apiKey = self::getApiKey();
        $headers = array("ApiKey: $apiKey");

        if ($cuerpo) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($cuerpo));
            array_push($headers, "content-Type: application/json");
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $resultado = curl_exec($curl);

        $respuesta = new RespuestaHTTP();
        $respuesta->cuerpo = $resultado;
        $respuesta->codigoRespuesta = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        return $respuesta;
    }
}
