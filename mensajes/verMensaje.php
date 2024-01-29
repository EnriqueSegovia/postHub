<?php if (isset($mensaje)) : ?>
    <div class="contenedor">

        <span class="fecha">
            <?php echo $mensaje->fecha->format("d/M/y H:i") ?>
        </span>

        <div class="info-usuario">
            <p>
                Nombre de usuario:
            </p>
            <p>
                <?php echo $mensaje->nombreUsuario; ?>
            </p>
            <?php if ($mensaje->tipoUsuario == "pago") : ?>
                <img class="usuarioPago" src="img/216411_star_icon.png">
            <?php endif; ?>
        </div>

        <div class="mensaje">
            <p>Mensaje: </p>
            <span><?php echo $mensaje->textoMensaje; ?></span>
        </div>
    </div>
<?php endif; ?>