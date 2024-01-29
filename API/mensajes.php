<?php

include_once "modelo/servicios/servicioAutenticacion.php";
include_once "modelo/mysql/mysqldb.php";
include_once "modelo/dao/daoMensajesMySql.php";
include_once "modelo/entidades/mensaje.php";
include_once "modelo/servicios/servicioMensajes.php";
include_once "dto/mensajeDto.php";
include_once "commons/autorizacion.php";

$BadRequestCode = 400;
$NotFoundCode = 404;
$MethodNotAllowedCode = 405;

$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo) {
    case "POST":
        $cuerpo = file_get_contents("php://input");
        if ($cuerpo) {
            $mensajeDto = MensajeDto::fromJson($cuerpo);

            $mensaje = $mensajeDto->toMensaje();
            ServicioMensajes::insertarMensaje($mensaje);
        } else {
            http_response_code($BadRequestCode);
        }
        break;
    case "GET":
        if (isset($_GET["id"]) && $_GET["id"] != "") {
            $id = $_GET["id"];
            $mensaje = ServicioMensajes::buscarMensaje($id);

            if ($mensaje) {
                header("content-Type: application/json");
                echo json_encode(MensajeDto::fromMensaje($mensaje));
            } else {
                http_response_code($NotFoundCode);
            }
        } else {
            $mensajes = ServicioMensajes::obtenerMensajes();
            $listaMensajesDto = array();
            foreach ($mensajes as $mensaje) {
                array_push($listaMensajesDto, MensajeDto::fromMensaje($mensaje));
            }
            echo json_encode($listaMensajesDto);
        }
        break;
    case "PUT":
        $cuerpo = file_get_contents("php://input");
        if ($cuerpo) {
            $mensajeDto = MensajeDto::fromJson($cuerpo);

            $mensaje = $mensajeDto->toMensaje();
            ServicioMensajes::actualizarMensaje($mensaje);
        } else {
            http_response_code($BadRequestCode);
        }
        break;
    case "DELETE":
        if (isset($_GET["id"]) && $_GET["id"] != "") {
            $id = $_GET["id"];
            ServicioMensajes::eliminarMensaje($id);
        } else {
            http_response_code($BadRequestCode);
        }
        break;
    default:
        http_response_code($MethodNotAllowedCode);
        break;
}
