<?php

class AgendaProspecto extends Controllers{

  /*
  *   !!
  *     Comentarios para furas referencias durante la codificacion
  *     de esta clase:
  *     !! TEXTO !! Significa que es importante leerlo y que tienes que
  *     al finalizar el trabajo (Cuando la clase ya funcione y no se
  *     tenga que hacer ningun cambio mas)
  *     -- TEXTO -- Signidica que Hay que revisar este metodo por que
  *     algo falla
  *     ** Texto ** Anotaciones de Adulfo para si mismo
  *   !!
  */

  public function __construct(){
    parent::__construct();
    session_start();
    if(empty($_SESSION['login'])){
      header('Location: '.base_url().'/login');
      die();
    }
  }

  public function AgendaProspecto(){
    $data['page_tag'] = "Agenda Prospectos";
    $data['page_title'] = "Agenda Prospecto";
    $data['page_name'] = "agendaprospecto";
    $data['page_functions_js'] = "functionsAgendaProspecto.js";
    $this->views->getView($this,"AgendaProspecto",$data);
  }

  // !! Funcion para llenar la tabla principal de la vista !!
  public function getAgendaProspectos(){

    $arrData = $this->model->selectAgendaProspectos();

    for($i = 0; $i < count($arrData); $i++){

      $arrData[$i]['id_guardado'] = $arrData[$i]['id'];
      $arrData[$i]['id'] = $i+1;

      if($arrData[$i]['estatus'] == 2) {


        $arrData[$i]['estatus'] = '
                                   <a class="cerrarModal btnAgendarProspecto" onClick="ftnAgendarProspecto(this,'.$arrData[$i]['id_guardado'].')" title="'.$arrData[$i]['asunto'].'">
                                     <span class="badge badge-info">
                                       Atendido
                                     </span>
                                   </a>
                                  ';

      }else{

        $arrData[$i]['estatus'] = '
                                   <a class="cerrarModal btnAgendarProspecto"   onClick="ftnAgendarProspecto(this,'.$arrData[$i]['id_guardado'].')" title="'.$arrData[$i]['asunto'].'">
                                     <span class="badge badge-secondary">
                                      Pendiente
                                     </span>
                                   </a>
                                  ';
      }
    }

    echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    die();

  }

  public function getAgendaProspecto($id_guardado){

    $intIdAgenda_guardado = intval(strClean($id_guardado));

    if ($intIdAgenda_guardado > 0) {

      $arrData = $this->model->selectAgendaProspecto($intIdAgenda_guardado);

      if(empty($arrData)){

        $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');

      }else{

        $arrData['info'] = '<div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->

                                <div class="widget-user-header bg-info">
                                  <h3 class="widget-user-username">'.$arrData['nombre_persona'].' '.$arrData['ap_paterno'].' '.$arrData['ap_materno'].'</h3>
                                  <h5 class="widget-user-desc">Prospecto</h5>
                                </div>

                                <div class="card-footer">

                                  <div class="row">

                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header"><i class="fas fa-calendar"></i> FECHA</h5>
                                        <span class="description-text">'.$arrData['fecha_programada'].'</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>

                                    <!-- /.col -->

                                    <div class="col-sm-4 border-right">
                                      <div class="description-block">
                                        <h5 class="description-header"><i class="fas fa-clock"></i> HORA</h5>
                                        <span class="description-text">'.$arrData['hora_programada'].'</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>

                                    <!-- /.col -->

                                    <div class="col-sm-4">
                                      <div class="description-block">
                                        <h5 class="description-header"><i class="fas fa-phone"></i> Telefono(s)</h5>
                                        <span class="description-text">'.$arrData['tel_celular'].' / '.$arrData['tel_fijo'].'</span>
                                      </div>
                                      <!-- /.description-block -->
                                    </div>

                                    <!-- /.col -->
                                  </div>

                                  <!-- /.row -->
                                  <br><br>
                                  <div class="info-box bg-light">
                                    <span class="info-box-icon bg-light"><i class="far fa-envelope"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-number">MENSAJE</span>
                                      <p >'.$arrData['detalle'].'</p>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                </div>
                              </div>';

        $arrResponse = array('estatus' => true, 'data' => $arrData);

      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }

    die();
  }

  public function setEstatusProspecto(){

    if($_POST){
      if(empty($_POST['idAgendaLtrUp']) || empty($_POST['txtEstatus'])){
          $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
      }else{
        $intIdAgenda = intval($_POST['idAgendaLtrUp']);
        $intEstatus = intvaL($_POST['txtEstatus']);

        if($intIdAgenda <> 0) {

          $request = $this->model->estatusUpdate($intIdAgenda, $intEstatus);
          $option = 1;

        }
        if($request > 0){
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

  public function getNombreUsuarioCreacion($id){

    $intIdUsuarioCreacion = intval(strClean($id));

    if($intIdUsuarioCreacion > 0){

      $arrData = $this->model->selectNombreUsuairoCreacion($intIdUsuarioCreacion);

      if(empty($arrData)){

        $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');

      }else{

        $arrResponse = array('estatus' => true, 'data' => $arrData);

      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }

    die();

  }


}

?>
