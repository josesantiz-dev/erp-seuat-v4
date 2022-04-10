<?php
class Promocion extends Controllers
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
    public function Promocion()
    {
        $data['page_tag'] = "Promocion de servicios";
        $data['page_title'] = "Promoción servicios";
        $data['page_name'] = "promocion_servicios";
        $data['page_functions_js'] = "functions_promocion.js";
		$data['servicios'] = $this->model->selectServicios();
		$data['campanias'] = $this->model->selectCampanias();
        $this->views->getView($this, "promocion", $data);
    }

    public function getPromociones(){
        $arrData = $this->model->selectPromociones();
        for ($i = 0; $i < count($arrData); $i++) {
			$arrData[$i]['numeracion'] = $i+1;
            if ($arrData[$i]['EstatusPromocion'] == 1) {
                $arrData[$i]['EstatusPromocion'] = '<span class="badge badge-dark">Activo</span>';
            } else {
                $arrData[$i]['EstatusPromocion'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $arrData[$i]['options'] = '
					<div class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-layer-group"></i> &nbsp; Acciones
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPromocion" onClick="fntEditPromocion(this,' . $arrData[$i]['IdPromocion'] . ')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPromocion" onClick="fntDelPromocion(' . $arrData[$i]['IdPromocion'] . ')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
							</div>
						</div>
					</div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getCategoria_servicio($id)
    {
        //if($_SESSION['permisosMod']['r']){
        $intIdCategoria_servicios = intval(strClean($id));
        if ($intIdCategoria_servicios > 0) {
            $arrData = $this->model->selectCategoria_servicio($intIdCategoria_servicios);
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

    public function getSelectServicios()
    {
        $htmlOptions = "<option value='' selected>- Elige un servicio -</option>";
        $arrData = $this->model->selectServicios();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                if ($arrData[$i]['estatus'] == 1) {

                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['nombre_servicio'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }
	public function getSelectServiciosEdit($id)
    {
        $htmlOptions = "";
        $arrData = $this->model->selectServicios();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['estatus'] == 1) {
                    if($arrData[$i]['id'] == $id){
                        $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '" selected>' . $arrData[$i]['nombre_servicio'] . '</option>';
                    }else{
                        $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['nombre_servicio'] . '</option>';
                    }
                }
				
            }
        }
        echo $htmlOptions;
        die();
    }

    public function getSelectCampanias()
    {
        $htmlOptions = "<option value='' selected>- Elige una campaña -</option>";
        $arrData = $this->model->selectCampanias();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                if ($arrData[$i]['estatus'] == 1) {

                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['nombre_campania'] . '</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }

    public function getSelectSubcampania($idCampania)
    {
        //if($_SESSION['permisosMod']['r']){
        $intIdCampania = intval(strClean($idCampania));
        $htmlOptions = "<option value='' selected>- Elige una subcampaña -</option>";
        $arrData = $this->model->selectSubcampanias($intIdCampania);
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                if ($arrData[$i]['estatus'] == 1) {

                    $htmlOptions .= '<option value="' . $arrData[$i]['id'] . '">' . $arrData[$i]['nombre_sub_campania'] . ' [ ' . $arrData[$i]['fecha_inicio'] . ' - ' . $arrData[$i]['fecha_fin'] . ' ]</option>';
                }
            }
        }
        echo $htmlOptions;
        //}
        die();
    }

    public function setPromocion()
    {
        if ($_POST) {
            if (empty($_POST['txtNombre_promocion']) || empty($_POST['listEstatus']) || empty($_POST['txtPorcentaje_descuento']) || empty($_POST['txtFecha_inicio']) || empty($_POST['txtFecha_fin']) || empty($_POST['txtId_usuario_creacion']) || empty($_POST['listSubcampania'])) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intIdPromocion = intval($_POST['idPromocion']);
                $strNombre_promocion = strClean($_POST['txtNombre_promocion']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intEstatus = intval($_POST['listEstatus']);
                $strPorcentaje_descuento = strClean($_POST['txtPorcentaje_descuento']);
                $strFecha_inicio = strClean($_POST['txtFecha_inicio']);
                $strFecha_fin = strClean($_POST['txtFecha_fin']);
                $strFecha_creacion = strClean($_POST['txtFecha_creacion']);
                $strFecha_actualizacion = strClean($_POST['txtFecha_actualizacion']);
                $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
                $intId_usuario_actualizacion = intval($_POST['txtId_usuario_actualizacion']);
                $intId_subcampania = intval($_POST['listSubcampania']);
                $intId_servicio = intval($_POST['listServicios']);

                if ($intIdPromocion == 0) {
                    //Crear
                    $request_promocion = $this->model->insertPromocion($strNombre_promocion,
                        $strDescripcion,
                        $intEstatus,
                        $strPorcentaje_descuento,
                        $strFecha_inicio,
                        $strFecha_fin,
                        $strFecha_creacion,
                        $strFecha_actualizacion,
                        $intId_usuario_creacion,
                        $intId_usuario_actualizacion,
                        $intId_subcampania,
                        $intId_servicio);
                    $option = 1;
                }

                if ($request_promocion > 0) {
                    if ($option == 1) {
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                    }
                } else if ($request_promocion == 'exist') {

                    $arrResponse = array('estatus' => false, 'msg' => '¡Atención! el nombre de la promoción ya existe.');
                } else {
                    $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            //}
        }
        die();
    }

	public function upPromocion(){
        if ($_POST) {
            if (empty($_POST['idPromocion_edit']) || empty($_POST['listCampania_edit']) || empty($_POST['listServicios_edit']) || empty($_POST['listSubcampania_edit']) || empty($_POST['txtDescripcion_edit']) || empty($_POST['txtFecha_fin_edit']) || empty($_POST['txtFecha_inicio_edit']) || empty($_POST['txtNombre_promocion_edit']) || empty($_POST['txtPorcentaje_descuento_edit'])) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {                
				$intId_promocion = intval($_POST['idPromocion_edit']);
				$intId_campania = intval($_POST['listCampania_edit']);
				$intId_servicio = intval($_POST['listServicios_edit']);
				$intId_subcampania = intval($_POST['listSubcampania_edit']);
				$strDescripcion = strClean($_POST['txtDescripcion_edit']);
				$strFecha_fin = strClean($_POST['txtFecha_fin_edit']);
				$strFecha_inicio = strClean($_POST['txtFecha_inicio_edit']);
				$strNombre_promocion = strClean($_POST['txtNombre_promocion_edit']);
				$intPorcentaje_descuento = intval($_POST['txtPorcentaje_descuento_edit']);
				$intEstatus = intval($_POST['listEstatusEdit']);
				$request_promocion = $this->model->updatePromocion($intId_promocion,$intId_campania,$intId_servicio,$intId_subcampania,$strDescripcion,$strFecha_fin,$strFecha_inicio,$strNombre_promocion,$intPorcentaje_descuento,$_SESSION['idUser'],$intEstatus);
				if($request_promocion){
					$arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
				}else{
					$arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
				}
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            //}
        }
        die();
    }

	public function getPromocion(int $id){
		$arrData = $this->model->selectPromocion($id);
		if($arrData){
			$arrData['fecha_fin'] = date('Y-m-d');
			$arrData['fecha_inicio'] = date('Y-m-d');
			$arrResponse['estatus'] = true;
			$arrResponse['data'] = $arrData;
		}
		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		die();
	}


    public function delPromocion()
    {
        if ($_POST) {
            //if($_SESSION['permisosMod']['d']){
            $intIdPromocion = intval($_POST['idPromocion']);
            $requestDelete = $this->model->deletePromocion($intIdPromocion);
            if ($requestDelete == 'ok') {
                $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la promoción correctamente.');
            } else if ($requestDelete == 'exist') {
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una promoción asociado a un servicio activo.');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la promoción.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            //}
        }
        die();
    }

}
