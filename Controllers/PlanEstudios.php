<?php
class PlanEstudios extends Controllers
{
    private $idUser;
    private $nomConexion;
    private $rol;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        $this->idUser = $_SESSION['idUser'];
        $this->nomConexion = $_SESSION['nomConexion'];
        $this->rol = $_SESSION['claveRol'];
    }
    public function planestudios()
    {
        $data['page_id'] = 10;
        $data['page_tag'] = "Planes de estudios";
        $data['page_title'] = "Planes de estudios";
        $data['page_content'] = "";
        $data['page_functions_js'] = "functions_plan_estudios.js";
        $data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
        $data['niveles_educativos'] = $this->model->selectNivelEducativo($this->nomConexion);
        $data['categorias'] = $this->model->selectCategorias($this->nomConexion);
        $data['modalidad'] = $this->model->selectModalidades($this->nomConexion);
        $data['plan'] = $this->model->selectPlanes($this->nomConexion);
        $data['clasificacion'] = $this->model->selectClasificaciones($this->nomConexion);
        $this->views->getView($this, "planestudios", $data);
    }

    public function getPlanEstudios()
    {
        $arrData = $this->model->selectPlanEstudios($this->nomConexion);
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['numeracion'] = $i + 1;
            $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'] . ' (' . $arrData[$i]['municipio'] . ')';
            if ($arrData[$i]['estatus'] == 1) {
                $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
            } else {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerPlanEstudios" onClick="fntVerPlanEstudios(' . $arrData[$i]['id'] . ')" data-toggle="modal" data-target="#ModalFormVerPlanEstudios" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlanEstudios" onClick="fntEditPlanEstudios(' . $arrData[$i]['id'] . ')" data-toggle="modal" data-target="#ModalFormEditPlanEstudios" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlanEstudios" onClick="fntDelPlanEstudios(' . $arrData[$i]['id'] . ')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Funcion para guardar una Categoria
    public function setPlanEstudios($arr)
    {
        $data = $_POST;
        $arreglo = json_decode($arr);
        $idPlanEstudiosEdit = 0;
        $idPlanEstudiosNuevo = 0;
        if (isset($_POST['idNuevo'])) {
            $idPlanEstudiosNuevo = intval($_POST['idNuevo']);
        }
        if (isset($_POST['idEdit'])) {
            $idPlanEstudiosEdit = intval($_POST['idEdit']);
        }

        if ($idPlanEstudiosEdit != 0) {
            $arrData = $this->model->updatePlanEstudios($idPlanEstudiosEdit, $data, $arreglo, $this->nomConexion);
            if ($arrData) {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos.');
            }
        }
        if ($idPlanEstudiosNuevo == 1) {
            $arrData = $this->model->insertPlanEstudios($data, $arreglo, $this->nomConexion);
            if ($arrData) {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible almacenar los datos');
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getPlanEstudio(int $idPlanEstudio)
    {
        $arrData['plan_estudio'] = $this->model->selectPlanEstudio($idPlanEstudio, $this->nomConexion);
        $arrData['clasificaciones'] = $this->model->selectClasificacionPlanEstudio($idPlanEstudio, $this->nomConexion);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getPlanEstudioEdit(int $idPlanEstudio)
    {
        $arrData['plan_estudio'] = $this->model->selectPlanEstudioEdit($idPlanEstudio, $this->nomConexion);
        $arrData['clasificaciones'] = $this->model->selectClasificacionPlanEstudio($idPlanEstudio, $this->nomConexion);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delPlanEstudio()
    {
        if ($_POST) {
            $intIdPlanEstudio = intval($_POST['idPlanEstudio']);
            $requestTablaRef = $this->model->getTablasRef($this->nomConexion);
            if (count($requestTablaRef) > 0) {
                $requestStatus = 0;
                foreach ($requestTablaRef as $key => $tabla) {
                    $nombreTabla = $tabla['tablas'];
                    if ($nombreTabla != 't_plan_x_clasificacion') {
                        $existColumn = $this->model->selectColumn($nombreTabla, $this->nomConexion);
                        if ($existColumn) {
                            $requestEstatusRegistro = $this->model->estatusRegistroTabla($nombreTabla, $intIdPlanEstudio, $this->nomConexion);
                            if ($requestEstatusRegistro) {
                                $requestStatus += count($requestEstatusRegistro);
                            } else {
                                $requestStatus += 0;
                            }
                        }
                    }
                }
                if ($requestStatus == 0) {
                    $requestDelete = $this->model->deletePlanEdtudio($intIdPlanEstudio, $this->nomConexion);
                    if ($requestDelete == 'ok') {
                        $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el plan de estudios.');
                    } else if ($requestDelete == 'exist') {
                        $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plan de estudios.');
                    } else {
                        $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plan de estudios.');
                    }
                } else {
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar porque hay registros activos relacionados a este plan de estudios.');
                }
            } else {
                $arrResponse = "eliminando";
                $requestDelete = $this->model->deletePlanEdtudio($intIdPlanEstudio, $this->nomConexion);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el plan de estudios.');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar el plan de estudios.');
                } else {
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el plan de estudios.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}
