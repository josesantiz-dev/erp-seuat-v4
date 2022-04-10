<?php

class DashboardSeguimiento extends Controllers{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
    }

    public function DashboardSeguimiento(){
        $data['page_tag'] = "Dashboard de seguimiento";
        $data['page_title'] = "Página dashboard de seguimiento";
        $data['page_name'] = "Página dashboard";
        $data['page_functions_js'] = "functionsDashboardSeguimiento.js";
        $data['planteles'] = $this->model->selectPlanteles();
        $this->views->getView($this,"dashboardseguimiento",$data);
    }

    public function getTotales($opc){
        $plantel = $opc;
        $arrData = $this->model->selectCards($plantel);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
}