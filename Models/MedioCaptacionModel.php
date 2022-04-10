<?php

  class MedioCaptacionModel extends Mysql{

    public $strMedioCaptacion;
    public $strFechaCreacion;
    public $intIdMediioCaptacion;
    public $intIdUsuario;
    public $intEstatus;

    function __construct(){
      parent::__construct();
    }

    public function selectMediosCaptacion(){

      $sql = "SELECT * FROM t_medio_captacion WHERE estatus !=0";
      $request = $this->select_all($sql);
      return $request;

    }

    public function insertMedioCaptacion(string $nombreMedioCaptacion, string $fechaCreacion){

      $return = "";
      $this->strMedioCaptacion = $nombreMedioCaptacion;
      $this->strFechaCreacion = $fechaCreacion;
      $this->intIdUsuario = $_SESSION['idUser'];
      $this->intEstatus = 1;

      $sql = "SELECT * FROM t_medio_captacion WHERE medio_captacion = '{$this->strMedioCaptacion}' ";
      $request = $this->select_all($sql);

      if(empty($request)){

        $query_insert = "INSERT INTO t_medio_captacion(medio_captacion, estatus, fecha_creacion, id_usuario_creacion) VALUES(?,?,?,?)";

        $arrData = array($this->strMedioCaptacion, $this->intEstatus, $this->strFechaCreacion, $this->intIdUsuario);

        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;

      }else{

        $return = "exit";

      }

      return $return;

    }

  }


?>
