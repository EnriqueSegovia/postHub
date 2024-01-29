<?php include_once "modelo/entidades/mensajeVista.php" ?>
<?php include_once "modelo/servicios/servicioMensajes.php" ?>
<?php include_once "login/autenticacion.php" ?>
<?php include_once "modelo/servicios/servicioAutenticacion.php" ?>
<?php include_once "modelo/rest/apiHelper.php" ?>
<?php include_once "modelo/dto/mensajeDto.php" ?>

<?php
session_start();

if (!Autenticacion::estaAutenticado()) {
    header("Location: login/login.php");
    exit();
}
?>
<div class="menu">
    <p class="usuario-login">
        Usuario:
        <?php echo Autenticacion::obtenerNombreUsuario(); ?>
    </p>
    <a class="button" href="login/logout.php">Cerrar sesión</a>
    <?php include "cabecera.html" ?>
</div>