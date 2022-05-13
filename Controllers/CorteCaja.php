<?php
	class CorteCaja extends Controllers{
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
			$this->rol = $_SESSION['claveRol'];
		}

		public function cortecaja()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Corte caja";
			$data['page_title'] = "Corte caja";
			$data['page_name'] = "Corte caja";
			$data['page_functions_js'] = "functions_corte_caja.js";
			//$plantel = $this->model->selectPlantelCajero($this->idUser,$this->nomConexion);
			$data['cajeros'] = $this->model->selectCajeros($this->nomConexion);
			$this->views->getView($this,"cortecaja",$data);
		}
		public function getCaja($idCaja){
			$arrData = $this->model->selectCaja($idCaja, $this->nomConexion);
			if($arrData){
				$arrData['estatus'] = true;
				$arrData['fechayhora_apertura_caja'] = date('Y-m-d H:i:s A', strtotime($arrData['fechayhora_apertura_caja']));
				$arrData['fechayhora_actual'] = date('Y-m-d H:i:s A');
			}else{
				$arrData['estatus'] = false;
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getTotalesMetodosPago($params){
			$arrs = explode(',',$params);
			$id_caja =  $arrs[0];
			$fecha_apertura = $arrs[1];
			$id_usuario = $this->model->selectIdUsuario($id_caja, $this->nomConexion);
			$arrData = $this->model->selectTotalesMetodosPago($id_usuario['id_usuario_atiende'],$fecha_apertura, $this->nomConexion);
			$array = [];
			for($i = 0; $i<count($arrData); $i++){
				$id_metodo_pago = $arrData[$i]['id_metodo_pago'];
				$total = $arrData[$i]['total'];
				if(!isset($array[$id_metodo_pago])){
					$array[$id_metodo_pago] = 0;
				}
				$array[$id_metodo_pago] += $total;
				
			}
			$arrayValue = [];
			foreach ($array as $key => $value) {
				$valores = array('id'=>$key,'metodo'=>$this->model->selectMetodoPago($key, $this->nomConexion)['descripcion'],'total'=>$value);
				array_push($arrayValue,$valores);
			}
			$arrResponse['detalles'] = $arrData;
			$arrResponse['totales'] = $arrayValue;
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
		
		public function getDetallesIngreso($idIngreso){
			$arrData = $this->model->selectDetalleIngreso($idIngreso, $this->nomConexion);
			for($i = 0; $i<count($arrData); $i++){
				$arrData[$i]['codigo'] = ($arrData[$i]['codigo_servicio'] == '')?$arrData[$i]['codigo_servicio_precarga']:$arrData[$i]['codigo_servicio'];
				$arrData[$i]['nombre'] = ($arrData[$i]['nombre_servicio'] == '')?$arrData[$i]['nombre_servicio_precarga']:$arrData[$i]['nombre_servicio'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function setCorteCaja($arr){
			$array = explode(',',$arr);
			$id_caja = $array[0];
			$id_corte_caja = $array[1];
			$datos = json_decode(base64_decode($array[2]));
			$total_entregada = $array[3];
			$id_usuario_recibe = $this->model->selectIdUsuario($array[4], $this->nomConexion);
			$faltante = $array[5];
			$sobrante = $array[6];
			$comentario = $datos->observaciones;

			$codigo_plantel = $this->model->selectPlantelCajero($this->idUser, $this->nomConexion);
			$consecFolio = $this->model->sigFoliocorte($codigo_plantel['codigo_plantel'], $this->nomConexion);
			$nuevoFolio = $consecFolio['num_folios']+1;
            $nuevoFolioConsecutivo = $codigo_plantel['codigo_plantel'].'CC'.date("mY").substr(str_repeat(0,4).$nuevoFolio,-4);
			$resCorteCaja = $this->model->updateCorteCaja($nuevoFolioConsecutivo,$id_corte_caja,$total_entregada,$this->idUser,$id_usuario_recibe['id_usuario_atiende'],$comentario, $this->nomConexion);
			if($resCorteCaja){
				$resStatuscaja = $this->model->updateStatusCaja($id_caja,$total_entregada, $this->nomConexion);
				if($resStatuscaja){
					foreach ($datos->totales as $key => $value) {
						$resDetalleCorteCaja = $this->model->insertDetalleCorteCaja($value->total,$value->total_caja,1,$this->idUser,$value->id_metodo_pago,$id_corte_caja, $this->nomConexion);
						if($resDetalleCorteCaja){
							$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente correctamente');
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar los datos');
						}
					}
				}else{
					$arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar los datos');
				}
			}else{
				$arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar los datos');
			}
			if($faltante != 0 || $sobrante != 0){
				$this->model->insertDineroCaja($id_corte_caja,$faltante,$sobrante,$this->idUser,$comentario, $this->nomConexion);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getCajeros(){
			$arrData = $this->model->selectCajeros($this->nomConexion);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function imprimir_comprobante_faltante($arr){
			$arrayValue = explode(',',$arr);
			$data['plantel'] = $this->model->selectPlantelUsuaurio($this->idUser, $this->nomConexion);
			$totales= json_decode(base64_decode($arrayValue[2]));
			$total_caja = 0;
			$total_sistema = 0;
			$faltante = $arrayValue[5];
			$sobrante = $arrayValue[6];
			foreach ($totales->totales as $key => $value) {
				$total_caja += $value->total_caja;
				$total_sistema += $value->total;
			}
			$data['total_caja'] = $total_caja;
			$data['total_sistema'] = $total_sistema;
			$data['faltante'] = $faltante;
			$data['sobrante'] = $sobrante;
			$this->views->getView($this,'viewpdf_comprobante_faltante_corte_caja',$data);
		}
	}
?>