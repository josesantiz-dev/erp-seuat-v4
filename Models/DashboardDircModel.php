<?php
    class DashboardDircModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectTotalesCard($plantel){
            if($plantel == "all"){
                $sqlPlanteles = "SELECT COUNT(*) AS total FROM t_planteles WHERE estatus = 1";
                $requestPlanteles = $this->select($sqlPlanteles);
                $sqlPlanEstudios = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE estatus = 1";
                $requestPlanEstudios = $this->select($sqlPlanEstudios);
                $sqlMaterias = "SELECT COUNT(*) AS total FROM t_materias WHERE estatus = 1";
                $requestMaterias = $this->select($sqlMaterias);
                $sqlRVOES = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE DATEDIFF(fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND estatus = 1";
                $requestRVOES = $this->select($sqlRVOES);
                $request['planteles'] = $requestPlanteles['total'];
                $request['plan_estudios'] = $requestPlanEstudios['total'];
                $request['materias'] = $requestMaterias['total'];
                $request['rvoes'] = $requestRVOES['total'];
                $request['tipo'] = "all";
            }else{
                $sqlPlanEstudios = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE estatus = 1 AND id_plantel = $plantel";
                $requestPlanEstudios = $this->select($sqlPlanEstudios);
                $sqlMaterias = "SELECT COUNT(*) AS total FROM t_materias AS mat 
                INNER JOIN t_plan_estudios AS pln ON mat.id_plan_estudios = pln.id WHERE mat.estatus = 1 AND pln.id_plantel = $plantel";
                $requestMaterias = $this->select($sqlMaterias);
                $sqlRVOES = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE DATEDIFF(fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND id_plantel = $plantel AND estatus = 1";
                $requestRVOES = $this->select($sqlRVOES);
                $request['plan_estudios'] = $requestPlanEstudios['total'];
                $request['materias'] = $requestMaterias['total'];
                $request['rvoes'] = $requestRVOES['total'];
                $request['tipo'] = "";
            }   
            return $request;
        }
        public function selectRvoesExpirar($plantel){
            if($plantel == "all"){
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl 
                INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(pl.fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }else{
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.id_plantel = $plantel AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }
            return $requestRVOES;
        }
        public function selectPlanteles(){
            $sql = "SELECT id,abreviacion_plantel,nombre_plantel,municipio FROM t_planteles WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlanEstudiosbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE id_plantel = $idPlantel";
            $request = $this->select($sql);
            return $request;
        }
        public function selectMateriasbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_materias AS mat
            INNER JOIN t_plan_estudios AS ples ON mat.id_plan_estudios = ples.id
            INNER JOIN t_planteles AS pl ON ples.id_plantel = pl.id WHERE pl.id = $idPlantel";
            $request = $this->select($sql);
            return $request;
        }
        public function selectRVOEproximoExpbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_plan_estudios WHERE id_plantel = $idPlantel";
            $request = $this->select($sql);
            return $request;
        }
    }
?>    