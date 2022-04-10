<?php
    class Modalidades extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
         //Funcion para la Vista de Modalidades
        public function modalidades(){
            $data['page_id'] = 6;
            $data['page_tag'] = "Modalidades";
            $data['page_title'] = "Modalidades";
            $data['page_name'] = "modalidades";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_modalidades.js";
            
            $this->views->getView($this,"modalidades",$data);
        }
        public function getModalidades(){
            $arrData = $this->model->selectModalidades();
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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditModalidad" onClick="fntEditModalidad('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditModalidad" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelModalidad" onClick="fntDelModalidad('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setModalidad(){
            $data = $_POST;
            $intIdModalidadNueva = 0;
            $intIdModalidadEdit = 0;
            if(isset($_POST['idModalidadNueva'])){
                $intIdModalidadNueva = intval($_POST['idModalidadNueva']);
            }
            if(isset($_POST['idModalidadEdit'])){
                $intIdModalidadEdit = intval($_POST['idModalidadEdit']);
            }
            if($intIdModalidadNueva == 1){
                $arrData = $this->model->insertModalidad($data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La modalidad ya existe');
                }
            }
            if($intIdModalidadEdit !=0){
                $arrData = $this->model->updateModalidad($intIdModalidadEdit,$data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'El nombre de la modalidad ya esiste');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getModalidad(int $idModalidad){
            $arrData = $this->model->selectModalidad($idModalidad);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        //Funcion para Eliminar Modalidad
		public function delModalidad(){
			if($_POST){
				$intIdModalidad = intval($_POST['idModalidad']);
				$requestDelete = $this->model->deleteModalidad($intIdModalidad);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la modalidad.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la modalidad.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
    }
?>