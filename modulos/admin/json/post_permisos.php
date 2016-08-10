<?php
require '../../bd/bd_conexion.php';

if (isset($_POST['username']))
    $username = $_POST['username'];
else header('Location: ../asignar_permisos.php');
if (isset($_POST['value']))
    $value = $_POST['value'];
else header('Location: ../asignar_permisos.php');
if (isset($_POST['item_id']))
    $item_id = $_POST['item_id'];
else header('Location: ../asignar_permisos.php');

if (isset($value)) {
    if ($value == 'true')
        $sql = "INSERT INTO permissions (username, item_id) VALUES ('$username', $item_id)";
    else $sql = "DELETE FROM permissions WHERE username='$username' AND item_id=$item_id";
}

$result_set = mysqli_query($con, $sql);

$data['success'] = $result_set;
echo json_encode($data);
