<?php
	class DashboardDirc extends Controllers{
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
		public function DashboardDirc(){
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard DIRC";
			$data['page_title'] = "Página Dashboard";
			$data['page_name'] = "Página Dashboard";
			$data['page_functions_js'] = "functions_dashboard_dirc.js";
			$data['planteles'] = $this->model->selectPlanteles();
			$this->views->getView($this,"dashboarddirc",$data);
		}
		public function getTotalesCard($plantel){
			$plantelConsultar = $plantel;
			$arrData = $this->model->selectTotalesCard($plantelConsultar);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}
		public function getListaRvoesExpirar($plantel){
			$plantelConsultar = $plantel;
			$arrData = $this->model->selectRvoesExpirar($plantelConsultar);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}
		public function getPlanEstudiosMateriabyPlantel($plantel){
			if($plantel == "all"){
				$arrData = $this->model->selectPlanteles();
				$array;
				foreach ($arrData as $key => $value) {
					$arrPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($value['id']);
					$arrMaterias = $this->model->selectMateriasbyPlantel($value['id']);
					$rvoes = $this->model->selectRVOEproximoExpbyPlantel($value['id']);
					$array[$value['id']] = array('id_plantel'=>$value['id'],'abreviacion_plantel'=>$value['abreviacion_plantel'],'municipio'=>$value['municipio'],'carreras' => $arrPlanEstudios['total'],'materias'=>$arrMaterias['total'],'rvoes'=>$rvoes);
				}
			}else{
				$array;
				$arrPlanEstudios = $this->model->selectPlanEstudiosbyPlantel($plantel);
				$arrMaterias = $this->model->selectMateriasbyPlantel($plantel);
				$rvoes = $this->model->selectRVOEproximoExpbyPlantel($plantel);
				$array[$plantel] = array('id_plantel'=>$plantel,'abreviacion_plantel'=>null,'carreras' => $arrPlanEstudios['total'],'materias'=>$arrMaterias['total'],'rvoes'=>$rvoes);
			}
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
            die();
		}
	}
?>