<?php

class PromocionModel extends Mysql
{
    public $intIdCategoria_servicios;
    public $strNombre_categoria;
    public $intEstatus;
    public $strFecha_creacion;
    public $strFecha_actualizacion;
    public $intId_usuario_creacion;
    public $intId_usuario_actualizacion;
    public $intIdCampania;
    public $intIdPromocion;
    public $intId_servicio;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectPromociones()
    {
        //Extraer todas las promociones
        //$sql = "SELECT * FROM t_promociones WHERE estatus !=0";
        $sql = "SELECT tp.id AS IdPromocion, tp.nombre_promocion AS NombrePromocion, tp.estatus AS EstatusPromocion, tp.porcentaje_descuento AS PorcentajeDescuento, ts.nombre_servicio AS NombreServicio
                FROM t_promociones tp
                INNER JOIN t_servicios ts
                ON tp.id_servicio = ts.id
                WHERE tp.estatus !=0
                ORDER BY tp.nombre_promocion ASC ";
        $request = $this->select_all($sql);
        return $request;
    }

    /* public function selectPromocion(int $intIdCategoria_servicios)
    {
        //Buscar una promoción
        $this->intIdCategoria_servicios = $intIdCategoria_servicios;
        $sql = "SELECT * FROM t_categoria_servicios WHERE id = $this->intIdCategoria_servicios";
        $request = $this->select($sql);
        return $request;
    } */
    public function selectPromocion(int $id){
        $sql = "SELECT p.id,p.nombre_promocion,p.id_servicio,p.descripcion,p.fecha_inicio,p.fecha_fin,s.id_campania,s.id AS id_subcampania,p.porcentaje_descuento,p.estatus FROM t_promociones AS p 
        INNER JOIN t_subcampania AS s ON p.id_subcampania = s.id
        WHERE p.id = $id";
        $request = $this->select($sql);
        return $request;
    }

    public function selectServicios()
    {
        $sql = "SELECT * FROM t_servicios WHERE estatus != 0 ORDER BY nombre_servicio ASC ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCampanias()
    {
        $sql = "SELECT * FROM t_campanias WHERE estatus != 0 ORDER BY fecha_inicio ASC ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectSubcampanias($intIdCampania)
    {
        $this->intIdCampania = $intIdCampania;
        $sql = "SELECT id, nombre_sub_campania, fecha_inicio, fecha_fin, estatus FROM t_subcampania WHERE id_campania = $this->intIdCampania AND estatus !=0 ORDER BY fecha_inicio ASC LIMIT 1  ";
        $request = $this->select_all($sql);
        return $request;
    }

    public function insertPromocion(string $nombre_promocion, string $descripcion, int $estatus, string $porcentaje_descuento, string $fecha_inicio, string $fecha_fin, string $fecha_creacion, string $fecha_actualizacion, int $id_usuario_creacion, int $id_usuario_actualizacion, int $id_subcampania, int $id_servicio)
    {

        $return = 0;
        $this->strNombre_promocion = $nombre_promocion;
        $this->strDescripcion = $descripcion;
        $this->intEstatus = $estatus;
        $this->strPorcentaje_descuento = $porcentaje_descuento;
        $this->strFecha_inicio = $fecha_inicio;
        $this->strFecha_fin = $fecha_fin;
        $this->strFecha_creacion = date('Y-m-d H:i:s'); // '2022-10-23 00:00:00'; //$fecha_creacion;
        $this->strFecha_actualizacion = $fecha_actualizacion;
        $this->intId_usuario_creacion = $id_usuario_creacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;
        $this->intId_subcampania = $id_subcampania;
        $this->intId_servicio = $id_servicio;

        $sql = "SELECT * FROM t_promociones WHERE nombre_promocion = '{$this->strNombre_promocion}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert = "INSERT INTO t_promociones(nombre_promocion,descripcion,estatus,porcentaje_descuento,fecha_inicio,fecha_fin,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion,id_subcampania,id_servicio) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array($this->strNombre_promocion, $this->strDescripcion, $this->intEstatus, $this->strPorcentaje_descuento, $this->strFecha_inicio, $this->strFecha_fin, $this->strFecha_creacion, $this->strFecha_actualizacion, $this->intId_usuario_creacion, $this->intId_usuario_actualizacion, $this->intId_subcampania, $this->intId_servicio);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }


    public function updatePromocion(int $intId_promocion,int $intId_campania,int $intId_servicio,int $intId_subcampania,string $strDescripcion,string $strFecha_fin,string $strFecha_inicio,string $strNombre_promocion,int $intPorcentaje_descuento,int $id_user,$intEstatus){
        $sql = "UPDATE t_promociones SET nombre_promocion = ?,descripcion = ?,estatus = ?,porcentaje_descuento = ?,fecha_inicio = ?,fecha_fin = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ?,id_subcampania = ?,id_servicio = ? WHERE id = $intId_promocion";
        $request = $this->update($sql,array($strNombre_promocion,$strDescripcion,$intEstatus,$intPorcentaje_descuento,$strFecha_inicio,$strFecha_fin,$id_user,$intId_subcampania,$intId_servicio));
        return $request;
    }

    public function updateCategoria_servicios(int $id, string $nombre_categoria, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion)
    {

        $this->intIdCategoria_servicios = $id;
        $this->strNombre_categoria = $nombre_categoria;
        $this->intEstatus = $estatus;
        //$this->strFecha_actualizacion = $fecha_actualizacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;

        $sql = "SELECT * FROM t_categoria_servicios WHERE nombre_categoria = '$this->strNombre_categoria' AND id != $this->intIdCategoria_servicios";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE t_categoria_servicios SET nombre_categoria = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdCategoria_servicios ";
            $arrData = array($this->strNombre_categoria, $this->intEstatus, $this->intId_usuario_actualizacion);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deletePromocion(int $idpromocion)
    {
        $this->intIdPromocion = $idpromocion;
        $sql = "UPDATE t_promociones SET estatus = ? WHERE id = $this->intIdPromocion";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }
        return $request;
    }

}
