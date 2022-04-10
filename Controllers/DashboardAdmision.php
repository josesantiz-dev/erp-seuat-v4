<?php
	class DashboardAdmision extends Controllers{
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
		public function DashboardAdmision(){
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard Admision";
			$data['page_title'] = "Página Dashboard";
			$data['page_name'] = "Página Dashboard";
			$data['page_functions_js'] = "functions_dashboard_admision.js";
			$data['planteles'] = $this->model->selectPlanteles();
            $data['campanias'] = $this->model->selectDataCampSubCampanias();
			$this->views->getView($this,"dashboardadmision",$data);
		}
		public function getTotalesCard($plantel){
			$plantelConsultar = $plantel;
			$arrData = $this->model->selectTotalesCard($plantelConsultar);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}/*
		public function getListaRvoesExpirar($plantel){
			$plantelConsultar = $plantel;
			$arrData = $this->model->selectRvoesExpirar($plantelConsultar);
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}*/

		public function getProspectosInscritosbyPlantel($plantel){
			if($plantel == "all"){
				$arrData = $this->model->selectPlantelesInscripcion();
				$array;
				foreach ($arrData as $key => $value) {
					$arrProspectos = $this->model->selectProspectosbyPlantel($value['id']);
					$arrInscritos = $this->model->selectInscritosbyPlantel($value['id']);
					$array[$value['id']] = array('id_plantel'=>$value['id'],'abreviacion_plantel'=>$value['abreviacion_plantel'],'municipio'=>$value['municipio'],'prospectos'=>$arrProspectos['total'],'inscritos'=>$arrInscritos['total']);
				}
			}else{
				$array;
				$arrProspectos = $this->model->selectProspectosbyPlantel($plantel);
				$arrInscritos = $this->model->selectInscritosbyPlantel($plantel);
				$array[$plantel] = array('id_plantel'=>$plantel,'abreviacion_plantel'=>'','municipio'=>'','prospectos'=>$arrProspectos['total'],'inscritos'=>$arrInscritos['total']);
			}
			echo json_encode($array,JSON_UNESCAPED_UNICODE);
            die();
		}
	}
?>