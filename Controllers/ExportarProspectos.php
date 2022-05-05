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
            $data['conexion'] = $this->nomConexion;
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


        public  function  exportarcsv(){
            $arrPersona = json_decode(base64_decode($_GET['data']));
            $plantelExportar = $_GET['plantel'];
            $arrColumn = $this->model->selectColumnTable($this->nomConexion);
            $fields = [];
            $nomenclatura = explode('_',$this->nomConexion);
            $follioTransfer = ''.$nomenclatura[1].date('Ymdgis').'';
            foreach ($arrColumn as $key => $value) {
                array_push($fields,$key);
            }
            array_push($fields,'nom_conexion');
            array_push($fields,'folio_transferencia');
            array_push($fields,'plantel_destino');
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
                array_push($lineData,''.$plantelExportar);
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
            $plantel = $_GET['plantel'];
            $arrPersona = json_decode(base64_decode($data));
            if(count($arrPersona)> 0){
                foreach ($arrPersona as $key => $value) {
                    $response = $this->model->updatePersonaTrans($value->id_persona,$this->nomConexion,$follioTransfer,$plantel);
                    if($response){
                        $arrEstatus = $this->model->updatePersona($value->id_persona,$this->nomConexion,$this->idUser);
                        if($arrEstatus){
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos exportados correctamente, y se actualizaron el estatus de
                            las personas como <b>Transferido</b> al plantel <b>'.conexiones[$plantel]['NAME'].'</b>');
                        }else{
                            $arrResponse = array('estatus' => true, 'msg' => 'No es posible actualizar los datos');
                        }
                    }
                }
                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>