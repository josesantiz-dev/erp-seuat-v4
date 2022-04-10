<?php
class Categoria_servicios extends Controllers
{
    private $idUser;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        $this->idUser = $_SESSION['idUser'];
    }

    public function Categoria_servicios()
    {
        $data['page_tag'] = "Categoría de servicios";
        $data['page_title'] = "Categoría servicios";
        $data['page_name'] = "categoria_servicios";
        $data['page_functions_js'] = "functions_categoria_servicios.js";
        $this->views->getView($this, "categoria_servicios", $data);
    }

    public function getCategoria_servicios(){
        $arrData = $this->model->selectCategoria_servicios();
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['numeracion'] = $i+1;
            if ($arrData[$i]['estatus'] == 1) {
                $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
            } else {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
			$arrData[$i]['aplica_colegiatura'] = ($arrData[$i]['colegiatura'] == 1)?'<div class="text-center text-primary"><i class="fas fa-check"></i></div>':'<div class="text-center"><i class="fas fa-ban"></i></div>';
            $arrData[$i]['options'] = '
				<div class="text-center">
					<div class="btn-group">
						<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-layer-group"></i> &nbsp; Acciones
						</button>
						<div class="dropdown-menu">
							<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditCategoria_servicios" onClick="fntEditCategoria_servicios(this,' . $arrData[$i]['id'] . ')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
							<div class="dropdown-divider"></div>
							<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelCategoria_servicios" onClick="fntDelCategoria_servicios(' . $arrData[$i]['id'] . ')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
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
        $intIdCategoria_servicios = intval(strClean($id)); //intval(strClean($idrol));
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

    public function setCategoria_servicios()
    {
        if ($_POST) {
            if (($_POST['idCategoria_servicios'] == '') || ($_POST['txtClave_categoria'] == '') || ($_POST['txtNombre_categoria'] == '') || ($_POST['listEstatus'] == '')) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intIdCategoria_servicios = intval($_POST['idCategoria_servicios']);
                $strClave_categoria = strClean($_POST['txtClave_categoria']);
                $strNombre_categoria = strClean($_POST['txtNombre_categoria']);
                $intAplica_colegiatura = intVal($_POST['chk_aplica_colegiatura']);
                $intEstatus = intval($_POST['listEstatus']);
                if ($intIdCategoria_servicios == 0) {
                    //Crear
                    $request_categoria_servicios = $this->model->insertCategoria_servicios($strClave_categoria, $strNombre_categoria, $intAplica_colegiatura, $intEstatus, $_SESSION['idUser']);
                    if ($request_categoria_servicios == 'exist') {
                        $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La categoría ya existe.');
                    } else if ($request_categoria_servicios > 0) {
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setCategoria_servicios_up()
    {
        if ($_POST) {
            if (empty($_POST['idCategoria_serviciosup']) || empty($_POST['listEstatusup']) || empty($_POST['txtClave_categoriaup']) || empty($_POST['txtNombre_categoriaup'])) {
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            } else {
                $intIdCategoria_servicios = intval($_POST['idCategoria_serviciosup']);
                $strClaveCategoria = strClean($_POST['txtClave_categoriaup']);
                $strNombre_categoria = strClean($_POST['txtNombre_categoriaup']);
                $intAplica_colegiatura = (empty($_POST['chk_aplica_colegiatura_edit'])?0:1);
                $intEstatus = intval($_POST['listEstatusup']);
                $request_categoria_servicios = "";
                if ($intIdCategoria_servicios != 0) {
                    $request_categoria_servicios = $this->model->updateCategoria_servicios($intIdCategoria_servicios,$strClaveCategoria,$strNombre_categoria,$intAplica_colegiatura,$intEstatus,$this->idUser);
                    if($request_categoria_servicios){
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');

                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delCategoria_servicios()
    {
        if ($_POST) {
            //if($_SESSION['permisosMod']['d']){
            $intIdCategoria_servicios = intval($_POST['idCategoria_servicios']);
            $requestDelete = $this->model->deleteCategoria_servicios($intIdCategoria_servicios);
            if ($requestDelete == 'ok') {
                $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la categoría correctamente.');
            } else if ($requestDelete == 'exist') {
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una categoría asociado a un servicio activo.');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la categoría.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            //}
        }
        die();
    }

}
