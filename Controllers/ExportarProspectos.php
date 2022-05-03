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


        public  function  exportarcsv($data){
            $arrPersona = json_decode(base64_decode($data));
            $arrColumn = $this->model->selectColumnTable($this->nomConexion);
            $fields = [];
            $follioTransfer = ''.$this->nomConexion.date('Ymdgis').'';
            foreach ($arrColumn as $key => $value) {
                array_push($fields,$value['Field']);
            }
            array_push($fields,'nom_conexion');
            array_push($fields,'folio_transferencia');
            $arrDatos = [];
            for ($i=0; $i < count($arrPersona); $i++) { 
                $idPersona = $arrPersona[$i]->id_persona;
                $estatus = $arrPersona[$i]->estatus;
                if($estatus == 1){
                    $arrData = $this->model->selectPersona($idPersona,$this->nomConexion);
                }
                $lineData = [];
                foreach ($arrData as $key => $value) {
                    array_push($lineData,$value);
                }
                array_push($lineData,$this->nomConexion);
                array_push($lineData,''.$follioTransfer);
                array_push($arrDatos,$lineData);
            }
            $newArray = [];
            array_push($newArray,$fields);
            foreach ($arrDatos as $key => $value) {
                array_push($newArray,$value);
            }
            $datos['data'] = $newArray;
            $datos['folio'] = $follioTransfer;
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        } 
        
        public function setTransferencia(){
            $data = $_GET['datos'];
            $follioTransfer = $_GET['folio'];
            $arrPersona = json_decode(base64_decode($data));
            if(count($arrPersona)> 0){
                foreach ($arrPersona as $key => $value) {
                    $response = $this->model->updatePersonaTrans($value->id_persona,$this->nomConexion,$follioTransfer);
                }
            }
            echo json_encode($arrPersona, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>