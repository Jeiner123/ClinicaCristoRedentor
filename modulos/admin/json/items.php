<?php
require '../../bd/bd_conexion.php';

$sql = 'SELECT * FROM items';
$result_set = mysqli_query($con, $sql);

$data['items'] = mysqli_fetch_all($result_set, MYSQLI_ASSOC);
echo json_encode($data);
