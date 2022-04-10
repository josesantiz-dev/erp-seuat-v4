<?php
    class Persona extends Controllers{
        private $idUser;
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
            $this->idUser = $_SESSION['idUser'];
        }
        public function persona(){
            $data['page_id'] = 9;
            $data['page_tag'] = "Persona";
            $data['page_title'] = "Personas";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_persona.js";
            $data['estados'] = $this->model->selectEstados();
            $data['categoria_persona'] = $this->model->selectCategoriasPersona();
            $data['grados_estudios'] = $this->model->selectGradosEstudios();
            $data['planteles'] = $this->model->selectPlanteles();
            $data['nivel_carrera_interes'] = $this->model->selectNivelesEducativos();
            $data['medios_captacion'] = $this->model->selectMediosCaptacion();
            $this->views->getView($this,"persona",$data);
        }
        public function getPersona($idPersona){
            $idPersona = $idPersona;
            $arrData = $this->model->selectPersona($idPersona);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPersonaEdit($idPersona){
            $idPersona = $idPersona;
            $arrData = $this->model->selectPersonaEdit($idPersona);
            if($arrData['nombre_plantel_interes'] == null){
                $arrData['plantel_interes'] = "Sin Plantel";
            }else{
                $arrData['plantel_interes'] = $arrData['nombre_plantel_interes'];
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPersonas(){
            $arrData = $this->model->selectPersonas();
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
                $id_subcampania = $this->model->selectSubcampania();
                $arrData = $this->model->insertPersona($data,$this->idUser,$id_subcampania['id']);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'mgg' => 'No es posible guardar los datos');
                }
            }
            if($intIdPersonaEdit !=0){
                $arrData = $this->model->updatePersona($intIdPersonaEdit,$data,$this->idUser,$id_subcampania['id']);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos Actualizados Correctamente');
                }else{
                    $arrResponse = array('estatus' => true, 'mgg' => 'No es posible actualizar los datos');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
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
        public function getCarrerasInteres(){
            $idNivel = $_GET['idNivel'];
            $arrData = $this->model->selectCarrerasInteres($idNivel);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function delPersona(){
            if($_POST){
				$intIdPersona = intval($_POST['idPersona']);
				$requestDelete = $this->model->deletePersona($intIdPersona);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la Persona.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la Persona.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }
    }
?>