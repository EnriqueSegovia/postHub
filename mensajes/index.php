<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once "menu.php" ?>

    <?php

    if (!Autenticacion::estaAutenticado()) {
        header("Location: login/login.php");
        exit();
    }
    $mensaje = MensajeVista::fromBody();

    $mensajes = ServicioMensajes::obtenerMensajes();
    ?>

    <form method="POST" action="publicar.php">
        <div class="usuario">
            <p>Nombre del usuario</p>
            <input type="text" name="nombreUsuario" value="<?php echo $mensaje->nombreUsuario ?>">
        </div>
        <div class="select-usuario">
            <p>Usuario normal/pago</p>
            <select name="tipoUsuario">
                <option value="pago" <?php if ($mensaje->tipoUsuario == "pago") echo "selected" ?>>Pago</option>
                <option value="nopago" <?php if ($mensaje->tipoUsuario == "nopago") echo "selected" ?>>No pago</option>
            </select>
        </div>
        <div class="mensaje">
            <p>Texto del mensaje</p>
            <input type="text" name="textoMensaje" value="<?php echo $mensaje->textoMensaje ?>">
        </div>

        <div>
            <button class="button">Publicar</button>
        </div>

    </form>

    <h2>Listado de Mensajes</h2>
    <div class="lista-mensajes">
        <?php
        if (count($mensajes) > 0) {
            foreach ($mensajes as $mensaje) {
                include "verMensaje.php";
            }
        } else {
            echo "No hay mensajes";
        }
        ?>
    </div>

</body>

</html>