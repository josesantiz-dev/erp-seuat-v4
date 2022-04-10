<?php
class Turnos extends Controllers{
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

    public function turno()
    {
        $data['page_tag'] = 'Turnos';
        $data['page_name'] = 'Turnos';
        $data['page_title'] = 'Turnos';
        $data['page_functions_js'] = 'functions_turnos.js';
        $this->views->getView($this,'turnos',$data);
    }

    public function getTurnos()
    {
        $arrData = $this->model->selectTurnos();
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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" onClick="fnEditarTurno('. $arrData[$i]['id'] .')" data-toggle="modal" data-target="#ModalEditTurno" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnEliminarTurno('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
				</div>
            </div>

            </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function getTurno(int $idTurno)
    {
        $intIdTurno = intval(strClean($idTurno));
        if($intIdTurno > 0)
        {
            $arrData = $this->model->selectTurno($intIdTurno);
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

    public function setTurnos()
    {
        $intIdTurnoNuevo = 0;
        $intIdTurnoEdit = 0;

        if(isset($_POST['idTurnoNuevo']))
        {
            $intIdTurnoNuevo = intval($_POST['idTurnoNuevo']);
        }

        if(isset($_POST['idTurnoEdit']))
        {
            $intIdTurnoEdit = intval($_POST['idTurnoEdit']);
        }

        // $intIdTurnoNuevo = isset($_POST['idTurnoNuevo']);
        // $intIdTurnoEdit = isset($_POST['idTurnoEdit']);

        if($intIdTurnoNuevo == 1)
        {
            $strNombreTurno = strClean($_POST['txtTurnoNuevo']);
            $strAbreviatura = strClean($_POST['txtAbreviatura']);
            $strHoraEnt = $_POST['txtHoraEnt'];
            $strHoraSal = $_POST['txtHoraSal'];
            $lun = isset($_POST['chkLunes']);
            $mar = isset($_POST['chkMartes']);
            $mie = isset($_POST['chkMiercoles']);
            $jue = isset($_POST['chkJueves']);
            $vie = isset($_POST['chkViernes']);
            $sab = isset($_POST['chkSabado']);
            $dom = isset($_POST['chkDomingo']);
            $lun == true ? $lun = 1 : $lun = 0;
            $mar == true ? $mar = 1 : $mar = 0;
            $mie == true ? $mie = 1 : $mie = 0;
            $jue == true ? $jue = 1 : $jue = 0;
            $vie == true ? $vie = 1 : $vie = 0;
            $sab == true ? $sab = 1 : $sab = 0;
            $dom == true ? $dom = 1 : $dom = 0;

            $arrData = $this->model->insertTurno($strNombreTurno, $strAbreviatura, $strHoraEnt, $strHoraSal, $lun, $mar, $mie, $jue, $vie, $sab, $dom);

            if($arrData['estatus'] != TRUE)
            {
                $arrResponse = array('estatus' => true, 'msg' => '¡Datos guardados correctamente!');
            }
            else
            {
                $arrResponse = array('estatus' => false, 'msg' =>'¡Atención! el turno ya existe.');
            }
        }

        if($intIdTurnoEdit != 0)
        {
            $strNombreTurnoEdit = strClean($_POST['txtTurnoEdit']);
            $strAbreviaturaEdit = strClean($_POST['txtAbreviaturaEdit']);
            $strHoraEntrEdit = $_POST['txtHoraEntEdit'];
            $strHoraSaliEdit = $_POST['txtHoraSalEdit'];
            $lunEdit = isset($_POST['chkLunesEdit']);
            $marEdit = isset($_POST['chkMartesEdit']);
            $mieEdit = isset($_POST['chkMiercolesEdit']);
            $jueEdit = isset($_POST['chkJuevesEdit']);
            $vieEdit = isset($_POST['chkViernesEdit']);
            $sabEdit = isset($_POST['chkSabadoEdit']);
            $domEdit = isset($_POST['chkDomingoEdit']);
            $lunEdit == true ? $lunEdit = 1 : $lunEdit = 0;
            $marEdit == true ? $marEdit = 1 : $marEdit = 0;
            $mieEdit == true ? $mieEdit = 1 : $mieEdit = 0;
            $jueEdit == true ? $jueEdit = 1 : $jueEdit = 0;
            $vieEdit == true ? $vieEdit = 1 : $vieEdit = 0;
            $sabEdit == true ? $sabEdit = 1 : $sabEdit = 0;
            $domEdit == true ? $domEdit = 1 : $domEdit = 0;
            $estatus = $_POST['slctEstatusTurnoEdit'];
            $arrData = $this->model->updateTurno($intIdTurnoEdit, $strNombreTurnoEdit, $strAbreviaturaEdit, $strHoraEntrEdit, $strHoraSaliEdit, $lunEdit, $marEdit, $mieEdit, $jueEdit, $vieEdit, $sabEdit, $domEdit, $estatus);
            if($arrData['estatus'] != TRUE)
            {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
            }
            else
            {
                $arrResponse = array('estatus' => false, 'msg' => $arrData['msg']);
            }
        }
        
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delTurno()
    {
        $idTrn = $_GET['id'];
        $requestDelete = $this->model->deteleTurno($idTrn);
        if($requestDelete == 'ok')
        {
            $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el turno');
        }
        else if($requestDelete == 'exist')
        {
            $arrResponse = array('estatus' => false, 'msg' => 'No se puede eliminar el turno');
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el turno');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>