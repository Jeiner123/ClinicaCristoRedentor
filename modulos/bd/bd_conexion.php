<?php
	date_default_timezone_set('America/Lima');
	$con = mysqli_connect("localhost", "root", "", "clinica");
    mysqli_set_charset($con, "utf8");

	// $con = mysqli_connect("50.62.209.159", "jeiner", "Clinica*123", "clinica");
	// $ftpServer = "50.62.169.11";
	// $ftpUsuario = "Jeiner";
	// $fftpClave = "1053301112";