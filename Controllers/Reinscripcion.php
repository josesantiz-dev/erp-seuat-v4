<?php
	class Reinscripcion extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
				die();
			}
		}
		public function reinscripcion(){
			$data['page_tag'] = "Reinscripcion";
			$data['page_title'] = "Reinscripcion";
			$data['page_name'] = "Reinscripcion";
			$data['page_functions_js'] = "functions_reinscripcion.js";
            $data['ciclos'] = $this->model->selectCiclos();
            $data['periodos'] = $this->model->selectPeriodo();
            $data['grados'] = $this->model->selectGrado();
            $data['grupos'] = $this->model->selectGrupo();
			$this->views->getView($this,"reinscripcion",$data);
		}

        //Buscar Persona del en el Modal Inscripcion
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                $arrData[$i]['apellidos'] = $arrData[$i]['ap_paterno'].' '.$arrData[$i]['ap_materno'];
                $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-secondary btn-sm" rl="'.$arrData[$i]['nombre_persona'].' '.$arrData[$i]['apellidos'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }

        public function getDatosAlumno(int $id){
            $arrData = $this->model->selectDatosAlumno($id);
            if($arrData['estatus'] == 1){
                $arrData['estatus'] = '<span class="badge badge-pill badge-success">Activo</span>';
            }else{
                $arrData['estatus'] = '<span class="badge badge-pill badge-warning">Innactivo</span>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
	}
?>