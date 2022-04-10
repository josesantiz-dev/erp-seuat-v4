<?php

class DashboardSeguimientoModel extends Mysql{

    public function __construct()
    {
        parent::__construct();
    }

    public function selectPlanteles()
    {
        $sql = "SELECT id, abreviacion_plantel, nombre_plantel, municipio FROM t_planteles WHERE estatus=1";
        $requestPlantel = $this->select_all($sql);
        return $requestPlantel;
    }

    public function selectCards($plt)
    {
        if($plt == "all")
        {
            $sql1 = "SELECT COUNT(*) as total_planteles FROM t_planteles";
            $requestPlanteles = $this->select($sql1);
            $request['planteles'] = $requestPlanteles['total_planteles'];
            $sql2 = "SELECT COUNT(*) as no_atendidos FROM t_agenda WHERE estatus=1";
            $requestNoAten = $this->select($sql2);
            $request['no_atendidos'] = $requestNoAten['no_atendidos'];
            $sql3 = "SELECT COUNT(*) as total FROM (SELECT id_prospecto FROM t_seguimiento_prospecto GROUP BY id_prospecto) as total";
            $requestTotalProspectos = $this->select($sql3);
            $request['totalProspectosSeguimiento'] = $requestTotalProspectos['total'];
            $sql4 = "SELECT COUNT(*) as total_prospect FROM t_personas WHERE id_categoria_persona = 1";
            $requestProspectos = $this->select($sql4);
            $request['totalProspec'] = $requestProspectos['total_prospect'];
            $request['tipo'] = "all";
            return $request;
        }else{
            $sqlPlantel = "SELECT id, nombre_plantel FROM t_planteles WHERE id = $plt";
            $requestPlantel = $this->select($sqlPlantel);
            $request['nomPlantel'] = $requestPlantel['nombre_plantel'];
            //$sqlProspecto = "SELECT COUNT(*) as total_prospecto_seguimiento FROM (SELECT id_persona, pe.nombre_persona, pe.id_plantel_interes FROM t_seguimiento_prospecto as seg INNER JOIN t_personas as pe ON seg.id_persona = pe.id WHERE pe.id_plantel_interes = 1 GROUP BY id_persona) as total";
            //$requestProspectos = $this->select($sqlProspecto);
            //$request['prospecto'] = $requestProspectos['total_prospecto_seguimiento'];
            //$sqlProspectoTotalPorPlantel = "SELECT count(id) AS total_prospecto FROM t_personas WHERE id_plantel_interes = $plt";
            //$requestProspectoTotal = $this->select($sqlProspectoTotalPorPlantel);
            //$request['prospecto_plantel'] = $requestProspectoTotal['total_prospecto'];
            $request['tipo']="";
            return $request;
            // $sql = "SELECT COUNT(*)	as total_prospectos FROM t_personas WHERE id_categoria_persona = 1 AND id_plantel_interes = $plt";
            // $requestProspectos = $this->select($sql);
            // $request['prospectos'] = $requestProspectos['total_prospectos'];
            // $request['nombre_plt'] = $requestPlantel['nombre_plantel'];
            // $sqlSeguimiento = "SELECT seg.id, seg.id_persona, CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno,' ') as nombre_persona
            // , per.id_plantel_interes FROM t_seguimiento_prospecto as seg INNER JOIN t_personas as per ON seg.id_persona = per.id WHERE per.id_plantel_interes = 1 GROUP BY seg.id_persona";
            // $requestProspectos = $this->select_all($sqlSeguimiento);
            // return $request;
        }
    }

    
}