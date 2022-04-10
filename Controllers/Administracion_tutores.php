<?php
    class Administracion_tutores extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'/login');
                die();
            }
        }

        public function Administracion_tutores()
        {
            $data['page_tag'] = "Administración tutores";
            $data['page_name'] = "Administración tutores";
            $data['page_title'] = "Administración tutores";
            $data['page_functions_js'] = "functions_administracion_tutores.js";
            $this->views->getView($this, "administracion_tutores", $data);
        }




        //PARA ENLISTAR ADMINISTRACION MATRICULAS TUTORES
        public function getAdministracionTutores(){
            $arrData = $this->model->selectAdministTutores();
            for($i=0; $i < count($arrData); $i++){
                if($arrData[$i]['Estatus'] == 1){
                    $arrData[$i]['Estatus'] = '<span class="badge badge-dark">Activo</span>';
                }else{
                    $arrData[$i]['Estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
                }
                $arrData[$i]['options'] = '
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditAdminisTutores" onClick="fntEditAdminisTutores(this,'.$arrData[$i]['idTut'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelAdminisTutores" onClick="fntDelAdminisTutores('.$arrData[$i]['idTut'].')" title="Eliminar"> &nbsp;&nbsp;
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



        //EDITAR TUTORES
        public function getAdminisTut($id){
            $intIdAdminisTurores = intval(strClean($id));
            if($intIdAdminisTurores > 0)
            {
                $arrData = $this->model->selectAdminisTut($intIdAdminisTurores);
                if(empty($arrData))
                {
                    $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('estatus' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



        //PARA ACTUALIZAR DATOS
    public function setAdminisTutores_up()
    {
        if($_POST)
        {
                if(empty($_POST['txtNombreTutorUp']) || empty($_POST['txtApellidoPatTutorUp']) || empty($_POST['txtApellidoMatTutorUp']) || empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdAdminisTurores = intval($_POST['idAdminTutoresUp']);
                    $strNombreTutor = strClean($_POST['txtNombreTutorUp']);
                    $strApellidoPatTutor = strClean($_POST['txtApellidoPatTutorUp']);
                    $strApellidoMatTutor = strClean($_POST['txtApellidoMatTutorUp']);
                    $strDirreccion = strClean($_POST['txtDirreccionUp']);
                    $strTelCelular = strClean($_POST['txtTelCelularUp']);
                    $strTelFijo = strClean($_POST['txtTelFijoUp']);
                    $strCorreo = strClean($_POST['txtCorreoUp']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $request_Adminis_tutores = "";

                        if($intIdAdminisTurores <> 0)
                        {
                            $request_Adminis_tutores = $this->model->updateAdministTutores($intIdAdminisTurores, 
                                                                                      $strNombreTutor,
                                                                                      $strApellidoPatTutor, 
                                                                                      $strApellidoMatTutor, 
                                                                                      $strDirreccion,
                                                                                      $strTelCelular,
                                                                                      $strTelFijo,
                                                                                      $strCorreo,
                                                                                      $intEstatus, 
                                                                                      $strFecha_Actualizacion, 
                                                                                      $intId_Usuario_Actualizacion);
                                                                                      $option = 1;
                        }

                        if($request_Adminis_tutores > 0 )
                        {
                            if($option == 1)
                            {
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


        //PARA ELIMINAR TUTORES
        public function delAdminisTutores(){
            if($_POST)
            {
                $intIdAdminisTurores = intval($_POST['idTut']);
                $requestDelete = $this->model->deleteAdministTutores($intIdAdminisTurores);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el tutor correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un tutor asociado a una inscripción activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el tutor.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


    }
?>