<?php
  session_start();
  if(isset($_SESSION['DNI'])){
      header('Location: view/');
  }
  if(!isset($_GET['opc'])){
    $opc = 0;
  }
  else{
    $opc = $_GET['opc'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clínica Cristo Redentor  | Iniciar sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/admin.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <link rel="shortcut icon" href="img/logo.png">
<style type="text/css">
  body{

  }
  h1{
    /*margin: 20px;*/
    font-family: cambria; 
    font-size:40px;
    font-weight: bold;
    color:#1990CE;
  }
  h2{
    /*margin: 15px;*/
    font-size:30px;
    font-weight: bold;
    font-family: cambria;
    color:#595959;
  }
  #logos{    
    background: #fff;
  }
</style>


</head>
<body class="hold-transition login-page">
  <div id="logos" class="container-fluid" style="padding:5px;">
    <div class="row">
      <div  class="col-md-6" align="center">
        <img  height="70" src="img/logo2.png" >
      </div>
      <div class="col-md-6" align="center">
        <img height="70" src="img/logo3.png">
      </div>
    </div>     
  </div><!-- logos -->
  <div class="row" >
    <div class="col-md-10 col-md-offset-1" align="center" style="margin-top:25px;">
      <h1>CLÍNICA CRISTO REDENTOR</h1>
    </div>
    <div class="col-md-10 col-md-offset-1" align="center" >
      <h2>INTRANET</h2>
    </div>
    <div class="col-md-12">
      <div class="login-box" style="margin-top:30px;margin-bottom:-50px;">
        <div class="login-box-body">
          <p class="login-box-msg">Bienvenido</p>
          <div class="mensaje text-red">
            <?php 
              if(base64_decode($opc)=='1'){
                echo '<span class="glyphicon glyphicon-warning-sign"></span>
                      <b>Datos ingresados no válidos</b>';
              }
              if(base64_decode($opc)=='2'){
                echo '<span class="glyphicon glyphicon-warning-sign"></span>
                      <b>La cuenta está inactiva</b>';
              }
            ?>
          </div>         

          <form action="modulos/bd/bd_iniciar_sesion.php" method="post">
            <div class="form-group has-feedback">
              <input type="text" name="txtUsuario" id="txtUsuario"class="form-control" placeholder="Nombre de usuario">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="txtClave" id="txtClave" class="form-control" placeholder="Contraseña">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox">Recordarme
                  </label>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
              </div>
            </div>
          </form>
          <br>
          <a href="#">Olvidé mi contraseña</a><br>
          <a href="#" class="text-center">Quiero registrarme...</a>

        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
    </div>
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
