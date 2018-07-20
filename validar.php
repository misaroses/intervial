<?php 

$code = $_POST['codigo'];

include('mysql.php');

$sql = "SELECT * FROM `usuarios` WHERE codigo = '$code'";

$result = $conexion->query($sql);

$row = $result->fetch_assoc();

//---rows 

$nombre = $row['nombre'];
$mail = $row['mail'];
$codigo = $row['codigo'];

//-----fin row




if ($code == $codigo) {
	session_start();
	$_SESSION['user'] = array('nombre' => $nombre, 'mail' => $mail,'codigo' => $codigo); 
	header('location:portal.php');
} else {
	header('location:index.php?error=1');
}


 ?>