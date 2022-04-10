<?php
class Salones extends Controllers{
    public function __construct(){
        parent::__construct();
		session_start();
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
    }

    public function salon(){
        $data['page_tag'] = 'Salones';
        $data['page_title'] = 'Salones';
        $data['data_name'] = 'Salones';
        $data['page_functions_js'] = 'functions_salones.js';
        $this->views->getView($this,'salon',$data);
    }

    public function getSalones()
    {
        $arrData = $this->model->selectSalones();
        for($i=0; $i<count($arrData); $i++)
        {
            $arrData[$i]['numeracion'] = $i + 1;
            if($arrData[$i]['estatus'] == 1)
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-primary">Activo</span>';
            }
            else
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $arrData[$i]['options'] = '<div class="text-center">
            <div class="btn-group">
                <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i> &nbsp; Acciones
                </button>
                <div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" onClick="fnEditarSalon('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalEditSalon" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnEliminarSalon('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
				</div>
            </div>

            </div>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }

    public function getSalon(int $idSalon)
    {
        $intIdSalon = intval(strClean($idSalon));
        if($intIdSalon > 0)
        {
            $arrData = $this->model->selectSalon($intIdSalon);
            if(empty($arrData))
            {
                $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados');
            }
            else
            {
                $arrResponse = array('estatus' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setSalon(){
        $intIdSalonNuevo = 0;
        $intIdSalonEdit = 0;
        if(isset($_POST['idSalonNuevo']))
        {
            $intIdSalonNuevo = intval($_POST['idSalonNuevo']);
        }
        if(isset($_POST['idSalonEdit']))
        {
            $intIdSalonEdit = intval($_POST['idSalonEdit']);
        }
        //$intIdSalonNuevo = isset($_POST['idSalonNuevo']);
        //$intIdSalonEdit = isset($_POST['idSalonEdit']);
    
        if ($intIdSalonNuevo == 1) {
            $strNombreSalon = strClean($_POST['txtNombreNuevo']);
            $strCantidadMax = intval($_POST['txtCantidadMax']);
            $arrData = $this->model->insertSalon($strNombreSalon, $strCantidadMax);
            if ($arrData['estatus'] != TRUE) {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => '¡Atención! el salón ya existe');
            }
        }


        if($intIdSalonEdit != 0){
            $strNombreSalonEdit = strClean($_POST['txtNombreEdit']);
            $strCantidadMaxEdit = intval($_POST['txtCantidadMaxEdit']);
            $intEstatus = intval($_POST['slctEstatus']);
            $arrData = $this->model->updateSalon($intIdSalonEdit, $strNombreSalonEdit, $strCantidadMaxEdit, $intEstatus);
            if($arrData['estatus'] != TRUE){
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
            }
            else{
                $arrResponse = array('estatus' => false, 'msg'=> 'El nombre del salón ya existe');
            }
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delSalon()
    {
        $idSln = $_GET['id'];
        $requestDelete = $this->model->deleteSalon($idSln);
        if($requestDelete == 'ok')
        {
            $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el salón');
        }
        else if($requestDelete == 'exist')
        {
            $arrResponse = array('estatus' => false, 'msg' => 'No se puede eliminar el salón');
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el salón');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>