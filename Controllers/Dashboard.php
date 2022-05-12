<?php
	class Dashboard extends Controllers{
		public function __construct()
		{
            session_start();

			parent::__construct();
		}

		public function Dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard DIRC";
			$data['page_title'] = "Página Dashboard";
			$data['page_name'] = "Página Dashboard";
			$data['page_functions_js'] = 'functions_bienvenido.js';
			//$data['frase'] = ($_SESSION['frase'] == true)?$this->obtenerFrase():null;
			$this->views->getView($this,"dashboard",$data);
		}

		public function obtenerFrase(){
			$estatus = false;
			if($_SESSION['frase'] == true){
				$_SESSION['frase'] = false;
				$estatus = true;
			}else{
				$_SESSION['frase'] = null;
				$estatus = false;
			}
			echo json_encode($estatus,JSON_UNESCAPED_UNICODE);
			die();
		}

	}
?>