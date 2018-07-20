<?php 
include('head.php');
session_start(); 


$codigo = $_SESSION['user']['codigo'];

include('mysql.php');

$sqle = "SELECT * FROM `resultados` WHERE `codigo`= '$codigo' ";

$resultado = $conexion->query($sqle);

$col = $resultado->fetch_assoc();

if ($col['codigo'] == $codigo) {

	header('location:enviado.php');

} else {

	$resp = date(r);
	
	$sql = "UPDATE `usuarios` SET `active`='$resp' WHERE `codigo` = '$codigo'";
	
		if ($conexion->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	$sql = "INSERT INTO `resultados`(`codigo`) VALUES ('$codigo')";

		if ($conexion->query($sql) === TRUE) {
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

	
}

 ?>

 <!--script language="JavaScript">

  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "Ha intentado salir de esta pagina. Si ha realizado algun cambio en los campos sin hacer clic en el boton Guardar, los cambios se perderan. Seguro que desea salir de esta pagina? ";
  }
</script-->


<script>



	$(document).ready(function(){
	
			var mono = 0;
	
		//-------- Cuando seleccione el boton submit
		$('#prueba').on('submit',function(e){
			e.preventDefault();
			enviar();
			mono += 1;
		});
	
		//------- Cuando se le acabe el tiempo
		alert('!Tienes 10 minutos para responder la prueba! \n No intente salir o recargar la página.');
	
		setTimeout(function(){
			if (mono == 0) {
				enviar();
			}
	
		}, 600000);
	
		function enviar(){
			//No modificar prueba código-------------
	
			var pet = $('#prueba').attr('action');
			var met = $('#prueba').attr('method');
	
		
			//-------------------------------
		
	/*
			$.ajax({
				beforeSend: function(){
					$('#loading').html('<p>Cargando...</p>');
				},
				url: pet,
				type: met,
				data: $('#data').serialize(),
				success: function(respuesta) {
					$('#loading').html(respuesta);
					console.log(respuesta)
				},
				error: function(jqXHR,estado,error) {
					$('#loading').html('<p>Error</p>');
					console.log(estado)
					console.log(error)
				},
				complete: function(jqXHR,estado) {
					console.log(estado)
				},
				timeout: 10000
			})
		 }
	*/
			var data = $('#prueba').serialize();
	
			
			$.post(pet,data).fail(function(){
	
				$('#loading').html('<p>Error</p>');
	
			}).done(function(a){
	
				$('#loading').html(a);
	
			})

				$('input[type="radio"]').prop('disabled',true);
				$('input[type="submit"]').prop('disabled',true);

		}
	});
</script>

<!--Tiempo-->
<script type="text/javascript">

	var tiempo = new Number();
	
	// tiempo em segundos
	tiempo = 600;
	
	function startCountdown(){
	
	 
	
	    // Si el tiempo no se restablece
	    if((tiempo - 1) >= 0){
	
	 
	
	        // Toma la parte entera de los minutos
	
	        var min = parseInt(tiempo/60);
	
	        // Calcula os segundos restantes
	
	        var seg = tiempo%60;
	
	        // El formato del número menor que diez, por ejemplo, 08, 07, ...
	
	  	if(min < 10){
	            min = "0"+min;
	            min = min.substr(0, 2);
	        }
	        if(seg <=9){
	            seg = "0"+seg;
	        }
	 
	        // Crea la variable para dar formato al estilo hora / cronómetro
	        horaImprimivel = min + ':' + seg;
	        // JQuery para fijar el valor
	        $("#sessao").html(horaImprimivel);
	 
	        // Define que la función se ejecutará de nuevo en 1000ms = 1 segundo
	        setTimeout('startCountdown()',1000);
	 
	        // diminui o tiempo
	        tiempo--;
	 
	    // Cuando el contador llega a cero hace esta acción
	    } else {
	    	alert('!Tu tiempo se ha agotado!');
	    }
	 
	}
	 
	// Llama la función al cargar la pantalla
	startCountdown();
 
</script>


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
	<div id="sessao"></div>


	<form id="prueba" action="enviar.php" method="POST">

		<?php 

		while ($row = $result->fetch_assoc()) { 

			$id = $row['id'];
			$pregunta = $row['pregunta'];
			$verdadero = $row['verdadero'];
			$falso = $row['falso'];
			$numero++;



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