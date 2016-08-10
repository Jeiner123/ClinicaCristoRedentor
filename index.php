<?php
session_start();

// Redirect to the panel if the user is already authenticated
if (isset($_SESSION['usuario']))
  header('Location: modulos/general/perfil.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clínica Cristo Redentor | Iniciar sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionic Icons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/admin.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <link rel="shortcut icon" href="img/logo.png">
    <style type="text/css">
        h1 {
            font-family: 'cambria', Georgia, Arial, serif;
            font-size: 40px;
            font-weight: bold;
            color: #1990CE;
        }

        h2 {
            font-size: 30px;
            font-weight: bold;
            font-family: 'cambria', Georgia, Arial, serif;
            color: #595959;
        }

        #logos {
            background: #fff;
        }
    </style>
</head>

<body class="hold-transition login-page">

<!-- Logos -->
<div id="logos" class="container-fluid" style="padding:5px;">
    <div class="row">
        <div class="col-md-6" align="center">
            <img height="70" src="img/logo2.png">
        </div>
        <div class="col-md-6" align="center">
            <img height="70" src="img/logo3.png">
        </div>
    </div>
</div>

<div class="row" >
    <?php
    if (isset($_GET['option']) && $_GET['option']=='register')
        include 'register.php';
    else
        include 'login.php'

    ?>
</div>

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<?php if (isset($_GET['option']) && $_GET['option']=='register') { ?>
    <script src="modulos/js/script.js"></script>
    <script>
        function cargarCboTipoTelefono() {
            opc = 'CC_TT_01';
            $.ajax({
                type: 'POST',
                data:'opc='+opc,
                url: './modulos/bd/bd_operaciones.php',
                success: function(rpta){
                    $('#tipoTelefono1').html(rpta);
                    $('#tipoTelefono2').html(rpta);
                    return true;
                },
                error: function(rpta){
                    alert(rpta);
                }
            });
        }
        cargarCboTipoTelefono();

        function validarPersona() {

            inputObligatorio('#nombres', 4);
            inputMismoValor('#DNI', 8);
            inputObligatorio('#apPaterno', 3);
            inputObligatorio('#apMaterno', 3);

            inputMismoValor('#fechaNacimiento', 10);

            inputCorreo('#correoPersonal');
            inputObligatorio('#direccion', 6);

            inputObligatorio('#telefono1', 6);
            comboObligatorio('#tipoTelefono1', 0);

            if ($('#telefono2').val().length > 0)
                comboObligatorio('#tipoTelefono2', 0);

            if($('.has-error').length > 0) {
                alert("Verifique los datos ingresados");
                return false;
            } else
                document.form.submit();

            /*
            abrirCargando();
            $.ajax({
                type: 'POST',
                data: formData,
                url: url,
                contentType :false,
                processData: false,
                success: function(rpta){
                    if(rpta==1){
                        alert("Registro exitoso");
                        limpiarForm(form);
                        cerrarModal('#modalRegPersonal');
                        cargarTablaPersonal();
                        cerrarCargando();
                        return true;
                    }
                    alert(rpta);
                    cerrarCargando();
                },
                error: function(rpta){
                    alert(rpta);
                    cerrarCargando();
                }
            });*/
        }
    </script>
<?php } ?>
</body>
</html>
