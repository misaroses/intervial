
<?php 
session_start(); 
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user']; 


	
	$codigo = $user['codigo'];
	
	include('mysql.php');
	
	$sql = "SELECT * FROM `resultados` WHERE codigo = '$codigo'";
	
	$result = $conexion->query($sql);
	
	$row = $result->fetch_assoc();
	
	
	//Check si ya fue enviada la prueba


		/* Creat codigo en la tabla
		$sql = "INSERT INTO `resultados`(`codigo`) VALUES ('$codigo')";

		if ($conexion->query($sql) === TRUE) {
			    echo "Codigo creado.<br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		s*/


		//subir respuestas
		$forma = strtoupper($user['codigo'][0]);
		
		$num = 1;
		
		$post = $_POST[ $forma.$num];
		
		$correcta = 0;
		
		
		while ($num <= 10) {

			//verificar si respondió
			$resp = $_POST[$forma.$num];

			if ($resp=='') {
				$resp = 'none';
			}


			$sql = "UPDATE `resultados` SET `$num`='$resp' WHERE `codigo` = '$codigo'";

			if ($conexion->query($sql) === TRUE) {
			    echo "Respuesta $resp subida.<br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}



			//sumar correcta
			if ($resp[0] == 1) {
				echo "Correcta $resp<br>";
				$correcta++;
			}


			$num++;
		}

		$sql = "UPDATE `resultados` SET `correctas`='$correcta' WHERE `codigo` = '$codigo'";

			if ($conexion->query($sql) === TRUE) {
			    echo "Correctas $correcta subida.<br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}



	
		?>
		<h2>!Tu prueba fue enviada!</h2><br>
		
		<a href="portal.php">Ver resultados</a>
		<?php
	
	

	
 } else {
 	?><h1>Error - No has ingresado el codigo</h1><br>
	<a href="index.php">Volver</a><?php
 }

?>

