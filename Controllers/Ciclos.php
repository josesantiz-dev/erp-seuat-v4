<?php
    class Ciclos extends Controllers{

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
            // $this->rol = $_SESSION['claveRol'];
        }

        public function Ciclos()
        {
            $data['page_tag'] = "Ciclos";
            $data['page_name'] = "Ciclos";
            $data['page_title'] = "Ciclos";
            $data['page_functions_js'] = "functions_ciclos.js";
            $this->views->getView($this, "ciclos", $data);
        }



        //PARA ENLISTAR TODOS LOS USUARIOS EN LA TABLA VISTA
        public function getCiclos(){
            $arrData = $this->model->selectCiclos($this->nomConexion);
            for($i=0; $i < count($arrData); $i++){
                /* $arrData[$i]['id_guardado'] = */ /* $arrData[$i]['IdCiclos']; */
                /* $arrData[$i]['id'] = $i+1; */
                $arrData[$i]['numeracion'] = $i+1;
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
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditCiclos" onClick="fntEditCiclos(this,'.$arrData[$i]['IdCiclos'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelCiclos" onClick="fntDelCiclos('.$arrData[$i]['IdCiclos'].')" title="Eliminar"> &nbsp;&nbsp;
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


        //EDITAR
        public function getCiclo($id){
            $intIdCiclos = intval(strClean($id));
            if($intIdCiclos > 0)
            {
                $arrData = $this->model->selectsCiclo($intIdCiclos, $this->nomConexion);
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


        //PARA GUARADAR CICLOS
        public function setCiclo(){
            if($_POST){

                /* dep($_POST); */
                if(empty($_POST['txtNombre_Ciclo']) || empty($_POST['listEstatus']) || empty($_POST['txtId_usuario_creacion']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdCiclos = intval($_POST['idCiclos']);
                    $strNombre_Ciclo = strClean($_POST['txtNombre_Ciclo']);
                    $strAnio = strClean($_POST['txtAnio']);
                    $intEstatus = intval($_POST['listEstatus']);
                    $strFecha_Creacion = strClean($_POST['txtFecha_Creacion']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_Actualizacion']);
                    $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_Actualizacion']);
                    $intId_Generacion = intval($_POST['listIdGeneracionesNuevo']);

                    if($intIdCiclos == 0)
                    {
                        $request_ciclo = $this->model->insertCiclo($strNombre_Ciclo,
                                                                   $strAnio,
                                                                   $intEstatus,
                                                                   $strFecha_Creacion,
                                                                   $strFecha_Actualizacion,
                                                                   $intId_usuario_creacion,
                                                                   $intId_Usuario_Actualizacion,
                                                                   $intId_Generacion, $this->nomConexion);
                                                                   $option = 1;
                    }

                    if($request_ciclo > 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                        }
                    }else if($request_ciclo == 'exist'){

                        $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El ciclo ya existe.');
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        //PARA ACTUALIZAR CICLOS
        public function setCiclos_up()
        {
            if($_POST)
            {
                if(empty($_POST['txtNombre_CicloUp']) || empty($_POST['txtAnioUp']) || empty($_POST['listEstatusUp']) || 
                   empty($_POST['txtId_Usuario_ActualizacionUp']) || empty($_POST['listIdGeneracionesEditar']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdCiclos = intval($_POST['idCiclosUp']);
                    $strNombre_Ciclo = strClean($_POST['txtNombre_CicloUp']);
                    $strAnio = strClean($_POST['txtAnioUp']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $intId_Generacion = intval($_POST['listIdGeneracionesEditar']);
                    $request_ciclo = "";

                    if($intIdCiclos <> 0)
                    {
                        $request_ciclo = $this->model->updateCiclos($intIdCiclos,
                                                                    $strNombre_Ciclo,
                                                                    $strAnio,
                                                                    $intEstatus,
                                                                    $strFecha_Actualizacion,
                                                                    $intId_Usuario_Actualizacion,
                                                                    $intId_Generacion, $this->nomConexion);
                                                                    $option = 1;
                    }

                    if($request_ciclo > 0 )
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
        public function delCiclos(){
            if($_POST)
            {
                $intIdCiclos = intval($_POST['IdCiclos']);
                $requestDelete = $this->model->deleteCiclos($intIdCiclos,$this->nomConexion);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el ciclo correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un ciclo asociado a un periodo activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el ciclo.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        //SELECT NUEVO CICLO GENERACION
        public function getSelectCiclo(){
            $htmlOptions = "<option value='' selected>- Elige una generación -</option>";
            $arrData = $this->model->selectCiclo($this->nomConexion);
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_generacion'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }


        //SELECT PARA EDITAR CICLO
        public function getSelectEditCiclo(){
            $htmlOptions = "<option value='' selected>- Elige una generación -</option>";
            $arrData = $this->model->selectEditCiclo( $this->nomConexion);
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_generacion'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }


        //PARA

    }
?>