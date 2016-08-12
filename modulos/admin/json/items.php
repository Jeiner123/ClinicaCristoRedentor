<?php
require '../../bd/bd_conexion.php';

$error = false;

if (isset($_GET['id']))
    $id = $_GET['id'];
else $error = true;

if ($error) {
    $data['success'] = false;
    exit( json_encode($data) );
}

$sql = "SELECT * FROM items WHERE module_id = $id";
$result_set = mysqli_query($con, $sql);

$data['items'] = mysqli_fetch_all($result_set, MYSQLI_ASSOC);
echo json_encode($data);
