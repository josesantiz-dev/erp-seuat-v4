<?php
class HistorialPagosAlumno extends Controllers{
    private $idUser;
    public function __construct(){
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
            die();
        }
        $this->idUser = $_SESSION['idUser'];
    }
    public function historial(){
        $data['page_id'] = 0;
		$data['page_tag'] = "Historial de pagos";
		$data['page_title'] = "Historial de pagos";
		$data['page_name'] = "Historial de pagos";
		$data['page_content'] = "";
		$data['page_functions_js'] = "functions_historial_pagos.js";
		$this->views->getView($this,"historialpahosalumno",$data);
    }
    public function getEstudiantes(){
        $arrData = $this->model->selectEstudiantes();
        for($i = 0; $i <count($arrData); $i++){
            $arrData[$i]['numeracion'] = $i+1;
            $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" onclick="seleccionarPersona('.$arrData[$i]['id'].')">Ver</button>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getDetallesEstudiante($idAlumno){
        $arrData = $this->model->selectDetalleEstudiante($idAlumno);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getUltimosMovimientosAlumno($idAlumno){
        $arrData = $this->model->selectUltimosMovimientos($idAlumno);
        for($i = 0; $i<count($arrData); $i++){
            $arrData[$i]['segundos'] = $this->convertSecToHuman($arrData[$i]['segundos']);
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getTodosMovimientosAlumno($idAlumno){
        $arrData = $this->model->selectTodosMovimientos($idAlumno);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    //Convertir segundos a Dias, Horas, minutos y segundos
    private function convertSecToHuman(int $segundos){
        $secondsInAMinute = 60;
        $secondsInAHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAHour;

        $days = floor($segundos / $secondsInADay);

        $hourSeconds = $segundos % $secondsInADay;
        $hour = floor($hourSeconds / $secondsInAHour);

        $minuteSeconds = $hourSeconds % $secondsInAHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hour,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj['d'].' dias, '.$obj['h'].' horas ,'.$obj['m'].' minutos y '.$obj['s'].' segundos';
        //return $obj;
    }
}
?>
