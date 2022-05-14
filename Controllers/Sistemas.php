<?php
    class Sistemas extends Controllers{
        private $idUSer;
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
            $this->idUSer = $_SESSION['idUser'];
            $this->nomConexion = $_SESSION['nomConexion'];
            $this->rol = $_SESSION['claveRol'];
        }
        public function sistemas()
        {   $data['page_tag'] = "Sistemas";
			$data['page_title'] = "Sistemas";
			$data['page_name'] = "sistemas";
			$data['page_functions_js'] = "functions_sistemas.js";
            $this->views->getView($this,'sistema',$data);
        }
    }


?>