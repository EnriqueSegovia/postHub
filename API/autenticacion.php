<?php

include_once "modelo/servicios/servicioAutenticacion.php";
include_once "modelo/mysql/mysqldb.php";
include_once "dto/loginDto.php";
include_once "commons/autorizacion.php";

$BadRequestCode = 400;
$MethodNotAllowedCode = 405;

$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo) {
    case "POST":
        $cuerpo = file_get_contents("php://input");
        if ($cuerpo) {
            $loginDto = LoginDto::fromJson($cuerpo);
            if (!ServicioAutenticacion::validarUsuarioPassword($loginDto->usuario, $loginDto->contrasena)) {
                http_response_code($BadRequestCode);
            }
        } else {
            http_response_code($BadRequestCode);
        }
        break;
    default:
        http_response_code($MethodNotAllowedCode);
        break;
}
