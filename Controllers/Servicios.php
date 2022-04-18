<?php
	class Servicios extends Controllers{

		private $idUser;
        private $nomConexion;
        private $rol;

		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
				die();
			}
			$this->idUser = $_SESSION['idUser'];
            $this->nomConexion = $_SESSION['nomConexion'];
            // $this->rol = $_SESSION['claveRol'];
		}
		public function Servicios(){
			$data['page_tag'] = "Servicios";
			$data['page_title'] = "Servicios";
			$data['page_name'] = "servicios";
			$data['page_functions_js'] = "functions_servicios.js";
			$data['categoria'] = $this->model->selectCategoriaServicios($this->nomConexion);
			$data['unidad_medida'] = $this->model->selectUnidadMedida($this->nomConexion);
			$data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
			$this->views->getView($this,"servicios",$data);
		}

		public function getServicios(){
			$arrData = $this->model->selectServicios($this->nomConexion);
			for ($i=0; $i < count($arrData); $i++) {
				$arrData[$i]['numeracion'] = $i+1;
				if($arrData[$i]['EstatusServicios'] == 1){
					$arrData[$i]['EstatusServicios'] = '<span class="badge badge-dark">Activo</span>';
				}else{
					$arrData[$i]['EstatusServicios'] = '<span class="badge badge-secondary">Inactivo</span>';
				}
				if($arrData[$i]['AplicaEdoCuenta'] == 1){
					$arrData[$i]['AplicaEdoCuenta'] = '<div class="text-center text-primary"><i class="fas fa-check"></i></div>';
				}else{
					$arrData[$i]['AplicaEdoCuenta'] = '<div class="text-center"><i class="fas fa-ban"></i></div>';
				}
				$arrData[$i]['options'] = '
				<div class="text-center">
					<div class="btn-group">
						<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-layer-group"></i> &nbsp; Acciones
						</button>
						<div class="dropdown-menu">
							<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditServicio" onClick="fnEditServicio(this,'.$arrData[$i]['IdServicios'].')" title="Editar" data-toggle="modal" data-target="#modalFormEditServicios"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
							<div class="dropdown-divider"></div>
							<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelServicio" onClick="fntDelServicio('.$arrData[$i]['IdServicios'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						</div>
					</div>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getServicio(int $id){
			$arrData = $this->model->selectServicio($id, $this->nomConexion);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getSelectUnidadMedida(){
			$htmlOptions = "<option value='' selected>- Elige una unidad de medida -</option>";
			$arrData = $this->model->selectUnidadMedida($this->nomConexion);
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) {
					if($arrData[$i]['estatus'] == 1){
						
						$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_unidad_medida'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}
		public function getSelectCategoriaServicios(){
			$htmlOptions = "<option value='' selected>- Elige una categoría para el servicio -</option>";
			$arrData = $this->model->selectCategoriaServicios($this->nomConexion);
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) {
					if($arrData[$i]['estatus'] == 1){
						
						$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_categoria'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}
		
		public function getSelectPlanteles(){
			$htmlOptions = "<option value='' selected>- Elige un plantel -</option>";
			$arrData = $this->model->selectPlanteles($this->nomConexion);
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) {
					if($arrData[$i]['estatus'] == 1){
						
						$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_plantel'].', '.$arrData[$i]['municipio'].', '.$arrData[$i]['estado'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}
		public function setServicio(){
			if($_POST){ //dep($_POST); die();
			//if($_SESSION['permisosMod']['w']){
				if(empty($_POST['txtCodigo_servicio']) || empty($_POST['txtNombre_servicio']) || empty($_POST['txtPrecio_unitario']) || empty($_POST['listAnioFiscal']) || empty($_POST['listEstatus']) || empty($_POST['txtFecha_creacion']) || empty($_POST['txtId_usuario_creacion'])  || empty($_POST['listIdPlantel']) || empty($_POST['listIdCategoria_servicio']) || empty($_POST['listIdUnidades_medida']) )
					{
						$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
					}else{
					$intIdServicio = intval($_POST['idServicio']);
					$strCodigo_servicio =  strClean($_POST['txtCodigo_servicio']);
					$strNombre_servicio =  strClean($_POST['txtNombre_servicio']);
					$intPrecio_unitario = intval($_POST['txtPrecio_unitario']);
					// $intAplica_edo_cuenta = intval($_POST['chkAplica_edo_cuenta']);
					$intAplica_edo_cuenta = (empty($_POST['chkAplica_edo_cuenta'])?0:1);
					$strAnio_fiscal = strClean($_POST['listAnioFiscal']);
					$intEstatus = intval($_POST['listEstatus']);
					$strFecha_creacion = date('Y-m-d H:i:s'); // strClean($_POST['txtFecha_creacion']);
					$strFecha_actualizacion = strClean($_POST['txtFecha_actualizacion']);
					$intId_usuario_creacion = strClean($_POST['txtId_usuario_creacion']);
					$intId_usuario_actualizacion = intval($_POST['txtId_usuario_actualizacion']);
					$intIdPlantel = intval($_POST['listIdPlantel']);
					$intIdCategoria_servicio = intval($_POST['listIdCategoria_servicio']);
					$intIdUnidades_medida = intval($_POST['listIdUnidades_medida']);

					if($intIdServicio == 0){
						$request_servicio = $this->model->insertServicio($strCodigo_servicio,$strNombre_servicio, $intPrecio_unitario, $intAplica_edo_cuenta, $strAnio_fiscal,$intEstatus,$strFecha_creacion,$strFecha_actualizacion,$intId_usuario_creacion,$intId_usuario_actualizacion, $intIdPlantel,$intIdCategoria_servicio,$intIdUnidades_medida, $this->nomConexion);
						$option = 1;
					} 
					if($request_servicio > 0 ){
						if($option == 1){
							$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
						}
					}else if($request_servicio == 'exist'){
						$arrResponse = array('estatus' => false, 'msg' => '¡Atención! el código del servicio ingresado ya existe.');
					}else{
						$arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			  //}
			}
			die();
		}

		public function setServicios_up(){
			if($_POST){
				if(empty($_POST['idServicioEdit'])  || empty($_POST['txtCodigo_servicio_edit']) || empty($_POST['txtNombre_servicio_edit']) || 
				empty($_POST['txtPrecio_unitario_edit']) || empty($_POST['listIdCategoria_servicio_edit']) || empty($_POST['listIdUnidades_medida_edit']) || 
				empty($_POST['listAnioFiscal_edit']) || empty($_POST['listIdPlantel_edit']) || empty($_POST['list_estatus_servicios_edit']) ){
					$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
				}else{
					$intIdServicio = intval($_POST['idServicioEdit']);
					$strCodigo_servicio =  strClean($_POST['txtCodigo_servicio_edit']);
					$strNombre_servicio =  strClean($_POST['txtNombre_servicio_edit']);
					$intPrecio_unitario = intval($_POST['txtPrecio_unitario_edit']);
					$intIdCategoria_servicio = intval($_POST['listIdCategoria_servicio_edit']);
					$intIdUnidades_medida = intval($_POST['listIdUnidades_medida_edit']);
					$strAnio_fiscal = strClean($_POST['listAnioFiscal_edit']);
					// $intAplica_edo_cuenta = intval($_POST['chkAplica_edo_cuenta_edit']);
					$intAplica_edo_cuenta = (empty($_POST['chkAplica_edo_cuenta_edit'])?0:1);
					$intIdPlantel = intval($_POST['listIdPlantel_edit']);
					$intEstatus = intval($_POST['list_estatus_servicios_edit']);
					$arrRequest = $this->model->updateServicio($intIdServicio,$strCodigo_servicio,$strNombre_servicio,$intPrecio_unitario,
						$intIdCategoria_servicio,$intIdUnidades_medida,$strAnio_fiscal,$intAplica_edo_cuenta,$intIdPlantel,$intEstatus,$_SESSION['idUser'],$this->nomConexion);
					if($arrRequest){
						$arrResponse = array("estatus" => true, "msg" => 'Datos actualizados correctamente.');
					}else{
						$arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos.');
					}
					
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function delServicio(){
			if($_POST){
				//if($_SESSION['permisosMod']['d']){ 
				$intIdServicio = intval($_POST['idServicio']);
				$requestDelete = $this->model->deleteServicio($intIdServicio, $this->nomConexion);
				if($requestDelete == 'ok'){
					$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el servicio correctamente.');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un servicio asociado a una venta activa.');
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el servicio.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					//}
			}
			die();
		}	
		
	}
?>