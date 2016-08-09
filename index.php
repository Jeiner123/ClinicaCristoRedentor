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
    <div class="col-md-10 col-md-offset-1" align="center" style="margin-top:25px;">
        <h1>CLÍNICA CRISTO REDENTOR</h1>
    </div>
    <div class="col-md-10 col-md-offset-1" align="center">
        <h2>INTRANET</h2>
    </div>

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
</body>
</html>
