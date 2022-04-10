<?php
    class Grados extends Controllers{
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

        public function Grados()
        {
            $data['page_tag'] = "Grados";
            $data['page_name'] = "Grados";
            $data['page_title'] = "Grados";
            $data['page_functions_js'] = "functions_grados.js";
            $this->views->getView($this, "grados", $data);
        }


        //PARA ENLISTAR TODOS LOS USUARIOS EN LA TABLA VISTA
        public function getGrados(){
            $arrData = $this->model->selectGrados();
            for($i=0; $i < count($arrData); $i++){
                /* $arrData[$i]['id_guardado'] = */ /* $arrData[$i]['IdCiclos']; */
                /* $arrData[$i]['id'] = $i+1; */
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
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditGrados" onClick="fntEditGrados(this,'.$arrData[$i]['IdGrados'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelGrados" onClick="fntDelGrados('.$arrData[$i]['IdGrados'].')" title="Eliminar"> &nbsp;&nbsp;
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


        //EDITAR GRADOS
        public function getGrado($id){
            $intIdGrados = intval(strClean($id));
            if($intIdGrados > 0)
            {
                $arrData = $this->model->selectGrado($intIdGrados);
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


        //PARA GUARADAR GRADOS
        public function setGrado(){
            if($_POST){

                /* dep($_POST); */
                if(empty($_POST['txtNombre_Grado']) || empty($_POST['txtNumero_Natural']) || empty($_POST['txtNumero_Romano']) || empty($_POST['listEstatus']) || empty($_POST['txtId_usuario_creacion']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdGrados = intval($_POST['idGrados']);
                    $strNombre_Grado = strClean($_POST['txtNombre_Grado']);
                    $strNumero_Natural = strClean($_POST['txtNumero_Natural']);
                    $strNumero_Romano = strClean($_POST['txtNumero_Romano']);
                    $intEstatus = intval($_POST['listEstatus']);
                    $strFecha_Creacion = strClean($_POST['txtFecha_Creacion']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_Actualizacion']);
                    $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_Actualizacion']);

                    if($intIdGrados == 0)
                    {
                        $request_grado = $this->model->insertGrado($strNombre_Grado,
                                                                   $strNumero_Natural,
                                                                   $strNumero_Romano,
                                                                   $intEstatus,
                                                                   $strFecha_Creacion,
                                                                   $strFecha_Actualizacion,
                                                                   $intId_usuario_creacion,
                                                                   $intId_Usuario_Actualizacion);
                                                                   $option = 1;
                    }

                    if($request_grado > 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                        }
                    }else if($request_grado == 'exist'){

                        $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El grado ya existe.');
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



        //PARA ACTUALIZAR GRADOS
        public function setGrados_up()
        {
            if($_POST)
            {
                if(empty($_POST['txtNombre_GradoUp']) || empty($_POST['txtNumero_NaturalUp']) || empty($_POST['txtNumero_RomanoUp']) || empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdGrados = intval($_POST['idGradosUp']);
                    $strNombre_Grado = strClean($_POST['txtNombre_GradoUp']);
                    $strNumero_Natural = strClean($_POST['txtNumero_NaturalUp']);
                    $strNumero_Romano = strClean($_POST['txtNumero_RomanoUp']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $request_grado = "";

                    if($intIdGrados <> 0)
                    {
                        $request_grado = $this->model->updateGrados($intIdGrados,
                                                                    $strNombre_Grado,
                                                                    $strNumero_Natural,
                                                                    $strNumero_Romano,
                                                                    $intEstatus,
                                                                    $strFecha_Actualizacion,
                                                                    $intId_Usuario_Actualizacion);
                                                                    $option = 1;
                    }

                    if($request_grado > 0 )
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


        //PARA ELIMINAR
        public function delGrados(){
            if($_POST)
            {
                $intIdGrados = intval($_POST['idGrados']);
                $requestDelete = $this->model->deleteGrados($intIdGrados);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el grado correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un grado asociado a una materia, precarga y salones compuestos activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el grado.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


    }
?>