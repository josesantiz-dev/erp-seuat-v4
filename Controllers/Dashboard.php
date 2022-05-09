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
			$data['frase'] = ($_SESSION['frase'] == true)?$this->obtenerFrase():null;
			$this->views->getView($this,"dashboard",$data);
		}

		private function obtenerFrase(){
			$URL_API =  "https://frasedeldia.azurewebsites.net/api/phrase";
			$data = json_decode(file_get_contents($URL_API), true);
			return $data;
		}

	}
?>