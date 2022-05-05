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
            WHERE p.estatus = 1 AND ac.id_categoria_persona = 1 ORDER BY p.id DESC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
        public function selectPersona(int $idPersona, string $nomConexion){
            //$sql = "SELECT *FROM t_personas WHERE id = $idPersona LIMIT 1";
            $sql = "SELECT per.id, per.nombre_persona,per.ap_paterno,per.ap_materno,per.alias,per.direccion,per.edad,per.sexo,per.cp,per.colonia,per.tel_celular,per.tel_fijo,
            per.email,per.edo_civil,per.ocupacion,per.id_localidad,per.curp,per.fecha_nacimiento,per.estatus,per.nombre_empresa,per.id_rol,per.id_escolaridad,
            per.id_datos_fiscales,pr.escuela_procedencia,pr.observaciones,pr.folio_transferencia,pr.plantel_de_origen,pr.plantel_a_transferir,pr.id_plantel_inscrito,
            pr.plantel_interes,pr.id_nivel_carrera_interes,pr.id_carrera_interes,pr.id_medio_captacion,pr.id_subcampania FROM t_personas AS per
            INNER JOIN t_prospectos AS pr ON pr.id_persona = per.id WHERE per.id = $idPersona LIMIT 1";
            $request = $this->select($sql,$nomConexion);
            return $request;
        }
        public function selectColumnTable(string $nomConexion){
            //$sql = "SHOW COLUMNS FROM t_personas";
            $sql = "SELECT per.id, per.nombre_persona,per.ap_paterno,per.ap_materno,per.alias,per.direccion,per.edad,per.sexo,per.cp,per.colonia,per.tel_celular,per.tel_fijo,
            per.email,per.edo_civil,per.ocupacion,per.id_localidad,per.curp,per.fecha_nacimiento,per.estatus,per.nombre_empresa,per.id_rol,per.id_escolaridad,
            per.id_datos_fiscales,pr.escuela_procedencia,pr.observaciones,pr.folio_transferencia,pr.plantel_de_origen,pr.plantel_a_transferir,pr.id_plantel_inscrito,
            pr.plantel_interes,pr.id_nivel_carrera_interes,pr.id_carrera_interes,pr.id_medio_captacion,pr.id_subcampania FROM t_personas AS per
            INNER JOIN t_prospectos AS pr ON pr.id_persona = per.id LIMIT 1";
            $request = $this->select($sql,$nomConexion);
            return $request;
        }
        public function updatePersonaTrans(int $idPersona, string $nomConexion,string $folioTransferencia,string $plantel){
            $sql = "UPDATE t_prospectos SET folio_transferencia = ?, plantel_a_transferir = ? WHERE id_persona = $idPersona";
            $request = $this->update($sql,$nomConexion,array($folioTransferencia,$plantel));
            return $request;
        }
        public function updatePersona(int $idPersona, string $nomConexion, int $idUser){
            $sql = "UPDATE t_personas SET estatus = ? ,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id = $idPersona";
            $request = $this->update($sql,$nomConexion,array(5,$idUser));
            return $request;
        }
    }
?>