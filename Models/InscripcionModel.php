<?php
    class InscripcionModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectInscripcionesAdmision(string $nomConexion){
            $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_plantel = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
       /*  public function selectInscripcionesAdmision(string $nomConexion){
            if($nomConexion == "Todos"){
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,
                tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                                LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
                                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                                INNER JOIN t_planteles AS plant ON plan.id_plantel = plant.id
                                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                                INNER JOIN t_historiales AS h ON ins.id_historial = h.id
                                WHERE h.inscrito = 1
                                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql, $nomConexion); 
            }else{
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_plantel = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql, $nomConexion);
            }
            return $request;
        } */

        public function selectInscripcionesControlEscolar($idplantel, string $nomConexion){
            $idPlantel = $idplantel;
            if($idPlantel == "Todos"){
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,
                tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                                LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
                                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                                INNER JOIN t_planteles AS plant ON plan.id_plantel = plant.id
                                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                                INNER JOIN t_historiales AS h ON ins.id_historial = h.id
                                WHERE h.inscrito = 1
                                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql, $nomConexion);
            }else{
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_plantel = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                WHERE plant.id = $idPlantel
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql, $nomConexion);
            }
            return $request;
        }
        public function selectPersona($id, string $nomConexion){
            $sql = "SELECT *FROM t_personas WHERE id = $id";
            $request = $this->select($sql, $nomConexion);
            return $request;
        }
        public function selectPersonasModal($data, string $nomConexion){
            $sql = "SELECT per.id,CONCAT(COALESCE(per.nombre_persona,''),' ',COALESCE(per.ap_paterno,''),' ',COALESCE(per.ap_materno,'')) AS nombre,
            ins.id AS id_inscripcion,pr.id AS id_prospecto FROM t_personas AS per
            LEFT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            LEFT JOIN t_prospectos AS pr ON pr.id_persona  = per.id
            WHERE CONCAT(COALESCE(per.nombre_persona,''),' ',COALESCE(per.ap_paterno,''),' ',COALESCE(per.ap_materno,'')) LIKE '%$data%' AND pr.id  != ''";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        public function insertInscripcion($data, $folioTransferencia, $plantelOrigen, $idUser, string $nomConexion){
            $idPersona = $data['idPersonaSeleccionada'];
            //$idPlantel = $data['listPlantelNuevo'];
            $idCarrera = $data['listCarreraNuevo'];
            $grado = $data['listGradoNuevo'];
            $turno = $data['listTurnoNuevo'];
            $empresa = $data['txtNombreEmpresa'];
            $nombreTutor = $data['txtNombreTutorAgregar'];
            $appPatTutor = $data['txtAppPaternoTutorAgregar'];
            $appMatTutor = $data['txtAppMaternoTutorAgregar'];
            $telCelularTutor = $data['txtTelCelularTutorAgregar'];
            $telFijoTutor = $data['txtTelFijoTutorAgregar'];
            $emailTutor = $data['txtEmailTutorAgregar'];

            $anioActual = date('Y');
            $siglaPlantel = conexiones[$nomConexion]['SIGLA'];

            $tipoIngreso = "Inscripcion";
            if($grado != 1){
                $idSalon = null;
            }else{
                $idSalon = 1;
            }
            $direccionTutor = $data['txtDireccionNuevo'];
            $idSubcampania = $data['idSubcampaniaNuevo'];
            $sql = "INSERT INTO t_tutores(nombre_tutor,appat_tutor,apmat_tutor,direccion,tel_celular,tel_fijo,email,estatus,id_usuario_creacion,fecha_creacion) VALUES(?,?,?,?,?,?,?,?,?,NOW())";
            $request = $this->insert($sql,$nomConexion,array($nombreTutor,$appPatTutor,$appMatTutor,$direccionTutor,$telCelularTutor,$telFijoTutor,$emailTutor,1,$idUser));
            if($request){
                $idTutor = $request;
                $sql_documentos = "SELECT doc.id FROM t_plan_estudios AS plan
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id 
                INNER JOIN t_documentos AS doc ON doc.id_nivel_educativo = niv.id WHERE plan.id = $idCarrera LIMIT 1";
                $request_documentos = $this->select($sql_documentos, $nomConexion);
                if($request_documentos){
                    $idDocumentos = $request_documentos['id'];
                    $sql_folio_sistema = "SELECT COUNT(*) AS total FROM t_inscripciones WHERE folio_sistema LIKE '%$siglaPlantel%'";
                    $request_folio_sistema = $this->select($sql_folio_sistema, $nomConexion);
                    $request_folio_sistema_format = str_pad($request_folio_sistema['total']+1 ,5,"0",STR_PAD_LEFT);
                    $folioSistema = $siglaPlantel.$anioActual.($request_folio_sistema_format);

                    $sql_historial = "INSERT INTO t_historiales(aperturado,inscrito,egreso,pasante,titulado,baja,matricula_interna,matricula_externa,fecha_inscrito,fecha_egreso,fecha_pasante,fecha_titulado,fecha_baja) VALUES(?,?,?,?,?,?,?,?,NOW(),?,?,?,?)";
                    $request_historial = $this->insert($sql_historial,$nomConexion,array(0,1,0,0,0,0,null,null,null,null,null,null));
                    if($request_historial){
                        $sql_inscripcion = "INSERT INTO t_inscripciones(folio_impreso,folio_sistema,tipo_ingreso,grado,promedio,id_horario,id_plan_estudios,id_personas,id_tutores,id_documentos,id_subcampania,id_salon_compuesto,id_historial,id_usuario_creacion,fecha_creacion,id_plantel_prospectado,folio_transferencia) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?,?)";
                        $request_inscripcion = $this->insert($sql_inscripcion,$nomConexion,array($folioSistema,$folioSistema,$tipoIngreso,$grado,null,$turno,$idCarrera,$idPersona,$idTutor,$idDocumentos,$idSubcampania,$idSalon,$request_historial,$idUser, $plantelOrigen,$folioTransferencia));
                        if($request_inscripcion){
                            $sqlEmpresa = "UPDATE t_personas SET nombre_empresa = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id = $idPersona";
                            $requestEmpresa = $this->update($sqlEmpresa,$nomConexion,array($empresa,$idUser));
                            $sqlUpdateProspecto = "UPDATE t_prospectos SET id_plantel_inscrito = ? WHERE id_persona = $idPersona";
                            $reqUpdateProspecto = $this->update($sqlUpdateProspecto,$nomConexion,array($nomConexion));
                            $sqlUpdateAsigCatPersona = "UPDATE t_asignacion_categoria_persona SET fecha_baja = NOW(), estatus = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id_persona = $idPersona AND id_categoria_persona = 1";
                            $reqUpdateAsigCatPersona = $this->update($sqlUpdateAsigCatPersona,$nomConexion,array(2,$idUser));
                            $sqlInsertCatPersona = "INSERT INTO t_asignacion_categoria_persona(fecha_alta,validacion_datos_personales,validacion_doctos,estatus,fecha_creacion,id_usuario_creacion,id_persona,id_categoria_persona) VALUES(NOW(),?,?,?,NOW(),?,?,?)";
                            $reqInsertCatPersona = $this->insert($sqlInsertCatPersona,$nomConexion,array(0,0,1,$idUser,$idPersona,2));
                        }
                    }

                }
            }
            return $reqInsertCatPersona;
        }
        public function selectPlanteles(string $nomConexion){
            $sql = "SELECT *FROM t_planteles WHERE estatus = 1";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        public function selectNivelesEducativos(string $nomConexion){
            $sql = "SELECT *FROM t_nivel_educativos WHERE estatus != 0";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectCarreras(int $nivel,string $nomConexion){
            $sql = "SELECT *FROM t_plan_estudios WHERE id_nivel_educativo = $nivel AND estatus !=0";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        public function selectGrados(string $nomConexion){
            $sql = "SELECT *FROM t_grados";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectSubcampanias(string $nomConexion){
            $sql = "SELECT c.id AS id_campania,c.nombre_campania,c.fecha_fin AS fecha_fin_campania,s.id AS id_subcampania,s.nombre_sub_campania,s.fecha_fin AS fecha_fin_subcampania FROM t_campanias AS c
            RIGHT JOIN t_subcampania AS s ON s.id_campania = c.id
            WHERE c.fecha_fin >= NOW()
            ORDER BY c.fecha_fin DESC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectPlanes(string $nomConexion){
            $sql = "SELECT *FROM t_organizacion_planes";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectturnos(string $nomConexion){
            $sql = "SELECT *FROM t_turnos WHERE id_categoria_persona = 2";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectDocumentacion($idAlumno, string $nomConexion){
            $idAlumno = $idAlumno;
            $sql = "SELECT insc.id_personas,insc.id_documentos,det.tipo_documento FROM t_inscripciones AS insc
            INNER JOIN t_documentos AS doc ON insc.id_documentos = doc.id
            INNER JOIN t_detalle_documentos AS det ON det.id_documentos = doc.id
            WHERE insc.id = $idAlumno";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectInscripcion(int $idInscripcion, string $nomConexion){
            $sql = "SELECT per.nombre_persona,per.ap_paterno,per.ap_materno,plnt.id AS id_plantel,ins.id_plan_estudios,plan.nombre_carrera FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
            INNER JOIN t_planteles AS plnt ON plan.id_plantel = plnt.id
            WHERE ins.id = $idInscripcion";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        //Lista de Inscritos en una Carrera
        public function selectInscritos(int $idCarrera, int $grado, int $turno, string $nomConexion){
            $sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_historiales AS h ON ins.id_historial = h.id
            WHERE ins.id_plan_estudios = $idCarrera AND ins.grado = $grado AND ins.id_horario = $turno AND h.inscrito = 1";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        //Obtener datos para la impresion de solicitud de inscripcion
        public function selectDatosImprimirSolInscricpion(int $idInscripcion, string $nomConexion){
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
            $request = $this->select($sql, $nomConexion);
            return $request;
        }
        //Obtener lista de documentacion por el Plan de Estudios
        public function selectDocumentacionInscripcion(int $idPlanEstudios, string $nomConexion){
            $idPlanEstudios = $idPlanEstudios;
            $sql = "SELECT dest.tipo_documento FROM t_plan_estudios AS plnest 
            INNER JOIN t_nivel_educativos AS nivel ON plnest.id_nivel_educativo = nivel.id 
            INNER JOIN t_documentos AS doc ON doc.id_nivel_educativo = nivel.id
            INNER JOIN t_detalle_documentos AS dest ON dest.id_documentos = doc.id
            WHERE plnest.id = $idPlanEstudios";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function updateEstatusInscripcion(int $idInscripcion, string $nomConexion){
            $sqlHistorial = "SELECT id_historial FROM t_inscripciones AS i
            INNER JOIN t_historiales AS h ON i.id_historial = h.id
            WHERE i.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial, $nomConexion);
            if($requestHistorial){
                $idHistorial = $requestHistorial['id_historial'];
                $sql = "UPDATE t_historiales SET inscrito = ?,cancelado = ?,fecha_cancelado = NOW() WHERE id= $idHistorial";
                $request = $this->update($sql,$nomConexion,array(0,1));
            } 
            return $request;
        }
        public function updatePosponerInscripcion(int $idInscripcion, int $idSubcampania, string $nomConexion){
            $sqlHistorial = "SELECT id_historial FROM t_inscripciones AS i
            INNER JOIN t_historiales AS h ON i.id_historial = h.id
            WHERE i.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial, $nomConexion);
            if($requestHistorial){
                $idHistorial = $requestHistorial['id_historial'];
                $sql = "UPDATE t_historiales SET inscrito = ?,pospuesto = ?,fecha_pospuesto = NOW() WHERE id= $idHistorial";
                $request = $this->update($sql,$nomConexion,array(0,1));
            }
            return $request;
        }

        public function selectProspecto(int $idPersona, string $nomConexion){
            $sql = "SELECT *FROM t_prospectos WHERE id_persona = $idPersona LIMIT 1";
            $request = $this->select($sql,$nomConexion);
            return $request;
        }
    }
?>