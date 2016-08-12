<?php
require '../../bd/bd_conexion.php';

$error = false;

if (isset($_GET['status']))
    $status = $_GET['status'];
else $error = true;
if (isset($_GET['id']))
    $id = $_GET['id'];
else $error = true;

if ($error) {
    $data['success'] = false;
    exit( json_encode($data) );
}

$sql = "UPDATE modules SET active = " . $status . " WHERE id = $id";
$result_set = mysqli_query($con, $sql);

$data['success'] = $result_set;
echo json_encode($data);
