<?php
    class VentasDia extends Controllers{
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
        public function ventasdia(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Ventas del dia";
            $data['page_title'] = "Ventas del dia";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_venta_dia.js";
            
            $this->views->getView($this,"ventasdia",$data);
        }
        
        //Ventas del Dia
        public function getVentasDia(){
            $fechaActual = date("Y-m-d");
            $arrData = $this->model->selectVentasDia($fechaActual,$this->idUser);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $array = $this->getDatosAlumno($arrData[$i]['id_persona']);
                $arrData[$i]['nombre_completo'] = $array['nombre_completo'];
                $arrData[$i]['plantel'] = $array['plantel'];
                $arrData[$i]['carrera'] = $array['nombre_carrera'];
                $arrData[$i]['grado'] = $array['grado'];
                $arrData[$i]['factura'] = 1;
                $arrData[$i]['total_formato'] = '$ '.formatoMoneda($arrData[$i]['total']);
                $arrData[$i]['acciones'] = '<button type="button"  id="'.$arrData[$i]['id'].'" f="'.$arrData[$i]['folio'].'" class="btn btn-secondary btn-xs" onclick="detallesIngreso('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#modalVentaDetallesDia">Detalles</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
        }

        public function getDetallesVenta(int $idIngreso){
            $observacion = $this->model->selectObservacionIngreso($idIngreso);
            $response['observacion'] = ($observacion['observaciones'] == '' || $observacion['observaciones'] == NULL)?'Sin observación':$observacion['observaciones'];
            $detallesVenta = $this->model->selectDetallesVenta($idIngreso);
            $response['detalles'] = $detallesVenta; 
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function setCorteDia(){
            $response['estatus'] = true;
            $response['msg'] = "Corte realizado correctamente";
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function imprimir_reporte_venta_dia(){
            $fechaActual = date("Y-m-d");
            $arrData['datos'] = $this->model->selectDatosUsuario($this->idUser);
            $arrData['ventas'] = $this->model->selectAllVentasDia($this->idUser,$fechaActual);
            $arrData['total'] = 0;
            foreach ($arrData['ventas'] as $key => $value) {
                $arrData['total'] += $value['total'];
            }
            $this->views->getView($this,"viewpdf_reporte_ventas_dia",$arrData);
            //var_dump($arrData);
        }

        private function getDatosAlumno(int $idAlumno){
            $arrData = $this->model->selectDatosAlumno($idAlumno);
            $arrData['nombre_completo'] = $arrData['nombre_persona'].' '.$arrData['ap_paterno'].' '.$arrData['ap_materno'];
            $arrData['plantel'] = $arrData['abreviacion_sistema'].'('.$arrData['abreviacion_plantel'].' / '.$arrData['municipio'].' )';
            return $arrData;
        }
    }
?>