<?php
	
	/**
	* @Autor César Betancurth
	*/
	class Inyector 
	{
		/**
		*Plasma Base Inyector (mg/s)
		*/
		const PLASMA_BASE= 100; 
		/**
		*Plasma Extra Inyector (mg/s)
		*/
		const PLASMA_EXTRA = 99;
		/**
		*Porcentaje de Daño Inyector (%)
		*/
		private $porcentajeDano;
		/**
		*Plasmas del Inyector (mg/s)
		*/
		private $plasma;
		/**
		*Plasma Extra del Inyector (mg/s)
		*/
		private $plasmaExtra;

		function __construct($porcentajeDano)
		{
			$this->plasma=0;
			$this->plasmaExtra=0;

			if($porcentajeDano >=0  && $porcentajeDano <=100)
				$this->porcentajeDano = $porcentajeDano;
			else
				throw new Exception('El porcentaje de daño ingresado no es valido: '.$porcentajeDano,100);
				
		}

		/**
		*getCapacidadPlasma()
		*Retorna la capacidad del Plasma 
		*/
		public function getCapacidadPlasma()
		{
			return $this->plasma;
		}

		/**
		*getPlasmaExtra()
		*Retorna el plasma extra definido para el inyector.
		*/
		public function getPlasmaExtra()
		{
			return $this->plasmaExtra;
		}


		/**
		*getPorcentajeDano()
		*Retorna porcentaje de daño del inyector.
		*/
		public function getPorcentajeDano()
		{
			return $this->porcentajeDano;
		}

		/**
		*setCapacidadPlasma()
		*Establece la capacidad de plama que pueda aportar el inyector
		*/

		public function setCapacidadPlasma($capacidadPlasma)
		{


			/*$capacidadPlasma = ((100 - $this->porcentajeDano) * Inyector::PLASMA_BASE) / 100;*/

			if(($capacidadPlasma>=0 &&  $capacidadPlasma <= Inyector::PLASMA_BASE) && ($capacidadPlasma <= (Inyector::PLASMA_BASE - $this->porcentajeDano)))
				$this->plasma = $capacidadPlasma;
			else 
				throw new Exception('La capacidad de plasma no es valida: '.$capacidadPlasma,200);

		}

		/**
		*setPlasmaExtra()
		*Permite asignar la capacidad extra de plasma al inyector calculada en el Manager.php
		*/
		public function setPlasmaExtra($plasmaExtra)
		{

			if($plasmaExtra >=0 && $plasmaExtra <=Inyector::PLASMA_EXTRA)
				$this->plasmaExtra = $plasmaExtra;
			else
			 	throw new Exception('La distribución del plasma extra excede el valor: '.$plasmaExtra,300);

		}


	}