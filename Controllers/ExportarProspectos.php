<?php
    //include  'Controllers/Persona.php';
    class ExportarProspectos extends Controllers{
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
        public function exportarprospectos(){
            $data['page_id'] = '';
            $data['page_tag'] = "Exportar prospectos";
            $data['page_title'] = "Exportar prospectos";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_exportar_prospectos.js";
            $this->views->getView($this,"exportarprospectos",$data);
        }

        public function getProspectos(){
            //$persona = new Persona();
            //$datos = $persona->getPersonas();
            $arrData = $this->model->selectPersonas($this->nomConexion);
            for ($i=0; $i < count($arrData); $i++) { 
                $numeracion = $i +1;
                $arrData[$i]['check'] = '<div class="form-check"><input class="form-check-input" type="checkbox" value="" id="defaultCheck1" onchange="fnSeleccionarProspectoExportar(this,'.$arrData[$i]['id'].')"></div>';
                $arrData[$i]['numeracion'] = $numeracion;
                $arrData[$i]['apellidos'] = $arrData[$i]['ap_paterno'].' '.$arrData[$i]['ap_materno'];
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function exportarcsv(){
            error_reporting(0);
            $delimiter = ',';
            $filename = 'prospectos.csv';
            $f = fopen('php://memory','w');
            $fields = array('nombre','apellidos');
            fputcsv($f,$fields,$delimiter);
            for ($i=0; $i < 10; $i++) { 
                $lineData = array('jose','santiz');
                fputcsv($f,$lineData,$delimiter);
            }
            fseek($f, 0);
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            fpassthru($f);
        }
    }
?>