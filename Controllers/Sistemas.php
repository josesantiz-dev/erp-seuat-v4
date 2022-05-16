<?php
    class Sistemas extends Controllers{
        private $idUSer;
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
            $this->idUSer = $_SESSION['idUser'];
            $this->nomConexion = $_SESSION['nomConexion'];
            $this->rol = $_SESSION['claveRol'];
        }
        //return View sistema
        public function sistemas()
        {   $data['page_tag'] = "Sistemas educativos";
			$data['page_title'] = "Sistemas educativos";
			$data['page_name'] = "sistemas educativos";
			$data['page_functions_js'] = "functions_sistemas.js";
            $this->views->getView($this,'sistema',$data);
        }

        //return Lists Sistemas
        public function getSistemas()
        {
            $arrResponse = $this->model->selectSistemas($this->nomConexion);
            for($i = 0; $i <count($arrResponse); $i++){
                $arrResponse[$i]['numeracion'] = $i+1;
                $arrResponse[$i]['estatus'] = ($arrResponse[$i]['estatus'] == 1)?'<span class="badge badge-success">Activo</span>':'<span class="badge badge-warning">Innactivo</span>';
                $arrResponse[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fnEditSistema('.$arrResponse[$i]['id'].')" data-toggle="modal" data-target="#modal_edit_sistema" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fnDelSistema('.$arrResponse[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //set New Sistema
        public function setSistema()
        {
            $data = $_POST;
            $files = $_FILES;
            $strNombresistema = $data['txt_nombre_sistema'];
            $strAbreviacion = $data['txt_abreviacion'];
            $strUbicacionFileTmp = $files['profileImageSistema']['tmp_name'];
            $nombreImagenSistema = time().'-'.conexiones[$this->nomConexion]['NAME'].'-Sistema-Educativo'.'.'.pathinfo($files['profileImageSistema']['name'],PATHINFO_EXTENSION);
            $direccionLogos = 'Assets/images/logos/';
			$nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema);
            if($strNombresistema == '' || $strAbreviacion == '' || $strUbicacionFileTmp == ''){
                $arrResponse = array('estatus' => false, 'msg' => 'Atención todos los campos son obligatorio');
            }
            if(move_uploaded_file($strUbicacionFileTmp,$nombreImagenSistemaFile)){
                $setSistema = $this->model->insertSistema($strNombresistema,$strAbreviacion,$nombreImagenSistema,$this->nomConexion,$this->idUSer);
                if($setSistema){
                    $arrResponse = array('estatus' => true, 'msg' => 'Se guardaron correctamente los datos');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar los datos');
                }
            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar la imagen');   
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Get Sistema By ID
        public function getSistema(int $idSistema)
        {   
            if($idSistema != null || $idSistema != ''){
                $arrData = $this->model->selectSistema($idSistema,$this->nomConexion);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => '', 'data'=>$arrData);   
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No se pudo obtener los datos', 'data'=> '');   
                }
            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo obtener los datos','data'=>'');   
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Update del sistema
        public function updateSistema()
        {
            $idSisistema = intval($_POST['id_sistema_edit']);
            $strNombreSistema = strClean($_POST['txt_nombre_sistema_edit']);
            $strAbreviacion = strClean($_POST['txt_abreviacion_edit']);
            $intEstatus = intval($_POST['listEstatusEdit']);
            $strNomFileActual = $_POST['name_file_edit']; //Logo actual
            $files = $_FILES;
            $strUbicacionFileTmp = $files['profileImageSistema']['tmp_name']; //Logo nuevo
            $nombreFile = "";
            if($idSisistema == '' || $strNombreSistema == '' || $strAbreviacion == '' || $intEstatus == ''){
                $arrResponse = array('estatus' => false, 'msg' => 'Atención todos los campos son obligatorio');
            }
            if($strUbicacionFileTmp != ''){ //Se cambio el Logo
                $direccionLogos = 'Assets/images/logos/';
                $nombreImagenSistema = time().'-'.conexiones[$this->nomConexion]['NAME'].'-Sistema-Educativo'.'.'.pathinfo($files['profileImageSistema']['name'],PATHINFO_EXTENSION);
                $nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema);
                if(move_uploaded_file($strUbicacionFileTmp,$nombreImagenSistemaFile)){
                    $arrData = $this->model->updateSistema($idSisistema,$strNombreSistema,$strAbreviacion,$intEstatus,$nombreImagenSistema,$this->idUSer,$this->nomConexion);
                    if($arrData){
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                    }

                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No se pudo actualizar la imagen');
                }
            }else{
                $arrData = $this->model->updateSistema($idSisistema,$strNombreSistema,$strAbreviacion,$intEstatus,null,$this->idUSer,$this->nomConexion);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                }
            }
            //$checkExist = $this->model->selectSistemaExist($idSisistema,$strNombreSistema,$strAbreviacion,$intEstatus,$this->nomConexion,$this->idUSer);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delSistema(int $idSistema)
        {
            if($idSistema == ''){
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo eliminar el registro');
                die();
            }
            $arrData = $this->model->delSistema($idSistema,$this->idUSer,$this->nomConexion);
            if($arrData){
                $arrResponse = array('estatus' => true, 'msg' => 'Registro eliminado correctamente');
            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo eliminar el registro');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }


?>