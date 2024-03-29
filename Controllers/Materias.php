<?php
    class Materias extends Controllers{
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

        public function materias(){
            $data['page_id'] = 9;
            $data['page_tag'] = "Materias";
            $data['page_title'] = "Materias";
            $data['page_content'] = "";
            $data['grados'] = $this->model->selectGrados($this->nomConexion);
            $data['plantel'] = $this->model->selectPlanteles($this->nomConexion);
            $data['clasificacion_materia'] = $this->model->selectClasificacion($this->nomConexion);
            $data['page_functions_js'] = "functions_materias.js";
            $this->views->getView($this,"materias",$data);
        }
        public function getMaterias(){
            $arrData = $this->model->selectMaterias($this->nomConexion);
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
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerMateria" onClick="fntVerMateria('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormVerMateria" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditMateria" onClick="fntEditMateria('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditMateria" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelMateria" onClick="fntDelMateria('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setMateria(){
            $data = $_POST;
            $intIdMateriaNueva = 0;
            $intIdMateriaEdit = 0;
            if(isset($_POST['idNuevo'])){
                $intIdMateriaNueva = intval($_POST['idNuevo']);
            }
            if(isset($_POST['idEdit'])){
                $intIdMateriaEdit = intval($_POST['idEdit']);
            }
            if($intIdMateriaNueva == 1){
                $arrData = $this->model->insertMateria($data, $this->nomConexion);
                if($arrData['estatus'] != TRUE){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La materia ya existe');
                }
            }
            if($intIdMateriaEdit !=0){
                $arrData = $this->model->updateMateria($intIdMateriaEdit,$data, $this->nomConexion);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos');

                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getMateria(int $idMateria){
            $arrData = $this->model->selectMateria($idMateria, $this->nomConexion);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        
        public function getPlanEstudiosNuevo(){
            $id = $_GET['id'];
            $arrData = $this->model->selectPlanEstudiosNuevo($id, $this->nomConexion);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPlanEstudios(){
            $arrData = $this->model->selectPlanEstudios($this->nomConexion);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        public function getGrados(){
            $arrData = $this->model->selectGrados($this->nomConexion);
            if($arrData){
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        //Funcion para Eliminar Materia
		public function delMateria(){
			if($_POST){
				$intIdMateria = intval($_POST['idMateria']);
				$requestDelete = $this->model->deleteMateria($intIdMateria, $this->nomConexion);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la materia.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la materia.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}

        public function checkCreditos(){
            $clasificacion = intval($_GET['clasificacion']);
            $credito = intval($_GET['credito']);
            $plnEstudio = intval($_GET['plan_estudio']);
            $arrData = $this->model->selectPlanEstudio($plnEstudio, $this->nomConexion);
            $arrDataClasificaciones = $this->model->selectClasificacionPlanEstudio($plnEstudio,$this->nomConexion);
            $arrDataCreditoClasificacion = $this->model->selectCreditoClasificacionPlanEstudio($plnEstudio,$clasificacion,$this->nomConexion);
            //$arrData = $this->model->selectClasificacionPlanEstudio($planEstudio, $this->nomConexion);
            $totalCreditoClasificacion = 0;
            $sumCreditosUtilizados = 0;
            $exist = false;
            foreach ($arrDataClasificaciones as $key => $clasif) {
                if(intval($clasif['id_clasificacion_materias']) == $clasificacion){
                    $exist = true;
                    $totalCreditoClasificacion = $clasif['total_creditos'];
                    break;
                }
            }
            for ($i=0; $i < count($arrDataCreditoClasificacion); $i++) { 
                $sumCreditosUtilizados += $arrDataCreditoClasificacion[$i]['creditos'];
            }
            if($exist){
                if($totalCreditoClasificacion < $sumCreditosUtilizados+$credito || $arrData['total_creditos'] < $sumCreditosUtilizados){
                    $requestData['estatus'] = false;
                    $requestData['msg'] = "La sumatoria de los creditos de las materias es mayor que el total del credito asignado a la clasificación asignada";
                }else{
                    $requestData['estatus'] = true;
                    $requestData['creditosUtilizados'] = $sumCreditosUtilizados;
                    $requestData['totalCreditos'] = $totalCreditoClasificacion;
                    $requestData['msg'] = "";
                }
            }else{
                if($clasificacion == 6){
                    $requestData['estatus'] = true;
                    $requestData['msg'] = "";
                }else{
                    $requestData['estatus'] = false;
                    $requestData['msg'] = "No existe la clasificación seleccionada, por favor agregar en el plan de estudios";
                }
            }
            echo json_encode($requestData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function checkCreditosEdit(){
            $clasificacion = intval($_GET['clasificacion']);
            $creditoActual = intval($_GET['creditoActual']);
            $credito = intval($_GET['creditoNuevo']);
            $plnEstudio = intval($_GET['plan_estudio']);
            $idClasifActual = intval($_GET['idClasifActual']);
            $arrData = $this->model->selectPlanEstudio($plnEstudio, $this->nomConexion);
            $arrDataClasificaciones = $this->model->selectClasificacionPlanEstudio($plnEstudio,$this->nomConexion);
            $arrDataCreditoClasificacion = $this->model->selectCreditoClasificacionPlanEstudio($plnEstudio,$clasificacion,$this->nomConexion);
            //$arrData = $this->model->selectClasificacionPlanEstudio($planEstudio, $this->nomConexion);
            $totalCreditoClasificacion = 0;
            $sumCreditosUtilizados = 0;
            $exist = false;
            foreach ($arrDataClasificaciones as $key => $clasif) {
                if(intval($clasif['id_clasificacion_materias']) == $clasificacion){
                    $exist = true;
                    $totalCreditoClasificacion = $clasif['total_creditos'];
                    break;
                }
            }
            for ($i=0; $i < count($arrDataCreditoClasificacion); $i++) { 
                $sumCreditosUtilizados += $arrDataCreditoClasificacion[$i]['creditos'];
            }
            if($exist){
                if($idClasifActual == $clasificacion){
                    if($totalCreditoClasificacion < $sumCreditosUtilizados-$creditoActual+$credito){
                        $requestData['estatus'] = false;
                        $requestData['msg'] = "La sumatoria de los creditos de las materias es mayor que el total del credito asignado a la clasificación asignada";
                    }else{
                        $requestData['estatus'] = true;
                        $requestData['msg'] = "";
                    }
                }else{
                    if($totalCreditoClasificacion <$sumCreditosUtilizados+$credito){
                        $requestData['estatus'] = false;
                        $requestData['msg'] = "La sumatoria de los creditos de las materias es mayor que el total del credito asignado a la clasificación asignada";
                    }else{
                        $requestData['estatus'] = true;
                        $requestData['msg'] = "";
                    }
                }
            }else{
                if($clasificacion == 6){
                    $requestData['estatus'] = true;
                    $requestData['msg'] = "";
                }else{
                    $requestData['estatus'] = false;
                    $requestData['msg'] = "No existe la clasificación seleccionada, por favor agregar en el plan de estudios";
                }
            }
            echo json_encode($requestData,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>    