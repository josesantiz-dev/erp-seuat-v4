<?php
    class CiclosModel extends Mysql{

        public $intIdCiclos;
        public $strNombre_Ciclo;
        public $strAnio;
        public $intEstatus;
        public $strFecha_Creacion;
        public $strFecha_Actualizacion;
        public $intId_usuario_creacion;
        public $intId_Usuario_Actualizacion;
        public $intId_Generacion;

        public function __construct()
        {
            parent::__construct();
        }


        //EXTRAER CICLOS O EXTRAER CICLOS
        public function selectCiclos(string $nomConexion)
        {
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT t_ciclos.id AS IdCiclos, t_ciclos.nombre_ciclo AS Nombre, t_ciclos.anio AS Anio, t_ciclos.estatus AS estatus, t_generaciones.nombre_generacion AS Generacion 
                    FROM t_ciclos 
                    INNER JOIN t_generaciones AS t_generaciones ON t_ciclos.id_generacion = t_generaciones.id 
                    WHERE t_ciclos.estatus !=0
                    ";
            $request = $this->select_all($sql, $this->strNomConexion);
            return $request;
        }


        //PARA EDITAR
        public function selectsCiclo (int $intIdCiclos, string $nomConexion)
        {
            //BUSCAR CICLOS
            $this->intIdCiclos = $intIdCiclos;
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_ciclos WHERE id = $this->intIdCiclos";
            $request = $this->select($sql, $this->strNomConexion);
            return $request;
        }


        //PARA GUARDAR O INSERTAR DATOS
        public function insertCiclo(string $Nombre_Ciclo, string $Anio, int $Estatus, string $Fecha_Creacion, string $Fecha_Actualizacion, int $Id_usuario_creacion, int $Id_Usuario_Actualizacion, int $Id_Generacion, string $nomConexion){

            $return = "";
            $this->strNombre_Ciclo = $Nombre_Ciclo;
            $this->strAnio = $Anio;
            $this->intEstatus = $Estatus;
            $this->strFecha_Creacion = $Fecha_Creacion;
            $this->strFecha_Actualizacion = $Fecha_Actualizacion;
            $this->intId_usuario_creacion = $Id_usuario_creacion;
            $this->intId_Usuario_Actualizacion = $Id_Usuario_Actualizacion;
            $this->intId_Generacion = $Id_Generacion;
            $this->strNomConexion = $nomConexion;

            $sql = "SELECT * FROM t_ciclos WHERE nombre_ciclo = '$this->strNombre_Ciclo' ";
            $request = $this->select_all($sql, $this->strNomConexion);

            if(empty($request)){
                $query_insert = "INSERT INTO t_ciclos(nombre_ciclo, anio, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, id_generacion) VALUES(?,?,?,?,?,?,?,?)";
                $arrData = array($this->strNombre_Ciclo, $this->strAnio, $this->intEstatus, $this->strFecha_Creacion, $this->strFecha_Actualizacion, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion, $this->intId_Generacion);
                $request_insert = $this->insert($query_insert,$this->strNomConexion,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }


        //PARA ACTUALIZAR
        public function updateCiclos(int $id, string $nombre_ciclo, string $anio, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion, int $id_generacion, string $nomConexion){
            $this->intIdCiclos = $id;
            $this->strNombre_Ciclo = $nombre_ciclo;
            $this->strAnio = $anio;
            $this->intEstatus = $estatus;
            /* $this->strFecha_Actualizacion = $fecha_actualizacion; */
            $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;
            $this->intId_Generacion = $id_generacion;
            $this->strNomConexion = $nomConexion;

            $sql = "SELECT * FROM t_ciclos WHERE nombre_ciclo = '$this->strNombre_Ciclo' AND id != $this->intIdCiclos";
            $request = $this->select_all($sql,  $this->strNomConexion);

            if(empty($request))
            {
                $sql = "UPDATE t_ciclos SET nombre_ciclo = ?, anio = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ?, id_generacion = ? WHERE id = $this->intIdCiclos ";
                $arrData = array($this->strNombre_Ciclo, $this->strAnio, $this->intEstatus, $this->intId_Usuario_Actualizacion, $this->intId_Generacion);
                $request = $this->update($sql,$this->strNomConexion,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }


        //MODELO PARA ELIMINAR
        public function deleteCiclos(int $idCiclos, string $nomConexion){
            $this->intIdCiclos = $idCiclos;
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_periodos WHERE id_ciclo = $this->intIdCiclos";
            $request = $this->select_all($sql,$this->strNomConexion);
            if(empty($request))
            {
                $sql = "UPDATE t_ciclos SET estatus = ? WHERE id = $this->intIdCiclos";
                $arrData =array(0);
                $request = $this->update($sql,$this->strNomConexion,$arrData);
                if($request)
                {
                    $request = 'ok';
                }else{
                    $request  = 'error';
                }
            }else{
                $request = 'exist';
            }
            return $request;
        }


        //SELECT
        public function selectCiclo(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_generaciones WHERE estatus != 0 ORDER BY nombre_generacion ASC ";
            $request = $this->select_all($sql, $this->strNomConexion);
            return $request;
        }
        

        //SELECT PARA EDITAR CICLO
        public function selectEditCiclo(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_generaciones WHERE estatus != 0 ORDER BY nombre_generacion ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }


        //MODELO PARA ACTUALIZAR


        //PARA ELIMINAR
    }
?>