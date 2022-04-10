<?php
	class EstudiantesModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Estudiantes
		public function selectEstudiantes(){
			$sql = "SELECT ins.id,per.id AS id_persona,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sa.nombre_salon,per.validacion_doctos,per.validacion_datos_personales,per.id_usuario_verificacion_doctos,per.id_usuario_verificacion_datos_personales FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
            INNER JOIN t_salones AS sa ON sal.id_salon = sa.id
            WHERE his.inscrito = 1 ORDER BY per.validacion_doctos ASC, per.validacion_datos_personales ASC";
			$request = $this->select_all($sql);
			return $request;
		}

        public function selectEstudianteInsc(int $idInscripcion){
            $sql = "SELECT ins.id,per.id AS id_persona,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos,per.validacion_datos_personales,per.id_usuario_verificacion_doctos,per.id_usuario_verificacion_datos_personales FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
            WHERE his.inscrito = 1 AND ins.id = $idInscripcion";
			$request = $this->select_all($sql);
			return $request;
        }
        /* public function selectEstudiantesVerificados(){
			$sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_doctos = 1 AND per.validacion_datos_personales = 1";
			$request = $this->select_all($sql);
			return $request;
		} */
        /* public function selectEstudiantesVerificarDatosPersonales(){
            $sql = "SELECT ins.id,per.id AS id_persona, per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_datos_personales = 0";
			$request = $this->select_all($sql);
			return $request;
        } */
        /* public function selectEstudiantesVerificarDocumentos(){
            $sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_doctos = 0";
			$request = $this->select_all($sql);
			return $request;
        } */
        public function selectDocumentacion(int $idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT ins.id AS id_inscripcion, doc.id AS id_documento, detdoc.id AS id_detalle_documento,
            detdoc.tipo_documento,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno)AS nom_persona FROM t_inscripciones AS ins
            INNER JOIN t_documentos AS doc ON ins.id_documentos = doc.id
            INNER JOIN t_detalle_documentos AS detdoc ON detdoc.id_documentos = doc.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            WHERE ins.id = $idInscripcion";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectDocumentacionEntregados(int $idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT doc.id, det.tipo_documento,doc.entrego_cantidad_original,doc.entrego_cantidad_copias,doc.prestamo_original FROM t_documentos_estudiante AS doc
            INNER JOIN t_historiales AS his ON doc.id_historial = his.id
            INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id
            INNER JOIN t_detalle_documentos AS det ON doc.id_detalle_documentos = det.id
            WHERE ins.id = $idInscripcion";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertOriginalDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $estadoCheckDocumentacion = $data['estado'];
            $cantidadOriginal;
            $estatus;
            if($estadoCheckDocumentacion == 'true'){
                $cantidadOriginal = 1;
                $estatus = 1;
            }else{
                $cantidadOriginal = 0;
                $estatus = 0;
            }
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_original = ?,estatus = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadOriginal,$estatus));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,$cantidadOriginal,0,$estatus,$idDetalleDocumentacion,$idHistorial));
            }
            return $request;
        }
        public function insertCopiaDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $estadoCheckDocumentacion = $data['estado'];
            $cantidadCopia = $data['cantidad'];
           $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_copias = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadCopia));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,0,$cantidadCopia,0,$idDetalleDocumentacion,$idHistorial));
            }
            return $cantidadCopia;
        }
        public function insertCantidadCopiaDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $cantidadCopia = $data['cantidad'];
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_copias = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadCopia));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,0,$cantidadCopia,0,$idDetalleDocumentacion,$idHistorial));
            }
            return $request;
        }
        public function selectEstatusDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlEstatus = "SELECT doc.id,doc.prestamo_original,doc.entrego_cantidad_original,
            doc.entrego_cantidad_copias,doc.estatus,doc.id_detalle_documentos,doc.id_historial,det.tipo_documento 
            FROM t_documentos_estudiante AS doc
            INNER JOIN t_detalle_documentos AS det ON doc.id_detalle_documentos = det.id WHERE id_historial = $idHistorial";
            $requestEstatus = $this->select_all($sqlEstatus);
            return $requestEstatus;
        }
        public function insertValidacionDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $sqlPersona = "SELECT id_personas FROM t_inscripciones WHERE id = $idInscripcion LIMIT 1";
            $requestPersona = $this->select($sqlPersona);
            $idPersona = $requestPersona['id_personas'];
            $sql = "UPDATE t_personas SET validacion_doctos = ?,id_usuario_verificacion_doctos = ? WHERE id = $idPersona";
            $request = $this->update($sql,array(1,1));
            return $request;
        }
        public function insertValidacionDatosPersonales($data){
            $idPersona = $data['idEdit'];
            $nombre = $data['txtNombreEdit'];
            $appPaterno = $data['txtApellidoPaEdit'];
            $appMaterno = $data['txtApellidoMaEdit'];
            $sexo = $data['listSexoEdit'];
            $edad = $data['txtEdadEdit'];
            $estadoCivil = $data['listEstadoCivilEdit'];
            $fechaNacimiento = $data['txtFechaNacimientoEdit'];
            $CURP = $data['txtCURPEdit'];
            $ocupacion = $data['txtOcupacionEdit'];
            $telefonoCel = $data['txtTelCelEdit'];
            $telefonofijo = $data['txtTelFiEdit'];
            $email = $data['txtEmailEdit'];
            $escolaridad = $data['listEscolaridadEdit'];
            $estado = $data['listEstadoEdit'];
            $municipio = $data['listMunicipioEdit'];
            $localidad = $data['listLocalidadEdit'];
            $colonia = $data['txtColoniaEdit'];
            $CP = $data['txtCPEdit'];
            $direccion = $data['txtDireccionEdit'];
            $sql = "UPDATE t_personas SET nombre_persona = ?,ap_paterno = ?,ap_materno = ?,direccion = ?,edad = ?,sexo = ?,cp = ?,colonia = ?,tel_celular = ?,tel_fijo = ?,email = ?,edo_civil = ?,ocupacion = ?,curp = ?,fecha_nacimiento = ?,validacion_datos_personales = ?,id_localidad = ? ,id_usuario_verificacion_datos_personales = ? WHERE id = $idPersona";
            $request = $this->update($sql,array($nombre,$appPaterno,$appMaterno,$direccion,$edad,$sexo,$CP,$colonia,$telefonoCel,$telefonofijo,$email,$estadoCivil,$ocupacion,$CURP,$fechaNacimiento,1,$localidad,1));
            return $request;
        }
        public function selectEstados(){
            $sql = "SELECT *FROM t_estados";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGradosEstudios(){
            $sql = "SELECT *FROM t_escolaridad";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectMunicipios($idEstado){
            $idEstado = $idEstado;
            $sql = "SELECT *FROM t_municipios WHERE id_estados = $idEstado";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectLocalidades($idMunicipio){
            $idMunicipio = $idMunicipio;
            $sql = "SELECT *FROM t_localidades WHERE id_municipio = $idMunicipio";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPersonaEdit($idPersona){
            $sql = "SELECT per.id,per.ap_materno,per.ap_paterno,per.colonia,per.cp,per.direccion,per.edad,per.edo_civil,
            per.email,per.estatus,per.id_categoria_persona,per.id_escolaridad,gra.nombre_escolaridad,per.id_localidad,
            loc.nombre AS nomlocalidad, per.nombre_persona,
            per.ocupacion,per.sexo,per.tel_celular,per.tel_fijo,per.validacion_doctos,per.validacion_datos_personales,mun.id AS idmun,mun.nombre AS nommunicipio,
            est.id AS idest,est.nombre AS nomestado,per.fecha_nacimiento,per.curp 
            FROM t_personas AS per
            INNER JOIN t_localidades AS loc ON per.id_localidad = loc.id
            INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
            INNER JOIN t_estados AS est ON mun.id_estados =  est.id
            INNER JOIN t_escolaridad AS gra ON per.id_escolaridad = gra.id
            WHERE per.id = $idPersona";
            $request = $this->select($sql);
            return $request;
        }
        public function selectUsuarioValidacion(int $idPersonaValidacion){
            $idUsuarioVerificado = $idPersonaValidacion;
            $sql = "SELECT CONCAT(per.nombre_persona,'&nbsp;',per.ap_paterno,'&nbsp;',per.ap_materno) AS nombre_persona_validacion FROM t_personas AS per 
            INNER JOIN t_usuarios AS us ON us.id_persona = per.id WHERE us.id = $idUsuarioVerificado";
            $request = $this->select($sql);
            return $request['nombre_persona_validacion'];
        }    

        public function insertPrestamoDocumentos($idDocumentosDetalles,$idInscripcion,$comentario,$fechaDevolucion){
            $documentosDetalles = $idDocumentosDetalles;
            $inscripcion = $idInscripcion;
            $comentario = $comentario;
            $fechaDevolucion = $fechaDevolucion;
            $sqlFolioPlantel = "SELECT plant.codigo_plantel FROM t_inscripciones AS ins 
                INNER JOIN t_plan_estudios AS pln ON ins.id_plan_estudios = pln.id 
                INNER JOIN t_planteles AS plant ON pln.id_plantel = plant.id WHERE ins.id = $idInscripcion LIMIT 1";
            $requestFolioPlantel = $this->select($sqlFolioPlantel);
            $codigoPlantel = $requestFolioPlantel['codigo_plantel'];
            $sqlFolioCosecutivo = "SELECT COUNT(folio) AS num_folios FROM  t_prestamo_documentos WHERE folio LIKE '%$codigoPlantel%'";
            $requestFolioConsecutivo = $this->select($sqlFolioCosecutivo);
            $cantidadFolios = $requestFolioConsecutivo['num_folios'];
            $nuevoFolio = $cantidadFolios+1;
            $nuevoFolioConsecutivo = $codigoPlantel.'PD'.date("mY").substr(str_repeat(0,4).$nuevoFolio,-4);
            foreach ($documentosDetalles as $key => $value) {
                $sqlPrestamo = "INSERT INTO t_prestamo_documentos(folio,fecha_prestamo,fecha_estimada_devolucion,id_documentos_estudiante,id_usuario_prestamo,comentario_prestamo) VALUES(?,NOW(),?,?,?,?)";
                $requestPrestamo = $this->insert($sqlPrestamo,array($nuevoFolioConsecutivo,$fechaDevolucion,$key,1,$comentario));
                if($requestPrestamo){
                    $sql = "UPDATE t_documentos_estudiante SET prestamo_original = ? WHERE id = $key";
                    $request = $this->update($sql,array(1));
                }else{
                }
            }
            return $request;
        }
        public function insertDevolucionDocumentos($folio,$data){
            $folioDoc = $folio;
            $datos = $data;
            $resultados;
            foreach ($datos as $key => $value) {
                $idDoc = $value['id_doc'];
                $comentario = $value['comentario'];
                if($value['check'] != true){
                    $sqlDevolucion = "UPDATE t_prestamo_documentos SET fecha_devolucion = NOW(),comentario_devolucion = ?,id_usuario_devolucion = ? WHERE folio = '$folioDoc' AND id_documentos_estudiante = $idDoc";
                    $requestDevolucion = $this->update($sqlDevolucion,array($comentario,1));
                    if($requestDevolucion){
                        $sql = "UPDATE t_documentos_estudiante SET prestamo_original = ? WHERE id = $idDoc";
                        $request = $this->update($sql,array(0));
                    }else{
                    }
                }
            }
            return $request;
        }

        public function selectHistorialFoliosPrestamoDoctos($idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT pres.id,pres.folio,det.tipo_documento,pres.fecha_prestamo,pres.fecha_estimada_devolucion,pres.comentario_prestamo,pres.id_usuario_prestamo,
            CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre_usuario,pres.fecha_devolucion,pres.comentario_devolucion,pres.id_usuario_devolucion FROM t_prestamo_documentos AS pres
            LEFT JOIN t_documentos_estudiante AS doc ON pres.id_documentos_estudiante = doc.id
            INNER JOIN t_historiales AS his ON doc.id_historial = his.id
            INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id 
            INNER JOIN t_detalle_documentos AS det ON doc.id_detalle_documentos = det.id 
            INNER JOIN t_usuarios AS us ON pres.id_usuario_prestamo = us.id 
            INNER JOIN t_personas AS per ON us.id_persona = per.id WHERE ins.id = $idInscripcion
            GROUP BY pres.folio HAVING COUNT(*)>=1 ORDER BY pres.id DESC";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectListaDocumentosFolio($folio){
            $folioDocumento = $folio;
            $sql = "SELECT pres.id,pres.folio,det.tipo_documento,pres.fecha_prestamo,pres.fecha_estimada_devolucion,pres.comentario_prestamo,pres.id_usuario_prestamo,
            CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre_usuario,
            CONCAT(peral.nombre_persona,' ',peral.ap_paterno,' ',peral.ap_materno) AS nombre_alumno,
            plan.nombre_carrera FROM t_prestamo_documentos AS pres
            INNER JOIN t_documentos_estudiante AS doc ON pres.id_documentos_estudiante = doc.id
            INNER JOIN t_historiales AS his ON doc.id_historial = his.id
            INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id 
            INNER JOIN t_detalle_documentos AS det ON doc.id_detalle_documentos = det.id 
            INNER JOIN t_usuarios AS us ON pres.id_usuario_prestamo = us.id 
            INNER JOIN t_personas AS peral ON ins.id_personas = peral.id
            INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
            INNER JOIN t_personas AS per ON us.id_persona = per.id WHERE pres.folio = '$folioDocumento'";
            $request = $this->select_all($sql) ;
            return $request;
        }
        public function selectTutorAlumno(int $idAlumno){
            $sql = "SELECT tut.id, tut.nombre_tutor, tut.appat_tutor, tut.apmat_tutor, tut.direccion, tut.tel_celular,
            tut.tel_fijo, tut.email FROM t_personas AS per
            INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            INNER JOIN t_tutores AS tut ON ins.id_tutores = tut.id WHERE per.id = $idAlumno LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function updateTutorAlumno($data){
            $idTutor = $data['idEditTutor'];
            $nombreTutor = $data['txtNombreTutor'];
            $apPatTutor = $data['txtAppPaternoTutor'];
            $apMatTutor = $data['txtAppMaternoTutor'];
            $telCelularTutor = $data['txtTelCelularTutor'];
            $telFijoTutor = $data['txtTelFijoTutor'];
            $emailTutor = $data['txtEmailTutor'];
            $direccionTutor = $data['txtDireccionTutor'];
            $sqlTutor = "UPDATE t_tutores SET nombre_tutor = ?,appat_tutor = ?,apmat_tutor = ?,direccion = ?,tel_celular = ?,tel_fijo = ?,email = ? WHERE id = $idTutor";
            $requestTutor = $this->update($sqlTutor,array($nombreTutor,$apPatTutor,$apMatTutor,$direccionTutor,$telCelularTutor,$telFijoTutor,$emailTutor));
            return $requestTutor;
        }
        public function selectDatosFiscales(int $idAlumno){
            $sql = "SELECT *FROM t_personas AS per 
            LEFT JOIN t_datos_fiscales AS datfis ON per.id_datos_fiscales = datfis.id 
            WHERE per.id = $idAlumno LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectStatusDatosFiscales(int $idAlumno){
            $sqlDatosFiscales = "SELECT per.id_datos_fiscales FROM t_personas AS per WHERE per.id = $idAlumno";
            $requestDatosFiscales = $this->select($sqlDatosFiscales);
            return $requestDatosFiscales;
        }
        public function insertDatosFiscales(int $idAlumno,int $CP,string $direccion,string $email,string $lugar,string $razonSocial,string $RFC,int $telefono){
            $sql = "INSERT INTO t_datos_fiscales(rfc,nombre_social,direccion,lugar,cp,telefono,email) VALUES(?,?,?,?,?,?,?)";
            $request = $this->insert($sql,array($RFC,$razonSocial,$direccion,$lugar,$CP,$telefono,$email));
            return $request;
        }
        public function updateDatosFiscales(int $idDatosFiscales,int $CP,string $direccion,string $email,string $lugar,string $razonSocial,string $RFC,int $telefono){
            $sql = "UPDATE t_datos_fiscales SET rfc = ?,nombre_social = ?,direccion = ?,lugar = ?,cp = ?,telefono = ?,email = ? WHERE id=$idDatosFiscales";
            $request = $this->update($sql,array($RFC,$razonSocial,$direccion,$lugar,$CP,$telefono,$email));
            return $request;
        }
        public function updateDatFiscPersona(int $idAlumno, int $idDatosFiscales){
            $sql = "UPDATE t_personas SET id_datos_fiscales = ? WHERE id= $idAlumno";
            $request = $this->update($sql,array($idDatosFiscales));
            return $request;
        }
        //Obtener datos para la impresion de solicitud de inscripcion
        public function selectDatosImprimirCartaAut(int $idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT ins.folio_impreso,plnes.nombre_carrera,plnes.id AS id_plan_estudio,orgpl.nombre_plan,plnes.duracion_carrera,peralum.nombre_persona,peralum.ap_paterno,peralum.ap_materno,peralum.direccion,peralum.colonia,peralum.tel_celular AS tel_celular_alumno,peralum.tel_fijo AS tel_fijo_alumno,peralum.email AS email_alumno,
            loc.nombre AS localidad,mun.nombre AS municipio,est.nombre AS estado,tut.nombre_tutor,tut.appat_tutor,tut.apmat_tutor,tut.tel_celular AS tel_celular_tutor,tut.tel_fijo AS tel_fijo_tutor,tut.email AS email_tutor,plntel.nombre_sistema,plntel.nombre_plantel,plntel.categoria,plntel.cve_centro_trabajo,CONCAT(plntel.domicilio,',',plntel.localidad,',',plntel.municipio,',',plntel.estado) AS ubicacion,ins.grado,esc.nombre_escolaridad,tur.hora_entrada,tur.hora_salida,peralum.nombre_empresa
            FROM t_inscripciones AS ins 
            INNER JOIN t_plan_estudios AS plnes ON ins.id_plan_estudios = plnes.id
            INNER JOIN t_planteles AS plntel ON plnes.id_plantel = plntel.id
            INNER JOIN t_organizacion_planes AS orgpl ON plnes.id_plan = orgpl.id
            INNER JOIN t_personas AS peralum ON ins.id_personas = peralum.id
            INNER JOIN t_tutores AS tut ON ins.id_tutores = tut.id
            INNER JOIN t_localidades AS loc ON peralum.id_localidad = loc.id
            INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
            INNER JOIN t_estados AS est ON mun.id_estados = est.id
            INNER JOIN t_escolaridad AS esc ON ins.grado = esc.id
            INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
            WHERE ins.id = $idInscripcion LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
	}
?>  