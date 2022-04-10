<?php
class Unidad_medida extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
    }

    public function Unidad_medida()
    {
        $data['page_tag'] = "Unidad de medida";
        $data['page_title'] = "Unidad de medida";
        $data['page_name'] = "unidad de medida";
        $data['page_functions_js'] = "functions_unidad_medida.js";
        $this->views->getView($this, "unidad_medida", $data);
    }

    public function getUnidad_medidas()
    {
        $arrData = $this->model->selectUnidad_medidas();
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['numeracion'] = $i+1;
            if ($arrData[$i]['estatus'] == 1) {
                $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
            } else {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $arrData[$i]['options'] = '
					<div class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-layer-group"></i> &nbsp; Acciones
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditUnidadMedida" onClick="fntEditUnidad_medida(this,' . $arrData[$i]['id'] . ')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelUnidadMedida" onClick="fntDelUnidad_medida(' . $arrData[$i]['id'] . ')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
							</div>
						</div>
					</div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setUnidad_medida(){
        if ($_POST) {
            if (empty($_POST['txtNombre']) || empty($_POST['listEstatus']) || empty($_POST['txtTipo']) || empty($_POST['txtClave'])) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intIdUnidad_medida = intval($_POST['idUnidad_medida']);
                $strNombre = strClean($_POST['txtNombre']);
                $intEstatus = intval($_POST['listEstatus']);
				$strTipo = strClean($_POST['txtTipo']);
				$strClave = strClean($_POST['txtClave']);
				if ($intIdUnidad_medida == 0) {
                    $requestUnidadMedida = $this->model->insertUnidad_medida($intIdUnidad_medida,$strNombre,$intEstatus,$strTipo,$strClave,$_SESSION['idUser']);
                    if($requestUnidadMedida){
                        if($requestUnidadMedida == 'exist'){
                            $arrResponse = array('estatus' => false,'msg'=>'¡Atención! el nombre d ela unidad de medida ya existe');
                        }else{
                            $arrResponse = array('estatus' => true,'msg'=>'Datos guardados correctamente');
                        }
                    }else{
                        $arrResponse = array('estatus' => false,'msg'=>'No es posible almacenar los datos');
                    }
					
                }
            } 
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUnidad_medida($id)
    {
        //if($_SESSION['permisosMod']['r']){
        $intIdUnidad_medida = intval(strClean($id));
        if ($intIdUnidad_medida > 0) {
            $arrData = $this->model->selectUnidad_medida($intIdUnidad_medida);
            if (empty($arrData)) {
                $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('estatus' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        //}
        die();
    }

    public function setUnidad_medida_up(){
        if ($_POST) { 
            if (empty($_POST['idUnidad_medidaup']) || empty($_POST['txtTipoEdit']) || empty($_POST['txtClaveEdit']) || empty($_POST['txtNombreEdit']) || empty($_POST['listEstatusEdit'])) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intId = intval($_POST['idUnidad_medidaup']);
                $strTipo = strClean($_POST['txtTipoEdit']);
                $strClave = strClean($_POST['txtClaveEdit']);
                $strNombre = strClean($_POST['txtNombreEdit']);
                $intEstatus = intval($_POST['listEstatusEdit']);
                $intIdUser = $_SESSION['idUser'];
                if ($intId != 0) {
                    $requestUnidadMedida = $this->model->updateUnidad_medida($intId,$strTipo,$strClave,$strNombre,$intEstatus,$intIdUser);
                    if($requestUnidadMedida){
                        if($requestUnidadMedida === "exist"){
                            $arrResponse = array('estatus' => false, 'msg' => 'Existe un registro con el mismo nombre.');
                        }else{
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
                        }
                    }else{
                        $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos.');
                    }
                    
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delUnidad_medida(){
        if ($_POST) {
            $intIdUnidad_medida = intval($_POST['idUnidad_medida']);
            $requestDelete = $this->model->deleteUnidad_medida($intIdUnidad_medida);
            if ($requestDelete == 'ok') {
                $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la unidad de medida correctamente.');
            } else if ($requestDelete == 'exist') {
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una unidad de medida asociado a un servicio activo.');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la unidad de medida.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}
