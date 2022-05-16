<?php
    class SistemasModel extends Mysql{
        
        public $nomConexion;
        public $nomSistema;
        public $abreviacionSistema;
        public $logoSistema;
        public $estatus;
        public $idDatosFiscales;
        public $idUser;
        public function __construct()
        {
            parent::__construct();
        }
        //Select sistemas
        public function selectSistemas(string $nomConexion)
        {
            $this->nomConexion = $nomConexion;
            $sql = "SELECT *FROM t_sistemas_educativos WHERE estatus != 0";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        //Insert Sistema
        public function insertSistema(string $nombreSistema,string $abreviacionSistema, string $nomImagen, string $nomConexion, int $idUser)
        {
            $this->nomSistema = $nombreSistema;
            $this->abreviacionSistema = $abreviacionSistema;
            $this->logoSistema = $nomImagen;
            $this->nomConexion = $nomConexion;
            $this->idUser = $idUser;
            $sql = "INSERT INTO t_sistemas_educativos(nom_conexion,nombre_sistema,abreviacion_sistema,logo_sistema,estatus,fecha_creacion,id_usuario_creacion) VALUES(?,?,?,?,?,NOW(),?)";
            $request = $this->insert($sql,$this->nomConexion,array($this->nomConexion,$this->nomSistema,$this->abreviacionSistema,$this->logoSistema,1,$this->idUser));
            return $request;
        }

        //Select Sistema by ID
        public function selectSistema(int $idSistema, string $nomConexion)
        {
            $this->nomConexion = $nomConexion;
            $sql = "SELECT *FROM t_sistemas_educativos WHERE id = $idSistema LIMIT 1";
            $request = $this->select($sql,$this->nomConexion);
            return $request;
        }

        public function selectSistemaExist(int $idSistema,string $strNombreSistema,string $strAbreviacion,int $intEstatus,string $nomConexion,int $idUser)
        {
            $this->nomSistema = $strNombreSistema;
            $this->abreviacionSistema = $strAbreviacion;
            $this->estatus = $intEstatus;
            $this->nomConexion = $nomConexion;
            $this->idUser = $idUser;
            return "jose";
        }
        
        public function updateSistema(int $idSistema,string $strNombreSistema,string $strAbreviacion,int $intEstatus,$nombreImagenSistema,int $idUSer,string $nomConexion)
        {
            $this->nomSistema = $strNombreSistema;
            $this->abreviacionSistema = $strAbreviacion;
            $this->estatus = $intEstatus;
            $this->logoSistema = $nombreImagenSistema;
            $this->idUser = $idUSer;
            $this->nomConexion = $nomConexion;
            if($this->logoSistema == null){
                $sql = "UPDATE t_sistemas_educativos SET nombre_sistema = ?,abreviacion_sistema = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id = $idSistema";
                $request = $this->update($sql,$this->nomConexion,array($this->nomSistema,$this->abreviacionSistema,$this->estatus,$this->idUser)); 
            }else{
                $sql = "UPDATE t_sistemas_educativos SET nombre_sistema = ?,abreviacion_sistema = ?,logo_sistema = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id = $idSistema";
                $request = $this->update($sql,$this->nomConexion,array($this->nomSistema,$this->abreviacionSistema,$this->logoSistema,$this->estatus,$this->idUser));
            }
            return $request;
        }

        public function delSistema(int $idSistema,int $idUSer,string $nomConexion)
        {
            $this->idUser = $idUSer;
            $this->nomConexion = $nomConexion;
            $sql = "UPDATE t_sistemas_educativos SET estatus = ? WHERE id = $idSistema";
            $request = $this->update($sql,$this->nomConexion,array(0));
            return $request;
        }
    }
?>