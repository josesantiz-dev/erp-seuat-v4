<?php
	class Estudiantes extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para la Vista de Estudiantes
		public function estudiantes()
		{
			$data['page_id'] = 0;
			$data['page_tag'] = "Estudiantes";
			$data['page_title'] = "Estudiantes";
			$data['page_name'] = "estudiantes";
			$data['page_content'] = "";
			$data['estados'] = $this->model->selectEstados();
            $data['grados_estudios'] = $this->model->selectGradosEstudios();
			$data['page_functions_js'] = "functions_estudiantes.js";
			$this->views->getView($this,"estudiantes",$data);
		}


        
		/* public function verificados(){
			$data['page_id'] = 0;
			$data['page_tag'] = "Estudiantes";
			$data['page_title'] = "Estudiantes verificados";
			$data['page_name'] = "verificados";
			$data['page_content'] = "";
			$data['estados'] = $this->model->selectEstados();
            $data['grados_estudios'] = $this->model->selectGradosEstudios();
			$data['page_functions_js'] = "functions_estudiantes.js";
			$this->views->getView($this,"estudiantes",$data);
		} */
		/* public function verificar_datos_personales(){
			$data['page_id'] = 0;
			$data['page_tag'] = "Estudiantes";
			$data['page_title'] = "Estudiantes sin verificar datos personales";
			$data['page_name'] = "verificar_datos_personales";
			$data['page_content'] = "";
			$data['estados'] = $this->model->selectEstados();
            $data['grados_estudios'] = $this->model->selectGradosEstudios();
			$data['page_functions_js'] = "functions_estudiantes.js";
			$this->views->getView($this,"estudiantes",$data);
		} */
		/* public function verificar_documentos(){
			$data['page_id'] = 0;
			$data['page_tag'] = "Estudiantes";
			$data['page_title'] = "Estudiantes sin verificar documentos";
			$data['page_name'] = "verificar_documentos";
			$data['page_content'] = "";
			$data['page_functions_js'] = "functions_estudiantes.js";
			$this->views->getView($this,"estudiantes",$data);
		} */
        public function getEstudiantes(){
            $arrData = $this->model->selectEstudiantes();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
                $valorDoctos;
                $valorDatPer;
                if($arrData[$i]['validacion_doctos'] == 0){
                    $arrData[$i]['validacion_doctos_status'] = '<span class="badge badge-danger">No validado</span>';
                    $valorDoctos['modal'] = "#ModalFormDocumentacion";
                    $valorDoctos['class'] = "documentacionInscripcion";
                    $valorDoctos['onclick'] = "fntDocumentacionInscripcion";
                    //$arrData[$i]['usuario_validacion'] = "null";
                    $valorDoctos['usuario_validacion'] = "null";
                    $valorDoctos['value'] = "Validar documentos";
                    $valorDoctos['nombre'] = $arrData[$i]['nombre_persona'].'&nbsp;'.$arrData[$i]['apellidos'];
                }else{
                    $arrData[$i]['validacion_doctos_status'] = '<span class="badge badge-success">Validado</span>';
                    $valorDoctos['modal'] = "#ModalFormDocumentacionVerificado";
                    $valorDoctos['class'] = "documentacionInscripcionVerificado";
                    $valorDoctos['onclick'] = "fntDocumentacionInscripcionVerificado";
                    //$arrData[$i]['usuario_validacion'] = $this->model->selectUsuarioValidacion($arrData[$i]['id_usuario_verificacion_doctos']);
                    $valorDoctos['usuario_validacion'] = "usuario";
                    $valorDoctos['value'] = "Ver documentos";
                    $valorDoctos['nombre'] = $arrData[$i]['nombre_persona'].'&nbsp;'.$arrData[$i]['apellidos'];
                }
				if($arrData[$i]['validacion_datos_personales'] == 0){
                    $arrData[$i]['validacion_datos_personales_status'] = '<span class="badge badge-danger">No validado</span>';
                    //$valorDatPer['usuario_validacion'] = "null";
                    $valorDatPer['usuario_validacion'] = "null";
                    $valorDatPer['value'] = "Validar datos personales";
                }else{
                    $arrData[$i]['validacion_datos_personales_status'] = '<span class="badge badge-success">Validado</span>';
                    //$valorDatPer['usuario_validacion'] = $this->model->selectUsuarioValidacion($arrData[$i]['id_usuario_verificacion_datos_personales']);
                    $valorDatPer['usuario_validacion'] = "usuario";
                    $valorDatPer['value'] = "Ver datos personales";
                }
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal datosPersonalesVerficar" onClick="fnDatosPersonalesVerificacion(this)" idper = '.$arrData[$i]['id_persona'].' valda = '.$arrData[$i]['validacion_datos_personales'].' usv = "'.$arrData[$i]['id_usuario_verificacion_datos_personales'].'" data-toggle="modal" data-target="#ModalFormEditPersona" title="Datos Personales"> &nbsp;&nbsp; <i class="far fa-address-book"></i> &nbsp;'.$valorDatPer['value'].'</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal '.$valorDoctos['class'].'" onclick="'.$valorDoctos['onclick'].'(this)" idins = '.$arrData[$i]['id'].' valdo = '.$arrData[$i]['validacion_doctos'].' n = "'.$valorDoctos['nombre'].'" usv = "'.$arrData[$i]['id_usuario_verificacion_doctos'].'" data-toggle="modal" data-target="'.$valorDoctos['modal'].'" title="Documentacion"> &nbsp;&nbsp; <i class="far fa-file-word"></i> &nbsp;'.$valorDoctos['value'].'</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal editDatosFiscales" onclick="fnDatosFiscales(this)" idPer = '.$arrData[$i]['id_persona'].' data-toggle="modal" data-target="#ModalFormDatosFiscales" title="Datos fiscales"> &nbsp;&nbsp; <i class="fas fa-file-invoice-dollar"></i> &nbsp;Datos fiscales</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal editTutor" onclick="fnEditTutor(this)" idPer = '.$arrData[$i]['id_persona'].' data-toggle="modal" data-target="#ModalFormEditTutor" title="Tutor"> &nbsp;&nbsp; <i class="fas fa-user-friends"></i> &nbsp;Datos tutor</button>
						<div class="dropdown-divider"></div>
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function gettUsuarioValidacion(){
            $idUsuario = $_GET['idUser'];
            $arrData = $this->model->selectUsuarioValidacion($idUsuario);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
		/* public function getEstudiantesVerificados(){
			$arrData = $this->model->selectEstudiantesVerificados();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
 
                $arrData[$i]['validacion'] = '<span class="badge badge-success">Validado</span>';
                
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>-->
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal documentacionInscripcion" onClick="fntDocumentacionInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormDocumentacion" title="Documentacion"> &nbsp;&nbsp; <i class="fas fa-copy"></i> &nbsp;Documentos</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal plataformasInscripcion" onClick="fntPlataformasInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormPlataformasInscripcion" title="Plataformas"> &nbsp;&nbsp; <i class="fas fa-cat"></i> &nbsp;Tutores</button>
						<div class="dropdown-divider"></div>
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>-->
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>'; 
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		} */
		/* public function getEstudiantesVerificarDatosPersonales(){
			$arrData = $this->model->selectEstudiantesVerificarDatosPersonales();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>-->
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal datosPersonalesVerficar" onClick="fnDatosPersonalesVerificacion('.$arrData[$i]['id_persona'].')" data-toggle="modal" data-target="#ModalFormEditPersona" title="Datos Personales"> &nbsp;&nbsp; <i class="fas fa-copy"></i> &nbsp;Verificar datos personales</button>
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal plataformasInscripcion" onClick="fntPlataformasInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormPlataformasInscripcion" title="Plataformas"> &nbsp;&nbsp; <i class="fas fa-cat"></i> &nbsp;Tutores</button>-->
						<!--<div class="dropdown-divider"></div>-->
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>-->
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>'; 
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		} */
		/* public function getEstudiantesVerificarDocumentos(){
			$arrData = $this->model->selectEstudiantesVerificarDocumentos();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
                if($arrData[$i]['validacion_doctos'] == 0){
                    $arrData[$i]['validacion_doctos'] = '<span class="badge badge-danger">No validado</span>';
                }else{
                    $arrData[$i]['validacion_doctos'] = '<span class="badge badge-success">validado</span>';
                }
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>-->
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal documentacionInscripcion" onclick="fntDocumentacionInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormDocumentacion" title="Documentacion"> &nbsp;&nbsp; <i class="fas fa-copy"></i> &nbsp;Verificar documentos</button>
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal plataformasInscripcion" onClick="fntPlataformasInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormPlataformasInscripcion" title="Plataformas"> &nbsp;&nbsp; <i class="fas fa-cat"></i> &nbsp;Tutores</button>-->
						<!--<div class="dropdown-divider"></div>-->
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>-->
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>'; 
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		} */
        public function getDocumentacion(){
            $idInscripcion = $_GET['idIns'];
            $arrData = $this->model->selectDocumentacion($idInscripcion);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getDocumentosEntregados(){
            $idInscripcion = $_GET['idIns'];
            $arrData = $this->model->selectDocumentacionEntregados($idInscripcion);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setValidacionDocumentacion(){
            $data = $_POST;
			$arrData = $this->model->insertValidacionDocumentacion($data);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
		public function setValidacionDatosPersonales(){
			$data = $_POST;
			$arrData = $this->model->insertValidacionDatosPersonales($data);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
        public function setOriginalDocumentacion(){
            $data = $_GET;
            $arrData = $this->model->insertOriginalDocumentacion($data);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setCopiaDocumentacion(){
            $data = $_GET;
            $arrData = $this->model->insertCopiaDocumentacion($data);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setCantidadCopiaDocumentacion(){
            $data = $_GET;
            $arrData = $this->model->insertCantidadCopiaDocumentacion($data);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getEstatusDocumentacion(){
            $data = $_GET;
            $arrData = $this->model->selectEstatusDocumentacion($data);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
		public function getMunicipios(){
            $idEstado = $_GET['idestado'];
            $arrData = $this->model->selectMunicipios($idEstado);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		public function getLocalidades(){
            $idMunicipio = $_GET['idmunicipio'];
            $arrData = $this->model->selectLocalidades($idMunicipio);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		public function getPersonaEdit($idPersona){
            $idPersona = $idPersona;
            $arrData = $this->model->selectPersonaEdit($idPersona);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		public function getListEstados(){
			$arrResponse = $this->model->selectEstados();
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
        public function setPrestamoDocumentos(){
            $data = $_POST;
            $idInscripion = $data['idInscripcionPrestamo'];
            $comentario = $data['txtComentarioPrestamo'];
            $idDocumentosDetalles = array();
            $fechaDevolucion = $data['txtFechaDevolucion'];
            foreach ($data as $key => $value) {
                if(gettype($key) == 'integer'){
                    $idDocumentosDetalles[$key] = $value;
                }
            }
            if(count($idDocumentosDetalles) >= 1){
                $arrPrestamo = $this->model->insertPrestamoDocumentos($idDocumentosDetalles,$idInscripion,$comentario,$fechaDevolucion);
                if($arrPrestamo){
                    $arrResponse['status'] = true;
                    $arrResponse['msg'] = "Prestamo realizado correctamente";
                }
            }else{
                $arrResponse['status'] = false;
                $arrResponse['msg'] = "Selecciona al menos un documento";
            } 
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }
        public function setDevolucionDocumentos(){
            $datos = $_GET['data'];
            $valor = json_decode($datos,true);
            $folio = "";
            $data;
            if(count($valor) >= 1){
                $folio = $valor[0]['folio'];
                $data = $valor[1];
            }
            $arrDevolucion = $this->model->insertDevolucionDocumentos($folio,$data);
            if($arrDevolucion){
                $arrResponse['estatus'] = true;
                $arrResponse['msg'] = "Devolución realizado correctamente";
            }else{
                $arrResponse['estatus'] = false;
                $arrResponse['msg'] = "Error en la Devolución";
            }
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }
        public function getHistorialPrestamoDocumentos(){
            $idInscripcion = $_GET['idIns'];
            $arrHistorialFoliosDoc = $this->model->selectHistorialFoliosPrestamoDoctos($idInscripcion);
            echo json_encode($arrHistorialFoliosDoc,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function imprimir_comp_doc_prestamo($folio){
            $folioFormat = base64_decode($folio);
            $data['folio'] = $folioFormat;
            $data['data'] = $this->model->selectListaDocumentosFolio($folioFormat);
			$this->views->getView($this,"viewpdf_prestamo_doc",$data);
        }
        public function imprimir_carta_compromiso_doc($date){
            $newDate = explode(',',$date);
            $idInscripcionFormat = base64_decode($newDate[0]);
            $fechaComEntrega = base64_decode($newDate[1]);
            $data['idInscripcion'] = $idInscripcionFormat;
            $arrData['docstatus'] = $this->model->selectEstatusDocumentacion($data);
            $arrData['doc'] = $this->model->selectDocumentacion($idInscripcionFormat);
            $arrData['data'] = $this->model->selectEstudianteInsc($idInscripcionFormat);
            $arrData['fechaComEntrega'] = $fechaComEntrega;
			$this->views->getView($this,"viewpdf_entrega_doc",$arrData);
        }

        public function geTutorAlumno($idPersona){
            $idAlumno = $idPersona;
            $arrData = $this->model->selectTutorAlumno($idAlumno);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getDatosFiscales($idPersona){
            $idAlumno = $idPersona;
            $arrData = $this->model->selectDatosFiscales($idAlumno);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setDatosFiscales(){
            $datos = $_POST;
            $idAlumno = $datos['idPersonaDatosFis'];
            $CP = $datos['txtCP'];
            $direccion = $datos['txtDireccion'];
            $email = $datos['txtEmail'];
            $lugar = $datos['txtLugar'];
            $razonSocial = $datos['txtNombreSocial'];
            $RFC = $datos['txtRFC'];
            $telefono = $datos['txtTelefono'];
            $respondeStatusDatFiscales = $this->model->selectStatusDatosFiscales($idAlumno);
            if($respondeStatusDatFiscales['id_datos_fiscales'] == null){
                $responseDaosFiscales = $this->model->insertDatosFiscales($idAlumno,$CP,$direccion,$email,$lugar,$razonSocial,$RFC,$telefono);
                if($responseDaosFiscales){
                    $responseEstatusDatFisPersona = $this->model->updateDatFiscPersona($idAlumno,$responseDaosFiscales);
                    if($responseEstatusDatFisPersona){
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos fiscales agregado correctamente');
                    }else{
                        $arrResponse = array('estatus' => false, 'msg' => 'No es posible agregar los datos');
                    }
                }
            }else{
                $response = $this->model->updateDatosFiscales($respondeStatusDatFiscales['id_datos_fiscales'],$CP,$direccion,$email,$lugar,$razonSocial,$RFC,$telefono);
                if($response){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos fiscales actualizados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setTutor(){
            $data = $_POST;
            $arrData = $this->model->updateTutorAlumno($data);
            if($arrData){
                $arrResponse['estatus'] = true;
                $arrResponse['msg'] = "Tutor actualizado correctamente";
            }else{
                $arrResponse['estatus'] = false;
                $arrResponse['msg'] = "Error en la actualización";
            }
 
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getCartaAut($idInscripcionActual){
            $idInscripcionFormat = base64_decode($idInscripcionActual);
            $arrDataIns = $this->model->selectDatosImprimirCartaAut($idInscripcionFormat);
            $data['datos'] = $arrDataIns;
            $this->views->getView($this,"viewpdf_carta_autenticidad",$data);
        }
    }
?>