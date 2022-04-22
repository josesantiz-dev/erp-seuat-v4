<?php
	class DashboardDirc extends Controllers{
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
		public function DashboardDirc(){
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard DIRC";
			$data['page_title'] = "Página Dashboard";
			$data['page_name'] = "Página Dashboard";
			$data['page_functions_js'] = "functions_dashboard_dirc.js";
			//$data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
			$this->views->getView($this,"dashboarddirc",$data);
		}
		public function getTotalesCard($params){
			$arrParams = explode(',',$params);
			$nomConexion = $arrParams[0];
			$idPlatel = $arrParams[1];
			if($nomConexion == 'all' && $idPlatel == 'all'){
				$totalPlanteles = 0;
				$totalPlanEstudios = 0;
				$totalMaterias = 0;
				$totalRVOES = 0;
				foreach (conexiones as $key => $conexion) {
					$planteles = $this->model->selectTotalPlanteles($key);
					$totalPlanteles += $planteles['total'];
					$planEstudios = $this->model->selectTotalesPlanEstudios($key);
					$totalPlanEstudios += $planEstudios['total'];
					$materias = $this->model->selectTotalesMaterias($key);
					$totalMaterias += $materias['total'];
					$rvoes = $this->model->selectTotalesRVOES($key);
					$totalRVOES += $rvoes['total'];
				}
				$arrData['planteles'] = $totalPlanteles;
                $arrData['plan_estudios'] = $totalPlanEstudios;
                $arrData['materias'] = $totalMaterias;
                $arrData['rvoes'] = $totalRVOES;
                $arrData['tipo'] = "all";
			}else if($nomConexion != 'all' && $idPlatel =='all'){
				$totalPlanteles = $this->model->selectTotalPlanteles($nomConexion);
				$totalPlanEstudios = $this->model->selectTotalesPlanEstudios($nomConexion);
				$totalMaterias = $this->model->selectTotalesMaterias($nomConexion);
				$totalRVOES = $this->model->selectTotalesRVOES($nomConexion);
				$arrData['planteles'] = $totalPlanteles['total'];
                $arrData['plan_estudios'] = $totalPlanEstudios['total'];
                $arrData['materias'] = $totalMaterias['total'];
                $arrData['rvoes'] = $totalRVOES['total'];
                $arrData['tipo'] = "all"; 
			}else if($nomConexion != 'all' && $idPlatel != 'all'){
				$totalPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($nomConexion,$idPlatel);
				$totalMaterias = $this->model->selectMateriasbyPlantel($nomConexion,$idPlatel);
				$totalRVOES = $this->model->selectRVOEproximoExpbyPlantel($nomConexion,$idPlatel);
				$arrData['planteles'] = 1;
                $arrData['plan_estudios'] = $totalPlanEstudios['total'];
                $arrData['materias'] = $totalMaterias['total'];
                $arrData['rvoes'] = count($totalRVOES);
                $arrData['tipo'] = "all";
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}
		public function getListaRvoesExpirar($params){
			$arrParams = explode(',',$params);
			$nomConexion = $arrParams[0];
			$idPlantel = $arrParams[1];
			if($nomConexion == 'all' && $idPlantel == 'all'){
				$arrRes = [];
				foreach (conexiones as $keyCon => $conexion) {
					$arrPlantel = $this->model->selectDatosPlantel($keyCon);
					foreach ($arrPlantel as $keyP => $plantel) {
						$arrData = $this->model->selectRvoesExpirar($keyCon,$plantel['id']);
						for($i = 0; $i<count($arrData); $i++){
							$arrData[$i]['nom_conexion'] = $keyCon;
							$arrData[$i]['plantel_bd'] = $conexion['NAME'];
						}
						array_push($arrRes,$arrData);
					}
				}
				$newArray = array_merge([], ...$arrRes);
			}else if($nomConexion != 'all' && $idPlantel == 'all'){
				$arrPlantel = $this->model->selectDatosPlantel($nomConexion);
				$arrRes = [];
				foreach ($arrPlantel as $keyP => $plantel) {
					$arrData = $this->model->selectRvoesExpirar($nomConexion,$plantel['id']);
					for($i = 0; $i<count($arrData); $i++){
						$arrData[$i]['nom_conexion'] = $nomConexion;
						$arrData[$i]['plantel_bd'] = conexiones[$nomConexion]['NAME'];
					}
					array_push($arrRes,$arrData);
				}
				$newArray = array_merge([], ...$arrRes);

			}else if($nomConexion != 'all' && $idPlantel != 'all'){
				$newArray = $this->model->selectRvoesExpirar($nomConexion,$idPlantel);
				for($i = 0; $i<count($newArray); $i++){
					$newArray[$i]['nom_conexion'] = $nomConexion;
					$newArray[$i]['plantel_bd'] = conexiones[$nomConexion]['NAME'];
				}
			}
			echo json_encode($newArray ,JSON_UNESCAPED_UNICODE);
            die();
		}
		public function getPlanEstudiosMateriabyPlantel($params){
			$arrParams = explode(',',$params);
			$nomConexion = $arrParams[0];
			$idPlantel = $arrParams[1];
			if($nomConexion == 'all' && $idPlantel == 'all'){
				$array = [];
				foreach (conexiones as $key => $conexion) {
					$arrPlantel = $this->model->selectDatosPlantel($key);
					foreach ($arrPlantel as $keyp => $plantel) {
						$arrPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($key,$plantel['id']);
						$arrMaterias = $this->model->selectMateriasbyPlantel($key,$plantel['id']);
						$rvoes = $this->model->selectRVOEproximoExpbyPlantel($key,$plantel['id']);
						$array[$key.'/'.$plantel['id']] = array('id_plantel' => $key.'/'.$plantel['id'],'abreviacion_plantel'=>$plantel['abreviacion_plantel'],'municipio'=>$plantel['municipio'],'carreras'=>$arrPlanEstudios['total'],'materias'=>$arrMaterias['total'],'rvoes'=>count($rvoes));
					}
				}
			}else if($nomConexion != 'all' && $idPlantel == 'all'){
				$array = [];
				$arrPlantel = $this->model->selectDatosPlantel($nomConexion);
				foreach ($arrPlantel as $key => $plantel) {
					$arrPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($nomConexion,$plantel['id']);
					$arrMaterias = $this->model->selectMateriasbyPlantel($nomConexion,$plantel['id']);
					$rvoes = $this->model->selectRVOEproximoExpbyPlantel($nomConexion,$plantel['id']);
					$array[$nomConexion.'/'.$plantel['id']] = array('id_plantel' => $nomConexion.'/'.$plantel['id'],'abreviacion_plantel'=>$plantel['abreviacion_plantel'],'municipio'=>$plantel['municipio'],'carreras'=>$arrPlanEstudios['total'],'materias'=>$arrMaterias['total'],'rvoes'=>count($rvoes));
				}
			}else if($nomConexion != 'all' && $idPlantel != 'all'){
				$array = [];
				$arrPlantel = $this->model->selectPlantel($nomConexion, $idPlantel);
				$arrPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($nomConexion,$arrPlantel['id']);
				$arrMaterias = $this->model->selectMateriasbyPlantel($nomConexion,$arrPlantel['id']);
				$rvoes = $this->model->selectRVOEproximoExpbyPlantel($nomConexion,$arrPlantel['id']);
				$array[$nomConexion.'/'.$arrPlantel['id']] = array('id_plantel' => $nomConexion.'/'.$arrPlantel['id'],'abreviacion_plantel'=>$arrPlantel['abreviacion_plantel'],'municipio'=>$arrPlantel['municipio'],'carreras'=>$arrPlanEstudios['total'],'materias'=>$arrMaterias['total'],'rvoes'=>count($rvoes));

			}
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
            die();
		}

		public function getPlanteles(string $nomConexion){
			$arrData = $this->model->selectDatosPlantel($nomConexion);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}
	}
?>