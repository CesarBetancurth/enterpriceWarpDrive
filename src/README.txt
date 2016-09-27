/**
* Autor: César Augusto Betancurth R.
* Correo: cesaraugusto18@gmail.com
* Fecha: 22/09/2016
*
* Gestor de Flujo de Plasma 
* Realizado para: Provedatos S.A.
*/

El Gestor de Flujo de Plasma se diseñó para resolver el caso de  "Enterprise’ warp-drive management software" con el fin de permitir calcular el flujo de funcionamiento de cada inyector para un porcentaje de la velocidad de la luz deseado, maximizando el tiempo de funcionamiento en una situación de daño.

La solución se conforma por dos (2) clases "Gestor" e "Inyector". Para hacer el ingreso de los inputs se cuenta con dos (2) opciones mediante consola y a través de navegador web.

-Clase Gestor: Se encarga de gestionar la asignación y distribución del flujo del plasma para los inyectores que permita alcanzar el porcentaje de velocidad de luz deseado y de entregar los resultados.

-Clase Inyector: Describe el objeto inyector, contiene los atributos y métodos de este.

-----------EJECUCION INPUTS PROPUESTOS----------
-->Para ejecutar todos los input propuestos haga uso del archivo:
	
	ejecutar_inputs.bat

-----------INGRESO DE INPUT'S-------------------

--> OPCIÓN 1. Ingreso de inputs por Consola:

Para ejecutar el programa ingresando los input a través de consola:

1. Copie la carpeta "enterpriceWarpDrive" en un directorio donde tenga permisos para ejecutar comandos por consola.
   Recomendación: Copiar  la carpeta en un directorio del servidor o en la carpeta donde está instalado PHP.

2. Abra la consola "cmd" y acceda a la ruta donde se encuentra la carpeta "/enterpriceWarpDrive/src".
 	
 	Ejemplo: $> C:\wamp\www\enterpriceWarpDrive\src>

3. Ubicado en  "enterpriceWarpDrive\src" ejecute el siguiente comando:
	$>php iniciarGestor.php [dano A %] [dano B %] [dano C %] [velocidad %]

	Ejemplo:
	$> C:\wamp\www\enterpriceWarpDrive\src>$>php iniciarGestor.php 0 0 0 100

-----------------------------------------------------------------

-->OPCIÓN 2. Ingreso de Inputs por navegador Web.

1. Copie la carpeta "enterpriceWarpDrive" en el directorio htdocs del Servidor (XAMPP , MAMP, LAMP , WAMP)

2. Abra el navegador web y acceda a "http://[direccion servidor]/enterpriceWarpDrive/src"

	Ejemplo: http://localhost/enterpriceWarpDrive/src/

3. Ingrese los inputs en las casillas correspondiente y para finalizar seleccione la opción "Calcular Plasma".

4. Para ingresar de nuevo otro inputs realice clic sobre el logo de Provedatos.

-----------EJECUCION TEST----------
1. Ubicado en la carpeta /enterpriceWarpDrive/test/  seleccione el archivo:
		
		ejecutar_test.bat