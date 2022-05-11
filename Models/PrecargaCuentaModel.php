<?php

class PrecargaCuentaModel extends Mysql
{
   
    public $intIdPers;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectPlanteles(string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT *FROM t_planteles WHERE estatus = 1";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }

    public function selectPlanEstudios(string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectPlanEstudiosByNivel(int $idNivel, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id,pe.id_nivel_educativo,ne.nombre_nivel_educativo  AS id_plantel FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_nivel_educativo = $idNivel";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectPlanEstudiosByPlantel(int $idPlantel, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_plantel = $idPlantel";
        $request = $this->select_all($sql, $this->strNomConexion);
        return $request;
    }
    public function selectPlanEstudiosByPlantelNivel(int $idPlantel, int $idNivel, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE  pe.estatus = 1 AND pe.id_plantel = $idPlantel AND pe.id_nivel_educativo = $idNivel";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectServicios(int $idPlantel, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT s.id,s.nombre_servicio,s.codigo_servicio,s.precio_unitario,cs.nombre_categoria FROM t_servicios AS s
        INNER JOIN t_categoria_servicios AS cs ON s.id_categoria_servicio = cs.id WHERE s.aplica_edo_cuenta = 1 AND s.id_plantel = $idPlantel";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function seletNiveles(string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT *FROM t_nivel_educativos";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectNivelesByPlantel(int $idPlantel, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT ne.id,ne.nombre_nivel_educativo FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS p ON pe.id_plantel = p.id
        INNER JOIN t_nivel_educativos AS ne ON pe.id_nivel_educativo = ne.id
        WHERE pe.id_plantel = $idPlantel AND pe.estatus = 1
        GROUP BY pe.id_nivel_educativo";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectPeriodos(string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT *FROM t_periodos";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function selectGrados(string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT *FROM t_grados";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }
    public function insertPrecargaCuenta(int $idPlantel,int $idPlanEstudios,int $idNivel,int $idPeriodo,int $idGrado,int $idServicio,$precioNuevo,$fechaLimitePago,$idUser, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $this->intCobroTotsal = $precioNuevo;
        // $sql = "INSERT INTO t_precarga(cobro_total,fecha_limite_cobro,estatus,id_usuario_creacion,fecha_creacion,id_servicio,id_plan_estudios,id_periodo,id_grado) VALUES(?,?,?,?,NOW(),?,?,?,?)";
        // $request = $this->insert($sql,$this->strNomConexion,array($precioNuevo,$fechaLimitePago,1,$idUser,$idServicio,$idPlanEstudios,$idPeriodo,$idGrado));
        $sql = "SELECT * FROM t_precarga WHERE cobro_total = '$this->intCobroTotsal' ";
            $request = $this->select_all($sql,$this->strNomConexion);
        if(empty($request)){
            $sql = "INSERT INTO t_precarga(cobro_total,fecha_limite_cobro,estatus,id_usuario_creacion,fecha_creacion,id_servicio,id_plan_estudios,id_periodo,id_grado) VALUES(?,?,?,?,NOW(),?,?,?,?)";
            $request = $this->insert($sql,$this->strNomConexion,array($precioNuevo,$fechaLimitePago,1,$idUser,$idServicio,$idPlanEstudios,$idPeriodo,$idGrado));
    
            $return = $request;
        }else{
            $return = "exist";
        }
        return $return;
    }

    // public function insertPrecargaCuenta(int $idPlantel,int $idPlanEstudios,int $idNivel,int $idPeriodo,int $idGrado,int $idServicio,$precioNuevo,$fechaLimitePago,$idUser, string $nomConexion){
    //     $this->strNomConexion = $nomConexion;
    //     $sql = "INSERT INTO t_precarga(cobro_total,fecha_limite_cobro,estatus,id_usuario_creacion,fecha_creacion,id_servicio,id_plan_estudios,id_periodo,id_grado) VALUES(?,?,?,?,NOW(),?,?,?,?)";
    //     $request = $this->insert($sql,$this->strNomConexion,array($precioNuevo,$fechaLimitePago,1,$idUser,$idServicio,$idPlanEstudios,$idPeriodo,$idGrado));
    //     return $request;
    // }

    public function selectServiciosByInput($value, string $nomConexion){
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT *FROM t_servicios WHERE nombre_servicio LIKE '%$value%'";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }

    //EXTRAER PRECARGAS
    public function selectPrecargas(string $nomConexion)
    {
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT tPre.id AS idPre, tPre.cobro_total AS cTotal, tPre.fecha_limite_cobro AS limCobro, tSe.nombre_servicio AS nomSer, 
                tPla.nombre_carrera AS nomCarre, tPe.nombre_periodo AS nomPer, tGra.nombre_grado AS nomGra, tPre.estatus AS est
                FROM t_precarga AS tPre
                INNER JOIN t_servicios AS tSe ON tPre.id_servicio = tSe.id
                INNER JOIN t_plan_estudios AS tPla ON tPre.id_plan_estudios = tPla.id
                INNER JOIN t_periodos AS tPe ON tPre.id_periodo = tPe.id
                INNER JOIN t_grados AS tGra ON tPre.id_grado = tGra.id
                WHERE tPre.estatus !=0
                ";
        $request = $this->select_all($sql,$this->strNomConexion);
        return $request;
    }

    //PARA EDITAR
    public function selectPrecargaCuenta (int $intIdPrecarga, string $nomConexion)
    {
        //BUSCAR SALONES COMPUESTOS
        $this->intIdPrecarga = $intIdPrecarga;
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT * FROM t_precarga WHERE id = $this->intIdPrecarga";
        $request = $this->select($sql,$this->strNomConexion);
        return $request;
    }

    //PARA ACTUALIZAR PRECARGA
    public function updatePrecargaCuentas(int $id, string $cobro_total, string $fecha_limite_cobro, int $estatus, string $fecha_modificacion, 
                                            int $id_usuario_modificacion, string $nomConexion)
    {
        $this->intIdPrecargaCuenta = $id;
        $this->intNuevoPrecio = $cobro_total;
        $this->strFechaLimCobro = $fecha_limite_cobro;
        $this->intEstatus = $estatus;
        /* $this->strFecha_Actualizacion = $fecha_modificacion; */
        $this->intId_Usuario_Actualizacion = $id_usuario_modificacion;
        $this->strNomConexion = $nomConexion;

        $sql = "SELECT * FROM t_precarga WHERE cobro_total = '$this->intNuevoPrecio' AND id != $this->intIdPrecargaCuenta";
        $request = $this->select_all($sql,$this->strNomConexion);

        if(empty($request))
        {
            $sql = "UPDATE t_precarga SET cobro_total = ?, fecha_limite_cobro = ?, estatus = ?, fecha_modificacion = NOW(), id_usuario_modificacion = ? WHERE id = $this->intIdPrecargaCuenta ";
            $arrData = array($this->intNuevoPrecio, $this->strFechaLimCobro, $this->intEstatus, $this->intId_Usuario_Actualizacion);
            $request = $this->update($sql,$this->strNomConexion,$arrData);
        }else{
            $request = "exist";
        }
        return $request;
    }

    //MODELO PARA ELIMINAR PRECARGA CUENTA
    public function deletePrecargaCuenta(int $idPre, string $nomConexion){
        $this->intIdPrecargaCuenta = $idPre;
        $this->strNomConexion = $nomConexion;
        $sql = "SELECT * FROM t_estado_cuenta WHERE id_precarga = $this->intIdPrecargaCuenta";
        $request = $this->select_all($sql,$this->strNomConexion);
        if(empty($request))
        {
            $sql = "UPDATE t_precarga SET estatus = ? WHERE id = $this->intIdPrecargaCuenta";
            $arrData =array(0);
            $request = $this->update($sql,$this->strNomConexion,$arrData);
            if($request)
            {
                $request = 'ok';
            }else{
                $request  = 'error';
            }
        }else{
            $request = 'exist';
        }
        return $request;
    }

}
