<?php
    class ModalidadesModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectModalidades(){
            $sql = "SELECT *FROM t_modalidades WHERE estatus !=0 ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertModalidad($data){
            $idUser = $_SESSION['idUser'];
            $nombreModalidad = $data['txtModalidadNueva'];
            $request;
            //$estatus = $data['listEstatusNueva'];
            $sqlExist = "SELECT *FROM t_modalidades WHERE nombre_modalidad = '$nombreModalidad'";
            $requestExist = $this->select($sqlExist);
            if($requestExist){
                $request['estatus'] = TRUE;
            }else{
                $sqlNew = "INSERT INTO t_modalidades(nombre_modalidad,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) 
                VALUES (?,?,NOW(),NOW(),?,?)";
                $requestNew = $this->insert($sqlNew,array($nombreModalidad,1,$idUser,$idUser));   
                $request['estatus'] = FALSE;
            }
            return $request;
        }
        public function selectModalidad(int $idModalidad){
            $sql = "SELECT *FROM t_modalidades WHERE id = $idModalidad LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function updateModalidad(int $intIdModalidadEdit,$data){
            $idUser = $_SESSION['idUser'];
            $idModalidad = $intIdModalidadEdit;
            $nombreModalidad = $data['txtModalidadEdit'];
            $estatus = $data['listEstatusEdit'];
            $request;
            $sqlExist = "SELECT *FROM t_modalidades WHERE nombre_modalidad = '$nombreModalidad' AND id != $idModalidad";
            $requestExist = $this->select($sqlExist);
            if($requestExist){
                $request['estatus'] = TRUE;
            }else{
                $sqlUpdate = "UPDATE t_modalidades SET nombre_modalidad = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idModalidad";
                $requestUpdate = $this->update($sqlUpdate,array($nombreModalidad,$estatus,$idUser,$idUser));
                $request['estatus'] = FALSE;
            }
            return $request;
        }
        public function deleteModalidad(int $intIdModalidad){
            $sql = "SELECT * FROM t_modalidades WHERE id = $intIdModalidad";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_modalidades SET estatus = ? WHERE id = $intIdModalidad";
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