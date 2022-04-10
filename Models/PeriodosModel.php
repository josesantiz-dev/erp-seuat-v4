<?php
    class PeriodosModel extends Mysql{

        public $intIdPeriodos;
        public $strNombre_Periodo;
        public $strFecha_inicio;
        public $strFecha_fin;
        public $intEstatus;
        public $strFecha_Creacion;
        public $strFecha_Actualizacion;
        public $intId_usuario_creacion;
        public $intId_Usuario_Actualizacion;
        public $intId_Organizacion_planes;
        public $intId_Ciclo;

        public function __construct()
        {
            parent::__construct();
        }


        //EXTRAER PERIODOS
        public function selectPeriodos()
        {
            $sql = "SELECT t_periodos.id AS IdPeriodos, t_periodos.nombre_periodo AS Nombre, t_periodos.fecha_inicio_periodo AS Fecha_inicio, t_periodos.fecha_fin_periodo AS Fecha_fin, t_periodos.estatus AS estatus, t_organizacion_planes.nombre_plan AS Plan, t_ciclos.nombre_ciclo AS Nombre_ciclo 
                    FROM t_periodos 
                    INNER JOIN t_organizacion_planes AS t_organizacion_planes ON t_periodos.id_organizacion_planes = t_organizacion_planes.id
                    INNER JOIN t_ciclos AS t_ciclos ON t_periodos.id_ciclo = t_ciclos.id 
                    WHERE t_periodos.estatus !=0
                    /* SELECT * FROM t_ciclos WHERE estatus !=0 */
                    ";
            $request = $this->select_all($sql);
            return $request;
        }


        //PARA EDITAR PERIODOS
        public function selectPeriodo (int $intIdPeriodos)
        {
            //BUSCAR PERIODOS
            $this->intIdPeriodos = $intIdPeriodos;
            $sql = "SELECT * FROM t_periodos WHERE id = $this->intIdPeriodos";
            $request = $this->select($sql);
            return $request;
        }


        //PARA GUARDAR O INSERTAR DATOS O PERIODOS
        public function insertPeriodo(string $Nombre_Periodo, string $Fecha_inicio, string $Fecha_fin, int $Estatus, string $Fecha_Creacion, string $Fecha_Actualizacion, int $Id_usuario_creacion, int $Id_Usuario_Actualizacion, int $Id_Organizacion_planes, int $Id_Ciclo){

            $return = "";
            $this->strNombre_Periodo = $Nombre_Periodo;
            $this->strFecha_inicio = $Fecha_inicio;
            $this->strFecha_fin = $Fecha_fin;
            $this->intEstatus = $Estatus;
            $this->strFecha_Creacion = $Fecha_Creacion;
            $this->strFecha_Actualizacion = $Fecha_Actualizacion;
            $this->intId_usuario_creacion = $Id_usuario_creacion;
            $this->intId_Usuario_Actualizacion = $Id_Usuario_Actualizacion;
            $this->intId_Organizacion_planes = $Id_Organizacion_planes;
            $this->intId_Ciclo = $Id_Ciclo;

            $sql = "SELECT * FROM t_periodos WHERE nombre_periodo = '$this->strNombre_Periodo' ";
            $request = $this->select_all($sql);

            if(empty($request)){
                $query_insert = "INSERT INTO t_periodos(nombre_periodo, fecha_inicio_periodo, fecha_fin_periodo, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, id_organizacion_planes, id_ciclo) VALUES(?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strNombre_Periodo, $this->strFecha_inicio, $this->strFecha_fin, $this->intEstatus, $this->strFecha_Creacion, $this->strFecha_Actualizacion, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion, $this->intId_Organizacion_planes, $this->intId_Ciclo);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exit";
            }
            return $return;
        }


        //ACTUALIZAR PERIODOS
        public function updatePeriodos(int $id, string $nombre_periodo, string $fecha_inicio_periodo, string $fecha_fin_periodo, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion, int $id_organizacion_planes, int $id_ciclo){
            $this->intIdPeriodos = $id;
            $this->strNombre_Periodo = $nombre_periodo;
            $this->strFecha_inicio = $fecha_inicio_periodo;
            $this->strFecha_fin = $fecha_fin_periodo;
            $this->intEstatus = $estatus;
            /* $this->strFecha_Actualizacion = $fecha_actualizacion; */
            $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;
            $this->intId_Organizacion_planes = $id_organizacion_planes;
            $this->intId_Ciclo = $id_ciclo;

            $sql = "SELECT * FROM t_periodos WHERE nombre_periodo = '$this->strNombre_Periodo' AND id != $this->intIdPeriodos";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE t_periodos SET nombre_periodo = ?, fecha_inicio_periodo = ?, fecha_fin_periodo = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ?, id_organizacion_planes = ?, id_ciclo = ? WHERE id = $this->intIdPeriodos ";
                $arrData = array($this->strNombre_Periodo, $this->strFecha_inicio, $this->strFecha_fin, $this->intEstatus, $this->intId_Usuario_Actualizacion, $this->intId_Organizacion_planes, $this->intId_Ciclo);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }


        //MODELO PARA ELIMINAR PERIODOS
        public function deletePeriodos(int $idPeriodos){
            $this->intIdPeriodos = $idPeriodos;
            $sql = "SELECT * FROM t_precarga WHERE id_periodo = $this->intIdPeriodos";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE t_periodos SET estatus = ? WHERE id = $this->intIdPeriodos";
                $arrData =array(0);
                $request = $this->update($sql,$arrData);
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



        /* ---------------------------------SELECT PARA NUEVO---------------------------------------------------------- */
        //SELECT PERIODOS ORGANIZACION
        public function selectPeriodoOrg(){
            $sql = "SELECT * FROM t_organizacion_planes WHERE estatus != 0 ORDER BY nombre_plan ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        //SELECT PERIODOS CICLOS
        public function selectPeriodoCiclos(){
            $sql = "SELECT * FROM t_ciclos WHERE estatus != 0 ORDER BY nombre_ciclo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }
        /* ------------------------------------------------------------------------------------------- */


        /* -----------------------------------------SELECT PARA EDITAR-------------------------------------------------- */
        //SELECT PARA EDITAR PERIODO PLAN
        public function selectEditPerioPlan(){
            $sql = "SELECT * FROM t_organizacion_planes WHERE estatus != 0 ORDER BY nombre_plan ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        //SELECT PARA EDITAR PERIODO PLAN
        public function selectEditPerioCiclo(){
            $sql = "SELECT * FROM t_ciclos WHERE estatus != 0 ORDER BY nombre_ciclo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }
        /* ------------------------------------------------------------------------------------------- */

        
    }
?>    