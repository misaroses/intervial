<?php 

include('mysql.php');

$codigo = $user['codigo'];

$sqle = "DELETE FROM `resultados`";

$resultado = $conn->query($sqle);

if ($conn->query($sqle)) {
	echo "<p>Resultados borrados</p>";
} else {

	die("<br><p>Connection failed: " . $conn->connect_error . "</p>");
}

$sqle = "DELETE FROM `usuarios` WHERE `active`";

$resultado = $conn->query($sqle);

if ($conn->query($sqle)) {
	echo "<p>Active borrado</p>";
} else {

	die("<br><p>Connection failed: " . $conn->connect_error . "</p>");
}

?>
