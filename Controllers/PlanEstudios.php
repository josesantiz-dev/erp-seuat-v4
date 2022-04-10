<?php
    class PlanEstudios extends Controllers{
        public function __construct(){
            parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
        }

        public function planestudios(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Planes de estudios";
            $data['page_title'] = "Planes de estudios";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_plan_estudios.js";
			$data['planteles'] = $this->model->selectPlanteles();
			$data['niveles_educativos'] = $this->model->selectNivelEducativo();
			$data['categorias'] = $this->model->selectCategorias();
			$data['modalidad'] = $this->model->selectModalidades();
			$data['plan'] = $this->model->selectPlanes();
			$data['clasificacion'] = $this->model->selectClasificaciones();
            $this->views->getView($this,"planestudios",$data);
        }

        function getPlanEstudios(){
            $arrData = $this->model->selectPlanEstudios();
            for ($i=0; $i < count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
				$arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
                if($arrData[$i]['estatus'] == 1)
				{
					$arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
				}else{
					$arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
				}
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerPlanEstudios" onClick="fntVerPlanEstudios('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormVerPlanEstudios" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlanEstudios" onClick="fntEditPlanEstudios('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlanEstudios" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlanEstudios" onClick="fntDelPlanEstudios('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para guardar una Categoria
		public function setPlanEstudios($arr){
			$data = $_POST;
			$arreglo = json_decode($arr);
			$idPlanEstudiosEdit = 0;
			$idPlanEstudiosNuevo = 0;
			if(isset($_POST['idNuevo'])){
				$idPlanEstudiosNuevo = intval($_POST['idNuevo']);
			}
			if(isset($_POST['idEdit'])){
				$idPlanEstudiosEdit = intval($_POST['idEdit']);
			}
			
			if($idPlanEstudiosEdit != 0 ){
				$arrData = $this->model->updatePlanEstudios($idPlanEstudiosEdit,$data,$arreglo);
				if($arrData){
					$arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
				}else{
					$arrResponse = array('estatus' => false, 'mgg' => 'No es posible actualizar los datos.');
				}
			}
			if($idPlanEstudiosNuevo == 1){
				$arrData = $this->model->insertPlanEstudios($data,$arreglo);
			    if($arrData){
			        $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
			    }else{
			        $arrResponse = array('estatus' => false, 'mgg' => 'No es posible almacenar los datos'); 
                }
			} 
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

        public function getPlanEstudio(int $idPlanEstudio){
            $arrData['plan_estudio'] = $this->model->selectPlanEstudio($idPlanEstudio);
            $arrData['clasificaciones'] = $this->model->selectClasificacionPlanEstudio($idPlanEstudio);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
        }
        public function getPlanEstudioEdit(int $idPlanEstudio){
			$arrData['plan_estudio'] = $this->model->selectPlanEstudioEdit($idPlanEstudio);
            $arrData['clasificaciones'] = $this->model->selectClasificacionPlanEstudio($idPlanEstudio);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

		public function delPlanEstudio(){
			if($_POST){
					$intIdPlanEstudio = intval($_POST['idPlanEstudio']);
					$requestTablaRef = $this->model->getTablasRef();
					if(count($requestTablaRef)>0){
						$requestStatus = 0;
						foreach ($requestTablaRef as $key => $tabla) {
							$nombreTabla = $tabla['tablas'];
							$existColumn = $this->model->selectColumn($nombreTabla);
							if($existColumn){
								$requestEstatusRegistro = $this->model->estatusRegistroTabla($nombreTabla,$intIdPlanEstudio);
								if($requestEstatusRegistro){
									$requestStatus += count($requestEstatusRegistro);
								}else{
									$requestStatus += 0;
								}	
							}
						}
						if($requestStatus == 0){
							$requestDelete = $this->model->deletePlanEdtudio($intIdPlanEstudio);
							if($requestDelete == 'ok'){
								$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el plan de estudios.');
							}else if($requestDelete == 'exist'){
								$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plan de estudios.');
							}else{
								$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plan de estudios.');
							}
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar porque hay materias activas relacionados a este plan de estudios.');
						}
					}else{
						$arrResponse = "eliminando";
						$requestDelete = $this->model->deletePlanEdtudio($intIdPlanEstudio);
						if($requestDelete == 'ok'){
							$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el plan de estudios.');
						}else if($requestDelete == 'exist'){
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plan de estudios.');
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plan de estudios.');
						}
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
       
    }
?>