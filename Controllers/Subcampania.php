<?php

  class Subcampania extends Controllers{

    public function __construct(){
      parent::__construct();
      session_start();
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
        die();
      }
    }

    public function Subcampania(){
      $data['page_tag'] = "Subcampaña";
      $data['page_title'] = "Subcampaña";
      $data['page_name'] = "subcampania";
      $data['page_functions_js'] = "functionsSubcampania.js";
      // $data['dataCampania'] = $this->model->selectCampania();
      $data['dataLastCampania'] = $this->model->selectLastCampania();
      $this->views->getView($this,"subcampania",$data);
    }

    public function getSubcampania(){
      $arrData = $this->model->selectSubcampania();
      for ($i=0; $i < count($arrData); $i++){
        $arrData[$i]['id_guardado'] = $arrData[$i]['id'];
        $arrData[$i]['id'] = $i+1;
        if($arrData[$i]['estatus'] == 1){
          $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
        }else{
          $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
        }
        $arrData[$i]['options'] = '
                                    <div class="text-center">
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                        </button>
                                        <div class="dropdown-menu">
                                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSubcampania" onClick="ftnEditarSubcampania(this,'.$arrData[$i]['id_guardado'].')" title="Editar"> &nbsp;&nbsp;
                                          <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSubcampania" onClick="ftnDelSubcampania('.$arrData[$i]['id_guardado'].')" title="Eliminar"> &nbsp;&nbsp;
                                          <i class="far fa-trash-alt "></i> &nbsp; Eliminar
                                        </button>
                                      </div>
                                      </div>
                                    </div>
                                  ';
      }
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();
    }


    /*ESTO FALTA VER SI APLICA O BUSCO OTRA FORMA*/
    public function getSelectCampania(){
      $arrData = $this->model->selectCampania();
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function getSubcampanias($id){
      $intIdSubcampania = intval(strClean($id));
      if($intIdSubcampania){
        $arrData = $this->model->selectSubcampanias($intIdSubcampania);
        if(empty($arrData)){
            $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
          }else{
            $arrResponse = array('estatus' => true, 'data' => $arrData);
        }
        echo  json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      }
      die();
    }

    public function setSubcampania(){
      if($_POST){
        if(empty($_POST['txtNombreSubcampania']) || empty($_POST['listaEstatus']) || empty($_POST['txtIdUsuarioCreacion'])){
          //echo $_POST['txtIdUsuarioCreacion'];
          $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{
          $intIdSubcampania = intval($_POST['idSubcampania']);
          $strNombreSubcampania = strClean($_POST['txtNombreSubcampania']);
          $strFechaInicio = strClean($_POST['txtFechaInicio']);
          $strFechaFin = strClean($_POST['txtFechaFin']);
          $intIdCampania = intval($_POST['selectIdCampania']);
          $intEstatus = intval($_POST['listaEstatus']);
          $strFechaCreacion = strClean($_POST['txtFechaCreacion']);
          $strFechaActualizacion = strClean($_POST['txtFechaActualizacion']);
          $intIdUsuarioCreacion = intval($_POST['txtIdUsuarioCreacion']);
          $intIdUsuarioActualizacion = intval($_POST['txtIdUsuarioActualizacion']);
          $intPresupuesto = intval($_POST['txtPresupuesto']);

          $fechas = $this->model->selectFechas($intIdCampania);
          $arrData = $fechas['fecha_fin'];
          if($arrData >= $strFechaFin){
            if($fechas['fecha_inicio'] >= $strFechaInicio){
              if($intIdSubcampania == 0){
                //Crear
                $requestSubcampania = $this->model->insertSubcampania($strNombreSubcampania,
                                                                      $strFechaInicio,
                                                                      $strFechaFin,
                                                                      $intIdCampania,
                                                                      $intEstatus,
                                                                      $strFechaCreacion,
                                                                      $strFechaActualizacion,
                                                                      $intIdUsuarioCreacion,
                                                                      $intIdUsuarioActualizacion,
                                                                      $intPresupuesto);
                                                                      $option = 1;
              }
              if($requestSubcampania > 0){
                if($option == 1){
                  $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                }
              }else if($requestSubcampania == 'exit'){
                $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La Subcampaña ya esxiste');
              }else{
                $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
              }
            }else{
              $arrResponse = array("estatus" => false, "msg" => 'La fecha limite, tiene que ser una fecha valida.');
            }
            //date("Y-m-d\TH-i");
            //$strFechaInicio
          }else{
            $arrResponse = array("estatus" => false, "msg" => 'La fecha limite, tiene que estar dentro del limite de la Campaña.');
          }
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      }
      die();
    }

    public function setSubcampaniaUP(){
      if($_POST){
        if(empty($_POST['txtNombreSubcampaniaUp']) || empty($_POST['listaEstatusUp']) ||empty($_POST['txtIdUsuarioActualizacionUp'])){
          $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{
          $intIdSubcampania = intval($_POST['idSubcampaniaUp']);
          $strNombreSubcampania = strClean($_POST['txtNombreSubcampaniaUp']);
          $intEstatus = intval($_POST['listaEstatusUp']);
          $strFechaActualizacion = strClean($_POST['txtFechaActualizacionUp']);
          $intIdUsuarioActualizacion = intval($_POST['txtIdUsuarioActualizacionUp']);
          $fechaInicoActualizacion = strClean($_POST['txtFechaInicioUp']);
          $fechaFinActualizacion = strClean($_POST['txtFechaFinUp']);
          $intPresupuesto = intval($_POST['txtPresupuestoUp']);
          $requestSubcampania = "";

          if($intIdSubcampania <> 0){
            $requestSubcampania = $this->model->updateSubcampania($intIdSubcampania,
                                                                  $strNombreSubcampania,
                                                                  $intEstatus,
                                                                  $strFechaActualizacion,
                                                                  $intIdUsuarioActualizacion,
                                                                  $fechaInicoActualizacion,
                                                                  $fechaFinActualizacion,
                                                                  $intPresupuesto);
                                                                  $option = 1;
          }
          if($requestSubcampania > 0){
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

    public function delSubcampania(){
      if($_POST){
        $intIdSubcampania = intval($_POST['idSubcampania']);
        $requestDelete = $this->model->deleteSubcampania($intIdSubcampania);
        if($requestDelete == 'ok'){
          $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la Subcampaña correctamente.');
        }else if($requestDelete == 'exit'){
          $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una Subcampaña asociado a un servicio activo.');
        }else{
          $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la Subcampaña.');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      }
      die();
    }

    public function getFechas($idCampania){
      $intIdCampania = $idCampania;
      if($intIdCampania){
        $arrData = $this->model->selectFechas($intIdCampania);
        if(empty($arrData)){
          $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
        }else{

          setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
          $arrData['fecha_i'] = strftime("%d de %B de %Y", strtotime($arrData['fecha_inicio']));
          $arrData['fecha_f'] = strftime("%d de %B de %Y", strtotime($arrData['fecha_fin']));
          $arrResponse = array('estatus' => true, 'data' => $arrData);
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      }
      die();
    }


    public function getPresupuesto($idCampania){

      $intIdCampania = $idCampania;
      $data = 0;
      $presupuesto = 0;
      if($intIdCampania){

        $arrData = $this->model->selectPresupuesto($intIdCampania);
        if(empty($arrData)){

          $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados');

        }else{

          $subCampPresupuesto = $this->model->selectPresupuestosSubCampania($intIdCampania);
          if(!empty($subCampPresupuesto)){

            for($i = 0; $i < count($subCampPresupuesto); $i++){

              $data =  $data + intval($subCampPresupuesto[$i]['presupuesto']);

            }
            $presupuesto = intval($arrData['presupuesto']);
            $presupuesto = $presupuesto - $data;

          }else{

            $presupuesto = intval($arrData['presupuesto']);

          }

          $arrResponse = array('estatus' => true, 'data' => $presupuesto);

        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

      }

      die();

    }

    public function setAjaxPresupuesto($params){

      $pres = 0;
      $porcen = 0;
      $presupuesto = 0;
      $data = 0;

      $idSubcampania = "";
      $presupuestoActual = "";
      $arrParams = explode(',', $params);
      $ajaxTxt = intval($arrParams[0]);
      $id = $arrParams[1];
      if(count($arrParams) == 3){
        $idSubcampania = intval($arrParams[2]);
        $presupuestoActual = $this->model->selectSubcampanias($idSubcampania);
      }

      $arrData = $this->model->selectPresupuesto($id);
      $presupuesto = intval($arrData['presupuesto']);
      $subCampPresupuesto = $this->model->selectPresupuestosSubCampania($id);
      if(!empty($subCampPresupuesto)){

        for($i = 0; $i < count($subCampPresupuesto); $i++){

          $data =  $data + intval($subCampPresupuesto[$i]['presupuesto']);

        }

        if(!($presupuestoActual == "")){

          $data = $data - intval($presupuestoActual['presupuesto']);
          if($data < 0){
            $data = $data * -1;
          }

        }

        $presupuesto = $presupuesto - $data;

      }

      $pres =  $presupuesto - $ajaxTxt;

      if($pres > 0){

        $arrResponse = array('estatus' => true, 'data' => $pres, 'color' => 'text-success', 'porcentaje' => $porcen, 'msg' => '');

      }else if($pres < 0){

        $arrResponse = array('estatus' => false, 'data' => 0, 'color' => 'text-danger', 'porcentaje' => $porcen, 'msg' => '<b>No puede usar mas de lo que se destino a la campaña</b>');

      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

    }

  }



?>
