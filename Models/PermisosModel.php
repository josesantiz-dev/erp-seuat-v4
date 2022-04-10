<?php

class PermisosModel extends Mysql
{
    public $intIdpermiso;
    public $intIdrol;
    public $intIdmodulo;
    public $r;
    public $w;
    public $u;
    public $d;

	public function __construct()
	{
		parent::__construct();
	}

    public function selectModulos()
    {
        $sql = "SELECT * FROM t_modulos WHERE estatus != 0";
        $request = $this->select_all($sql);
        return $request;
    }	
    public function selectPermisosRol(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM t_permisos WHERE id_rol = $this->intIdrol";
        $request = $this->select_all($sql);
        return $request;
    }

    public function deletePermisos(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "DELETE FROM t_permisos WHERE id_rol = $this->intIdrol";
        $request = $this->delete($sql);
        return $request;
    }

    public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d){
        $this->intIdrol = $idrol;
        $this->intIdmodulo = $idmodulo;
        $this->r = $r;
        $this->w = $w;
        $this->u = $u;
        $this->d = $d;
        $query_insert  = "INSERT INTO t_permisos(id_rol,id_modulo,r,w,u,d) VALUES(?,?,?,?,?,?)";
        $arrData = array($this->intIdrol, $this->intIdmodulo, $this->r, $this->w, $this->u, $this->d);
        $request_insert = $this->insert($query_insert,$arrData);		
        return $request_insert;
    }
}
?>