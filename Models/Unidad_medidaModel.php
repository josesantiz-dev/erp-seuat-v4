<?php
class Unidad_medidaModel extends Mysql{
    public $intId;
    public $strTipo;
    public $strClave;
    public $strNombreUnidadMedida;
    public $intEstatus;
    public $intIdUsuarioCreacion;
    public $intIdUsuarioActualizacion;
    public $strFechaCreacion;
    public $strFechaActualizacion;

	public function __construct()
	{
		parent::__construct();
	}

    public function selectUnidad_medidas(){
        $sql = "SELECT id, tipo, clave, nombre_unidad_medida, estatus FROM t_unidades_medida WHERE estatus !=0 ORDER BY id DESC ";
        $request = $this->select_all($sql);
        return $request;
    }


    public function insertUnidad_medida(int $intId,string $strNombre,int $intEstatus,string $strTipo,string $strClave,int $id_user){   
        $this->intId = $intId;
        $this->strNombreUnidadMedida = $strNombre;
        $this->intEstatus = $intEstatus;
        $this->strTipo = $strTipo;
        $this->strClave = $strClave;
        $this->intIdUsuarioCreacion = $id_user;
        
        $sql = "SELECT * FROM t_unidades_medida WHERE nombre_unidad_medida = '{$this->strNombreUnidadMedida}' ";
        $request = $this->select_all($sql);
        if(empty($request)){
            $sql = "INSERT INTO t_unidades_medida(tipo,clave,nombre_unidad_medida,estatus,id_usuario_creacion,fecha_creacion) VALUES(?,?,?,?,?,NOW())";
            $request = $this->insert($sql,array($this->strTipo,$this->strClave,$this->strNombreUnidadMedida,$this->intEstatus,$this->intIdUsuarioCreacion));
        }else{
            $request = "exist";
        }
        return $request;
    }	



    public function selectUnidad_medida(int $intId)
    {
        //Buscar una unidad de medida
        $this->intId = $intId;
        $sql = "SELECT * FROM t_unidades_medida WHERE id = $this->intId";
        $request = $this->select($sql);
        return $request;
    }



    public function updateUnidad_medida(int $intId,string $strTipo,string $strClave,string $strNombre,int $intEstatus,int $intIdUser){
        $this->intId = $intId;
        $this->strTipo = $strTipo;
        $this->strClave = $strClave;
        $this->strNombreUnidadMedida = $strNombre;
        $this->intEstatus = $intEstatus;
        $this->intIdUsuarioActualizacion = $intIdUser;
        
        $sql = "SELECT * FROM t_unidades_medida WHERE nombre_unidad_medida = '$this->strNombreUnidadMedida' AND id != $this->intId";
        $request = $this->select_all($sql);
        if(empty($request)){
            $sql = "UPDATE t_unidades_medida SET tipo = ?,clave = ?,nombre_unidad_medida = ?, estatus = ?, id_usuario_actualizacion = ?,fecha_actualizacion = NOW() WHERE id = $this->intId ";
            $arrData = array($this->strTipo,$this->strClave,$this->strNombreUnidadMedida, $this->intEstatus, $this->intIdUsuarioActualizacion);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }


    public function deleteUnidad_medida(int $idunidad_medida){
			$this->intId = $idunidad_medida;
			$sql = "SELECT * FROM t_servicios WHERE id_unidades_medida = $this->intId";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE t_unidades_medida SET estatus = ? WHERE id = $this->intId";
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