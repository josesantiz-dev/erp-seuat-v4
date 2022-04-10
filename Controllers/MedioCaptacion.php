<?php

  class MedioCaptacion extends Controllers{

    function __construct(){

      parent::__construct();
      session_start();
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
        die();
      }

    }

    public function MedioCaptacion(){

      $data['page_tag'] = "Medios de Captacion";
      $data['page_title'] = "Medios de Captacion";
      $data['page_name'] = "medio_captacion";
      $data['page_functions_js'] = "functionsMedioCapatacion.js";
      $this->views->getView($this,"MedioCaptacion",$data);

    }

    public function getMediosCaptacion(){

      $arrData = $this->model->selectMediosCaptacion();
      for($i = 0; $i < count($arrData); $i++){

        $arrData[$i]['id_gurardado'] = $arrData[$i]['id'];
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
              <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditMedioCaptacion" onClick="fntEditMedioCaptacion(this,'.$arrData[$i]['id_gurardado'].')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
              <div class="dropdown-divider"></div>
              <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelMedioCaptacion" onClick="fntDelMedioCaptacion('.$arrData[$i]['id_gurardado'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
            </div>
          </div>
        </div>';

      }
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();

    }

    public function setMedioCaptacion(){

      if($_POST){

        if(empty($_POST['txtMedioCaptacion'])){
          $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{

          $strMedioCaptacion = strClean($_POST['txtMedioCaptacion']);
          $strFechaCreacion = strClean($_POST['txtFechaCreacion']);
          $intIdMediioCaptacion = intval($_POST['idMedioCaptacion']);

          if($intIdMediioCaptacion == 0){

            $requestMedioCaptacion = $this->model->insertMedioCaptacion($strMedioCaptacion,
                                                                        $strFechaCreacion,
                                                                        $intIdMediioCaptacion);
                                                                        $option = 1;

          }

          if($requestMedioCaptacion > 0){

            if($option == 1){

              $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');

            }

          }else if($requestMedioCaptacion == 'exit'){

            $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El Medio de Captacion ya esxiste');

          }else{

            $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');

          }

        }

        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

      }

      die();

    }

  }


?>
