<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Enterprice Warp Drive</title>
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>
<body>
	<header>
		<img src="./imagenes/logo.png" id="logo">
	</header>
	<section>
	<form id="formulario" method="post" action="procesar.php">
	  Da&ntilde;o Inyector A:<br>
	  <input type="number" name="danoInyectorA" value="0" min="0" max="100"><br>
	  Da&ntilde;o Inyector B:<br>
	  <input type="number" name="danoInyectorB" value="0" min="0" max="100"><br>
	  Da&ntilde;o Inyector C:<br>
	  <input type="number" name="danoInyectorC" value="0" min="0" max="100"> <br>
	  Porcentaje Velocidad:<br>
	  <input type="number" name="porcentajeVel" value="100"><br>	
	  <input type="submit" name="enviar" value="Calcular Plasma" class="aceptar">
	</form>
	</section>

</body>
</html>