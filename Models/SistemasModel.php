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
    }
?>