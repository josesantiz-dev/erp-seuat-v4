<?php
  class SeguimientoCajas extends Controllers{

    public function __construct(){
      parent::__construct();
      session_start();
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
        die();
      }
    }
    public function seguimientocajas(){
        $data['page_tag'] = "Seguimiento cajas";
        $data['page_title'] = "Seguimiento cajas";
        $data['page_name'] = "seguimiento cajas";
        $data['page_functions_js'] = "functions_seguimiento_cajas.js";
        $data['cajeros'] = $this->model->selectCajeros(null);
        $this->views->getView($this,"seguimientocajas",$data);
    }
    public function selectCajeros($idPlantel){
        $arrData = $this->model->selectCajeros($idPlantel);
        for($i = 0; $i<count($arrData); $i++){
            if($arrData[$i]['estatus_caja'] == 1){
                $fechaApertura = $this->model->selectCaja($arrData[$i]['id_caja'])['fechayhora_apertura_caja'];
                $totalVenta = $this->model->selectVentaTotal($arrData[$i]['id_caja'],$fechaApertura);
                $total = 0;
                foreach ($totalVenta as $key => $value) {
                    $total += $value['total'];
                }
                $arrData[$i]['total_venta'] = $total;
            }else{
                $arrData[$i]['total_venta'] = 0;
            }
        }
        return $arrData;
    }
    public function selectVentasAll(){
        $arrData = $this->model->selectVentasTotalAll();
        $dias = [];
        $planteles = [];
        $arrGrafica = [];
        foreach ($arrData as $key => $value) {
            if(!in_array($value['fecha'],$dias)){
                array_push($dias,$value['fecha']);
            }
        }
        foreach ($arrData as $key => $value) {
            if($planteles[$value['id_plantel']] == ''){
                $planteles[$value['id_plantel']] = null;
            }
            $planteles[$value['id_plantel']] = $value['abreviacion_sistema'].'/'.$value['abreviacion_plantel'].'/'.$value['municipio'];
        }
        $arrColores = ['','#f44336','#e91e63','#9c27b0','#673ab7','#3f51b5','#2196f3','#03a9f4','#00bcd4','#009688','#4caf50','#ff5722','#ff5722','#f50057'];
        foreach ($planteles as $keyPlantel => $valuePlantel) {
            $id_plantel = $keyPlantel;
            $nombre_plantel = $valuePlantel;
            $data = [];
            foreach ($dias as $keyDias => $valueDias) {
                $dia = $valueDias;
                $valor = 0;
                foreach ($arrData as $key => $value) {
                    if($value['id_plantel'] == $id_plantel && $value['fecha'] == $dia){
                        //array_push($data,$value['total']);
                        $valor = intval($value['total']);
                    }
                }
                array_push($data,$valor);
            }
            $value1 = array('label'=>$valuePlantel,'data'=>$data,'borderColor'=>$arrColores[$keyPlantel],'fill'=>false);
            array_push($arrGrafica,$value1);
            $data = array();
        }
        $array['dias'] = $dias;
        $array['datos'] = $arrGrafica;
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
		die();
    }
  }
?>
