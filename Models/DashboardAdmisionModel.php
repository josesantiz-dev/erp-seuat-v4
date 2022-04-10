<?php
    class DashboardAdmisionModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectTotalesCard($plantel){
            if($plantel == "all"){
                $sqlPlanteles = "SELECT COUNT(*) FROM t_inscripciones AS ins
                INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                INNER JOIN t_planteles AS p ON pe.id_plantel = p.id 
                WHERE p.estatus = 1 GROUP BY p.id";
                $requestPlanteles = $this->select_all($sqlPlanteles);
                $sqlProspectos = "SELECT COUNT(*) AS total FROM t_personas AS per
                WHERE per.estatus !=0 AND per.id_categoria_persona = 1";
                $requestProspectos = $this->select($sqlProspectos);
                $sqlInscritos = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                WHERE ins.tipo_ingreso = 'Inscripcion'";
                $requestInscritos = $this->select($sqlInscritos);
                $request['planteles'] = count($requestPlanteles);
                $request['prospectos'] = $requestProspectos['total'];
                $request['inscritos'] = $requestInscritos['total'];
                $request['tipo'] = "all";
            }else{
                /*$sqlPlanteles = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                RIGHT JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                WHERE pe.id_plantel  = $plantel";
                $requestPlanteles = $this->select($sqlPlanteles);
                $requestPlanteles = $this->select($sqlPlanteles);*/
                $sqlProspectos = "SELECT COUNT(*) AS total FROM t_personas AS per
                WHERE per.estatus !=0 AND per.id_plantel_interes = $plantel AND per.id_categoria_persona = 1";
                $requestProspectos = $this->select($sqlProspectos);
                $sqlInscritos = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                WHERE ins.tipo_ingreso = 'Inscripcion' AND pe.id_plantel = $plantel";
                $requestInscritos = $this->select($sqlInscritos);
                $request['prospectos'] = $requestProspectos['total'];
                $request['inscritos'] = $requestInscritos['total'];
                $request['tipo'] = "";
            }   
            return $request;
        }
        /* public function selectRvoesExpirar($plantel){
            if($plantel == "all"){
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl 
                INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(pl.fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }else{
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.id_plantel = $plantel AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }
            return $requestRVOES;
        } */
        public function selectPlanteles(){
            $sql = "SELECT id,abreviacion_plantel,nombre_plantel,municipio FROM t_planteles WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlantelesInscripcion(){
            $sql = "SELECT p.id, p.abreviacion_plantel,p.abreviacion_sistema,p.municipio FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
            INNER JOIN t_planteles AS p ON pe.id_plantel = p.id";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectProspectosbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_personas AS per
            WHERE per.estatus !=0 AND per.id_plantel_interes = $idPlantel AND per.id_categoria_persona = 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectInscritosbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
            WHERE ins.tipo_ingreso = 'Inscripcion' AND pe.id_plantel = $idPlantel";
            $request = $this->select($sql);
            return $request;
        }
        public function selectDataCampSubCampanias(){
            $sql = "SELECT c.nombre_campania,s.nombre_sub_campania,c.fecha_inicio AS fecha_inicio_campania,c.fecha_fin AS fecha_fin_campania,
            s.fecha_inicio AS fecha_inicio_subcampania,s.fecha_fin AS fecha_fin_subcampania,COUNT(*) AS total FROM t_subcampania AS s
            INNER JOIN t_campanias AS c ON s.id_campania = c.id
            LEFT JOIN t_inscripciones AS i ON i.id_subcampania = s.id
            GROUP  BY s.nombre_sub_campania HAVING COUNT(*)>=1
            ORDER BY s.fecha_fin DESC LIMIT 5";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>    