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
        public function selectSistemas(string $nomConexion)
        {
           // $this->nomConexion = $nomConexion;
            $sql = "SELECT *FROM t_sistemas_educativos WHERE estatus != 0";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
    }
?>