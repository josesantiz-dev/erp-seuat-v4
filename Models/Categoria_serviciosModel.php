<?php

class Categoria_serviciosModel extends Mysql
{
    public $intIdCategoria_servicios;
    public $strClave_categoria_servicio;
	public $strNombre_categoria;
    public $intAplica_colegiatura;
	public $intEstatus;
    public $intId_user;
	public $strFecha_creacion;
    public $strFecha_actualizacion;
    public $intId_usuario_creacion;
    public $intId_usuario_actualizacion;

	public function __construct()
	{
		parent::__construct();
	}

    public function selectCategoria_servicios()
    {
        //Extraer las categorias de servicios
        $sql = "SELECT * FROM t_categoria_servicios WHERE estatus !=0 ORDER BY id DESC";
        $request = $this->select_all($sql);
        return $request;
    }
    

    public function selectCategoria_servicio(int $intIdCategoria_servicios)
    {
        //Buscar Categoria
        $this->intIdCategoria_servicios = $intIdCategoria_servicios;
        $sql = "SELECT * FROM t_categoria_servicios WHERE id = $this->intIdCategoria_servicios";
        $request = $this->select($sql);
        return $request;
    }


    public function insertCategoria_servicios(string $strClave_categoria,string $strNombre_categoria,int $intAplica_colegiatura,int $intEstatus,int $id_user){
        $this->strClave_categoria_servicio = $strClave_categoria;
        $this->strNombre_categoria = $strNombre_categoria;
        $this->intAplica_colegiatura = $intAplica_colegiatura;
        $this->intEstatus = $intEstatus;
        $this->intId_user = $id_user;
       
        $sql = "SELECT * FROM t_categoria_servicios WHERE nombre_categoria = '{$this->strNombre_categoria}'";
        $request = $this->select_all($sql);
        
        if(empty($request)){
            $query_insert = "INSERT INTO t_categoria_servicios(clave_categoria,nombre_categoria,colegiatura,estatus,fecha_creacion,id_usuario_creacion) VALUES(?,?,?,?,NOW(),?)";
            $arrData = array($this->strClave_categoria_servicio,$this->strNombre_categoria,$this->intAplica_colegiatura, $this->intEstatus, $this->intId_user);
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        }else{
            $return = "exist";
        }
        return $return;
    }	

    public function updateCategoria_servicios(int $id, string $clave_categoria,string $nombre_categoria, int $aplica_colegiatura,int $estatus,int $id_user){
        $this->intIdCategoria_servicios = $id;
        $this->strClave_categoria_servicio = $clave_categoria;
        $this->strNombre_categoria = $nombre_categoria;
        $this->intAplica_colegiatura = $aplica_colegiatura;
        $this->intEstatus = $estatus;
        $this->intId_user = $id_user;
        
        $sql = "SELECT * FROM t_categoria_servicios WHERE nombre_categoria = '$this->strNombre_categoria' AND id != $this->intIdCategoria_servicios";
        $request = $this->select_all($sql);
        if(empty($request))
        {
            $sql = "UPDATE t_categoria_servicios SET clave_categoria = ?,nombre_categoria = ?, colegiatura = ?,estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdCategoria_servicios ";
            $arrData = array($this->strClave_categoria_servicio,$this->strNombre_categoria, $this->intAplica_colegiatura,$this->intEstatus, $this->idUser);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }


    public function deleteCategoria_servicios(int $idcategoria_servicios)
		{
			$this->intIdCategoria_servicios = $idcategoria_servicios;
			$sql = "SELECT * FROM t_servicios WHERE id_categoria_servicio = $this->intIdCategoria_servicios";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE t_categoria_servicios SET estatus = ? WHERE id = $this->intIdCategoria_servicios";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}

}
?>