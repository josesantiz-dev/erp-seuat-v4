<?php
    class Salones_compuestos extends Controllers{
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

        public function Salones_compuestos()
        {
            $data['page_tag'] = "Salones compuestos";
            $data['page_name'] = "Salones compuestos";
            $data['page_title'] = "Salones compuestos";
            $data['page_functions_js'] = "functions_salones_compuestos.js";
            $this->views->getView($this, "salones_compuestos", $data);
        }


        //PARA ENLISTAR TODOS LOS SALONES COMPUESTOS
        public function getSalonesCompuest(){
            $arrData = $this->model->selectSalonesCompuest();
            for($i=0; $i < count($arrData); $i++){
                if($arrData[$i]['Est'] == 1){
                    $arrData[$i]['Est'] = '<span class="badge badge-dark">Activo</span>';
                }else{
                    $arrData[$i]['Est'] = '<span class="badge badge-secondary">Inactivo</span>';
                }
                $arrData[$i]['options'] = '
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalonesComp" onClick="fntEditSalonesComp(this,'.$arrData[$i]['IdSalonCom'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalonesComp" onClick="fntDelSalonesComp('.$arrData[$i]['IdSalonCom'].')" title="Eliminar"> &nbsp;&nbsp;
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
        public function getSalonComp($id){
            $intIdSalonesCompuestos = intval(strClean($id));
            if($intIdSalonesCompuestos > 0)
            {
                $arrData = $this->model->selectSalonCompu($intIdSalonesCompuestos);
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




        //PARA GUARADAR SALONES COMPUESTOS
        public function setSalonCompuesto(){
            if($_POST){

                /* dep($_POST); */
                if(empty($_POST['txtNombre_SalonCompuesto']) || empty($_POST['txtId_usuario_creacion']) || empty($_POST['listIdPeriodosNuevo']) || 
                   empty($_POST['listIdGradosNuevo']) || empty($_POST['listIdGruposNuevo']) || empty($_POST['listIdPlantelesNuevo']) || 
                   empty($_POST['listIdTurnosNuevo']) || empty($_POST['listIdSalonesNuevo']) || empty($_POST['listEstatus']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdSalonesCompuestos = intval($_POST['idSalonesCompuestos']);
                    $strNombre_SalonCompuesto = strClean($_POST['txtNombre_SalonCompuesto']);
                    $strFecha_Creacion = strClean($_POST['txtFecha_Creacion']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_Actualizacion']);
                    $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_Actualizacion']);
                    $intId_Periodos = intval($_POST['listIdPeriodosNuevo']);
                    $intId_Grados = intval($_POST['listIdGradosNuevo']);
                    $intId_Grupos = intval($_POST['listIdGruposNuevo']);
                    $intId_Planteles = intval($_POST['listIdPlantelesNuevo']);
                    $intId_Turnos = intval($_POST['listIdTurnosNuevo']);
                    $intId_Salones = intval($_POST['listIdSalonesNuevo']);
                    $intEstatus = intval($_POST['listEstatus']);

                    if($intIdSalonesCompuestos == 0)
                    {
                        $request_salones_compuesto = $this->model->insertSalonCompuesto($strNombre_SalonCompuesto,
                                                                                        $strFecha_Creacion,
                                                                                        $strFecha_Actualizacion,
                                                                                        $intId_usuario_creacion,
                                                                                        $intId_Usuario_Actualizacion,
                                                                                        $intId_Periodos,
                                                                                        $intId_Grados,
                                                                                        $intId_Grupos,
                                                                                        $intId_Planteles,
                                                                                        $intId_Turnos,
                                                                                        $intId_Salones,
                                                                                        $intEstatus);
                                                                                        $option = 1;
                    }

                    if($request_salones_compuesto > 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                        }
                    }else if($request_salones_compuesto == 'exist'){

                        $arrResponse = array('estatus' => false, 'msg' => '¡Atención! El salon compuesto ya existe.');
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }



        //PARA ACTUALIZAR SALONES COMPUESTOS
        public function setSalonesCompuestos_up()
        {
            if($_POST)
            {
                if(empty($_POST['txtNombre_SalonCompuestoUp']) || empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']) || 
                   empty($_POST['listIdPeriodosEditar']) || empty($_POST['listIdGradosEditar']) || empty($_POST['listIdGruposEditar']) || 
                   empty($_POST['listIdPlantelesEditar']) || empty($_POST['listIdTurnosEditar']) || empty($_POST['listIdSalonesEditar']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdSalonesCompuestos = intval($_POST['idSalonesCompuestosUp']);
                    $strNombre_SalonCompuesto = strClean($_POST['txtNombre_SalonCompuestoUp']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $intId_Periodos = intval($_POST['listIdPeriodosEditar']);
                    $intId_Grados = intval($_POST['listIdGradosEditar']);
                    $intId_Grupos = intval($_POST['listIdGruposEditar']);
                    $intId_Planteles = intval($_POST['listIdPlantelesEditar']);
                    $intId_Turnos = intval($_POST['listIdTurnosEditar']);
                    $intId_Salones = intval($_POST['listIdSalonesEditar']);
                    $request_Salon_compuesto = "";

                    if($intIdSalonesCompuestos <> 0)
                    {
                        $request_Salon_compuesto = $this->model->updateSalonesComp($intIdSalonesCompuestos,
                                                                                   $strNombre_SalonCompuesto,
                                                                                   $intEstatus,
                                                                                   $strFecha_Actualizacion,
                                                                                   $intId_Usuario_Actualizacion,
                                                                                   $intId_Periodos,
                                                                                   $intId_Grados,
                                                                                   $intId_Grupos,
                                                                                   $intId_Planteles,
                                                                                   $intId_Turnos,
                                                                                   $intId_Salones);
                                                                                   $option = 1;
                    }

                    if($request_Salon_compuesto > 0 )
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
        public function delSalonesCompuest(){
            if($_POST)
            {
                $intIdSalonesCompuestos = intval($_POST['IdSalonCom']);
                $requestDelete = $this->model->deleteSalonesCompu($intIdSalonesCompuestos);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el salón compuesto correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar un salón compuesto asociado a una inscripción activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el salón compuesto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


        






        /*---------------------------------------SELECT PARA NUEVOS---------------------------------------*/ 
        public function getSelectSalonComPerio(){
            $htmlOptions = "<option value='' selected>- Elige un periodo -</option>";
            $arrData = $this->model->selectSalonComPerio();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_periodo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectSalonComGrado(){
            $htmlOptions = "<option value='' selected>- Elige un grado -</option>";
            $arrData = $this->model->selectSalonComGrado();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_grado'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectSalonComGrupo(){
            $htmlOptions = "<option value='' selected>- Elige un grupo -</option>";
            $arrData = $this->model->selectSalonComGrupo();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_grupo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectSalonComPlantel(){
            $htmlOptions = "<option value='' selected>- Elige un plantel -</option>";
            $arrData = $this->model->selectSalonComPlant();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_plantel'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectSalonComHorar(){
            $htmlOptions = "<option value='' selected>- Elige un turno -</option>";
            $arrData = $this->model->selectSalonComHorar();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_turno'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectSalonComSalon(){
            $htmlOptions = "<option value='' selected>- Elige un salón -</option>";
            $arrData = $this->model->selectSalonComSalon();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_salon'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }
        /*--------------------------------------------------------------------------------------------------*/ 


        /*---------------------------------------SELECT PARA EDITAR---------------------------------------*/ 
        
        public function getSelectEditSalonComPerio(){
            $htmlOptions = "<option value='' selected>- Elige un periodo -</option>";
            $arrData = $this->model->selectEditSalonComPerio();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_periodo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditSalonComGrado(){
            $htmlOptions = "<option value='' selected>- Elige un grado -</option>";
            $arrData = $this->model->selectEditSalonComGrado();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_grado'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditSalonComGrupo(){
            $htmlOptions = "<option value='' selected>- Elige un grupo -</option>";
            $arrData = $this->model->selectEditSalonComGrupo();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_grupo'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditSalonComPlantel(){
            $htmlOptions = "<option value='' selected>- Elige un plantel -</option>";
            $arrData = $this->model->selectEditSalonComPlant();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_plantel'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditSalonComHorar(){
            $htmlOptions = "<option value='' selected>- Elige un turno -</option>";
            $arrData = $this->model->selectEditSalonComHorar();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_turno'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getSelectEditSalonComSalon(){
            $htmlOptions = "<option value='' selected>- Elige un salón -</option>";
            $arrData = $this->model->selectEditSalonComSalon();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) {
                    if($arrData[$i]['estatus'] == 1){
                        $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre_salon'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();
        }
        /*--------------------------------------------------------------------------------------------------*/ 


    }
?>