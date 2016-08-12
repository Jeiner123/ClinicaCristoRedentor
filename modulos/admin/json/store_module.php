<?php
require '../../bd/bd_conexion.php';

$error = false;

if (isset($_POST['nombre']))
    $nombre = $_POST['nombre'];
else $error = true;
if (isset($_POST['folder']))
    $folder = $_POST['folder'];
else $error = true;

if ($error) {
    $data['success'] = false;
    exit( json_encode($data) );
}

$sql = "INSERT INTO modules (nombre, folder) VALUES ('$nombre', '$folder')";
$result_set = mysqli_query($con, $sql);

$data['success'] = $result_set;
echo json_encode($data);
