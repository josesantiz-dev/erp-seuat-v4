<?php
	class ConsultasIngresosEgresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function selectEdoCuentaByMatriculaRFC($str){
			$datosAlumno = $str;
			$sql = "SELECT ing.id,s.codigo_servicio,s.nombre_servicio,ing.folio,p.descripcion,ing.observaciones,ingdet.abono,ingdet.cargo,s.precio_unitario,p.fecha AS fecha_pago,
			ing.fecha AS fecha_pagado,ingdet.cantidad,ing.tipo_comprobante FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			LEFT JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			LEFT JOIN t_precarga_cuenta AS p ON ingdet.id_precarga_cuenta = p.id
			INNER JOIN t_servicios AS s ON ingdet.id_servicio = s.id
			WHERE dfis.rfc = '$str' OR his.matricula_interna = '$str' AND s.aplica_edo_cuenta = 1";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectDatosAlumnoByMatriculaRFC($str){
			$sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,h.matricula_interna,pl.nombre_sistema,
			pl.nombre_plantel,pe.nombre_carrera,pl.categoria,pl.cve_centro_trabajo,pl.domicilio,pl.cod_postal,pl.colonia,
			pl.localidad,pl.municipio,pl.estado,pr.nombre_periodo,p.tel_celular,p.email,sc.nombre_salon FROM t_inscripciones AS i
			INNER JOIN t_historiales AS h ON i.id_historial = h.id
			INNER JOIN t_personas AS p ON i.id_personas = p.id
			INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
			INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
			INNER JOIN t_salones_compuesto AS sc ON i.id_salon_compuesto = sc.id
			INNER JOIN t_periodos AS pr ON sc.id_periodo = pr.id
			WHERE h.matricula_interna = $str";
			$request = $this->select($sql);
			return $request;
		}
		/* public function selectEdoCuentaById(int $idAlumno){
			$sql = "SELECT ing.id,s.codigo_servicio,s.nombre_servicio,ing.folio,p.descripcion,ing.observaciones,ingdet.abono,ingdet.cargo,s.precio_unitario,p.fecha AS fecha_pago,
			ing.fecha AS fecha_pagado,ingdet.cantidad,ing.tipo_comprobante FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			LEFT JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			LEFT JOIN t_precarga_cuenta AS p ON ingdet.id_precarga_cuenta = p.id
			INNER JOIN t_servicios AS s ON ingdet.id_servicio = s.id
			WHERE ing.id_persona = $idAlumno AND s.aplica_edo_cuenta = 1";
			$request = $this->select_all($sql);
			return $request;
		} */
		public function selectEdoCuentaById(int $idAlumno){
			$sql = "SELECT ec.id,s.codigo_servicio,s.precio_unitario,ec.pagado FROM t_estado_cuenta AS ec
			INNER JOIN t_precarga AS p ON ec.id_precarga = p.id
			INNER JOIN t_servicios AS s ON p.id_servicio = s.id
			WHERE ec.id_persona = $idAlumno";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectDatosAlumnoById(int $idAlumno){
			$sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,h.matricula_interna,pl.nombre_sistema,
			pl.nombre_plantel,pe.nombre_carrera,pl.categoria,pl.cve_centro_trabajo,pl.domicilio,pl.cod_postal,pl.colonia,
			pl.localidad,pl.municipio,pl.estado,pr.nombre_periodo,p.tel_celular,p.email,sa.nombre_salon FROM t_inscripciones AS i
			INNER JOIN t_historiales AS h ON i.id_historial = h.id
			INNER JOIN t_personas AS p ON i.id_personas = p.id
			INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
			INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
			INNER JOIN t_salones_compuesto AS sc ON i.id_salon_compuesto = sc.id
			INNER JOIN t_salones AS sa ON sc.id_salon = sa.id
			INNER JOIN t_periodos AS pr ON sc.id_periodo = pr.id
			WHERE i.id_personas = $idAlumno";
			$request = $this->select($sql);
			return $request;
		}
		public function selectPersonasModal($data){
            $sql = "SELECT per.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre,
            ins.id AS id_inscripcion,his.matricula_interna,df.rfc FROM t_personas AS per
            RIGHT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            LEFT join t_datos_fiscales AS df ON per.id_datos_fiscales = df.id
            WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }
		//Obtener estatus del estado de cuenta por ID
        public function selectStatusEstadoCuentaById(int $idPersonaSeleccionada){
            $sql = "SELECT *FROM t_estado_cuenta WHERE id_persona = $idPersonaSeleccionada";
            $request = $this->select_all($sql);
            return $request;
        }
		//Obtener estatus del estado de cuenta por matricula interna/externa o RFC
       /*  public function selectStatusEstadoCuentaByMatrRFC($matriculaRFC){
            $sql = "SELECT *FROM t_ingresos AS i
			LEFT JOIN t_personas AS p ON i.id_persona = p.id
			LEFT JOIN t_datos_fiscales AS df ON p.id_datos_fiscales = df.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = p.id
			INNER JOIN t_historiales AS h ON ins.id_historial = h.id
			WHERE df.rfc = '$matriculaRFC' OR h.matricula_interna = '$matriculaRFC' OR h.matricula_externa = '$matriculaRFC'";
            $request = $this->select_all($sql);
            return $request;
        } */
		public function selectIdAlumnoByRFC($rfc){
			$sql = "SELECT p.id FROM t_personas AS p
			LEFT JOIN t_datos_fiscales AS df ON p.id_datos_fiscales = df.id
			WHERE df.rfc = '$rfc'";
			$request = $this->select($sql);
			return $request;
		}
		public function selectIdAlumnoByMatricula($matricula){
			$sql = "SELECT p.id FROM t_inscripciones AS ins
			INNER JOIN t_personas AS p ON ins.id_personas = p.id
			INNER JOIN t_historiales AS h ON ins.id_historial = h.id
			WHERE h.matricula_externa = '' OR h.matricula_interna = '$matricula'";
			$request = $this->select($sql);
			return $request;
		}





		/////////////////////////
		public function selectEdoCta(int $idAlumno){
			$sql = "SELECT ec.id AS id_edo_cta,s.codigo_servicio,s.nombre_servicio,s.precio_unitario,p.fecha_limite_cobro,ec.pagado,p.id AS id_precarga
			FROM t_estado_cuenta AS ec
			INNER JOIN t_precarga AS p ON ec.id_precarga = p.id
			INNER JOIN t_servicios AS s ON p.id_servicio = s.id
			WHERE ec.id_persona = $idAlumno";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectDetallePago(int $idPrecarga, int $idPersona){
            $sql = "SELECT i.id AS id_ingreso, i.folio, i.observaciones,idet.abono,idet.cargo,i.fecha,idet.cantidad,i.tipo_comprobante FROM t_ingresos_detalles AS idet
            INNER JOIN t_precarga AS p ON idet.id_precarga = p.id 
            LEFT JOIN t_ingresos i ON idet.id_ingresos = i.id 
            WHERE i.id_persona = $idPersona AND p.id = $idPrecarga";
			$request = $this->select($sql);
			return $request;
		}
	}
?>