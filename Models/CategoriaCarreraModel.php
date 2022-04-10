<?php
	class CategoriaCarreraModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Carreras
		public function selectCategoriasCarreras(){
			$sql = "SELECT *FROM t_categoria_carreras WHERE estatus != 0 ORDER BY id DESC";
			$request = $this->select_all($sql);
			return $request;
		}
		
		public function insertCategoriaCarrera($data){
			$idUser = $_SESSION['idUser'];
			$nombreCategoriaCarrera = $data['txtNombrecategoriaNueva'];
			//$estatusCategoriaNueva = $data['listEstatusCategoriaNueva'];
			$request;
			$sqlExist = "SELECT *FROM t_categoria_carreras WHERE nombre_categoria_carrera = '$nombreCategoriaCarrera'";
			$requestExist = $this->select($sqlExist);
			if($requestExist){
				$request['estatus'] = TRUE;
			}else{
				$sqlNew = "INSERT INTO t_categoria_carreras(nombre_categoria_carrera,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) VALUES(?,?,NOW(),NOW(),?,?)";
				$requestNew = $this->insert($sqlNew,array($nombreCategoriaCarrera,1,$idUser,$idUser));
				$request['estatus'] = FALSE;
			}
			return $request;
		}
		public function updateCategoriaCarrera($idCategoriaCarreraEdit,$data){
			$idUser = $_SESSION['idUser'];
			$idCategoria = $idCategoriaCarreraEdit;
			$nombreCategoriaCarrera = $data['txtNombrecategoriaEdit'];
			$estatusCategoriaNueva = $data['listEstatusCategoriaEdit'];
			$request;
			$sqlExist = "SELECT *FROM t_categoria_carreras WHERE nombre_categoria_carrera = '$nombreCategoriaCarrera' AND id != $idCategoria";
			$requestExist = $this->select($sqlExist);
			if($requestExist){
				$request['estatus'] = TRUE;
			}else{
				$sqlUpdate = "UPDATE t_categoria_carreras SET nombre_categoria_carrera = ?, estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idCategoria";
				$requestUpdate = $this->update($sqlUpdate,array($nombreCategoriaCarrera,$estatusCategoriaNueva,$idUser,$idUser));
				$request['estatus'] = FALSE;
			}
			return $request;
		}
		public function selectCategoriaCarrera(int $idCategoria){
			$sql = "SELECT *FROM t_categoria_carreras WHERE id = $idCategoria LIMIT 1";
			$request = $this->select($sql);
			return $request;
		}

		public function deleteCategoriaCarrera(int $idCategoriaCarrera){
			$sql = "SELECT * FROM t_categoria_carreras WHERE id = $idCategoriaCarrera";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_categoria_carreras SET estatus = ? WHERE id = $idCategoriaCarrera";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request){
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}
			return $request;
		}
	}
?>