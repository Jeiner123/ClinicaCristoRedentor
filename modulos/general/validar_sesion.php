<?php
session_start();
if (!isset($_SESSION['full_name']))
    header("Location:../../index.php");

$full_name = $_SESSION['full_name'];
$usuario = $_SESSION['usuario'];

$nombres = $_SESSION['nombres'];
$ap_paterno = $_SESSION['ap_paterno'];
$ap_materno = $_SESSION['ap_materno'];
