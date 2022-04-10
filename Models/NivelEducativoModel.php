<?php
    class NivelEducativoModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectNivelesEducativos(){
            $sql = "SELECT *FROM t_nivel_educativos WHERE estatus !=0 ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertNivelEducativo($data){
            $idUser = $_SESSION['idUser'];
            $nombreNivelEducativo = $data['txtNombreNuevo'];
            $abreviatura = $data['txtAbreviaturaNuevo'];
            $orden = $data['txtOrdenNuevo'];
            $request;
            if($orden == null){
                $orden = null;
            }
            $sqlExist = "SELECT *FROM t_nivel_educativos WHERE nombre_nivel_educativo = '$nombreNivelEducativo' OR abreviatura = '$abreviatura'";
            $requestExist = $this->select($sqlExist);
            if($requestExist){
                $request['estatus'] = TRUE;
            }else{
                $sqlNew = "INSERT INTO t_nivel_educativos(nombre_nivel_educativo,abreviatura,orden,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) 
                    VALUES (?,?,?,?,NOW(),NOW(),?,?);";
                $requestNew = $this->insert($sqlNew,array($nombreNivelEducativo,$abreviatura,$orden,1,$idUser,$idUser));
                $request['estatus'] = FALSE;
            }
            return $request;
        }

        public function selectNivelEducativo(int $idNivelEducativo){
            $sql = "SELECT *FROM t_nivel_educativos WHERE id = $idNivelEducativo LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }

        public function updateNivelEducativo(int $intIdNivelEducativoEdit,$data){
            $idUser = $_SESSION['idUser'];
            $idNivelEducativo = $intIdNivelEducativoEdit;
            $nombreNivelEducativo = $data['txtNombreEdit'];
            $abreviatura = $data['txtAbreviaturaEdit'];
            $orden = $data['txtOrdenEdit'];
            $estatus = $data['listEstatusEdit'];
            if($orden == null){
                $orden = null;
            }
            $request;
            $sqlExistNom = "SELECT *FROM t_nivel_educativos WHERE nombre_nivel_educativo = '$nombreNivelEducativo' AND id != $idNivelEducativo";
            $requestExistNom = $this->select($sqlExistNom);
            if($requestExistNom){
                $sqlExistAbre = "SELECT *FROM t_nivel_educativos WHERE abreviatura = '$abreviatura' AND id != $idNivelEducativo";
                $requestExistAbre = $this->select($sqlExistAbre);
                $request['estatus'] = TRUE;
                $request['msg'] = 'Nombre existente en la Base de Datos';
                if($requestExistAbre){
                    $request['estatus'] = TRUE;
                    $request['msg'] = 'Nombre y Abreviatura existente en la Base de Datos';
                }else{
                    $request['estatus'] = TRUE;
                    $request['msg'] = 'Nombre existente en la Base de datos';
                }
            }else{
                $sqlExistAbre = "SELECT *FROM t_nivel_educativos WHERE abreviatura = '$abreviatura' AND id != $idNivelEducativo";
                $requestExistAbre = $this->select($sqlExistAbre);
                if($requestExistAbre){
                    $request['estatus'] = TRUE;
                    $request['msg'] = "Abreviatura existente en la Base de datos";
                }else{
                    $request['estatus'] = FALSE;
                    $request['msg'] = "";
                    $sqlUpdate = "UPDATE t_nivel_educativos SET nombre_nivel_educativo = ?, abreviatura = ?, orden = ?,estatus = ?, fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idNivelEducativo";
                    $requestUpdate = $this->update($sqlUpdate,array($nombreNivelEducativo,$abreviatura,$orden,$estatus,$idUser,$idUser));
                }
            }
            return $request;
        }

        public function deleteNivelEducativo(int $intIdNivelEductaivo){
            $sql = "SELECT * FROM t_nivel_educativos WHERE id = $intIdNivelEductaivo";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_nivel_educativos SET estatus = ? WHERE id = $intIdNivelEductaivo";
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