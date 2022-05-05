<?php
    class Persona extends Controllers{
        private $idUser;
		private $nomConexion;
		private $rol;
		public function __construct()
		{
			parent::__construct();
			session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
			$this->idUser = $_SESSION['idUser'];
			$this->nomConexion = $_SESSION['nomConexion'];
			$this->rol = $_SESSION['claveRol'];
		}
        public function persona(){
            $data['page_id'] = 9;
            $data['page_tag'] = "Persona";
            $data['page_title'] = "Personas";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_persona.js";
            $data['estados'] = $this->model->selectEstados($this->nomConexion);
            $data['categoria_persona'] = $this->model->selectCategoriasPersona($this->nomConexion);
            $data['grados_estudios'] = $this->model->selectGradosEstudios($this->nomConexion);
            //$data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
            $data['nivel_carrera_interes'] = $this->model->selectNivelesEducativos($this->nomConexion);
            $data['medios_captacion'] = $this->model->selectMediosCaptacion($this->nomConexion);
            $this->views->getView($this,"persona",$data);
        }
        public function getPersona($idPersona){
            $idPersona = $idPersona;
            $arrData = $this->model->selectPersona($idPersona, $this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPersonaEdit($idPersona){
            $idPersona = $idPersona;
            $arrData = $this->model->selectPersonaEdit($idPersona, $this->nomConexion);
            $arrData['id_plantel_interes'] = $arrData['plantel_interes'];
            if($arrData['plantel_interes'] == null){
                $arrData['plantel_interes'] = "Sin Plantel";
            }else{
                $arrData['plantel_interes'] = conexiones[$arrData['plantel_interes']]['NAME'];
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPersonas(){
            $arrData = $this->model->selectPersonas($this->nomConexion);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['apellidos'] = $arrData[$i]['ap_paterno'].' '.$arrData[$i]['ap_materno'];
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerPersona" onClick="fntVerPersona('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormVerPersona" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPersona" onClick="fntEditPersona('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPersona" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPersona" onClick="fntDelPersona('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>-->
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setPersona(){
            $data = $_POST;
            $intIdPersonaNueva = 0;
            $intIdPersonaEdit = 0;
            if(isset($_POST['idNuevo'])){
                $intIdPersonaNueva = intval($_POST['idNuevo']);
            }
            if(isset($_POST['idEdit'])){
                $intIdPersonaEdit = intval($_POST['idEdit']);
            }
            if($intIdPersonaNueva == 1){
                $id_subcampania = $this->model->selectSubcampania($this->nomConexion);
                if($id_subcampania){
                    $arrData = $this->model->insertPersona($data,$this->idUser,$id_subcampania['id'], $this->nomConexion);
                    if($arrData){
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                    }else{
                        $arrResponse = array('estatus' => false, 'msg' => 'No es posible guardar los datos');
                    }
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No existe una subcampania activa');
                }
            }
            if($intIdPersonaEdit !=0){
                $arrData = $this->model->updatePersona($intIdPersonaEdit,$data,$this->idUser,$this->nomConexion);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos Actualizados Correctamente');
                }else{
                    $arrResponse = array('estatus' => true, 'msg' => 'No es posible actualizar los datos');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }

        public function getMunicipios(){
            $idEstado = $_GET['idestado'];
            $arrData = $this->model->selectMunicipios($idEstado, $this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getLocalidades(){
            $idMunicipio = $_GET['idmunicipio'];
            $arrData = $this->model->selectLocalidades($idMunicipio, $this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getCarrerasInteres(){
            $idNivel = $_GET['idNivel'];
            $arrData = $this->model->selectCarrerasInteres($idNivel, $this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function delPersona(){
            if($_POST){
				$intIdPersona = intval($_POST['idPersona']);
				$requestDelete = $this->model->deletePersona($intIdPersona, $this->nomConexion);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la Persona.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la Persona.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }

        public function setUploadCsvProspecto($args){
            $arrValues = json_decode($args);
            if(count($arrValues) > 0){
                foreach ($arrValues as $key => $value) {
                    if($value->id != ''){
                        //Insertar persona masiva
                        $id = intval($value->id);
                        $nombrePersona = strClean($value->nombre_persona);
                        $apPaterno = ($value->ap_paterno == '')?null:strClean($value->ap_paterno);
                        $apMaterno = ($value->ap_materno == '')?null:strClean($value->ap_materno);
                        $alias = strClean($value->alias);
                        $direccion = ($value->direccion == '')?null:strClean($value->direccion);
                        $edad = ($value->edad == '')?null:intval($value->edad);
                        $sexo = strClean($value->sexo);
                        $cp = ($value->cp == '')?null:intval($value->cp);
                        $colonia = ($value->colonia == '')?null:strClean($value->colonia);
                        $telCelular = ($value->tel_celular == '')?null:strClean($value->tel_celular);
                        $telFijo = ($value->tel_fijo == '')?null:strClean($value->tel_fijo);
                        $email = ($value->email == '')?null:strClean($value->email);
                        $edoCivil = ($value->edo_civil == '')?null:strClean($value->edo_civil);
                        $ocupacion = ($value->ocupacion == '')?null:strClean($value->ocupacion);
                        $idLocalidad = intval($value->id_localidad);
                        $curp = ($value->curp == '')?null:strClean($value->curp);
                        $fechaNacimiento = ($value->fecha_nacimiento == '')?null:strClean($value->fecha_nacimiento);
                        $estatus = 1;
                        $idRol = 1;
                        $idEscolaridad = ($value->id_escolaridad == '')?null:intval($value->id_escolaridad);
                        $escuelaProcedencia = ($value->escuela_procedencia == '')?null:strClean($value->escuela_procedencia);
                        $observaciones = null;
                        $plantelInteres = ($value->plantel_interes == '')?null:strClean($value->plantel_interes);
                        $nivelCarreraInteres = ($value->id_nivel_carrera_interes == '')?null:intval($value->id_nivel_carrera_interes);
                        $carreraInteres = ($value->id_carrera_interes == '')?null:intval($value->id_carrera_interes);
                        $medioCaptacion = ($value->id_medio_captacion == '')?null:intval($value->id_medio_captacion);
                        $idsubcampania = ($value->id_subcampania == '')?null:intval($value->id_subcampania);
                        $plantelOrigen = strClean($value->nom_conexion);
                        $folioTransferencia = strClean($value->folio_transferencia);
                        $response = $this->model->insertPersonaCSV($id, $nombrePersona, $apPaterno, $apMaterno, $alias, $direccion, $edad, $sexo, $cp, $colonia, $telCelular, $telFijo, $email, $edoCivil, $ocupacion, $idLocalidad, $curp, $fechaNacimiento, $estatus, $idRol, $idEscolaridad, $escuelaProcedencia, $plantelInteres, $nivelCarreraInteres, $carreraInteres, $medioCaptacion, $idsubcampania, $plantelOrigen, $folioTransferencia, $this->idUser, $this->nomConexion);
                        if(!$response){
                            $arrResponse = array('estatus' => false, 'msg' => 'Error al importar.');
                        }
                    }
                }
                $arrResponse = array('estatus' => true, 'msg' => 'Se ha importado correctamente.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>