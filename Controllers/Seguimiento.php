<?php

class Seguimiento extends Controllers{

    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
          header('Location: '.base_url().'/login');
          die();
        }
    }

    public function seguimiento(){
        $data['page_tag'] = "Seguimiento de prospectos";
        $data['page_title'] = "Seguimiento de prospección";
        $data['page_name'] = "Seguimiento de prospectos";
        $this->views->getView($this,'seguimiento',$data);
    }

    public function agenda(){
        $data['page_tag'] = "Agenda de seguimiento";
        $data['page_name'] = "Agenda de seguimiento";
        $this->views->getView($this,'AgendaProspecto',$data);
    }

    public function persona(){
        $data['page_tag'] = "Persona";
        $data['page_title'] = "Personas";
        $data['page_content'] = "";
        $data['page_functions_js'] = "functions_persona.js";
        //$data['estados'] = $this->model->selectEstados();
        //$data['categoria_persona'] = $this->model->selectCategoriasPersona();
        //$data['grados_estudios'] = $this->model->selectGradosEstudios();
        //$data['planteles'] = $this->model->selectPlanteles();
        //$data['medios_captacion'] = $this->model->selectMediosCaptacion();
        $this->views->getView($this,"persona",$data);
    }


    public function seguimiento_prospectos(){
        $data['page_tag'] = "Seguimiento de prospección";
        $data['page_title'] = "Seguimiento de prospección";
        $data['page_functions_js'] = "functionsSegProspectos.js";
        $data['planteles'] = $this->model->selectPlanteles();
        $data['niveles'] = $this->model->selectNiveles();
        $data['lvls'] = $this->model->selectEscolaridad();
        $data['carreras'] = $this->model->selectCarreras();
        $data['estados'] = $this->model->selectEstados();
        $data['campania'] = $this->model->selectCampania();
        // $data['municipio'] = $this->model->selectLocalidad();
        // $data['localidad'] = $this->model->selectMunicipio();
        $this->views->getView($this,'seguimiento_prospectos',$data);
    }

    public function getCarrera()
    {
        $idNivel = $_GET['idNivel'];
        $arrData = $this->model->selectCarrera($idNivel);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getProspecto(int $idPers)
    {
        $id = $idPers;
        $arrData = $this->model->selectProspecto($id);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editDatos()
    {
        if(isset($_POST['idProspectoEdit']))
        {
            $idProspecto = $_POST['idProspectoEdit'];
        }
        if(isset($_POST['idPersonaEdit']))
        {
            $idPersona = $_POST['idPersonaEdit'];
        }
        $nombre = strClean($_POST['txtNombreEdit']);
        $apepat = strClean($_POST['txtApellidoPatEdit']);
        $apemat = strClean($_POST['txtApellidoMatEdit']);
        $telefono = $_POST['txtTelefonoCelEdit'];
        $email = $_POST['txtEmail'];
        $plantel = intval($_POST['slctPlantelEdit']);
        $nivel = intval($_POST['slctNivelEstudiosEdit']);
        $carrera = intval($_POST['slctCarreraEdit']);


        $arrData = $this->model->updatePersona($nombre,$apepat,$apemat,$telefono,$email,$plantel,$nivel,$carrera,$idPersona,$idProspecto);

        if($arrData['estatus'] == TRUE)
        {
            $arrResponse = array('estatus' => TRUE, 'msg' => 'Datos actualizados correctamente');
        }
        else
        {
            $arrResponse = array('estatus' => TRUE, 'msg' => 'No se puede actualizar correctamente');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getRespuestasRapidas(){
        $arrData = $this->model->selectRespuestasRapidas();
        for($i=0; $i<count($arrData); $i++){
            $arrData[$i]['respuesta_rapida'] = '<input type="radio" class="form-check-input" id="rad'.$arrData[$i]['identificador'].'" name="rad" value="'.$arrData[$i]['id'].'">'.$arrData[$i]['respuesta_rapida']."<br>";
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function getProspectos(){
        $arrData = $this->model->selectProspectos();
        for($i=0; $i<count($arrData); $i++){
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
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setSeguimientoProspectoIndividual(){
        if(isset($_POST['idProsInd']));
        {
            $intIdPro = intval($_POST['idProsInd']);
        }
        $intResp = intval($_POST['rad']);
        $strComent = strClean($_POST['txtComentarioSegInd']);
        $arrData = $this->model->insertSeguimientoProspectoInd($intResp,$strComent,$intIdPro);
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

    public function setProgramarAgenda(){
        if($_POST){
        if(empty($_POST['txtFechaProg']) || empty($_POST['txtHoraProg']) || empty($_POST['idUsuarioAtendidoAgenda']) || empty($_POST['txtFechaRegistro'])){
            $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{
            $intIdPersona = intval($_POST['idPersona']);
            $intIdUsuarioAtendio = intval($_SESSION['idUser']);
            $strFechaProgramada = strClean($_POST['txtFechaProg']);
            $strFechaRegistro= strClean($_POST['txtFechaRegistro']);
            $strHoraProgramada = strClean($_POST['txtHoraProg']);
            $strAsuntoLlamada = strClean($_POST['txtAsunto']);
            $strDetalleLlamada = strClean($_POST['txtComentario']);
            if($intIdPersona <> 0){
            $requestAgendarProspecto = $this->model->insertAgendaProspecto($intIdPersona,
                                                                            $intIdUsuarioAtendio,
                                                                            $strFechaProgramada,
                                                                            $strFechaRegistro,
                                                                            $strHoraProgramada,
                                                                            $strAsuntoLlamada,
                                                                            $strDetalleLlamada);
                                                                            $option = 1;
            }
            if($requestAgendarProspecto > 0){
            if($option == 1){
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
            }
            }else{
            $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');
            }
        }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPersonaSeguimiento(int $idPersona)
    {
        $intIdPersona = intval($idPersona);
        if($intIdPersona > 0)
        {
            $data['datos'] = $this->model->selectPersonaSeguimiento($intIdPersona);
            $data['seguimiento'] = $this->model->selectSeguimientoProspecto($intIdPersona);
            if(empty($data['datos']))
            {
                $data['response'] = array('estatus' => false, 'msg' => 'Datos no encontrados');
            }
            else
            {
                $data['response'] = array('estatus' => true, 'msg' => $data['datos']);
            }
            for($i=0;$i<count($data['seguimiento']);$i++)
            {
               $data['seguimiento'][$i]['respuesta_rapida'] = '<span class="badge badge-warning">'.$data['seguimiento'][$i]['respuesta_rapida'].'</span>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    public function setNuevoProspecto(){
      if($_POST){

        if(empty($_POST['txtNombreNuevo']) || empty($_POST['listSexoNuevo']) || empty($_POST['txtApellidoPaNuevo']) || empty($_POST['txtApellidoMaNuevo'])){
            $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{

          //<Datos Personales Prospecto>
          $strNombreP = strClean($_POST['txtNombreNuevo']);
          $strApellidoPaP = strClean($_POST['txtApellidoPaNuevo']);
          $strApellidoMaP = strClean($_POST['txtApellidoMaNuevo']);
          $strSexoP = strClean($_POST['listSexoNuevo']);
          $strAliasP = strClean($_POST['txtAlias']);
          $strEdoCivil = strClean($_POST['listEstadoCivilNuevo']);
          $strOcupacion = strClean($_POST['txtOcupacionNuevo']);
          $strFechaNacimiento = strClean($_POST['txtFechaNacimientoNuevo']);
          $intEscolaridad = intval($_POST['slctEscolaridad']);
          //<Recidencia Prospecto>
          $intLocalidadP = intval($_POST['listLocalidadNuevo']);
          //<Contacto Prospecto>
          $strTelcelP = strClean($_POST['txtTelCelNuevo']);
          $strTelFiP = strClean($_POST['txtTelFiNuevo']);
          $strEmailP = strClean($_POST['txtEmailNuevo']);
          //<Prospecto>
          $strPlantelProcedenciaP = strClean($_POST['txtPlantelProcedencia']);
          $intPlantelInteresP = intval($_POST['slctPlantel']);
          $intNivelEstudiosInteresP = intval($_POST['slctNivelEstudios']);
          $intCarreaInteresP = intval($_POST['slctCarreraNvo']);
          //<medio_captacion Prospecto>
          $intMedioCaptacionP = intval($_POST['rad']);
          $strComentarioP = strClean($_POST['comentario']);
          //<Otris Datos>
          $intIdProspecto = intval($_POST['idNuevo']);
          $intIdSubcampania = intval($_POST['slctSubcampania']);

          if($intIdProspecto == 0){

            $requestProspecto = $this->model->insertProspecto($strNombreP, $strApellidoPaP, $strApellidoMaP, $strAliasP, $strEdoCivil, $strOcupacion, $strFechaNacimiento, $intEscolaridad, $strSexoP, $intLocalidadP, $strTelcelP, $strTelFiP, $strEmailP, $strPlantelProcedenciaP, $intPlantelInteresP, $intNivelEstudiosInteresP, $intCarreaInteresP, $intMedioCaptacionP, $strComentarioP, $intIdSubcampania);
            $option = 1;

          }

          if($requestProspecto > 0){

            if($option == 1){
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
            }

          }else{

            $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');

          }

        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

      }

      die();
    }

    public function getMunicipios(){

      $idEstado = $_GET['idestado'];
      $arrData = $this->model->selectMunicipios($idEstado);
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();

    }

    public function getLocalidades(){

      $idMunicipio = $_GET['idmunicipio'];
      $arrData = $this->model->selectLocalidades($idMunicipio);
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();

    }

    public function getMedioCaptacion(){

      $arrData = $this->model->selectMediosCaptacion();
      for($i=0; $i<count($arrData); $i++){

        $arrData[$i]['med_capInput'] = '<input type="radio" class="form-check-input" id="rad'.$arrData[$i]['id'].'" onclick="validarMedio()" name="rad" value="'.$arrData[$i]['id'].'">'.$arrData[$i]['medio_captacion'].'
        <br>';

      }
      // <input type="radio" class="form-check-input" id="radno_da_linea" name="rad" value="11">No da línea<br>
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();

    }

    public function getSubCampaniass(int $idCampania){

      $arrData = $this->model->selectSubcampanaia($idCampania);

      for($i=0; $i<count($arrData); $i++){

        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
        $arrData[$i]['fecha_inicio'] = strftime("%d de %B de %Y", strtotime($arrData[$i]['fecha_inicio']));
        $arrData[$i]['fecha_fin'] = strftime("%d de %B de %Y", strtotime($arrData[$i]['fecha_fin']));

      }

      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();

    }

}
