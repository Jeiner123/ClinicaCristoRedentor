<?php
require '../../bd/bd_conexion.php';

$error = false;

if (isset($_GET['estado']))
    $estado = $_GET['estado'];
else $error = true;
if (isset($_GET['usuario']))
    $usuario = $_GET['usuario'];
else $error = true;

if ($error) {
    $data['success'] = false;
    exit( json_encode($data) );
}

$sql = "UPDATE usuario SET estado = " . $estado . " WHERE usuario = '$usuario'";
$result_set = mysqli_query($con, $sql);

$data['success'] = $result_set;
echo json_encode($data);
