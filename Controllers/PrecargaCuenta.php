<?php
	class PrecargaCuenta extends Controllers{

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
		//Funcion para la Vista de Planteles
		public function precargacuenta()
		{
			$data['page_tag'] = "Precarga cuenta";
			$data['page_title'] = "Precarga cuenta";
			$data['page_name'] = "Precarga cuenta";
			$data['page_content'] = "";
            $data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
			// $data['niveles'] = $this->model->selectNiveles($this->nomConexion);
            $data['periodos'] = $this->model->selectPeriodos($this->nomConexion);
            $data['grados'] = $this->model->selectGrados($this->nomConexion);
			$data['page_functions_js'] = "functions_precarga_cuenta.js";
			$this->views->getView($this,"precargaCuenta",$data);
		}
        public function getPlanEstudios($arrgs){
			$args = explode(",",$arrgs);
			$idPlantel = $args[0];
			$idNivel = $args[1];
            if($idPlantel == 'Todos'){
				if($idNivel == 'null'){
					$arrData = $this->model->selectPlanEstudios($this->nomConexion);
				}else{
					$arrData = $this->model->selectPlanEstudiosByNivel($idNivel,$this->nomConexion);
				}
            }
			else{
                $idPlantel = intval($idPlantel);
				if($idNivel == 'null' || $idNivel == 'Todos'){
					$arrData = $this->model->selectPlanEstudiosByPlantel($idPlantel,$this->nomConexion);
				}
				else{
					$arrData = $this->model->selectPlanEstudiosByPlantelNivel($idPlantel,$idNivel,$this->nomConexion);
				}
            }
            for($i = 0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = "<button type='button' class='btn btn-primary btn-xs center' onclick='fnSeleccionarPlanEstudios(".$arrData[$i]['id_plantel'].",".$arrData[$i]['id'].")'>Seleccionar</button>";
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		
        public function getServicios(int $idPlantel){
            $idPlantel = intval($idPlantel);
            $arrData = $this->model->selectServicios($idPlantel,$this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

		public function getNivelesByPlantel($idPlantel){
			if($idPlantel == 'Todos'){
				$arrData = $this->model->seletNiveles($this->nomConexion);
			}else{
				$idPlantel = intval($idPlantel);
				$arrData = $this->model->selectNivelesByPlantel($idPlantel,$this->nomConexion);
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setPrecarga($args){
			$params = explode(",",$args);
			$idPlantel = intval($params[0]);
			$idNivel = intval($params[1]);
			$idPeriodo = intval($params[2]);
			$idGrado = intval($params[3]);
			$idServicio = intval($params[4]);
            $precioNuevo = $params[5];
            $fechaLimitePago = $params[6];
            $idPlanEstudios = $params[7];
            if(empty($idPlantel) && empty($idNivel) && empty($idPeriodo) && empty($idGrado) && empty($idServicio) && empty($precioNuevo) && empty($fechaLimitePago)){
                $arrResponse = array('estatus' => false, 'msg' => 'Error en los datos.');
            }else{
                $arrData = $this->model->insertPrecargaCuenta($idPlantel,$idPlanEstudios,$idNivel,$idPeriodo,$idGrado,$idServicio,$precioNuevo,$fechaLimitePago,$_SESSION['idUser'],$this->nomConexion);
                if($arrData){
                    $arrResponse = true;
                }else{
                    $arrResponse = false;
                }
            }
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getServiciosByInput($valueInput){
			$input = strClean($valueInput);
			if($input != ""){
				$arrData = $this->model->selectServiciosByInput($input,$this->nomConexion);
				for($i = 0; $i<count($arrData); $i++){
					$arrData[$i]['numeracion'] = $i+1;
					$arrData[$i]['precio'] = '$'.formatoMoneda($arrData[$i]['precio_unitario']);
					$arrData[$i]['options'] = '<button type="button" class="btn btn-primary btn-xs" n="'.$arrData[$i]['nombre_servicio'].'" c="'.$arrData[$i]['codigo_servicio'].'" onclick="fnSeleccionarServicio(this,'.$arrData[$i]['id'].','.$arrData[$i]['precio_unitario'].')">Agregar</button>';
				}
			}else{
				// $arrData = null; estaba antes
				$arrData = true;
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}
	}
?>