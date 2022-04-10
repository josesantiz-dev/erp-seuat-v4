<?php
    class Plan extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        public function plan(){
            $data['page_id'] = 8;
            $data['page_tag'] = "Organización de planes";
            $data['page_title'] = "Organización del plan de programa";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_plan.js";
            $this->views->getView($this,"plan",$data);
        }
        public function getPlanes(){
            $arrData = $this->model->selectPlanes();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                if($arrData[$i]['estatus'] == 1){
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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setPlan(){
            $data = $_POST;
            $intIdPlanNuevo = 0;
            $intIdPlanEdit = 0;
            if(isset($_POST['idNuevo'])){
                $intIdPlanNuevo = intval($_POST['idNuevo']);
            }
            if(isset($_POST['idEdit'])){
                $intIdPlanEdit = intval($_POST['idEdit']);
            }
            if($intIdPlanNuevo == 1){
                $arrData = $this->model->insertPlan($data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El plan ya existe');
                }
            }
            if($intIdPlanEdit !=0){
                $arrData = $this->model->updatePlan($intIdPlanEdit,$data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => $arrData['msg']);
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getPlan(int $idPlan){
            $arrData = $this->model->selectPlan($idPlan);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        //Funcion para Eliminar Plan
		public function delPlan(){
			if($_POST){
				$intIdPlan = intval($_POST['idPlan']);
				$requestDelete = $this->model->deletePlan($intIdPlan);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el plan.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plan.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
    }
?>