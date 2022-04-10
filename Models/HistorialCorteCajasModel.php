<?php
	class HistorialCorteCajasModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function selectCortesCajas(){
			$sql = "SELECT cc.id,cc.folio,p.nombre_plantel,p.municipio,c.nombre,cc.fechayhora_apertura_caja,cc.fechayhora_cierre_caja,CONCAT(pe.nombre_persona,' ',
            pe.ap_paterno,' ',pe.ap_materno) AS usuario_entrega, CONCAT(pr.nombre_persona,' ',pr.ap_paterno,' ',pr.ap_materno) AS usuario_recibe,dc.dinero_faltante,
            dc.dinero_sobrante FROM t_corte_caja AS cc
            INNER JOIN t_cajas AS c ON cc.id_caja = c.id
            INNER JOIN t_planteles AS p ON c.id_plantel = p.id
            LEFT JOIN t_usuarios AS ur ON cc.id_usuario_recibe = ur.id
            LEFT JOIN t_usuarios AS ue ON cc.id_usuario_entrega = ue.id
            LEFT JOIN t_personas AS pr ON ur.id_persona = pr.id
            LEFT JOIN t_personas AS pe ON ue.id_persona = pe.id
            LEFT JOIN t_dinero_caja AS dc ON dc.id_corte_caja = cc.id ORDER BY cc.fechayhora_cierre_caja DESC";
			$request = $this->select_all($sql);
			return $request;
		}
	}
?>  