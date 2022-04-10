<?php
    class NivelEducativo extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        //Funccion para la Vista de NivelEducativos
        public function niveleducativo(){
            $data['page_id'] = 7;
            $data['page_tag'] = "Niveles educativo";
            $data['page_title'] = "Niveles educativos";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_nivel_educativo.js";
            $this->views->getView($this,"niveleducativo",$data);
        }
        public function getNivelesEducativos(){
            $arrData = $this->model->selectNivelesEducativos();
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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditNivelEducativo" onClick="fntEditNivelEducativo('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditNivelEducativo" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelNivelEducativo" onClick="fntDelNivelEducativo('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setNivelEducativo(){
            $data = $_POST;
            $intIdNivelEducativoNuevo = 0;
            $intIdNivelEducativoEdit = 0;
            if(isset($_POST['idNuevo'])){
                $intIdNivelEducativoNuevo = intval($_POST['idNuevo']);
            }
            if(isset($_POST['idEdit'])){
                $intIdNivelEducativoEdit = intval($_POST['idEdit']);
            }
            if($intIdNivelEducativoNuevo == 1){
                $arrData = $this->model->insertNivelEducativo($data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El nivel educativo ya existe');
                }
            }
            if($intIdNivelEducativoEdit !=0){
                $arrData = $this->model->updateNivelEducativo($intIdNivelEducativoEdit,$data);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => $arrData['msg']);
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getNivelEducativo(int $idNivelEducativo){
            $arrData = $this->model->selectNivelEducativo($idNivelEducativo);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        //Funcion para Eliminar Nivel Educativo
		public function delNivelEducativo(){
			if($_POST){
				$intIdNivelEductaivo = intval($_POST['idNivelEducativo']);
				$requestDelete = $this->model->deleteNivelEducativo($intIdNivelEductaivo);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el nivel educativo.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el nivel educativo.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
    }
?>