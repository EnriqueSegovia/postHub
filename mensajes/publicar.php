<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once "menu.php" ?>

    <?php
    $mensaje = MensajeVista::fromBody();
    ?>

    <form method="POST" action="publicar.php">
        <?php if (isset($_POST["Aceptar"])) :  ?>
            <h2>¡Tu mensaje se ha publicado correctamente!</h2>

            <?php include "verMensaje.php" ?>

            <?php
            ServicioMensajes::insertarMensaje($mensaje);
            ?>

            <a class="button" href="index.php">Volver al inicio</a>
        <?php else : ?>
            <h2>Vas a publicar el siguiente mensaje: </h2>
            <?php include "verMensaje.php" ?>

            <div>
                <button class="button" name="Aceptar">Aceptar</button>
                <button class="button" value="Cancelar" formaction="index.php">Cancelar</button>
            </div>
        <?php endif; ?>
        <div><input type="hidden" name="nombreUsuario" value="<?php echo $mensaje->nombreUsuario ?>"></div>
        <div><input type="hidden" name="textoMensaje" value="<?php echo $mensaje->textoMensaje ?>"></div>
        <div><input type="hidden" name="tipoUsuario" value="<?php echo $mensaje->tipoUsuario ?>"></div>

    </form>
</body>

</html>