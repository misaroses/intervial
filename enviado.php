<?php 
include('head.php');
 ?>

<body>
<center>
	
<?php 
session_start(); 
if (isset($_SESSION['user'])) {

	$user = $_SESSION['user'];

?>

	<h2>Nombre: <?php echo $user['nombre']; ?></h2>
	<h2>Email: <?php echo $user['mail']; ?></h2>
	<a href="index.php">Cerrar sesión</a>
</center>
<hr>



<?php 




//------prueba------------------------//

$forma = strtoupper($user['codigo'][0]);


include('mysql.php');

$sql = "SELECT * FROM `pruebas` WHERE forma = '$forma' ORDER BY `id` ASC";

$result = $conexion->query($sql);

?>

<center>
<h1>Prueba forma: <?php echo strtoupper($user['codigo'][0]); ?></h1>


	<form id="prueba" action="enviar.php" method="POST">

		<?php 

		while ($row = $result->fetch_assoc()) { 

			$id = $row['id'];
			$pregunta = $row['pregunta'];
			$verdadero = $row['verdadero'];
			$falso = $row['falso'];
			$numero++;

			include('mysql.php');
		
			$codigo = $user['codigo'];
			
			$sqle = "SELECT * FROM `resultados` WHERE `codigo`= '$codigo' ";
			
			$resultado = $conn->query($sqle);
		
			$col = $resultado->fetch_assoc();
	

			if ($col['codigo'] != $codigo) {
				echo "error no hay prueba";
			}
	



				if ($col[$id] == '1v' || $col[$id] == '1f') {
						$respuesta = "<p style='color:green;'>Correcta</p>";
						$res_verdadero = "";
						$res_falso = "";
					} else {
						$respuesta = "<p style='color:red;'>Incorrecta</p>";

						if ($verdadero == 1) {
							$res_verdadero = "<";
							$res_falso ="";
						} elseif ($falso == 1) {
							$res_verdadero = "";
							$res_falso = "<";
						}
					}

				$select = $col[$id];

				if ($select[0] == 'v') {
					$radio_v = 'disabled checked';
					$radio_f = 'disabled';
				} else {
					$radio_v = 'disabled';
					$radio_f = 'disabled checked';
				}

				$enviado = 'disabled';



			?>

			<h2><?php echo $numero . '.- ' . $pregunta; ?></h2>

			<input <?php echo $radio_v; ?> type="radio" name="<?php echo $forma . $id; ?>" value='<?php echo $verdadero; ?>v'>
			
			<label>V</label><?php echo $res_verdadero; ?>
			<br>

			<input <?php echo $radio_f; ?> type="radio" name="<?php echo $forma . $id; ?>" value='<?php echo $falso; ?>f'>
			
			<label>F</label><?php echo $res_falso; ?>
			<br>

				<?php echo $respuesta; ?>

		<?php } ?>

		<br><br><input type="submit">

		<div id="loading"></div>

	</form>

</center> 


<?php 

} else { 
	?>
	<h1>Error - No has ingresado el codigo</h1><br>
	<a href="index.php">Volver</a>
	<?php
}
 ?>

<style>body {font-family: sans-serif;}</style>





</body>
</html>







<?php 
//------------------------//------------------------//------------------------//------------------------
//Check si ya fue enviada la prueba
	

/*
	include('mysql.php');

	$codigo = $user['codigo'];

	echo $codigo.'<br>';
	
	$sqle = "SELECT * FROM `resultados` WHERE `codigo`= '$codigo' ";
	
	$resultado = $conexion->query($sqle);

	$col = $resultado->fetch_assoc();



		$accion_codigo = true;


	$e = '1';

	echo $col[$e].'<br>';

	function resultados($e) {

		echo $e;
			
		$conn = new mysqli("localhost","root","root","juego");
	
		$codigo = $user['codigo'];
	
		echo $codigo.'<br>';
		
		$sqle = "SELECT * FROM `resultados` WHERE `codigo`= '$codigo' ";
		
		$resultado = $conn->query($sqle);
	
		$col = $resultado->fetch_assoc();

		echo $col[$e];

	}






			//------- post -----------------------------------------//

		

			if (isset($_POST[$id])) {
				if ($_POST[$id] == '1v' || $_POST[$id] == '1f') {
						$respuesta = "<p style='color:green;'>Correcta</p>";
						$res_verdadero = "";
						$res_falso = "";
					} else {
						$respuesta = "<p style='color:red;'>Incorrecta</p>";

						if ($verdadero == 1) {
							$res_verdadero = "<";
							$res_falso ="";
						} elseif ($falso == 1) {
							$res_verdadero = "";
							$res_falso = "<";
						}
					}

				$select = $_POST[$id];

				if ($select[0] == 'v') {
					$radio_v = 'disabled checked';
					$radio_f = 'disabled';
				} else {
					$radio_v = 'disabled';
					$radio_f = 'disabled checked';
				}

				$enviado = 'disabled';

			}

			//------- fin post ------------------------------------//
*/
 ?>