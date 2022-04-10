<?php

class Roles extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
	}

	public function Roles()
	{
		$data['page_id'] = 3;
		$data['page_tag'] = "Roles de Usuario";
		$data['page_name'] = "rol_usuario";
		$data['page_title'] = "Roles de usuario";
		$data['page_functions_js'] = "functions_roles.js";
		$this->views->getView($this,"roles",$data);
	}

			public function getRoles()
		{
			$arrData = $this->model->selectRoles();

			for ($i=0; $i < count($arrData); $i++) {

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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['id'].')" title="Permisos"> &nbsp;&nbsp; <i class="fas fa-key icono-azul"></i> &nbsp; Permisos</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditRol" onClick="fntEditRol('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormRol" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelRol" onClick="fntDelRol('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>


				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estatus'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_rol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		public function getRol(int $idrol)
		{
			//if($_SESSION['permisosMod']['r']){
				$intIdrol = intval(strClean($idrol));
				if($intIdrol > 0)
				{
					$arrData = $this->model->selectRol($intIdrol);
					if(empty($arrData))
					{
						$arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('estatus' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}		

		public function setRol(){
			//dep($_POST);
			$intIdrol = intval($_POST['idRol']);
			$strRol =  strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intEstatus = intval($_POST['listEstatus']);
			//$request_rol = "";
			if($intIdrol == 0)
			{
				//Crear
				//if($_SESSION['permisosMod']['w']){
					$request_rol = $this->model->insertRol($strRol, $strDescripcion,$intEstatus);
					$option = 1;
				//}
			}else{
				//Actualizar
				//if($_SESSION['permisosMod']['u']){
					$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intEstatus);
					$option = 2;
				//}		
			}

				if($request_rol > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
					}
				}else if($request_rol == 'exist'){
					
					$arrResponse = array('estatus' => false, 'msg' => '¡Atención! El Rol ya existe.');
				}else{
					$arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delRol()
		{
			if($_POST){
				//if($_SESSION['permisosMod']['d']){
					$intIdrol = intval($_POST['idRol']);
					$requestDelete = $this->model->deleteRol($intIdrol); // Crear Método deleteRol en el Modelo RolesModel.php
					if($requestDelete == 'ok')
					//if($requestDelete)
					{
						$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el Rol.');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//}
			}
			die();
		}		
}

?>