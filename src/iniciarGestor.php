<?php

include 'Gestor.php';

if (isset ( $argv )) 
{
	if (count ( $argv ) == 5) 
	{

		echo "\n\n#----------------RESULTADOS----------------#\n\n";
		
		echo "#Resultado de plasma requerido por cada inyector:\n\n";
		
		$gestor = new Gestor ( array (
				$argv [1],
				$argv [2],
				$argv [3] 
		), $argv [4] );

		echo $gestor->distribucionPlasma();
		echo $gestor->visualizarResultados();




		echo "\n--------------------FIN-----------------------\n";
		
	} 
	else 
	{
		if(count($argv) < 5)
			echo "Faltan argumentos!! \n\nUse: php iniciarGestor.php [dano A %] [dano B %] [dano C %] [velocidad %]\n";
		else
			echo "Sobran argumentos!! \n\nUse: php iniciarGestor.php [dano A %] [dano B %] [dano C %] [velocidad %]\n";
	}	
}