<?php include('head.php') ?>
<body>

<?php 

session_start();
$_SESSION['user'] = array();
session_destroy();

 ?>

<center>
	
<form action="validar.php" method="post">
		<h1>Escribe tu código aquí</h1>
		<input type="text" name="codigo">
		<input type="submit">

		<?php 

			if (isset($_GET['error'])) {
				echo "<br>Error en el código";
			}
		 ?>
	</form>
	<br><br>
	<button id="borrar">Borrar pruebas</button>
	<div id="resp"></div>
</center>

<script>
	$(document).ready(function(){
		$('#borrar').click(function(){
			$('#borrar').attr('disabled',true);
			$('#resp').load('deletall.php');
		});
	});
</script>

<style>body {font-family: sans-serif;}</style>

</body>
</html>