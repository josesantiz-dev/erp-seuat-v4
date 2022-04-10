<?php
	class ReinscripcionModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

        //Obtener datos persona
        public function selectPersonasModal($data){
            $sql = "SELECT per.id,per.nombre_persona,per.ap_paterno,per.ap_materno,
            ins.id AS id_inscripcion,pln.nombre_carrera,ins.grado,ins.id_salon_compuesto,gr.nombre_grupo FROM t_personas AS per
            LEFT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_plan_estudios AS pln ON ins.id_plan_estudios = pln.id
            INNER JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
            INNER JOIN t_grupos AS gr ON sal.id_grado = gr.id
            WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectDatosAlumno(int $idAlumno){
            $sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,p.id_categoria_persona,cp.nombre_categoria,
            i.id AS id_inscripcion,i.id_plan_estudios,pe.nombre_carrera,pe.id_plantel,pln.nombre_plantel,i.grado,i.id_salon_compuesto,
            sc.nombre_salon,sc.id_periodo,per.nombre_periodo,per.id_ciclo,c.nombre_ciclo,c.id_generacion,g.nombre_generacion,p.estatus FROM t_personas AS p
            INNER JOIN t_categoria_personas AS cp ON p.id_categoria_persona = cp.id
            INNER JOIN t_inscripciones AS i ON i.id_personas = p.id
            INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
            INNER JOIN t_planteles AS pln ON pe.id_plantel = pln.id
            INNER JOIN t_salones_compuesto AS sc ON i.id_salon_compuesto = sc.id
            INNER JOIN t_periodos AS per ON sc.id_periodo = per.id
            INNER JOIN t_ciclos AS c ON per.id_ciclo = c.id
            INNER JOIN t_generaciones AS g ON c.id_generacion = g.id
            WHERE p.id = $idAlumno";
            $request = $this->select($sql);
            return $request;
        }

        public function selectCiclos(){
            $sql = "SELECT *FROM t_ciclos";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPeriodo(){
            $sql = "SELECT *FROM t_periodos";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGrado(){
            $sql = "SELECT *FROM t_grados";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGrupo(){
            $sql = "SELECT *FROM t_grupos";
            $request = $this->select_all($sql);
            return $request;
        }
	}
?>