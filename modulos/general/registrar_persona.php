<?php

if (isset($_POST['nombres']))
    $nombres = $_POST['nombres'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['DNI']))
    $DNI = $_POST['DNI'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['apPaterno']))
    $apPaterno = $_POST['apPaterno'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['apMaterno']))
    $apMaterno = $_POST['apMaterno'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['fechaNacimiento']))
    $fechaNacimiento = $_POST['fechaNacimiento'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['sexo']))
    $sexo = $_POST['sexo'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['correoPersonal']))
    $correoPersonal = $_POST['correoPersonal'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['direccion']))
    $direccion = $_POST['direccion'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['telefono1']))
    $telefono1 = $_POST['telefono1'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['tipoTelefono1']))
    $tipoTelefono1 = $_POST['tipoTelefono1'];
else header('Location: ../../index.php?option=register&msg=1');

if (isset($_POST['telefono2'])) {
    $telefono2 = $_POST['telefono2'];
    if (isset($_POST['tipoTelefono2']))
        $tipoTelefono2 = $_POST['tipoTelefono2'];
    else header('Location: ../../index.php?option=register&msg=1');
}

require '../bd/bd_conexion.php';

$sql = "INSERT INTO Persona (DNI, nombres, apPaterno, apMaterno, fechaNacimiento, sexo, telefono1, tipoTelefono1, telefono2, tipoTelefono2, correoPersonal, direccion, timestamp) ";
$sql .= "VALUES ('$DNI', '$nombres', '$apPaterno', '$apMaterno', '$fechaNacimiento', '$sexo', '$telefono1', $tipoTelefono1, ".($telefono2?"'$telefono2'":"NULL").", ".($tipoTelefono2?"'$tipoTelefono2'":"NULL").", '$correoPersonal', '$direccion', NOW())";

$result_set = mysqli_query($con, $sql);

if ($result_set)
    header('Location: ../../index.php?option=register&msg=2');
else header('Location: ../../index.php?option=register&msg=1');
