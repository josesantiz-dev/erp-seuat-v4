<?php
    class GeneracionModel extends Mysql{

        public $intIdGeneraciones;
        public $strNombre_Generacion;
        public $strFecha_inicio;
        public $strFecha_fin;
        public $intEstatus;
        public $intId_usuario_creacion;
        public $intId_Usuario_Actualizacion;
        public $strFecha_Creacion;
        public $strFecha_Actualizacion;
    
        public function __construct(){
              parent::__construct();
        }


        //EXTRAER GENERACIONES
        public function selectGeneraciones(string $nomConexion)
        {
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT tGen.id AS idGen, tGen.nombre_generacion AS nomGen, tGen.fecha_inicio_gen AS fechIn, tGen.fecha_fin_gen AS fechFin, tGen.estatus AS est 
                    FROM t_generaciones AS tGen
                    WHERE tGen.estatus !=0";
            $request = $this->select_all($sql, $this->strNomConexion);
            return $request;
        }


        //PARA EDITAR
        public function selectGeneracion(int $intIdGeneraciones, string $nomConexion)
        {
            //Buscar Generaciones
            $this->strNomConexion = $nomConexion;
            $this->intIdGeneraciones = $intIdGeneraciones;
            $sql = "SELECT * FROM t_generaciones WHERE id = $this->intIdGeneraciones";
            $request = $this->select($sql,$this->strNomConexion);
            return $request;
        }


        //PARA GUARDAR O INSERTAR DATOS
        public function insertGeneracion(string $Nombre_Generacion, string $Fecha_inicio, string $Fecha_fin, int $Estatus, int $Id_usuario_creacion, int $Id_Usuario_Actualizacion, string $Fecha_Creacion, string $Fecha_Actualizacion, string $nomConexion){

            $return = "";
            $this->strNombre_Generacion = $Nombre_Generacion;
            $this->strFecha_inicio = $Fecha_inicio;
            $this->strFecha_fin = $Fecha_fin;
            $this->intEstatus = $Estatus;
            $this->intId_usuario_creacion = $Id_usuario_creacion;
            $this->intId_Usuario_Actualizacion = $Id_Usuario_Actualizacion;
            $this->strFecha_Creacion = $Fecha_Creacion;
            $this->strFecha_Actualizacion = $Fecha_Actualizacion;
            $this->strNomConexion = $nomConexion;
      
            $sql = "SELECT * FROM t_generaciones WHERE nombre_generacion = '$this->strNombre_Generacion' ";
            $request = $this->select_all($sql,$this->strNomConexion);
      
            if(empty($request)){
              $query_insert = "INSERT INTO t_generaciones(nombre_generacion, fecha_inicio_gen, fecha_fin_gen, estatus, id_usuario_creacion, id_usuario_actualizacion, fecha_creacion, fecha_actualizacion) VALUES(?,?,?,?,?,?,?,?)";
              $arrData = array($this->strNombre_Generacion, $this->strFecha_inicio, $this->strFecha_fin, $this->intEstatus, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion, $this->strFecha_Creacion, $this->strFecha_Actualizacion);
              $request_insert = $this->insert($query_insert,$this->strNomConexion,$arrData);
              $return = $request_insert;
            }else{
              $return = "exit";
            }
            return $return;
        }


        //MODELO PARA ACTUALIZAR
        public function updateGeneraciones(int $id, string $nombre_generacion, string $fecha_inicio_gen, string $fecha_fin_gen, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion, string $nomConexion){

          $this->intIdGeneraciones = $id;
          $this->strNombre_Generacion = $nombre_generacion;
          $this->strFecha_inicio = $fecha_inicio_gen;
          $this->strFecha_fin = $fecha_fin_gen;
          $this->intEstatus = $estatus;
          //$this->strFecha_Actualizacion = $fecha_actualizacion;
          $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;
          $this->strNomConexion = $nomConexion;
  
          $sql = "SELECT * FROM t_generaciones WHERE nombre_generacion = '$this->strNombre_Generacion' AND id != $this->intIdGeneraciones";
          $request = $this->select_all($sql,$this->strNomConexion);
  
          if(empty($request))
          {
              $sql = "UPDATE t_generaciones SET nombre_generacion = ?, fecha_inicio_gen = ?, fecha_fin_gen = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdGeneraciones ";
              $arrData = array($this->strNombre_Generacion, $this->strFecha_inicio, $this->strFecha_fin, $this->intEstatus, $this->intId_Usuario_Actualizacion);
              $request = $this->update($sql,$this->strNomConexion,$arrData);
          }else{
              $request = "exist";
          }
          return $request;			
        }


        //ELIMINAR 
        public function deleteGeneraciones(int $idGeneraciones, string $nomConexion){
          $this->intIdGeneraciones = $idGeneraciones;
          $this->strNomConexion = $nomConexion;
          $sql = "SELECT * FROM t_ciclos WHERE id_generacion = $this->intIdGeneraciones";
          $request = $this->select_all($sql, $$this->strNomConexion);
          if(empty($request))
          {
            $sql = "UPDATE t_generaciones SET estatus = ? WHERE id = $this->intIdGeneraciones";
            $arrData = array(0);
            $request = $this->update($sql,$this->strNomConexion,$arrData);
            if($request)
            {
              $request = 'ok';	
            }else{
              $request = 'error';
            }
          }else{
            $request = 'exist';
          }
          return $request;
        }


        // public function deleteGeneraciones(int $idGeneraciones, string $nomConexion){
        //   $this->intIdGeneraciones = $idGeneraciones;
        //   $this->strNomConexion = $nomConexion;
        //   $sql = "SELECT * FROM t_ciclos WHERE id_generacion = $this->intIdGeneraciones";
        //   $request = $this->select_all($sql,$this->strNomConexion);
        //   if(empty($request))
        //   {
        //       $sql = "UPDATE t_generaciones SET estatus = ? WHERE id = $this->intIdGeneraciones";
        //       $arrData =array(0);
        //       $request = $this->update($sql,$this->strNomConexion,$arrData);
        //       if($request)
        //       {
        //           $request = 'ok';
        //       }else{
        //           $request  = 'error';
        //       }
        //   }else{
        //       $request = 'exist';
        //   }
        //   return $request;
        // }


        // //SELECT CATEGORIAS
        // public function selectCategorias(string $nomConexion){
        //   $sql = "SELECT *FROM t_categoria_personas";
        //   $request = $this->select_all($sql, $nomConexion);
        //   return $request;
        // }

    }
?>