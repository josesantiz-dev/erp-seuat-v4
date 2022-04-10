<?php

class Campania extends Controllers{

  public function __construct(){
    parent::__construct();
    session_start();
    if(empty($_SESSION['login'])){
      header('Location: '.base_url().'/login');
      die();
    }
  }

  public function Campania(){
    $data['page_tag'] = "Campañas";
    $data['page_title'] = "Campañas";
    $data['page_name'] = "campania";
    $data['page_functions_js'] = "functionsCampania.js";
    $this->views->getView($this,"Campania",$data);
  }

  public function getCampanias(){
    $arrData = $this->model->selectCampanias();
    for($i=0; $i < count($arrData); $i++){
      $arrData[$i]['id_guardado'] = $arrData[$i]['id'];
      $arrData[$i]['id'] = $i+1;
      // $arrData[$i]['id'] = $i+1;
      if($arrData[$i]['estatus'] == 1){
        $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
      }else{
        $arrData[$i]['estatus']= '<span class="badge badge-secondary">Inactivo</span>';
      }
      $arrData[$i]['options'] = '
                                  <div class="text-center">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                      </button>
                                      <div class="dropdown-menu">
                                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditCampania" onClick="fntEditCampanias(this,'.$arrData[$i]['id_guardado'].')" title="Editar"> &nbsp;&nbsp;
                                          <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                        </button>
                                      <div class="dropdown-divider"></div>
                                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelCampania" onClick="fntDelCampania('.$arrData[$i]['id_guardado'].')" title="Eliminar"> &nbsp;&nbsp;
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

  public function getCampania($id){
    $intIdCampania = intval(strClean($id));
    if($intIdCampania > 0){
      $arrData = $this->model->selectCampania($intIdCampania);
      if(empty($arrData)){
        $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
      }else{
        $arrResponse = array('estatus' => true, 'data' => $arrData);
      }
      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    die();
  }

  public function setCampanias(){
    if($_POST){
      if(empty($_POST['txtNombreCampanias']) || empty($_POST['listaEstatus']) || empty($_POST['txtIdUsuarioCreacion']) || empty($_POST['txtPresupuesto'])){
        $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
      }else{

          $intIdCampania = intval($_POST['idCampanias']);
          $strNombreCampanias = strClean($_POST['txtNombreCampanias']);
          $strFechaInicio = strClean($_POST['txtFechaInicio']);
          $strFechaFin = strClean($_POST['txtFechaFin']);
          $intPresupuesto = intval($_POST['txtPresupuesto']);
          $intEstatus = intval($_POST['listaEstatus']);
          $strFechaCreacion = strClean($_POST['txtFechaCreacion']);
          $strFechaActualizacion = strClean($_POST['txtFechaActualizacion']);
          $intIdUsuarioCreacion = intval($_POST['txtIdUsuarioCreacion']);
          $intIdUsuarioActualizacion = intval($_POST['txtIdUsuarioActualizacion']);

          if ($intIdCampania == 0) {
            //Crear
            $requestCampanias = $this->model->insertCampania($strNombreCampanias,
                                                             $strFechaInicio,
                                                             $strFechaFin,
                                                             $intEstatus,
                                                             $strFechaCreacion,
                                                             $strFechaActualizacion,
                                                             $intIdUsuarioCreacion,
                                                             $intIdUsuarioActualizacion,
                                                             $intPresupuesto);
                                                             $option = 1;
          }
          if($requestCampanias > 0){
            if($option == 1){
              $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
            }
          }else if($requestCampanias == 'exit'){
            $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La Campaña ya esxiste');
          }else{
            $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
          }
        }
      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    die();
  }

  public function setCampaniasUp(){
    if($_POST){
      if(empty($_POST['txtNombreCampaniasUp']) || empty($_POST['listEstatusUp']) || empty($_POST['txtIdUsuarioActualizacionUp']) || empty($_POST['txtFechaInicioUp']) || empty($_POST['txtFechaFinUp']) || empty($_POST['txtPresupuestoUp'])){
        // echo '<script>console.log("Hola mundo")</script>';
        $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
      }else{

        $intIdCampania = intval($_POST['idCampaniasUp']);
        $strNombreCampania = strClean($_POST['txtNombreCampaniasUp']);
        $intEstatus = intval($_POST['listEstatusUp']);
        $intIdUsuarioActualizacion = intval($_POST['txtIdUsuarioActualizacionUp']);
        $strFechaInicioActualizacion = strClean($_POST['txtFechaInicioUp']);
        $strFechaFinActualizacion = strClean($_POST['txtFechaFinUp']);
        $intPresupuesto = intval($_POST['txtPresupuestoUp']);
        $requestCampanias = "";

        $selectSubcampania = $this->model->selectSubcampania($intIdCampania);
        if(count($selectSubcampania) > 0){

          $arrData = $this->model->selectFecha($intIdCampania);
          if(($arrData['fecha_inicio'] == $strFechaInicioActualizacion) && ($arrData['fecha_fin'] == $strFechaFinActualizacion)){

            $requestCampanias = $this->model->updateCampanias($intIdCampania,
                                                                $strNombreCampania,
                                                                $intEstatus,
                                                                $intIdUsuarioActualizacion,
                                                                $strFechaInicioActualizacion,
                                                                $strFechaFinActualizacion,
                                                                $intPresupuesto);
                                                                $option = 1;

          }else{

            $contSub = 1;

          }

        }else{

          $requestCampanias = $this->model->updateCampanias($intIdCampania,
                                                              $strNombreCampania,
                                                              $intEstatus,
                                                              $intIdUsuarioActualizacion,
                                                              $strFechaInicioActualizacion,
                                                              $strFechaFinActualizacion,
                                                              $intPresupuesto);
                                                              $option = 1;

        }
        if($requestCampanias > 0){
          if($option == 1){
            $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
          }
        }else if($contSub){

          $arrResponse = array("estatus" => false, "msg" => 'No puede editar la campaña esta campaña esta vinculada '.count($selectSubcampania).' subcampañas, favor de eliminarlas antes de editar.');

        }else{

          $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');

        }

      }//Este es del primer else
      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    die();
  }

  public function delCampania(){
    if($_POST){
      $intIdCampania = intval($_POST['idCampanias']);
      $requestDelete = $this->model->deleteCampanias($intIdCampania);
      if($requestDelete == 'ok'){
        $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la Campaña correctamente.');
      }else if($requestDelete == 'exit'){
        $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una Campaña asociado a un servicio activo.');
      }else{
        $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la Campaña.');
      }
      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    die();
  }

}


?>
