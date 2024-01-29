<?php
class DaoMensajesMySql
{
    public function create($mensaje)
    {
        $tipoUsuario = $mensaje->tipoUsuario == "pago" ?: 0;
        $fecha = $mensaje->fecha->format("c");
        $consulta = "INSERT INTO mensajes (nombre, texto, depago, fecha)
                    VALUES (?, ?, ?, ?)";

        MySqlDB::consultaEscritura($consulta, $mensaje->nombreUsuario, $mensaje->textoMensaje, $tipoUsuario, $fecha);
    }

    public function read()
    {
        $resultado = MySqlDB::consultaLectura("SELECT * FROM mensajes");

        $retorno = array();
        foreach ($resultado as $fila) {
            $mensaje = $this->mensajeFromValueArray($fila);
            array_push($retorno, $mensaje);
        }
        return $retorno;
    }

    public function update($mensaje)
    {
        $tipoUsuario = $mensaje->tipoUsuario == "pago" ?: 0;
        $fecha = $mensaje->fecha->format("c");
        $consulta = "UPDATE mensajes SET nombre = ?, texto = ?, depago = ?, fecha = ? WHERE id = ?";

        MySqlDB::consultaEscritura($consulta, $mensaje->nombreUsuario, $mensaje->textoMensaje, $tipoUsuario, $fecha, $mensaje->id);
    }

    public function delete($id)
    {
        $consulta = "DELETE mensajes WHERE id = ?";

        MySqlDB::consultaEscritura($consulta, $id);
    }

    public function search($id)
    {
        $resultado = MySqlDB::consultaLectura("SELECT * FROM mensajes WHERE id = ?", $id);
        if (count($resultado) < 1) {
            return null;
        } else {
            return $this->mensajeFromValueArray($resultado[0]);
        }
    }

    private function mensajeFromValueArray($fila)
    {
        $tipoUsuario = $fila["depago"] ? "pago" : "nopago";
        $fecha = new DateTime($fila["fecha"]);
        return new Mensaje($fila["id"], $fila["nombre"], $fila["texto"], $tipoUsuario, $fecha);
    }
}
