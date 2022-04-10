<?php

  class SubcampaniaModel extends Mysql{

    public $intIdSubcampania;
    public $strNombreSubcampania;
    public $strFechaInicio;
    public $strFechaFin;
    public $intIdCampania;
    public $strNombreCampania;
    public $intEstatus;
    public $strFechaCreacion;
    public $strFechaActualizacion;
    public $intIdUsuarioCreacion;
    public $intIdUsuarioActualizacion;
    public $intPresupuesto;

    public function __construct() {
      parent::__construct();
    }

    public function selectSubcampania(){
      $sql = "SELECT t_subcampania.*, t_campanias.nombre_campania FROM t_subcampania INNER JOIN t_campanias WHERE t_subcampania.id_campania = t_campanias.id AND t_subcampania.estatus !=0";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectSubcampanias(int $intIdSubcampania){
      $this->intIdSubcampania = $intIdSubcampania;
      $sql = "SELECT * FROM t_subcampania WHERE id = $this->intIdSubcampania";
      $request = $this->select($sql);
      return $request;
    }

    //Metodo para buscar y seleccionar la fecha limite para la subCampaña
    public function selectFechaFin(int $id){
      $return = "";
      $this->intIdCampania = $id;
      $sql = "SELECT fecha_fin FROM t_campanias WHERE id = {$this->intIdCampania}";
      $request = $this->select($sql);
      if(empty($request)){
        $return = "exit";
      }else{
        $return = $request;
      }
      return $request;
    }

    public function selectFechas(int $id){

      $this->intIdCampania = $id;
      $sql = "SELECT fecha_inicio, fecha_fin FROM t_campanias WHERE id = {$this->intIdCampania}";
      $request = $this->select($sql);
      return $request;

    }

    //Metodo para seleccionar las campañas
    public function selectLastCampania(){
      $sql = "SELECT t_campanias.id, t_campanias.nombre_campania FROM t_campanias WHERE estatus = 1 ORDER BY id DESC";
      $request = $this->select_all($sql);
      return $request;
    }

    public function insertSubcampania(string $nombreSubcampania, string $fechaInico, string $fechaFin, int $idCampania, int $estatus, string $fechaCreacion, string $fechaActualizacion, int $idUsuarioCreacion, int $idUsuarioActualizacion, int $presupuesto){

      $return = "";
      $this->strNombreSubcampania = $nombreSubcampania;
      $this->strFechaInicio = $fechaInico;
      $this->strFechaFin = $fechaFin;
      $this->intIdCampania = $idCampania;
      $this->intEstatus = $estatus;
      $this->strFechaCreacion = $fechaCreacion;
      $this->strFechaActualizacion = $fechaActualizacion;
      $this->intIdUsuarioCreacion = $idUsuarioCreacion;
      $this->intIdUsuarioActualizacion = $idUsuarioActualizacion;
      $this->intPresupuesto = $presupuesto;

      $sql = "SELECT * FROM t_subcampania WHERE nombre_sub_campania = '{$this->strNombreSubcampania}'";
      $request = $this->select_all($sql);

      if(empty($request)){
        $query_insert = "INSERT INTO t_subcampania(nombre_sub_campania, fecha_inicio, fecha_fin, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, id_campania, presupuesto) VALUES(?,?,?,?,?,?,?,?,?,?);";
        $arrData = array($this->strNombreSubcampania, $this->strFechaInicio, $this->strFechaFin, $this->intEstatus, $this->strFechaCreacion, $this->strFechaActualizacion, $this->intIdUsuarioCreacion, $this->intIdUsuarioActualizacion, $this->intIdCampania, $this->intPresupuesto);
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exit";
      }
      return $return;
    }

    public function updateSubcampania(int $id, string $nombreSubcampania, int $estatus, string $fechaActualizacion, int $idUsuarioActualizacion, string $fechaInico, string $fechaFin,  int $presupuesto){
      $this->intIdSubcampania = $id;
      $this->strNombreSubcampania = $nombreSubcampania;
      $this->intEstatus = $estatus;
      $this->intIdUsuarioActualizacion = $idUsuarioActualizacion;
      $this->strFechaInicio = $fechaInico;
      $this->strFechaFin = $fechaFin;
      $this->intPresupuesto = $presupuesto;

      $sql = "SELECT * FROM t_subcampania WHERE nombre_sub_campania = '$this->strNombreSubcampania' AND id != '$this->intIdSubcampania'";
      $request = $this->select_all($sql);

      if(empty($request)){
        $sql = "UPDATE t_subcampania SET nombre_sub_campania = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ?, fecha_inicio = ?, fecha_actualizacion = ?, presupuesto = ? WHERE id = $this->intIdSubcampania";
        $arrData = array($this->strNombreSubcampania, $this->intEstatus, $this->intIdUsuarioActualizacion, $this->strFechaInicio, $this->strFechaFin, $this->intPresupuesto);
        $request = $this->update($sql,$arrData);
      }else{
        $request = "exist";
      }
      return $request;
    }

    public function deleteSubcampania(int $idSubcampania){
      $this->intIdSubcampania = $idSubcampania;
      $sql = "SELECT * FROM t_promociones WHERE id_subcampania = $this->intIdSubcampania";
      $request = $this->select_all($sql);
      if(empty($request)){
        $sql = "UPDATE t_subcampania SET estatus = ? WHERE id = $this->intIdSubcampania";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        if($request){
          $request = 'ok';
        }else{
          $request = 'error';
        }
      }else{
        $request = 'exist';
      }
      return $request;
    }

    public function selectPresupuesto(int $id){

      $return = "";
      $this->intIdCampania = $id;
      $sql = "SELECT presupuesto FROM t_campanias WHERE id = {$this->intIdCampania}";
      $request = $this->select($sql);
      return $request;

    }

    public function selectPresupuestosSubCampania(int $id){

      $return = "";
      $this->intIdCampania = $id;
      $sql = "SELECT presupuesto FROM t_subcampania WHERE id_campania = {$this->intIdCampania}";
      $request = $this->select_all($sql);
      return $request;

    }

  }

?>
