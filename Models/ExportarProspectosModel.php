<?php
    class ExportarProspectosModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectPersonas(string $nomConexion){
            $sql = "SELECT p.id,p.alias,p.nombre_persona,p.ap_paterno,p.ap_materno,p.email,p.tel_celular,
            p.direccion,p.estatus,c.nombre_categoria FROM t_personas AS p
            LEFT JOIN t_asignacion_categoria_persona AS ac ON ac.id_persona = p.id
            INNER JOIN t_categoria_personas AS c ON ac.id_categoria_persona = c.id
            WHERE p.estatus != 0 AND ac.id_categoria_persona = 1 ORDER BY p.id DESC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectPersona(int $idPersona, string $nomConexion){
            $sql = "SELECT *FROM t_personas WHERE id = $idPersona LIMIT 1";
            $request = $this->select($sql,$nomConexion);
            return $request;
        }
        public function selectColumnTable(string $nomConexion){
            $sql = "SHOW COLUMNS FROM t_personas";
            $request = $this->select_all($sql,$nomConexion);
            return $request;
        }
        public function updatePersonaTrans(int $idPersona, string $nomConexion,string $folioTransferencia,string $plantel){
            $sql = "UPDATE t_prospectos SET folio_transferencia = ?, plantel_transferido = ? WHERE id_persona = $idPersona";
            $request = $this->update($sql,$nomConexion,array($folioTransferencia,$plantel));
            return $request;
        }
        public function updatePersona(int $idPersona, string $nomConexion){
            $sql = "UPDATE t_personas SET estatus = ? WHERE id = $idPersona";
            $request = $this->update($sql,$nomConexion,array(2));
            return $request;
        }
    }
?>