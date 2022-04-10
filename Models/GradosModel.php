<?php
    class GradosModel extends Mysql{

        public $intIdGrados;
        public $strNombre_Grado;
        public $strNumero_Natural;
        public $strNumero_Romano;
        public $intEstatus;
        public $strFecha_Creacion;
        public $strFecha_Actualizacion;
        public $intId_usuario_creacion;
        public $intId_Usuario_Actualizacion;

        public function __construct()
        {
            parent::__construct();
        }


        //EXTRAER CICLOS O EXTRAER CICLOS
        public function selectGrados()
        {
            $sql = "SELECT t_grados.id AS IdGrados, t_grados.nombre_grado AS Nombre, t_grados.numero_natural AS Numero_Nat, t_grados.numero_romano AS Numero_Rom, t_grados.estatus AS estatus 
                    FROM t_grados 
                    WHERE t_grados.estatus !=0
                    ";
            $request = $this->select_all($sql);
            return $request;
        }


        //PARA EDITAR GRADOS
        public function selectGrado (int $intIdGrados)
        {
            //BUSCAR GRADOS
            $this->intIdGrados = $intIdGrados;
            $sql = "SELECT * FROM t_grados WHERE id = $this->intIdGrados";
            $request = $this->select($sql);
            return $request;
        }



        //PARA GUARDAR O INSERTAR DATOS
        public function insertGrado(string $Nombre_Grado, string $Numero_Natural, string $Numero_Romano, int $Estatus, string $Fecha_Creacion, string $Fecha_Actualizacion, int $Id_usuario_creacion, int $Id_Usuario_Actualizacion){

            $return = "";
            $this->strNombre_Grado = $Nombre_Grado;
            $this->strNumero_Natural = $Numero_Natural;
            $this->strNumero_Romano = $Numero_Romano;
            $this->intEstatus = $Estatus;
            $this->strFecha_Creacion = $Fecha_Creacion;
            $this->strFecha_Actualizacion = $Fecha_Actualizacion;
            $this->intId_usuario_creacion = $Id_usuario_creacion;
            $this->intId_Usuario_Actualizacion = $Id_Usuario_Actualizacion;

            $sql = "SELECT * FROM t_grados WHERE nombre_grado = '$this->strNombre_Grado' ";
            $request = $this->select_all($sql);

            if(empty($request)){
                $query_insert = "INSERT INTO t_grados(nombre_grado, numero_natural, numero_romano, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion) VALUES(?,?,?,?,?,?,?,?)";
                $arrData = array($this->strNombre_Grado, $this->strNumero_Natural, $this->strNumero_Romano, $this->intEstatus, $this->strFecha_Creacion, $this->strFecha_Actualizacion, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exit";
            }
            return $return;
        }


        //PARA ACTUALIZAR GRADOS
        public function updateGrados(int $id, string $Nombre_Grado, string $Numero_Natural, string $Numero_Romano, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion){
            $this->intIdGrados = $id;
            $this->strNombre_Grado = $Nombre_Grado;
            $this->strNumero_Natural = $Numero_Natural;
            $this->strNumero_Romano = $Numero_Romano;
            $this->intEstatus = $estatus;
            /* $this->strFecha_Actualizacion = $fecha_actualizacion; */
            $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;

            $sql = "SELECT * FROM t_grados WHERE nombre_grado = '$this->strNombre_Grado' AND id != $this->intIdGrados";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE t_grados SET nombre_grado = ?, numero_natural = ?, numero_romano = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdGrados ";
                $arrData = array($this->strNombre_Grado, $this->strNumero_Natural, $this->strNumero_Romano, $this->intEstatus, $this->intId_Usuario_Actualizacion);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }


        //MODELO PARA ELIMINAR GRADOS
        public function deleteGrados(int $idGrados){
            $this->intIdGrados = $idGrados;
            $sql = "SELECT * FROM t_materias WHERE id_grados = $this->intIdGrados";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE t_grados SET estatus = ? WHERE id = $this->intIdGrados";
                $arrData =array(0);
                $request = $this->update($sql,$arrData);
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


    }
?>