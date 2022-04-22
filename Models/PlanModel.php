<?php
    class PlanModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectPlanes(string $nomConexion){
            $sql = "SELECT *FROM t_organizacion_planes WHERE estatus !=0 ORDER BY id DESC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        public function insertPlan($data, string $nomConexion){
            $idUser = $_SESSION['idUser'];
            $nombrePlan = $data['txtNombreNuevo'];
            $abreviaturaPlan = $data['txtAbreviaturaNuevo'];
            //$estatus = $data['listEstatusNuevo'];
            $request = [];
            $sqlExist = "SELECT *FROM t_organizacion_planes WHERE nombre_plan = '$nombrePlan' OR abreviatura = '$abreviaturaPlan'";
            $requestExist = $this->select($sqlExist, $nomConexion);
            if($requestExist){
                $request['estatus'] = TRUE;
            }else{
                $sqlNew = "INSERT INTO t_organizacion_planes(nombre_plan,abreviatura,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) 
                VALUES (?,?,?,NOW(),NOW(),?,?);";
                $requestNew = $this->insert($sqlNew,$nomConexion,array($nombrePlan,$abreviaturaPlan,1,$idUser,$idUser));
                $request['estatus'] = FALSE;
            }
            return $request;
        }

        public function selectPlan(int $idPlan, string $nomConexion){
            $sql = "SELECT *FROM t_organizacion_planes WHERE id = $idPlan LIMIT 1";
            $request = $this->select($sql, $nomConexion);
            return $request;
        }

        public function updatePlan(int $intIdPlanEdit,$data, string $nomConexion){
            $idUser = $_SESSION['idUser'];
            $idPlan = $intIdPlanEdit;
            $nombrePlan = $data['txtNombreEdit'];
            $abreviaturaPlan = $data['txtAbreviaturaEdit'];
            $estatus = $data['listEstatusEdit'];
            $request = [];
            $sqlExistNom = "SELECT *FROM t_organizacion_planes WHERE nombre_plan = '$nombrePlan' AND id != $idPlan";
            $requestExistNom = $this->select($sqlExistNom, $nomConexion);
            if($requestExistNom){
                $sqlExistAbre = "SELECT *FROM t_organizacion_planes WHERE abreviatura = '$abreviaturaPlan' AND id != $idPlan";
                $requestExistAbre = $this->select($sqlExistAbre, $nomConexion);
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
                $sqlExistAbre = "SELECT *FROM t_organizacion_planes WHERE abreviatura = '$abreviaturaPlan' AND id != $idPlan";
                $requestExistAbre = $this->select($sqlExistAbre, $nomConexion);
                if($requestExistAbre){
                    $request['estatus'] = TRUE;
                    $request['msg'] = "Abreviatura existente en la Base de datos";
                }else{
                    $request['estatus'] = FALSE;
                    $request['msg'] = "";
                    $sqlUpdate = "UPDATE t_organizacion_planes SET nombre_plan = ? ,abreviatura = ?,estatus = ?, fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlan";
                    $requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlan,$abreviaturaPlan,$estatus,$idUser,$idUser));
                }
            }
            return $request;

        }

        public function deletePlan(int $intIdPlan, string $nomConexion){
            $sql = "SELECT * FROM t_organizacion_planes WHERE id = $intIdPlan";
			$request = $this->select_all($sql, $nomConexion);
			if($request){
				$sql = "UPDATE t_organizacion_planes SET estatus = ? WHERE id = $intIdPlan";
				$arrData = array(0);
				$request = $this->update($sql,$nomConexion,$arrData);
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