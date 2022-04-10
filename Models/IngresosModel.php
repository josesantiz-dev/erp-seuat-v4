<?php
	class IngresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
        //Lista de ingresos
        public function selectIngresos(){
            $sql = "SELECT *FROM t_ingresos";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener datos persona
        public function selectPersonasModal($data){
            $sql = "SELECT per.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre,
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
        //Obtener estatus del estado de cuenta
        public function selectStatusEstadoCuenta(int $idPersonaSeleccionada){
            $sql = "SELECT *FROM t_estado_cuenta WHERE id_persona = $idPersonaSeleccionada";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener lista de Servicios
        public function selectServicios(int $idPersona, int $idGrado){
            $sqlSerEdoCta = "SELECT ec.id AS id_edo_cta,p.id AS id_precarga,s.nombre_servicio,s.precio_unitario,cs.colegiatura FROM t_estado_cuenta AS ec
            INNER JOIN t_precarga AS p ON ec.id_precarga = p.id
            INNER JOIN t_servicios AS s ON p.id_servicio = s.id
            INNER JOIN t_categoria_servicios AS cs ON s.id_categoria_servicio = cs.id
            WHERE ec.id_persona = $idPersona AND p.id_grado = $idGrado";
            $requestServEdoCta = $this->select_all($sqlSerEdoCta);
            $arrayServ = [];
            foreach ($requestServEdoCta as $key => $value) {
                if($value['colegiatura'] != 1){
                    array_push($arrayServ,$value);
                }
            }
            //$sql = "SELECT *FROM t_servicios WHERE codigo_servicio NOT LIKE '%COL%'";
            $sqlOtrosServ = "SELECT *FROM t_servicios AS s WHERE s.aplica_edo_cuenta != 1";
            $requestOtrosServ = $this->select_all($sqlOtrosServ);
            foreach ($requestOtrosServ as $key => $value) {
                array_push($arrayServ,$value);
            }
            return $arrayServ;
        }
        //Obtener lista de Colegiaturas
        public function selectColegiaturas(int $idPersona, int $idGrado){
            $sql = "SELECT ec.id AS id_edo_cta,p.id AS id_precarga,s.nombre_servicio,s.precio_unitario,ec.pagado FROM t_estado_cuenta AS ec
            INNER JOIN t_precarga AS p ON ec.id_precarga = p.id
            INNER JOIN t_servicios AS s ON p.id_servicio = s.id
            INNER JOIN t_categoria_servicios AS cs ON s.id_categoria_servicio = cs.id
            WHERE ec.id_persona = $idPersona AND p.id_grado = $idGrado AND cs.colegiatura = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        //Lista de Promociones por Servicio
        public function selecPromociones(int $idServicio){
            $sql = "SELECT *FROM t_servicios AS ser INNER JOIN t_promociones AS prom ON prom.id_servicio = ser.id WHERE ser.id = $idServicio";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener carrera del Alumno
        public function selectCarreraAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT id_plan_estudios FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;    
        }
        //Obtener grado del Alumno
        public function selectGradoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT grado FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        //Obtener periodo del Alumno
        public function selectPeriodoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT ins.id_salon_compuesto,sc.id_periodo FROM t_inscripciones AS ins 
            INNER JOIN t_salones_compuesto AS sc ON ins.id_salon_compuesto = sc.id 
            WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        //Obtener datos para generar un estado de cuenta
        public function generarEdoCuentaAlumno(int $idPersonaSeleccionada,int $idPlantel, int $idCarrera, int $idGrado, int $idPeriodo, int $idUser){
            $sqlServicios = "SELECT p.id AS id_precarga FROM t_precarga AS p
            INNER JOIN t_servicios AS s ON p.id_servicio = s.id
            WHERE s.aplica_edo_cuenta = 1 AND s.id_plantel = $idPlantel AND s.estatus = 1 AND p.id_plan_estudios = $idCarrera AND p.id_periodo = $idPeriodo AND p.id_grado = $idGrado";
            $requestServicios = $this->select_all($sqlServicios);
            if($requestServicios){
                foreach ($requestServicios as $key => $servicio) {
                    $idPrecarga = $servicio['id_precarga'];
                    $sqlEdoCta = "INSERT INTO t_estado_cuenta(pagado,estatus,id_usuario_creacion,fecha_creacion,id_precarga,id_persona) VALUES(?,?,?,NOW(),?,?)";
                    $requestEdoCta = $this->insert($sqlEdoCta,array(0,1,$idUser,$idPrecarga,$idPersonaSeleccionada));
                    if($requestEdoCta){
                        $request['estatus'] = true;
                        $request['msg'] = null;
                    }
                }
            }else{
                $request['estatus'] = false;
                $request['msg'] = "No hay datos cargados para la carrera, grado o periodo del Alumno";
            }
            return $request;
        }
        //Actualizar ingresos
       /*  public function updateIngresos($idIngreso,$tipoPago,$tipoComprobante,$observaciones,$folioNuevo,$total){
            $sql = "UPDATE t_ingresos SET fecha = NOW(),folio = ?,forma_pago = ?,tipo_comprobante = ?,total = ?,observaciones = ?,
            recibo_inscripcion = ? WHERE id= $idIngreso";
            $request = $this->update($sql,array($folioNuevo,$tipoPago,$tipoComprobante,$total,$observaciones,1));
            return $idIngreso;
        } */
        //Actualizar ingresos detalles
        public function updateIngresosDetalles($idIngreso,$cantidad,$precioUnitario,$subtotal,$arrPromociones){
            $sql = "UPDATE t_ingresos_detalles SET cantidad = ? ,cargo = ?,abono = ?,saldo = ?,precio_subtotal = ?,promociones_aplicadas = ? WHERE id_ingresos = $idIngreso";
            $request = $this->update($sql,array($cantidad,$precioUnitario,$precioUnitario,$precioUnitario,$subtotal,$arrPromociones));
            return $idIngreso;
        }
        //Obtener el siguiente Folio
        public function selectFolioSig(int $idAlumno){
            $sqlPlantel = "SELECT pl.id AS id_plantel,pl.abreviacion_plantel,pl.abreviacion_sistema,pl.codigo_plantel  FROM t_personas AS p
            INNER JOIN t_inscripciones AS i ON i.id_personas = p.id
            INNER JOIN t_plan_estudios AS ple ON i.id_plan_estudios = ple.id
            INNER JOIN t_planteles AS pl ON ple.id_plantel = pl.id
            WHERE p.id = $idAlumno LIMIT 1";
            $requestPlantel = $this->select($sqlPlantel);
            $codigoPlantel = $requestPlantel['codigo_plantel'];

            $sqlFolioCosecutivo = "SELECT COUNT(folio) AS num_folios FROM  t_ingresos WHERE folio LIKE '%$codigoPlantel%'";
            $requestFolioConsecutivo = $this->select($sqlFolioCosecutivo);
            $cantidadFolios = $requestFolioConsecutivo['num_folios'];
            $nuevoFolio = $cantidadFolios+1;
            $nuevoFolioConsecutivo = $codigoPlantel.'IN'.date("mY").substr(str_repeat(0,4).$nuevoFolio,-4);

            return $nuevoFolioConsecutivo;
        }
        //Obtener el Id del ingreso de un id Servicio e id Alumno
       /*  public function checkIdIngreso(int $idServicio,int $idAlumno){    
            $sql = "SELECT i.id FROM t_ingresos AS i
            RIGHT JOIN t_ingresos_detalles AS id ON id.id_ingresos = i.id
            WHERE id.id_servicio = $idServicio AND i.id_persona = $idAlumno";
            $request = $this->select($sql);
            return $request;
        } */
        
        //Insertar un nuevo Ingreso
        public function insertIngresos(string $folio,int $formaPago, string $tipoComprobante,int $total,string $observaciones,int $idAlumno, int $idPlantel,int $idUser){
            $sqlIngresos = "INSERT INTO t_ingresos(fecha,folio,estatus,id_metodo_pago,tipo_comprobante,referencia,total,observaciones,recibo_inscripcion,id_plantel,id_persona,id_usuario) VALUES(NOW(),?,?,?,?,?,?,?,?,?,?,?)";
            $requestIngresos = $this->insert($sqlIngresos,array($folio,1,$formaPago,$tipoComprobante,$folio,$total,$observaciones,1,$idPlantel,$idAlumno,$idUser));
            return $requestIngresos;
        }
        //Insertar un nuevo ingreso detalle
        public function insertIngresosDetalle(int $cantidad,int $cargo,int $abono,int $saldo,int $precioSubtotal,int $descuentoDinero,int $descuentoPorcentaje,string $promocionesAplicadas,$idServicio,$idPrecarga,int $idIngreso){
            if($idServicio == null && $idPrecarga != null){ //Edo Cta
                $sqlIngDetalle = "INSERT INTO t_ingresos_detalles(cantidad,cargo,abono,saldo,precio_subtotal,descuento_dinero,descuento_porcentaje,promociones_aplicadas,id_servicio,id_ingresos,id_precarga) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $requestIngDetalle = $this->insert($sqlIngDetalle,array($cantidad,$cargo,$abono,$saldo,$precioSubtotal,$descuentoDinero,$descuentoPorcentaje,$promocionesAplicadas,NULL,$idIngreso,$idPrecarga));
            }else if($idServicio !=null && $idPrecarga == null){
                $sqlIngDetalle = "INSERT INTO t_ingresos_detalles(cantidad,cargo,abono,saldo,precio_subtotal,descuento_dinero,descuento_porcentaje,promociones_aplicadas,id_servicio,id_ingresos,id_precarga) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $requestIngDetalle = $this->insert($sqlIngDetalle,array($cantidad,$cargo,$abono,$saldo,$precioSubtotal,$descuentoDinero,$descuentoPorcentaje,$promocionesAplicadas,$idServicio,$idIngreso,NULL));
            }
            return $requestIngDetalle;
        }
        //Consultar datos del Plantel para Los recibos
        public function selectDatosInstitucion(int $idIngreso){
            $sql = "SELECT i.id_plantel,p.nombre_plantel,p.nombre_sistema,p.cve_centro_trabajo,p.cod_postal,p.colonia,p.domicilio,p.estado,p.localidad,p.municipio,
            p.abreviacion_sistema,df.rfc,p.codigo_plantel FROM t_ingresos AS i 
            INNER JOIN t_planteles AS p ON i.id_plantel = p.id
            INNER JOIN t_datos_fiscales AS df ON p.id_datos_fiscales = df.id
            WHERE i.id = $idIngreso LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        //Consultar datos de la Venta/Ingreso
        public function selectDatosVenta(int $idIngreso){
            $sql = "SELECT i.id AS id_ingreso,i.folio,i.fecha AS fecha_ingreso,id.cantidad,id.id AS id_ingreso_detalle,i.total,s.nombre_servicio,s.precio_unitario,s.codigo_servicio,
            id.id_precarga,sp.nombre_servicio AS nombre_servicio_precarga,sp.precio_unitario AS precio_unitario_precarga,sp.codigo_servicio AS codigo_servicio_precarga FROM t_ingresos AS i       
            RIGHT JOIN t_ingresos_detalles AS id ON id.id_ingresos = i.id
            LEFT JOIN t_servicios AS s ON id.id_servicio = s.id
            LEFT JOIN t_precarga AS p ON id.id_precarga = p.id
            LEFT JOIN t_servicios AS sp ON p.id_servicio = sp.id
            WHERE i.id = $idIngreso";
            $request = $this->select_all($sql);
            return $request;
        }
        //Consultar datos del Alumno vinculado a la Venta
        public function selectDatosAlumno(int $idIngreso){
            $sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,pe.nombre_carrera,h.matricula_interna,per.fecha_inicio_periodo,per.fecha_fin_periodo,pe.nombre_carrera FROM t_ingresos AS i
            INNER JOIN t_personas AS p ON i.id_persona = p.id
            INNER JOIN t_inscripciones AS ins ON i.id_persona = ins.id_personas
            INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
            INNER JOIN t_historiales AS h ON ins.id_historial = h.id
            INNER JOIN t_salones_compuesto AS sc ON ins.id_salon_compuesto = sc.id
            INNER JOIN t_periodos AS per ON sc.id_periodo = per.id
            WHERE i.id = $idIngreso LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectDatosUsuario(int $idUsuario){
            $sql = "SELECT p.nombre_persona, p.ap_paterno, p.ap_materno, l.nombre AS localidad, m.nombre AS municipio, e.nombre AS estado FROM t_usuarios AS u 
            INNER JOIN t_personas AS p ON u.id_persona = p.id 
            INNER JOIN t_localidades AS l ON p.id_localidad = l.id
            INNER JOIN t_municipios AS m ON l.id_municipio = m.id
            INNER JOIN t_estados AS e ON m.id_estados = e.id
            LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function updateEdoCta(int $id,int $idUser){
            $sql = "UPDATE t_estado_cuenta SET pagado = ? ,id_usuario_actualizacion = ?,fecha_actualizacion = NOW() WHERE id = $id";
            $request = $this->update($sql,array(1,$idUser));
            return $request;
        }

        public function selectMetodosPago(){
            $sql = "SELECT *FROM t_metodos_pago WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEstatusCaja(int $idUser){
            $sql = "SELECT c.id AS id_caja,c.id_usuario_atiende,ec.estatus_caja,c.nombre FROM t_cajas AS c
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = c.id
            WHERE c.id_usuario_atiende = $idUser";
            $request = $this->select($sql);
            return $request;
        }
        public function updateEstatusCaja(int $idCaja, int $estatus,int $monto){
            $sql = "UPDATE t_estatus_caja SET estatus_caja = ?,monto_caja = ? WHERE id_caja = $idCaja";
            $request = $this->update($sql,array($estatus,$monto));
            return $request;
        }
        public function insertCorteCaja(int $monto, int $idCaja){
            $sql = "INSERT INTO t_corte_caja(fechayhora_apertura_caja,cantidad_recibida,id_caja) VALUES(NOW(),?,?)";
            $request = $this->insert($sql,array($monto,$idCaja));
            return $request;
        }

        //Obtener plantel del Alumno
        public function selectPlantelAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT plte.id FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS plnest ON ins.id_plan_estudios = plnest.id
            INNER JOIN t_planteles AS plte ON plnest.id_plantel = plte.id WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }

        public function selectPlantelUSer(int $idUser){
            $sql = "SELECT p.id FROM t_administrativo AS ad 
            INNER JOIN t_planteles AS p ON ad.id_plantel = p.id WHERE ad.id_usuario = $idUser LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
	}
?>  