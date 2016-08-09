<?php
require '../../bd/bd_conexion.php';

$sql = 'SELECT * FROM usuario';
$result_set = mysqli_query($con, $sql);

$data['users'] = mysqli_fetch_all($result_set, MYSQLI_ASSOC);
echo json_encode($data);
