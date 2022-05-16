<?php

	class Plantel extends Controllers{
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

		//Funcion para la Vista de PlantelesnomConexion
		public function Plantel()
		{
			$data['page_id'] = 4;
			$data['page_tag'] = "Planteles";
			$data['page_title'] = "Planteles";
			$data['page_name'] = "plantel";
			$data['page_content'] = "";
			$data['page_functions_js'] = "functions_planteles.js";
			$data['lista_categorias'] = $this->model->selectCategorias($this->nomConexion); //Traer lista de Categorias
			$data['lista_estados'] = $this->model->selectEstados($this->nomConexion); //Traer lista de Estados
			$data['sistemas_educativos'] = $this->model->selectSistemasEducativos($this->nomConexion);
			$this->views->getView($this,"plantel",$data);
		}

		//Funcion para traer Lista de Planteles
		public function getPlanteles(){
			$arrData = $this->model->selectPlanteles($this->nomConexion);
			for ($i=0; $i < count($arrData); $i++) {
				$arrData[$i]['numeracion'] = $i+1;
				$arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerPlantel" onClick="fntVerPlantel('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalVerPlantel" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlantel" onClick="fntEditPlantel('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlantel" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlantel" onClick="fntDelPlantel('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		
		//Funcion para obtener Datos de un Plantel
		public function getPlantel(int $idPlantel){
			$arrData = $this->model->selectPlantel($idPlantel, $this->nomConexion);
			$arrDataSistemaEducativo = $this->model->selectSistemaEducativo($arrData['id_sistema'],$this->nomConexion);
			$arrData['nombre_sistema_educativo'] = $arrDataSistemaEducativo['nombre_sistema'];
			$arrData['abreviacion_sistema_educativo'] = $arrDataSistemaEducativo['abreviacion_sistema'];
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		//Funcion para traer Lista de Municipios
		public function getMunicipios(){
			$idEstado = $_GET['idestado'];
			$arrData = $this->model->selectMunicipios($idEstado, $this->nomConexion);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		//Funcion para traer Lista de Localidades
		public function getLocalidades(){
			$idMunicipio = $_GET['idmunicipio'];
			$arrData = $this->model->selectLocalidades($idMunicipio, $this->nomConexion);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		//Funcion para Guardar un Nuevo Plantel
		public function setPlantel(){
			$data = $_POST;
            $files = $_FILES;
			$idPlantelEdit = 0;
			$idPlantelNuevo = 0;
			if(isset($_POST['idPlantelNuevo'])){
				$idPlantelNuevo = intval($_POST['idPlantelNuevo']);
			}
			if(isset($_POST['idPlantelEdit'])){
				$idPlantelEdit = intval($_POST['idPlantelEdit']);
			}
			
			if($idPlantelEdit != 0 ){
				$arrData = $this->model->updatePlantel($idPlantelEdit,$data,$files, $this->nomConexion);
				if($arrData['estatus'] != TRUE){
					$arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'La Clave del centro de trabajo ya existe');
				}
			}
			if($idPlantelNuevo == 1){
				$arrData = $this->model->insertPlantel($data,$files, $this->nomConexion);
			    if($arrData['estatus'] != TRUE){
			        if($arrData['imagen'] == false){
						$arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar la imagen.');
					}else{
						$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
					}
			    }else{
			    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La Clave del centro de trabajo ya existe'); 
                }
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		//Funcion para Elimniar un Plantel
		public function delPlantel(){
			if($_POST){
					$intIdPlantel = intval($_POST['idPlantel']);
					$requestTablaRef = $this->model->getTablasRef($this->nomConexion);
					if(count($requestTablaRef)>0){
						$requestStatus = 0;
						foreach ($requestTablaRef as $key => $tabla) {
							$nombreTabla = $tabla['tablas'];
							$existColumn = $this->model->selectColumn($nombreTabla, $this->nomConexion);
							if($existColumn){
								$requestEstatusRegistro = $this->model->estatusRegistroTabla($nombreTabla,$intIdPlantel, $this->nomConexion);
								 if($requestEstatusRegistro){
									$requestStatus += count($requestEstatusRegistro);
								}else{
									$requestStatus += 0;
								} 
							}
						}
						if($requestStatus == 0){
							$requestDelete = $this->model->deletePlantel($intIdPlantel, $this->nomConexion);
							if($requestDelete == 'ok'){
								$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el Plantel.');
							}else if($requestDelete == 'exist'){
								$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plantel.');
							}else{
								$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plantel.');
							} 
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar porque hay plan de estudios activos relacionados a este plantel.');
						} 
					}else{
						$requestDelete = $this->model->deletePlantel($intIdPlantel, $this->nomConexion);
						if($requestDelete == 'ok'){
							$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el Plantel.');
						}else if($requestDelete == 'exist'){
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plantel.');
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plantel.');
						}
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getListEstados(){
			$arrResponse = $this->model->selectEstados($this->nomConexion);
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}
?>