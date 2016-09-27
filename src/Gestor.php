<?php
	
	/**
	* @Autor César Betancurth
	*/
		
	include 'Inyector.php';

	class Gestor
	{

		/**
		* Flujo de plasma con el que se logra el 100% de la velocidad (ms/g)
		*/
		const FLUJO_PLASMA_MAX = 300;

		/**
		* Cantidad de inyectores que posee el Motor
		*/
		const INYECTOR_CANT = 3;

		/**
		* Tiempo Máx de Funcionamiento definido sin usar flujo de plasma Extra
		*/
		const TIEMPO_FUNCIONAR_MAX = 100;

		/**
		* Porcentaje Máx que se puede obtener de acuerdo a la cantidad de inyectores , plasma base y plasma extra de los inyectores
		*/
		private $porcentajeVelocidadMax;

		/**
		* Es la cantidad de plasma requerido para alcanzar la velocidad indicada.
		*/
		private $plasmaRequerido;


		/**
		* Controla si es posible realizar la distribución del plasma para la velocidad solicitada
		*/
		private $distribuirPlasma;

		/**
		* Arreglo de Input's de Inyectores
		*/
		private $inyectores;

		function __construct($danoInyectores,$porcentajeVelocidad)
		{
			$porcentajeVelocidadMax = (((Inyector::PLASMA_BASE + Inyector::PLASMA_EXTRA) * Gestor::INYECTOR_CANT) * 100) / Gestor::FLUJO_PLASMA_MAX;

			if($porcentajeVelocidad>=0 && $porcentajeVelocidad <= $porcentajeVelocidadMax)
				$this->plasmaRequerido = ($porcentajeVelocidad * Gestor::FLUJO_PLASMA_MAX)/100;
			else
				throw new Exception('El porcentaje de Velocidad: '.$porcentajeVelocidad.' esta fuera del rango permito',400);

			$this->inyectores=array();
			
			foreach ($danoInyectores as $danoInyector) 
			{

				 $this->inyectores[] = new Inyector($danoInyector);			
			}


		}
	
		/**
		* flujoPlasmaInyectores()
		* Asigna las capacidad de plasma del inyector teniendo en cuenta el porcentaje de daño que este presenta
		*/
		public function flujoPlasmaInyectores()
		{

			$flujoPlasma = 0;

			foreach ($this->inyectores as $inyector) 
			{

				$capacidadPlasma = ((100 - $inyector->getPorcentajeDano()) * Inyector::PLASMA_BASE) / 100;
				$inyector->setCapacidadPlasma($capacidadPlasma);
				$flujoPlasma += $inyector->getCapacidadPlasma();

			}

			return $flujoPlasma;
		}

		/**
		* inyectoresActivos()
		* Retorna la cantidad de inyectores que se encuentran funcionando, es decir, aquellos que poseen un porcentaje de daño menor a 100
		*/		
		public function inyectoresActivos()
		{
			$cant = 0;

			foreach ($this->inyectores as $inyector) 
			{
				if($inyector->getPorcentajeDano() < 100)
					$cant ++;
				
			}

			return $cant;

		}

		/**
		* distribucionPlasma()
		* Distribuye el flujo de plasma requerido  entre los inyectores activos, maximizando el tiempo de funcionamiento
		* buscando cumplir con el porcentaje de velocidad de la luz deseado
		*/	
		public function distribucionPlasma()
		{	

			$this->distribuirPlasma = false;

			if($this-> inyectoresActivos() <> 0)
			{
				$deltaCapacidad= $this->plasmaRequerido - $this->flujoPlasmaInyectores();
		
				$flujoPorInyector = $deltaCapacidad / $this-> inyectoresActivos();

				if($deltaCapacidad > 0)
				{
					if($flujoPorInyector<= Inyector::PLASMA_EXTRA)
					{
							$this->distribuirPlasma = true;

							foreach ($this->inyectores as $inyector)
							{
								if($inyector->getPorcentajeDano()<100)
									$inyector->setPlasmaExtra($flujoPorInyector);
									
							}

					}
				}
				else
				{	
					$this->distribuirPlasma = true;

					foreach ($this->inyectores as $inyector) 
					{	
						if($inyector->getPorcentajeDano() <100)
						{
							$nuevaCapacidadPlasma =$inyector->getCapacidadPlasma() + $flujoPorInyector;
		
							if($nuevaCapacidadPlasma < 0)
							{	
								$nuevaCapacidadPlasma=$flujoPorInyector;

								while($nuevaCapacidadPlasma < 0)
								{
									$acumulado = 0;

									$nuevoFlujoDistribuido= $nuevaCapacidadPlasma / $this-> inyectoresActivos();

									foreach ($this->inyectores as $inyector)
									{
										if($inyector->getPorcentajeDano() <100)
										{
											$nuevaCapacidadDistribuida =  $inyector->getCapacidadPlasma() + $nuevoFlujoDistribuido;

											if($nuevaCapacidadDistribuida < 0)
												$acumulado += $nuevoFlujoDistribuido;
											else
												$inyector->setCapacidadPlasma($nuevaCapacidadDistribuida);
										}
									}
									$nuevaCapacidadPlasma = $acumulado;
								}
							}
							else
								$inyector->setCapacidadPlasma($nuevaCapacidadPlasma);
						}//fin if
					
					}//fin foreach

				}//fin else
			
			}//fin if inyectores activos

		}

		/**
		* visualizarResultados()
		* Imprime los resultados obtenidos según la distribución del plasma 
		*/	
		public function visualizarResultados()
		{	
			if(isset($this->distribuirPlasma))
			{
				if($this->distribuirPlasma)
				{		
					$mensaje="";
						
					foreach ($this->inyectores as $key => $inyector) 
					{
						$mensaje .= chr(65+$key).": ";
						$mensaje .= $inyector->getCapacidadPlasma() + $inyector->getPlasmaExtra();
						$mensaje .= " mg/s, ";
					}
					echo substr($mensaje, 0,-2);

					foreach ($this->inyectores as $key => $inyector) 
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

				}
				else
				{
					echo "Unable to comply\n";
					echo "Tiempo de funcionamiento 0\n";
				}
			}		
			else
					throw new Exception('Primero debe ejecutar '.$capacidadPlasma);

		}

		/**
		* getInyectores()
		* Retorna el arreglo de inyectores
		*/			
		public function getInyectores()
		{
			return $this->inyectores;
		}

		/**
		* getDistribuirPlama()
		* Retorna el atributo DistribuirPlasma que indica si fue posible o no realizar la distribución 
		* de acuerdo a los inputs ingresados
		*/	
		public function getDistribuirPlama()
		{
			return $this->distribuirPlasma;
		}

	}