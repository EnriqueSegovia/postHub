<?php

class ServicioMensajes
{
    public static function insertarMensaje($mensaje)
    {
        $daoMensajes = new DaoMensajesMySql();
        $daoMensajes->create($mensaje);
    }

    public static function obtenerMensajes()
    {
        $daoMensajes = new DaoMensajesMySql();
        return $daoMensajes->read();
    }

    public static function actualizarMensaje($mensaje)
    {
        $daoMensajes = new DaoMensajesMySql();
        $daoMensajes->update($mensaje);
    }
    public static function eliminarMensaje($id)
    {
        $daoMensajes = new DaoMensajesMySql();
        $daoMensajes->delete($id);
    }

    public static function buscarMensaje($id)
    {
        $daoMensajes = new DaoMensajesMySql();
        return $daoMensajes->search($id);
    }
}
