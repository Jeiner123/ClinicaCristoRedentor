<?php
// Show a message if the login fails
if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
} else {
    $opc = 0;
}
?>
<div class="col-md-6 col-md-offset-3">
    <div style="margin-top:30px;margin-bottom:-50px;">
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

            <form action="modulos/general/registrar_persona.php" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="DNI">DNI</label>
                        <input type="text" name="DNI" id="DNI" class="form-control" onkeypress="return soloNumeroEntero(event);">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="apPaterno">Apellido paterno</label>
                        <input type="text" name="apPaterno" id="apPaterno" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apMaterno">Apellido materno</label>
                        <input type="text" name="apMaterno" id="apMaterno" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sexo">Sexo</label>
                        <p>
                            <input type="radio" name="sexo" value="M" class="form-control" title="Hombre" checked> Masculino
                            <input type="radio" name="sexo" value="F" class="form-control" title="Mujer"> Femenino
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="correoPersonal">Correo electrónico</label>
                        <input type="text" name="correoPersonal" id="correoPersonal" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="telefono1">Teléfono (1)</label>
                        <input type="text" name="telefono1" id="telefono1" class="form-control" onkeypress="return soloTelefono(event);">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipoTelefono1">Tipo de teléfono (1)</label>
                        <select class="form-control input-sm" id="tipoTelefono1" name="tipoTelefono1">
                            <option value="0">-- Seleccionar --</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="telefono2">Teléfono (2)</label> <em>Opcional</em>
                        <input type="text" name="telefono2" id="telefono2" class="form-control" onkeypress="return soloTelefono(event);">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipoTelefono2">Tipo de teléfono (2)</label> <em>Opcional</em>
                        <select class="form-control input-sm" id="tipoTelefono2" name="tipoTelefono2">
                            <option value="0">-- Seleccionar --</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="validarPersona();" type="button" class="btn btn-primary btn-block btn-flat">
                            Registrarme
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <a href="./index.php">Iniciar sesión</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div><!-- /.col-md-12 -->
