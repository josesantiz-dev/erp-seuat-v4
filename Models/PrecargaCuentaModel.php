<?php

class PrecargaCuentaModel extends Mysql
{
   
    public $intIdPers;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectPlanteles(){
        $sql = "SELECT *FROM t_planteles WHERE estatus = 1";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudios(){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudiosByNivel(int $idNivel){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id,pe.id_nivel_educativo,ne.nombre_nivel_educativo  AS id_plantel FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_nivel_educativo = $idNivel";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudiosByPlantel(int $idPlantel){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_plantel = $idPlantel";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudiosByPlantelNivel(int $idPlantel, int $idNivel){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_plantel = $idPlantel AND pe.id_nivel_educativo = $idNivel";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectServicios(int $idPlantel){
        $sql = "SELECT s.id,s.nombre_servicio,s.codigo_servicio,s.precio_unitario,cs.nombre_categoria FROM t_servicios AS s
        INNER JOIN t_categoria_servicios AS cs ON s.id_categoria_servicio = cs.id WHERE s.aplica_edo_cuenta = 1 AND s.id_plantel = $idPlantel";
        $request = $this->select_all($sql);
        return $request;
    }
    public function seletNiveles(){
        $sql = "SELECT *FROM t_nivel_educativos";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectNivelesByPlantel(int $idPlantel){
        $sql = "SELECT ne.id,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS p ON pe.id_plantel = p.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE pe.id_plantel = $idPlantel AND pe.estatus = 1
        GROUP BY pe.id_nivel_educativo";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPeriodos(){
        $sql = "SELECT *FROM t_periodos";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectGrados(){
        $sql = "SELECT *FROM t_grados";
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertPrecargaCuenta(int $idPlantel,int $idPlanEstudios,int $idNivel,int $idGrado,int $idPeriodo,int $idServicio,$precioNuevo,$fechaLimitePago,$idUser){
        $sql = "INSERT INTO t_precarga(cobro_total,fecha_limite_cobro,estatus,id_usuario_creacion,fecha_creacion,id_servicio,id_plan_estudios,id_periodo,id_grado) VALUES(?,?,?,?,NOW(),?,?,?,?)";
        $request = $this->insert($sql,array($precioNuevo,$fechaLimitePago,1,$idUser,$idServicio,$idPlanEstudios,$idPeriodo,$idGrado));
        return $request;
    }
    public function selectServiciosByInput($value){
        $sql = "SELECT *FROM t_servicios WHERE nombre_servicio LIKE '%$value%'";
        $request = $this->select_all($sql);
        return $request;
    }

}
