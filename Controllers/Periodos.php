<?php
    class Periodos extends Controllers{
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

        public function Periodos()
        {
            $data['page_tag'] = "Periodos";
            $data['page_name'] = "Periodos";
            $data['page_title'] = "Periodos";
            $data['page_functions_js'] = "functions_periodos.js";
            $this->views->getView($this, "periodos", $data);
        }



        //PARA ENLISTAR TODOS LOS PERIODOS EN LA TABLA VISTA
        public function getPeriodos(){
            $arrData = $this->model->selectPeriodos();
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
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPeriodos" onClick="fntEditPeriodos(this,'.$arrData[$i]['IdPeriodos'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPeriodos" onClick="fntDelPeriodos('.$arrData[$i]['IdPeriodos'].')" title="Eliminar"> &nbsp;&nbsp;
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



        //EDITAR PERIODOS
        public function getPeriodo($id){
            $intIdPeriodos = intval(strClean($id));
            if($intIdPeriodos > 0)
            {
                $arrData = $this->model->selectPeriodo($intIdPeriodos);
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


        //GUARDAR PERIODOS
        public function setPeriodo(){
            if($_POST){
                /* dep($_POST); */
                if(empty($_POST['txtNombre_Periodo']) || empty($_POST['txtFecha_inicio']) || empty($_POST['txtFecha_fin']) || 
                   empty($_POST['listEstatus']) || empty($_POST['txtId_usuario_creacion']) || empty($_POST['listIdOrganizacionesNuevo']) || empty($_POST['listIdCiclosNuevo']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdPeriodos = intval($_POST['idPeriodos']);
                    $strNombre_Periodo = strClean($_POST['txtNombre_Periodo']);
                    $strFecha_inicio = strClean($_POST['txtFecha_inicio']);
                    $strFecha_fin = strClean($_POST['txtFecha_fin']);
                    $intEstatus = intval($_POST['listEstatus']);
                    $strFecha_Creacion = strClean($_POST['txtFecha_Creacion']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_Actualizacion']);
                    $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_Actualizacion']);
                    $intId_Organizacion_planes = intval($_POST['listIdOrganizacionesNuevo']);
                    $intId_Ciclo = intval($_POST['listIdCiclosNuevo']);

                    if ($intIdPeriodos == 0)
                    {
                        $request_periodo = $this->model->insertPeriodo($strNombre_Periodo,
                                                                       $strFecha_inicio,
                                                                       $strFecha_fin,
                                                                       $intEstatus,
                                                                       $strFecha_Creacion,
                                                                       $strFecha_Actualizacion,
                                                                       $intId_usuario_creacion,
                                                                       $intId_Usuario_Actualizacion,
                                                                       $intId_Organizacion_planes,
                                                                       $intId_Ciclo);
                                                                       $option = 1;
                    }

                    if($request_periodo > 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                        }
                    }else if($request_periodo == 'exist'){

                        $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El periodo ya existe.');
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        //PARA ACTUALIZAR PERIODOS
        public function setPeriodos_up()
        {
            if($_POST)
            {
                if(empty($_POST['txtNombre_PeriodoUp']) || empty($_POST['txtFecha_inicioUp']) || empty($_POST['txtFecha_finUp']) || 
                   empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']) || empty($_POST['listIdCiclosEditar']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdPeriodos = intval($_POST['idPeriodosUp']);
                    $strNombre_Periodo = strClean($_POST['txtNombre_PeriodoUp']);
                    $strFecha_inicio = strClean($_POST['txtFecha_inicioUp']);
                    $strFecha_fin = strClean($_POST['txtFecha_finUp']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $intId_Organizacion_planes = intval($_POST['listIdOrganizacionesEditar']);
                    $intId_Ciclo = intval($_POST['listIdCiclosEditar']);
                    $request_periodo = "";

                    if($intIdPeriodos <> 0)
                    {
                        $request_periodo = $this->model->updatePeriodos($intIdPeriodos,
                                                                        $strNombre_Periodo,
                                                                        $strFecha_inicio,
                                                                        $strFecha_fin,
                                                                        $intEstatus,
                                                                        $strFecha_Actualizacion,
                                                                        $intId_Usuario_Actualizacion,
                                                                        $intId_Organizacion_planes,
                                                                        $intId_Ciclo);
                                                                        $option = 1;
                    }

                    if($request_periodo > 0 )
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


        //PARA ELIMINAR PERIODO
        public function delPeriodos(){
            if($_POST)
            {
                $intIdPeriodos = intval($_POST['idPeriodos']);
                $requestDelete = $this->model->deletePeriodos($intIdPeriodos);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el periodo correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un periodo asociado a un precarga y salones compuestos activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el periodo.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



        /* ----------------------------SELECT PARA NUEVO--------------------------------- */
        //SELECT periodos organizacion
        public function getSelectPeriodoOrganiz(){
            $htmlOptions = "<option value='' selected>- Elige una organización plan -</option>";
            $arrData = $this->model->selectPeriodoOrg();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_plan'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        //SELECT periodos ciclos
        public function getSelectPeriodoCiclo(){
            $htmlOptions = "<option value='' selected>- Elige un ciclo -</option>";
            $arrData = $this->model->selectPeriodoCiclos();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_ciclo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }
        /* ------------------------------------------------------------- */


        /* -----------------------------SELECT PARA EDITAR-------------------------------- */
        //SELECT PARA EDITAR PERIODO PLAN
        public function getSelectEditPerioPlan(){
            $htmlOptions = "<option value='' selected>- Elige un plan -</option>";
            $arrData = $this->model->selectEditPerioPlan();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_plan'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditPerioCiclo(){
            $htmlOptions = "<option value='' selected>- Elige un ciclo -</option>";
            $arrData = $this->model->selectEditPerioCiclo();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_ciclo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }
        /* ------------------------------------------------------------- */


    }
?>