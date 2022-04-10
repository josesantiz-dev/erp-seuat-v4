<?php

  class CampaniaModel extends Mysql{

    public $intIdCampanias;
    public $strNombreCampanias;
    public $strFechaInicio;
    public $strFechaFin;
    public $intEstatus;
    public $strFechaCreacion;
    public $strFechaActualizacion;
    public $intIdUsuarioCreacion;
    public $intIdUsuarioModificacion;
    public $intPresupuesto;

    public function __construct(){
  		parent::__construct();
  	}

    public function selectCampanias(){
      //Extraer las campañas
      $sql = "SELECT * FROM t_campanias WHERE estatus !=0";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectCampania(int $intIdCampanias){
      //Buscar campañas
      $this->intIdCampanias = $intIdCampanias;
      $sql = "SELECT * FROM t_campanias WHERE id = $this->intIdCampanias";
      $request = $this->select($sql);
      return $request;
    }

    public function insertCampania(string $nombreCampanias, string $fechaInicio, string $fechaFin, int $estatus, string $fechaCreacion, string $fechaActualizacion, int $idUsuarioCreacion, int $idUsuarioActualizacion, int $presupuesto){

      $return = "";
      $this->strNombreCampanias = $nombreCampanias;
      $this->strFechaInicio = $fechaInicio;
      $this->strFechaFin = $fechaFin;
      $this->intEstatus = $estatus;
      $this->strFechaCreacion = $fechaCreacion;
      $this->strFechaActualizacion = $fechaActualizacion;
      $this->intIdUsuarioCreacion = $idUsuarioCreacion;
      $this->intIdUsuarioModificacion = $idUsuarioActualizacion;
      $this->intPresupuesto = $presupuesto;

      $sql = "SELECT * FROM t_campanias WHERE nombre_campania = '{$this->strNombreCampanias}' ";
      $request = $this->select_all($sql);

      if(empty($request)){
        $query_insert = "INSERT INTO t_campanias(nombre_campania, fecha_inicio, fecha_fin, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, presupuesto) VALUES(?,?,?,?,?,?,?,?,?)";
        $arrData = array($this->strNombreCampanias, $this->strFechaInicio, $this->strFechaFin, $this->intEstatus, $this->strFechaCreacion, $this->strFechaActualizacion, $this->intIdUsuarioCreacion, $this->intIdUsuarioModificacion, $this->intPresupuesto);
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exit";
      }
      return $return;
    }

    public function updateCampanias(int $id, string $nombreCampanias, int $estatus, int $idUsuarioActualizacion, string $fechainicioActualizacion, string $fechafinActualizacion, int $presupuesto){

      $this->intIdCampanias = $id;
      $this->strNombreCampanias = $nombreCampanias;
      $this->intEstatus = $estatus;
      $this->intIdUsuarioModificacion = $idUsuarioActualizacion;
      $this->strFechaInicio = $fechainicioActualizacion;
      $this->strFechaFin = $fechafinActualizacion;
      $this->intPresupuesto = $presupuesto;

      $sql = "SELECT * FROM t_campanias WHERE nombre_campania = '$this->strNombreCampanias' AND id != '$this->intIdCampanias'";
      $request = $this->select_all($sql);

      if(empty($request)){
        $sql = "UPDATE t_campanias SET nombre_campania = ?, estatus = ?, fecha_actualizacion = now(), id_usuario_actualizacion = ?, fecha_inicio = ?, fecha_fin = ?, presupuesto = ? WHERE id = $this->intIdCampanias";
        $arrData = array($this->strNombreCampanias, $this->intEstatus, $this->intIdUsuarioModificacion, $this->strFechaInicio, $this->strFechaFin, $this->intPresupuesto);
        $request = $this->update($sql,$arrData);
      }else{
        $request = "exist";
      }
      return $request;
    }

    public function deleteCampanias(int $idCampanias) {
      $this->intIdCampanias = $idCampanias;
      $sql = "SELECT * FROM t_subcampania WHERE id_campania = $this->intIdCampanias";
      $request = $this->select_all($sql);
      if(empty($request)){
        $sql = "UPDATE t_campanias SET estatus = ? WHERE id = $this->intIdCampanias";
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

    public function selectFecha(int $id){

      $this->intIdCampanias = $id;
      $sql = "SELECT fecha_inicio, fecha_fin FROM t_campanias WHERE id = $this->intIdCampanias";
      $request = $this->select($sql);
      return $request;

    }

    public function selectSubcampania(int $id){

      $this->intIdCampanias = $id;
      $sql = "SELECT * FROM t_subcampania WHERE id_campania = $this->intIdCampanias AND estatus = 1";
      $request = $this->select_all($sql);
      return $request;

    }
}

?>
