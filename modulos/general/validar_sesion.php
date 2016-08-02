<?php 
  session_start();
  $usuario = "Invitado";
  if(!isset($_SESSION['usuarioClinica'])){ 
    header("Location:../../index.php");
  }
  $usuario = $_SESSION['usuarioClinica'];
?>