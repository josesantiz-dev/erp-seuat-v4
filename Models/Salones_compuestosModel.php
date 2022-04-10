<?php
    class Salones_compuestosModel extends Mysql{

        public $intIdSalonesCompuestos;
        public $strNombre_SalonCompuesto;
        public $strFecha_Creacion;
        public $strFecha_Actualizacion;
        public $intId_usuario_creacion;
        public $intId_Usuario_Actualizacion;
        public $intId_Periodos;
        public $intId_Grados;
        public $intId_Grupos;
        public $intId_Planteles;
        public $intId_Turnos;
        public $intId_Salones;
        public $intEstatus;

        public function __construct()
        {
            parent::__construct();
        }



        //EXTRAER SALONES COMPUESTOS O EXTRAER SALONES COMPUESTOS
        public function selectSalonesCompuest()
        {
            $sql = "SELECT t_salones_compuesto.id AS IdSalonCom, t_salones_compuesto.nombre_salon_compuesto AS NomSalCom, t_periodos.nombre_periodo AS NomPerio, t_grados.nombre_grado AS NomGrad, t_grupos.nombre_grupo AS NomGrup, t_planteles.nombre_plantel AS NomPlant, t_turnos.nombre_turno AS NomTurn, t_salones.nombre_salon AS NomSal, t_salones_compuesto.estatus AS Est
                    FROM t_salones_compuesto 
                    INNER JOIN t_periodos AS t_periodos ON t_salones_compuesto.id_periodo = t_periodos.id
                    INNER JOIN t_grados AS t_grados ON t_salones_compuesto.id_grado = t_grados.id
                    INNER JOIN t_grupos AS t_grupos ON t_salones_compuesto.id_grupo = t_grupos.id
                    INNER JOIN t_planteles AS t_planteles ON t_salones_compuesto.id_plantel = t_planteles.id
                    INNER JOIN t_turnos AS t_turnos ON t_salones_compuesto.id_turnos = t_turnos.id
                    INNER JOIN t_salones AS t_salones ON t_salones_compuesto.id_salon = t_salones.id
                    WHERE t_salones_compuesto.estatus !=0
                    ";
            $request = $this->select_all($sql);
            return $request;
        }



        //PARA EDITAR
        public function selectSalonCompu (int $intIdSalonesCompuestos)
        {
            //BUSCAR SALONES COMPUESTOS
            $this->intIdSalonesCompuestos = $intIdSalonesCompuestos;
            $sql = "SELECT * FROM t_salones_compuesto WHERE id = $this->intIdSalonesCompuestos";
            $request = $this->select($sql);
            return $request;
        }



        //PARA GUARDAR O INSERTAR DATOS
        public function insertSalonCompuesto(string $Nombre_SalonCompuesto, string $Fecha_Creacion, string $Fecha_Actualizacion, int $Id_usuario_creacion, int $Id_Usuario_Actualizacion, int $Id_Periodos, int $Id_Grados, int $Id_Grupos, int $Id_Planteles, int $Id_Turnos, int $Id_Salones, int $Estatus){

            $return = "";
            $this->strNombre_SalonCompuesto = $Nombre_SalonCompuesto;
            $this->strFecha_Creacion = $Fecha_Creacion;
            $this->strFecha_Actualizacion = $Fecha_Actualizacion;
            $this->intId_usuario_creacion = $Id_usuario_creacion;
            $this->intId_Usuario_Actualizacion = $Id_Usuario_Actualizacion;
            $this->intId_Periodos = $Id_Periodos;
            $this->intId_Grados = $Id_Grados;
            $this->intId_Grupos = $Id_Grupos;
            $this->intId_Planteles = $Id_Planteles;
            $this->intId_Turnos = $Id_Turnos;
            $this->intId_Salones = $Id_Salones;
            $this->intEstatus = $Estatus;

            $sql = "SELECT * FROM t_salones_compuesto WHERE nombre_salon_compuesto = '$this->strNombre_SalonCompuesto' ";
            $request = $this->select_all($sql);

            if(empty($request)){
                $query_insert = "INSERT INTO t_salones_compuesto(nombre_salon_compuesto, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, id_periodo, id_grado, id_grupo, id_plantel, id_turnos, id_salon, estatus) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strNombre_SalonCompuesto, $this->strFecha_Creacion, $this->strFecha_Actualizacion, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion, $this->intId_Periodos, $this->intId_Grados, $this->intId_Grupos, $this->intId_Planteles, $this->intId_Turnos, $this->intId_Salones, $this->intEstatus);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }


        //PARA ACTUALIZAR SALONES COMPUESTOS
        public function updateSalonesComp(int $id, string $nombre_salon_compuesto, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion, int $id_periodo, int $id_grado, int $id_grupo, int $id_plantel, int $id_turnos, int $id_salon){
            $this->intIdSalonesCompuestos = $id;
            $this->strNombre_SalonCompuesto = $nombre_salon_compuesto;
            $this->intEstatus = $estatus;
            /* $this->strFecha_Actualizacion = $fecha_actualizacion; */
            $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;
            $this->intId_Periodos = $id_periodo;
            $this->intId_Grados = $id_grado;
            $this->intId_Grupos = $id_grupo;
            $this->intId_Planteles = $id_plantel;
            $this->intId_Turnos = $id_turnos;
            $this->intId_Salones = $id_salon;

            $sql = "SELECT * FROM t_salones_compuesto WHERE nombre_salon_compuesto = '$this->strNombre_SalonCompuesto' AND id != $this->intIdSalonesCompuestos";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE t_salones_compuesto SET nombre_salon_compuesto = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ?, id_periodo = ?, id_grado = ?, id_grupo = ?, id_plantel = ?, id_turnos = ?, id_salon = ? WHERE id = $this->intIdSalonesCompuestos ";
                $arrData = array($this->strNombre_SalonCompuesto, $this->intEstatus, $this->intId_Usuario_Actualizacion, $this->intId_Periodos, $this->intId_Grados, $this->intId_Grupos, $this->intId_Planteles, $this->intId_Turnos, $this->intId_Salones);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }


        //MODELO PARA ELIMINAR SALONES COMPUESTOS
        public function deleteSalonesCompu(int $IdSalonCom){
            $this->intIdSalonesCompuestos = $IdSalonCom;
            $sql = "SELECT * FROM t_inscripciones WHERE id_salon_compuesto = $this->intIdSalonesCompuestos";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE t_salones_compuesto SET estatus = ? WHERE id = $this->intIdSalonesCompuestos";
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





        /*---------------------------------------SELECT PARA NUEVO----------------------------------------------*/
        public function selectSalonComPerio(){
            $sql = "SELECT * FROM t_periodos WHERE estatus != 0 ORDER BY nombre_periodo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalonComGrado(){
            $sql = "SELECT * FROM t_grados WHERE estatus != 0 ORDER BY nombre_grado ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalonComGrupo(){
            $sql = "SELECT * FROM t_grupos WHERE estatus != 0 ORDER BY nombre_grupo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalonComPlant(){
            $sql = "SELECT * FROM t_planteles WHERE estatus != 0 ORDER BY nombre_plantel ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalonComHorar(){
            $sql = "SELECT * FROM t_turnos WHERE estatus != 0 ORDER BY nombre_turno ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalonComSalon(){
            $sql = "SELECT * FROM t_salones WHERE estatus != 0 ORDER BY nombre_salon ASC ";
            $request = $this->select_all($sql);
            return $request;
        }
        /*-------------------------------------------------------------------------------------------------------*/


        /*---------------------------------------SELECT PARA EDITAR----------------------------------------------*/

        public function selectEditSalonComPerio(){
            $sql = "SELECT * FROM t_periodos WHERE estatus != 0 ORDER BY nombre_periodo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEditSalonComGrado(){
            $sql = "SELECT * FROM t_grados WHERE estatus != 0 ORDER BY nombre_grado ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEditSalonComGrupo(){
            $sql = "SELECT * FROM t_grupos WHERE estatus != 0 ORDER BY nombre_grupo ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEditSalonComPlant(){
            $sql = "SELECT * FROM t_planteles WHERE estatus != 0 ORDER BY nombre_plantel ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEditSalonComHorar(){
            $sql = "SELECT * FROM t_turnos WHERE estatus != 0 ORDER BY nombre_turno ASC ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectEditSalonComSalon(){
            $sql = "SELECT * FROM t_salones WHERE estatus != 0 ORDER BY nombre_salon ASC ";
            $request = $this->select_all($sql);
            return $request;
        }
        /*-------------------------------------------------------------------------------------------------------*/


    }
?>







