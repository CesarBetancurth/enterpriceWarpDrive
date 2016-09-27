<?php
	include 'Gestor.php';
?>

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
		<a href="./"><img src="./imagenes/logo.png" id="logo"></a>
	</header>
	<section>
 	<?php

		if($_POST["enviar"])
		{
			$inyectores=array();
			$inyectores[0]=$_POST['danoInyectorA'];
			$inyectores[1]=$_POST['danoInyectorB'];
			$inyectores[2]=$_POST['danoInyectorC'];
			$porcentajeVel=$_POST['porcentajeVel'];

		    $gestor = new Gestor($inyectores,$porcentajeVel);
			echo $gestor->distribucionPlasma();
			echo $gestor->visualizarResultados();
			echo "<br />";

			$infoInyector = $gestor->getInyectores();
		}	

		if($gestor->getDistribuirPlama())
		{
			foreach ($infoInyector as $key => $inyector) 
			{
	?>
				<div class="inyector">
						<center>
							<?php 
								if($inyector->getPorcentajeDano()==100)
								{
							?>
									<img src="./imagenes/danado.png?>"><br>
							<?php			
								}
								else
								{
							?>
									<img src="./imagenes/inyector.jpg?>"><br>
							<?php
								}
							?>
							<span><?php  echo chr(65+$key).": ". ($inyector->getCapacidadPlasma() + $inyector->getPlasmaExtra()) ." mg/s"; ?></span><br>
						</center>
				</div>

	<?php 
			} //fin foreach
	?>
			<div class="inyector">
					<center>
						<img src="./imagenes/time.png?>"><br>
						<span><?php

							foreach ($infoInyector as $key => $inyector) 
							{
								if($inyector->getPorcentajeDano()<100)
								{
									if($inyector->getPlasmaExtra() > 0)
									{
										echo "\nTiempo de funcionamiento: ".(Gestor::TIEMPO_FUNCIONAR_MAX - $inyector->getPlasmaExtra())." minutos";
									}
									else
										echo "\nTiempo de funcionamiento: Infinito";
									break;
								}
								
							}
						?></span><br>
					</center>
			</div>

	<?php
		}//fin if
		else
		{
	?>
			<div class="inyector">
						<center>
							<img src="./imagenes/error.png?>"><br>
							<span><?php echo "Unable to comply\n";
										echo "Tiempo de funcionamiento 0\n"; ?></span><br>
						</center>
				</div>
	<?php
		}
	?>
	</section>

</body>
</html>