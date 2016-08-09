<?php
// Show a message if the login fails
if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
} else {
    $opc = 0;
}
?>
<div class="col-md-12">
    <div class="login-box" style="margin-top:30px;margin-bottom:-50px;">
        <div class="login-box-body">
            <p class="login-box-msg">Formulario de registro</p>

            <div class="mensaje text-red">
            <?php if (base64_decode($opc) == '1') { ?>
                <span class="glyphicon glyphicon-warning-sign"></span>
                <b>Datos ingresados no válidos</b>
            <?php } ?>
            <?php if (base64_decode($opc) == '2') { ?>
                <span class="glyphicon glyphicon-warning-sign"></span>
                <b>La cuenta está inactiva</b>
            <?php } ?>
            </div>

            <form action="modulos/bd/bd_iniciar_sesion.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" name="txtUsuario" id="txtUsuario" class="form-control" placeholder="Nombre de usuario">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="txtClave" id="txtClave" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                </div>
            </form>
            <br>
            <a href="./index.php">Iniciar sesión</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div><!-- /.col-md-12 -->
