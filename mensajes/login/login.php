<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include "../cabecera.html" ?>
    <?php include "autenticacion.php" ?>
    <?php include_once "../modelo/servicios/servicioAutenticacion.php" ?>
    <?php include_once "../modelo/dto/loginDto.php" ?>
    <?php include_once "../modelo/rest/apiHelper.php" ?>

    <?php
    session_start();

    if (Autenticacion::estaAutenticado()) {
        header("Location: ../index.php");
        exit();
    }

    if (isset($_POST["usuario"]) && isset($_POST["password"])) {
        if (Autenticacion::autenticar($_POST["usuario"], $_POST["password"])) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Usuario y/o contraseña incorrectos";
        }
    }
    ?>

    <form method="POST" action="login.php">
        <div class="usuario">
            <p>Usuario</p>
            <input type="text" name="usuario" value="<?php echo Autenticacion::obtenerCookieUsuario() ?>" />
        </div>
        <div class="mensaje">
            <p>Contraseña</p>
            <input type="password" name="password">
        </div>

        <div>
            <button class="button">Iniciar sesión</button>
        </div>
    </form>

</body>

</html>