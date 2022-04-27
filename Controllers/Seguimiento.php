<?php
class Seguimiento extends Controllers{
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

    public function seguimiento_prospectos()
    {
        $data['page_tag'] = "Seguimiento de prospección";
        $data['page_title'] = "Seguimiento de prospección";
        $data['page_functions_js'] = "functions_SegProspectos.js";
        $this->views->getView($this,"seguimiento_prospectos",$data);
    }

    public function getProspectos()
    {
        $arrData = $this->model->selectProspectos($this->nomConexion);
        for ($i=0; $i < count($arrData) ; $i++) { 
            $arrData[$i]['numeracion'] = $i + 1;
            if($arrData[$i]['nombre_categoria'] == 'Prospecto')
            {
                $arrData[$i]['nombre_completo'] = $arrData[$i]['nombre_completo'].' <span class="badge badge-success">'. $arrData[$i]['nombre_categoria'] .'</span>';
                $arrData[$i]['options'] = '<div class="text-center">
                <div class="btn-group">
                    <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" data-toggle="modal" data-target="#ModalAgendarProspectoSeguimiento" onClick="ftnAgendar('. $arrData[$i]['id'] .')" title="Agendar"> &nbsp;&nbsp; <i class="fas fa-calendar-alt"></i> &nbsp; Agendar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEditDatosProspectoSeguimiento" onClick="fnEditarDatosProspecto('. $arrData[$i]['id'] .')"title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnDarSeguimiento('. $arrData[$i]['id'] .')" data-toggle="modal" data-target="#ModalSeguimiento" title="Seguimiento"> &nbsp;&nbsp; <i class="far fa-arrow-alt-circle-right"></i> &nbsp; Seguimiento</button>
                    </div>
                </div>
            </div>';
            }
            else if($arrData[$i]['nombre_categoria'] == 'Egresado'){
                $arrData[$i]['nombre_completo'] = $arrData[$i]['nombre_completo'].' <span class="badge badge-primary">'. $arrData[$i]['nombre_categoria'] .'</span>';
                $arrData[$i]['options'] =
                '<div class="text-center">
                <div class="btn-group">
                    <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" data-toggle="modal" data-target="#ModalAgendarProspectoSeguimiento" onClick="ftnAgendar('. $arrData[$i]['id'] .')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-calendar-alt"></i> &nbsp; Agendar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEditDatosProspectoSeguimiento" onClick="fnEditarDatosProspecto('.$arrData[$i]['id'].')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEgresadoSeguimiento" title="Egresado"> &nbsp;&nbsp; <i class="fas fa-user-graduate"></i> &nbsp; Egresado</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnDarSeguimiento('. $arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalSeguimiento" title="Seguimiento" disabled> &nbsp;&nbsp; <i class="far fa-arrow-alt-circle-right"></i> &nbsp; Seguimiento</button>
                    </div>
                </div>
            </div>';
            }
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agenda(){
        $data['page_tag'] = "Agenda de llamadas";
        $data['page_name'] = "Agenda de llamadas";
        $this->views->getView($this,"AgendaProspecto",$data);
    }

    public function setProgramarAgenda(){
        if($_POST){
            if(empty($_POST['txtFechaProg']) || empty($_POST['txtHoraProg']) || empty($_POST['idUsuarioAtendidoAgenda']) || empty($_POST['txtFechaRegistro'])){
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
            }
            else
            {
                $intIdPersona = intval($_POST['idPersona']);
                $intIdUsuarioAtendio = intval($_SESSION['idUser']);
                $strFechaProgramada = strClean($_POST['txtFechaProg']);
                $strFechaRegistro = strClean($_POST['txtFechaRegistro']);
                $strHoraProgramada = strClean($_POST['txtHoraProg']);
                $strAsuntoLlamada = strClean($_POST['txtAsunto']);
                $strDetalleLlamada = strClean($_POST['txtComentario']);
                if($intIdPersona <> 0){
                    $requestAgendarProspecto = $this->model->insertAgendaProspecto($intIdPersona, $intIdUsuarioAtendio, $strFechaProgramada, $strFechaRegistro, $strHoraProgramada, $strAsuntoLlamada, $strDetalleLlamada, $this->nomConexion);
                    $option = 1;
                }
                if($requestAgendarProspecto > 0){
                    if($option == 1)
                    {
                        $arrResponse = array('estatus' => true, 'msg' => 'Llamada agendada');
                    }
                }
                else{
                    $arrResponse = array('estatus' => false, "msg" => 'No es posible agendar, probablemente existe un registro');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }

    public function getPersonaSeguimiento(int $idPersona)
    {
        $intIdPersona = intval($idPersona);
        if($intIdPersona > 0)
        {
            $data['datos'] = $this->model->selectPersonaSeguimiento($intIdPersona, $this->nomConexion);
            $data['seguimiento'] = $this->model->selectSeguimientoProspecto($intIdPersona, $this->nomConexion);
            if(empty($data['datos']))
            {
                $data['response'] = array('estatus'=>false, 'msg' => 'Datos no encontrados');
            }
            else{
                $data['response'] = array('estatus'=>true, 'msg' => $data['datos']);
            }
            for ($i=0; $i < ; $i++) { 
                $data['seguimiento'][$i]['respuesta_rapida'] = '<span class="badge badge-warning">'.$data['seguimiento'][$i]['respuesta_rapida'].'</span>';
            }
        }
    }
}
?>