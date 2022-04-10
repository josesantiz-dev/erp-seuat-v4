<?php
	class HistorialPagosAlumnoModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Estudiantes
        public function selectEstudiantes(){
            $sql = "SELECT p.id,p.nombre_persona,CONCAT(p.ap_paterno,' ',p.ap_materno) AS apellidos,pe.nombre_carrera,
			CONCAT(pl.abreviacion_sistema,' (',pl.abreviacion_plantel,'/',pl.municipio,')') AS nombre_plantel,
			CONCAT(i.grado,' (',sa.nombre_salon,')') AS grado_grupo FROM t_inscripciones AS i
			INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
			INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
			LEFT JOIN t_salones_compuesto AS sc ON i.id_salon_compuesto = sc.id
			INNER JOIN t_salones AS sa ON sc.id_salon = sa.id
			INNER JOIN t_personas AS p ON i.id_personas = p.id";
            $request = $this->select_all($sql);
            return $request;
        }

		//Funcion para consultar Detalles de un Estudiante
		public function selectDetalleEstudiante(int $idAlumno){
			$sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,p.tel_celular,p.email,p.estatus,CONCAT(p.direccion,', ',p.colonia,', ',l.nombre,', ',m.nombre,', ',e.nombre) AS direccion
			FROM t_personas AS p 
			INNER JOIN t_localidades AS l ON p.id_localidad = l.id
			INNER JOIN t_municipios AS m ON l.id_municipio = m.id
			INNER JOIN t_estados AS e ON m.id_estados = e.id
			WHERE p.id = $idAlumno";
			$request = $this->select($sql);
			return $request;
		}
		//consulta de ultimos movimientos
		public function selectUltimosMovimientos(int $idAlumno){
			$sql = "SELECT i.id AS id_ingreso,i.observaciones,i.folio,i.fecha,TIMESTAMPDIFF(SECOND,i.fecha,NOW()) AS segundos FROM t_ingresos_detalles AS ide
			LEFT JOIN t_ingresos AS i ON ide.id_ingresos = i.id 
			WHERE i.id_persona = $idAlumno AND i.fecha != '' ORDER BY i.fecha DESC
			LIMIT 5";
			$request = $this->select_all($sql);
			return $request;
		}
		//consulta todos los movimeitnos del alumno
		public function selectTodosMovimientos(int $idAlumno){
			$sql = "SELECT i.folio, i.fecha,s.nombre_servicio AS nombre_servicio,spre.nombre_servicio AS nombre_servicio_precarga,id.cargo,per.nombre_persona,per.ap_paterno,per.ap_materno FROM t_ingresos_detalles AS id
			LEFT JOIN t_ingresos AS i ON id.id_ingresos = i.id
			LEFT JOIN t_precarga AS p ON id.id_precarga = p.id
			LEFT JOIN t_servicios AS s ON id.id_servicio = s.id
			LEFT JOIN t_servicios AS spre ON p.id_servicio = spre.id
			LEFT JOIN t_usuarios AS us ON i.id_usuario = us.id
			LEFT JOIN t_personas AS per ON us.id_persona = per.id
			WHERE i.id_persona = $idAlumno ORDER BY i.fecha DESC";
			$request = $this->select_all($sql);
			return $request;
		}
		
	}
?>  