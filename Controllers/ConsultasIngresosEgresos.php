<?php
    class ConsultasIngresosEgresos extends Controllers{
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
        //Vista de consultas
        public function consultas(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Consultas de estado de cuentas";
            $data['page_title'] = "Consultas de estado de cuentas";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_consultas_ingresos_egresos.js";
            $this->views->getView($this,"consultas_ingresos_egresos",$data);
        }

        //Obtener estado de cuenta por matricula
        public function getEstadoCuenta($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = $arrArgs[0];
            $idAlumno = $arrArgs[1];
            if($matriculaRFC != 'null'){
                $arrData = $this->estadoCuenta($matriculaRFC,$idAlumno);
            }else{
                $arrData = $this->estadoCuenta($matriculaRFC,$idAlumno);
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Imprimir estado de cuenta
        public function imprimir_edo_cta($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = base64_decode($arrArgs[0]);
            $idAlumno = base64_decode($arrArgs[1]);
            if($matriculaRFC != 'null'){
                $idAlumno = null;
                $isRFC = $this->model->selectIdAlumnoByRFC($matriculaRFC);
                if($isRFC){
                    $idAlumno = $isRFC['id'];
                }
                $isMatricula = $this->model->selectIdAlumnoByMatricula($matriculaRFC);
                if($isMatricula){
                    $idAlumno = $isMatricula['id'];
                }
                $estatus = $this->model->selectStatusEstadoCuentaById($idAlumno);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['pagado'] == 0){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                }
            }else{
                $estatus = $this->model->selectStatusEstadoCuentaById($idAlumno);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['pagado'] == 0){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                }
            }
            $data = ['data'=> $arrData,'edo_cta'=> $this->estadoCuenta($matriculaRFC,$idAlumno)];
            //var_dump($data['edo_cta']);
            $this->views->getView($this,"viewpdf_edo_cta",$data);
        }
        //Obtener datos del Alumno y datos del Estado de Cuenta
        public function getDatosAlumno($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = $arrArgs[0];
            $idAlumno = $arrArgs[1];
            if($matriculaRFC != 'null'){
                $idAlumno = null;
                $isRFC = $this->model->selectIdAlumnoByRFC($matriculaRFC);
                if($isRFC){
                    $idAlumno = $isRFC['id'];
                }
                $isMatricula = $this->model->selectIdAlumnoByMatricula($matriculaRFC);
                if($isMatricula){
                    $idAlumno = $isMatricula['id'];
                }
                if($isMatricula == false && $isRFC == false){
                    $arrData['estatus'] = false;
                    $arrData['msg'] = "Los datos ingresados no se encuentra en la base de datos";
                    echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
                    die();
                    finish();
                }
                $estatus = $this->model->selectStatusEstadoCuentaById($idAlumno);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['pagado'] == 0){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                    $arrData['msg'] = "El alumno no cuenta con un estado de cuenta";
                }
            }else{
                $estatus = $this->model->selectStatusEstadoCuentaById($idAlumno);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['pagado'] == 0){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                    $arrData['msg'] = "El alumno no cuenta con un estado de cuenta";
                }
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Buscar persona median el Modal
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                if($arrData[$i]['rfc'] == null){
                    $arrData[$i]['rfc'] = '<span class="badge badge-warning">Sin datos fiscales</span>';
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" r="" m="'.$arrData[$i]['matricula_interna'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
                }else{
                    $arrData[$i]['rfc'] = $arrData[$i]['rfc'];
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" r="'.$arrData[$i]['rfc'].'" m="'.$arrData[$i]['matricula_interna'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
                }
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }
        //Obtener subconcepto
        protected function getSubConcepto($str){
            if(stristr($str,'COL')){
                $array = explode('.',$str);
                $anio = explode('-',$array[2]);
                return $array[1].'/'.$anio[0];
            }else{ return $str;}
        }
        protected function estadoCuenta($matriculaRFC,$idAlum){
            $idAlumno = null;
            if($matriculaRFC != 'null'){
                $isRFC = $this->model->selectIdAlumnoByRFC($matriculaRFC);
                if($isRFC){
                    $idAlumno = $isRFC['id'];
                }
                $isMatricula = $this->model->selectIdAlumnoByMatricula($matriculaRFC);
                if($isMatricula){
                    $idAlumno = $isMatricula['id'];
                }
            }else{
                $idAlumno = $idAlum;
            }
            $datos = [];
            if($idAlumno != null){
                //$arrData = $this->model->selectEdoCuentaById($idAlumno);
                $arrData = $this->model->selectEdoCta($idAlumno);
                foreach ($arrData as $key => $value) {
                    if($value['pagado'] == 1){
                        //Pagado
                        $datosPago = $this->model->selectDetallePago($value['id_precarga'], $idAlumno);
                        $date = array('id_edo_cta' => $value['id_edo_cta'],'id_precarga'=>$value['id_precarga'],'pagado'=>true,'codigo_servicio'=>$value['codigo_servicio'],'nombre_servicio'=>$value['nombre_servicio'],'precio_unitario'=>$value['precio_unitario'],'fecha_limite_cobro'=>$value['fecha_limite_cobro'],'cargo'=>$datosPago['cargo'],'abono'=>$datosPago['abono'],'cantidad'=>$datosPago['cantidad'],'fecha_pago'=>$datosPago['fecha'],'referencia'=>$datosPago['folio'],'tipo_comprobante'=>$datosPago['tipo_comprobante'],'id_ingreso'=>$datosPago['id_ingreso']);
                        array_push($datos,$date);
                    }else{
                        $date = array('id_edo_cta' => $value['id_edo_cta'],'id_precarga'=>$value['id_precarga'],'pagado'=>false,'codigo_servicio'=>$value['codigo_servicio'],'nombre_servicio'=>$value['nombre_servicio'],'precio_unitario'=>$value['precio_unitario'],'fecha_limite_cobro'=>$value['fecha_limite_cobro'],'cargo'=>'','abono'=>'','cantidad'=>'','fecha_pago'=>'','referencia'=>'','tipo_comprobante'=>'','id_ingreso'=>'');
                        array_push($datos,$date);
                    }
                }
                $datosAlumno = $this->model->selectDatosAlumnoById($idAlumno);
               
                
            }
            for ($i=0; $i<count($datos); $i++){
                $datos[$i]['numeracion'] = $i+1;
                $datos[$i]['fecha'] = ($datos[$i]['fecha_limite_cobro']== '')?'0000:00:00':$datos[$i]['fecha_limite_cobro'];
                $datos[$i]['concepto'] = 'LA-C78MS';
                //$arrData[$i]['subconcepto'] = $this->getSubConcepto(($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion'].'.'.$arrData[$i]['fecha_pago']:$arrData[$i]['codigo_servicio']);
                //$arrData[$i]['descripcion'] = ($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion']:$arrData[$i]['nombre_servicio'];
                $datos[$i]['cargo'] = ($datos[$i]['cargo']=='')?'$0.00':$datos[$i]['cargo']; 
                $datos[$i]['recargo'] = '$0.00';
                $datos[$i]['abono'] = $datos[$i]['abono'];
                $datos[$i]['cantidad'] = ($datos[$i]['cantidad']=='')?'0':$datos[$i]['cantidad']; 
                $datos[$i]['precio_unitario'] = '$'.$datos[$i]['precio_unitario'];
                //$datos[$i]['fecha_pago'] = $datos[$i]['fecha_pagado'];
                //$datos[$i]['referencia'] = $datos[$i]['folio'];
                $params = array('id'=>$datos[$i]['id_edo_cta'],'id_alumno'=>$datosAlumno['id'],'nombre_completo'=>$datosAlumno['nombre_persona'].' '.$datosAlumno['ap_paterno'].' '.$datosAlumno['ap_materno'],'nombre_servicio'=>$datos[$i]['nombre_servicio'],'pu'=>$datos[$i]['precio_unitario'],'tipo'=>($datos[$i]['codigo_servicio'] == 'CM')?'col':'serv','precarga'=>true,'id_precarga'=>$datos[$i]['id_precarga']);
                $params = json_encode($params);
                $params64 = base64_encode($params);
                $datos[$i]['options'] = ($datos[$i]['fecha_pago'] == '')?'<div class="text-center"><a type="button" class="btn btn-primary btn-xs" href="'.BASE_URL.'/Ingresos/ingresos?d='.$params64.'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCobrar&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></div>':'<div class="text-center">
				<div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$datos[$i]['id_ingreso'].'" onclick="fnReimprimirComprobante(this)"> &nbsp;&nbsp; 
                            <i class="fas fa-print"></i> &nbsp; Reimprimir recibo
                        </button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$datos[$i]['referencia'].'"  onClick="fnFacturarVenta(this)"> &nbsp;&nbsp; 
                            <i class="fas fa-file-invoice"></i> &nbsp; Factutrar
                        </button>
						<div class="dropdown-divider">
                        </div>
						    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$datos[$i]['referencia'].'" onClick="fnCancelarVenta(this)"> &nbsp;&nbsp; <i class="fas fa-ban "></i> &nbsp; Cancelar
                            </button>
					</div>
				</div>
				</div>';
            }
            return $datos;
        }
    }
?>