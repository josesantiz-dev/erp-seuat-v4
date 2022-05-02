<?php

	class Mysql extends Conexion
	{

       	public $conexion = [];
		private $strquery;
		private $arrValues;
	    function __construct()
		{
        	foreach (conexiones as $key => $conexion) {
                $this->conexion[$key] = new Conexion();
                $this->conexion[$key] = $this->conexion[$key]->conect($key);
            }
		}

		/* public function conexion($conn){
            $conne = new Conexion();
            $conne = $conne->conect($conn);
            return $conne;
        } 
 */

		//Insertar un registro
		public function insert(string $query,string $bd, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$insert = $this->conexion[$bd]->prepare($this->strquery);
			$resInsert = $insert->execute($this->arrValues);
			if ($resInsert)
			{
				$lastInsert = $this->conexion[$bd]->lastInsertId();
			}else{
				$lastInsert = 0;
			}
			return $lastInsert;
		}

		//Buscar un registro
		public function select(string $query, string $bd)
		{
			$this->strquery = $query;
			$result = $this->conexion[$bd]->prepare($this->strquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		//Devuelve todos los registros
		public function select_all(string $query, string $bd)
		{
			//$bd = "conexion".$base_datos;
			$this->strquery = $query;
			$result = $this->conexion[$bd]->prepare($this->strquery);
			$result->execute();
			$data = $result->fetchall(PDO::FETCH_ASSOC);
			return $data;
		}

		//Actualizar registros
		public function update(string $query, string $bd, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$update = $this->conexion[$bd]->prepare($this->strquery);
			$resExecute = $update->execute($this->arrValues);
			return $resExecute;
		}

		//Eliminar un registro
		public function delete(string $query,string $bd)
		{
			$this->strquery = $query;
			$result = $this->conexion[$bd]->prepare($this->strquery);
			$del = $result->execute();
			return $del;
		}
	}

?>