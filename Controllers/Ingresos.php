<?php
    class Ingresos extends Controllers{
        private $idUser;
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
            $this->idUser = $_SESSION['idUser'];
        }
        //Mostrar vista de ingresos
        public function ingresos(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Ingresos";
            $data['page_title'] = "Caja (ingresos)";
            $data['page_content'] = "";
            $data['metodos_pago'] = $this->model->selectMetodosPago();
            $data['estatus_caja'] = $this->model->selectEstatusCaja($this->idUser);
            $data['page_functions_js'] = "functions_ingresos.js";
            $this->views->getView($this,"ingresos",$data);
        }
        //Funcion obtener lista ingresos
        public function getIngresos(){
            $arrData = $this->model->selectIngresos();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para buscar persona en el Modal
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }
        //Funcion para obtener si una persona tiene estado de cuenta
        public function getEstatusEstadoCuenta($idPersonaSeleccionada){
            $arrData = $this->model->selectStatusEstadoCuenta($idPersonaSeleccionada);
            if(count($arrData) == 0){
                $arrRequest = false;
            }else{
                $arrRequest = true;
            }
            echo json_encode($arrRequest,JSON_UNESCAPED_UNICODE);
            die();
        }        
        // Funcion para obtener Servicios por Tipo de pago
        public function getServicios($valor){
            $valor = explode(',',$valor);
            $pago = $valor[1];
            $grado = $valor[0];
            $idPersona = $valor[2];
            if($pago == 1){
                $arrData['tipo'] = "COL";
                $arrData['data'] = $this->model->selectColegiaturas($idPersona,$grado);
            }else{
                $arrData['tipo'] = "SERV";
                //$arrData['data'] = $this->model->selectServicios($idPersona,$grado);
                $datos = $this->model->selectServicios($idPersona,$grado);
                $arrData['data'] = $datos;
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para obtener promociones por Id del Servicio
        public function getPromociones($idServicio){
            $arrData = $this->model->selecPromociones($idServicio);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para generar un estado de cuenta
        public function generarEdoCuenta($idPersonaSeleccionada){
            $arrPlantel = $this->model->selectPlantelAlumno($idPersonaSeleccionada);
            $arrCarrera = $this->model->selectCarreraAlumno($idPersonaSeleccionada);
            $arrGrado = $this->model->selectGradoAlumno($idPersonaSeleccionada);
            $arrPeriodo = $this->model->selectPeriodoAlumno($idPersonaSeleccionada);
            $idPlantel = $arrPlantel['id'];
            $idCarrera = $arrCarrera['id_plan_estudios'];
            $idGrado = $arrGrado['grado'];
            $idPeriodo = $arrPeriodo['id_periodo'];
            $arrData = $this->model->generarEdoCuentaAlumno($idPersonaSeleccionada,$idPlantel,$idCarrera,$idGrado,$idPeriodo,$this->idUser);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para enviar ingresos
        public function setIngresos(){
            $idAlumno = $_GET['idP'];
            $tipoPago = $_GET['tipoP'];
            $tipoComprobante = $_GET['tipoCom'];
            $observaciones = $_GET['observacion'];
            $arrayDate = json_decode($_GET['date']);
            $isEdoCta = false;
            $total = 0;
            $estados;
            foreach ($arrayDate as $key => $value) {
                $total += $value->subtotal;
            }
            foreach ($arrayDate as $key => $value) {
                if($value->edo_cta == '1'){
                    $isEdoCta = true;
                    break;
                }
            }
            $folio = $this->model->selectFolioSig($idAlumno);
            //$idPlantel = $this->model->selectPlantelAlumno($idAlumno);
            $idPlantel = $this->model->selectPlantelUSer($this->idUser);
            if($idPlantel){
                $reqIngreso = $this->model->insertIngresos($folio,$tipoPago,$tipoComprobante,$total,$observaciones,$idAlumno,$idPlantel['id'],$this->idUser); 
                if($reqIngreso){
                    foreach ($arrayDate as $key => $value) {
                        $idServicio = null;
                        $idPrecarga = null;
                        if($value->edo_cta == 1){ //Estado de Cuenta
                            $idPrecarga = $value->precarga;
                            $reqIngDetalles = $this->model->insertIngresosDetalle($value->cantidad,$value->precio_unitario,$value->precio_unitario,$total,$value->subtotal,0,0,json_encode($value->promociones),$idServicio,$idPrecarga,$reqIngreso);
                            $idEstadoCta = $value->id_servicio;  //ID edo cta a actualizar como pagado
                            if($reqIngDetalles){
                                $reqEdoCtaUpdate = $this->model->updateEdoCta($idEstadoCta,$this->idUser);
                                //$arrResponse = $reqEdoCtaUpdate; Se se guardo correcxtamnete a Pagado
                            }
                            
                        }else{ //Otros Servicios
                            $idServicio = $value->id_servicio;
                            $reqIngDetalles = $this->model->insertIngresosDetalle($value->cantidad,$value->precio_unitario,$value->precio_unitario,$total,$value->subtotal,0,0,json_encode($value->promociones),$idServicio,$idPrecarga,$reqIngreso);
                        }
                        if($reqIngDetalles){
                            $arrResponse = array('estatus' => true, 'id'=>$reqIngreso,'msg' => 'Datos guardados correctamente!');                       
                        }else{
                           $arrResponse = array('estatus' => false, 'msg' => 'No es posible Guardar los Datos');
                        }
                    }
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible Guardar los Datos');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para imprimir comprante de una Venta
        public function imprimir_comprobante_venta(string $idVenta){
            $idIngreso = $this->reverse64($idVenta);
            $data['datosInstitucion'] = $this->model->selectDatosInstitucion($idIngreso); //Datos del plantel
            $data['datos_venta'] = $this->model->selectDatosVenta($idIngreso);//Datos del ingreso/venta
            $data['datos_alumno'] = $this->model->selectDatosAlumno($idIngreso);//Datos del Alumno
            $data['datos_usuario'] = $this->model->selectDatosUsuario($this->idUser);//Datos del Usuario Admin
            $arrDatosVenta = [];
            $total = 0;
            $inscripcion = 0;
            $colegiatura = 0;
            $otros = 0;
            foreach ($data['datos_venta'] as $key => $venta) {
                if($venta['codigo_servicio_precarga'] == 'CM'){
                    $colegiatura += $venta['precio_unitario_precarga'];
                }else if($venta['codigo_servicio_precarga'] == 'IN'){
                    $inscripcion += $venta['precio_unitario_precarga'];
                }else if($venta['codigo_servicio']!= null){
                    $otros += $venta['precio_unitario'];
                }
                $total = $venta['total'];
            }
            $arrDatosVenta['total'] = $total;
            $arrDatosVenta['inscripcion'] = $inscripcion;
            $arrDatosVenta['colegiatura'] = $colegiatura;
            $arrDatosVenta['otros'] = $otros;
            
            $data['datos_venta'] = $arrDatosVenta;
            $this->views->getView($this,"viewpdf_compromante_venta_media_carta",$data); 
        }
        public function aperturarCaja($args){
            $arg = explode(',',$args);
            $idCaja = $arg[0];
            $estatus = 1;
            $monto = $arg[1];
            $apertura = $this->model->updateEstatusCaja($idCaja,$estatus,$monto);
            if($apertura){
               $caja = $this->model->insertCorteCaja($monto,$idCaja);
                if($caja){
                    $arrResponse = array('estatus' => true, 'msg' => 'Caja aperturado correctamente!');
                }
            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No es posible aperturar la caja!');                       
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Funcion para convertir base64 a Array
        private function reverse64($arr){
            return base64_decode($arr);
        }
        
    }
?>