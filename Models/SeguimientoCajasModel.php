<?php
    class SeguimientoCajasModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectCajeros(string $nomConexion){
            $sql = "SELECT ca.id AS id_caja, us.id AS id_usuario, per.id AS id_persona,ca.nombre AS nombre_caja,
            per.nombre_persona,per.ap_paterno,per.ap_materno,ec.estatus_caja FROM t_cajas AS ca 
            INNER JOIN t_usuarios AS us ON ca.id_usuario_atiende = us.id
            INNER JOIN t_personas AS per ON us.id_persona = per.id
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = ca.id";
            $request = $this->select_all($sql,$nomConexion);
            return $request;
        }

        public function selectCaja(int $idCaja, string $nomConexion){
            $sql = "SELECT c.id,c.nombre,ec.estatus_caja,cc.id AS id_corte_caja,cc.fechayhora_apertura_caja,cc.fechayhora_cierre_caja FROM t_cajas AS c 
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = c.id
            RIGHT JOIN t_corte_caja AS cc ON cc.id_caja = c.id
            WHERE c.id = $idCaja ORDER BY cc.fechayhora_apertura_caja DESC";
            $request = $this->select($sql, $nomConexion);
            return $request;
        }

        public function selectVentaTotal(int $caja, string $fecha, string $nomConexion){
            $sql = "SELECT i.id, i.total,u.id AS id_usuario,c.id AS id_caja,i.fecha FROM t_ingresos AS i
            INNER JOIN t_usuarios AS u ON i.id_usuario = u.id
            INNER JOIN t_cajas AS c ON c.id_usuario_atiende = u.id
            WHERE i.fecha >= '$fecha' AND c.id = $caja";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

        public function selectVentasTotalAll(string $nomConexion){
            $sql = "SELECT i.nom_plantel,SUM(total) AS total,DATE_FORMAT(i.fecha,'%Y-%m-%d') AS fecha FROM t_ingresos AS i
            GROUP BY YEAR(i.fecha),MONTH(i.fecha),DAY(i.fecha), i.nom_plantel ORDER BY i.fecha ASC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }
    }

?>