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
        $data['escolaridad'] = $this->model->selectEscolaridad($this->nomConexion);
        $data['nivel_estudios_interes'] = $this->model->selectNivelInteres($this->nomConexion);
        $data['carrera_interes'] = $this->model->selectCarreraInteres($this->nomConexion);
        $data['estados'] = $this->model->selectEstados($this->nomConexion);
        $this->views->getView($this,"seguimiento_prospectos",$data);
    }

    public function getProspectos()
    {
        $arrData = $this->model->selectProspectos($this->nomConexion);
        for ($i=0; $i < count($arrData) ; $i++) { 
            $arrData[$i]['numeracion'] = $i + 1;
            $arrData[$i]['nom_plantel_interes'] = conexiones[$arrData[$i]['plantel_interes']]['NAME'];
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
            for ($i=0; $i < count($data['seguimiento']); $i++) { 
                $data['seguimiento'][$i]['respuesta_rapida'] = '<span class="badge badge-warning">'.$data['seguimiento'][$i]['respuesta_rapida'].'</span>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function getRespuestasRapidas()
    {
        $arrData = $this->model->selectRespuestasRapidas($this->nomConexion);
        for ($i=0; $i < count($arrData); $i++) { 
            $arrData[$i]['respuesta_rapida'] = '<input type="radio" class="form-check-input" id="rad'.$arrData[$i]['identificador'].'" name="rad" value="'.$arrData[$i]['id'].'">'.$arrData[$i]['respuesta_rapida'].'<br>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function setSeguimientoProspectoIndividual(){
        if(isset($_POST['idProsInd']))
        {
            $intIdPro = intval($_POST['idProsInd']);
        }
        $intResp = intval($_POST['rad']);
        $strComent = strClean($_POST['txtComentarioSegInd']);
        $arrData = $this->model->insertSeguimientoProspectoInd($intResp, $strComent, $intIdPro, $this->nomConexion);
        if($arrData == TRUE)
        {
            $arrResponse = array('estatus' => true, 'msg' => 'Se ha añadido el seguimiento');
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'Error, no puede agregarse el seguimiento');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getProspecto(int $idPers)
    {
        $id = $idPers;
        $arrData = $this->model->selectProspecto($id,$this->nomConexion);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getMunicipios(){
        $idEstado = $_GET['idestado'];
        $arrData = $this->model->selectMunicipios($idEstado,$this->nomConexion);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getLocalidades(){
        $idMunicipio = $_GET['idmunicipio'];
        $arrData = $this->model->selectLocalidades($idMunicipio, $this->nomConexion);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getMedioCaptacion()
    {
        $arrData = $this->model->selectMedioCaptacion($this->nomConexion);
        for ($i=0; $i < count($arrData); $i++) { 
            $arrData[$i]['med_capInput'] = '<input type="radio" class="form-check-input" id="rad'.$arrData[$i]['id'].'" name="rad" value="'.$arrData[$i]['id'].'">'.$arrData[$i]['medio_captacion'].'<br>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getCarrera()
    {
        $idNivel = $_GET['idNivel'];
        $arrData = $this->model->selectCarrera($idNivel, $this->nomConexion);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setProspecto()
    {
        $intIdProspecto = intval($_POST['idNuevo']);
        $strNombre = $_POST['txtNombreNuevo'];
        $strApePat = $_POST['txtApellidoPaNuevo'];
        $strApeMat = $_POST['txtApellidoMaNuevo'];
        $strSexo = $_POST['listSexoNuevo'];
        $strAlias = $_POST['txtAlias'];
        $intEdad = $_POST['txtEdadNuevo'];
        $strEdoCivil = $_POST['listEstadoCivilNuevo'];
        $strOcupacion = $_POST['txtOcupacion'];
        $strEscolaridad = $_POST['slctEscolaridad'];
        $strFechaNac = $_POST['txtFechaNacimientoNuevo'];
        $intLocalidad = $_POST['listLocalidadNuevo'];
        $intTel = $_POST['txtTelCelNuevo'];
        $intTelFijo = $_POST['txtTelFiNuevo'];
        $strEmail = $_POST['txtEmailNuevo'];
        $strPlantelProc = $_POST['txtPlantelProcedencia'];
        $strPlantelInt = $_POST['slctPlantelNvo'];
        $strNivel = $_POST['slctNivelEstudios'];
        $strCarrera = $_POST['slctCarreraNuevoPro'];
        $intMedio = $_POST['rad'];
        $strComentario = $_POST['txtObservacionPros'];

        if($intIdProspecto == 0)
        {
            $requestProspecto = $this->model->insertProspecto($strNombre, $strApePat, $strApeMat, $strAlias, $strEdoCivil, $strOcupacion, $strFechaNac, $strEscolaridad, $intEdad ,$strSexo, $intLocalidad, $intTel, $intTelFijo, $strEmail, $strPlantelProc, $strPlantelInt, $strNivel, $strCarrera, $intMedio, $strComentario, $this->nomConexion);
            $option = 1;
        }

        if($requestProspecto > 0)
        {
            if($option == 1)
            {
                $arrResponse = array('estatus' => true, 'msg' => 'Ha ingresado un nuevo prospecto');
            }
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos o probablemente existe un registro con el mismo nombre');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>