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
        public function selectSalonesCompuest(string $nomConexion)
        {
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT tSCom.id AS IdSalonCom, tSCom.nombre_salon_compuesto AS NomSalCom, tPe.nombre_periodo AS NomPerio, 
                           tc.anio AS anoCic, tGra.nombre_grado AS NomGrad, t_Gru.nombre_grupo AS NomGrup, tPla.nombre_plantel AS NomPlant, 
                           tTur.nombre_turno AS NomTurn, tSal.nombre_salon AS NomSal, tSCom.estatus AS Est
                    FROM t_salones_compuesto AS tSCom
                    INNER JOIN t_periodos AS tPe ON tSCom.id_periodo = tPe.id
                    INNER JOIN t_grados AS tGra ON tSCom.id_grado = tGra.id
                    INNER JOIN t_grupos AS t_Gru ON tSCom.id_grupo = t_Gru.id
                    INNER JOIN t_planteles AS tPla ON tSCom.id_plantel = tPla.id
                    INNER JOIN t_turnos AS tTur ON tSCom.id_turnos = tTur.id
                    INNER JOIN t_salones AS tSal ON tSCom.id_salon = tSal.id
                    INNER JOIN t_ciclos AS tc ON tPe.id_ciclo = tc.id
                    WHERE tSCom.estatus !=0
                    ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }



        //PARA EDITAR
        public function selectSalonCompu (int $intIdSalonesCompuestos, string $nomConexion)
        {
            //BUSCAR SALONES COMPUESTOS
            $this->intIdSalonesCompuestos = $intIdSalonesCompuestos;
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_salones_compuesto WHERE id = $this->intIdSalonesCompuestos";
            $request = $this->select($sql,$this->strNomConexion);
            return $request;
        }



        //PARA GUARDAR O INSERTAR DATOS
        public function insertSalonCompuesto(string $Nombre_SalonCompuesto, string $Fecha_Creacion, string $Fecha_Actualizacion, 
                                            int $Id_usuario_creacion, int $Id_Usuario_Actualizacion, int $Id_Periodos, int $Id_Grados, 
                                            int $Id_Grupos, int $Id_Planteles, int $Id_Turnos, int $Id_Salones, int $Estatus, string $nomConexion){

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
            $this->strNomConexion = $nomConexion;

            $sql = "SELECT * FROM t_salones_compuesto WHERE nombre_salon_compuesto = '$this->strNombre_SalonCompuesto' ";
            $request = $this->select_all($sql,$this->strNomConexion);

            if(empty($request)){
                $query_insert = "INSERT INTO t_salones_compuesto(nombre_salon_compuesto, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion, id_periodo, id_grado, id_grupo, id_plantel, id_turnos, id_salon, estatus) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strNombre_SalonCompuesto, $this->strFecha_Creacion, $this->strFecha_Actualizacion, $this->intId_usuario_creacion, $this->intId_Usuario_Actualizacion, $this->intId_Periodos, $this->intId_Grados, $this->intId_Grupos, $this->intId_Planteles, $this->intId_Turnos, $this->intId_Salones, $this->intEstatus);
                $request_insert = $this->insert($query_insert,$this->strNomConexion,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }


        //PARA ACTUALIZAR SALONES COMPUESTOS
        public function updateSalonesComp(int $id, string $nombre_salon_compuesto, int $estatus, string $fecha_actualizacion, 
                                        int $id_usuario_actualizacion, int $id_periodo, int $id_grado, int $id_grupo, int $id_plantel, 
                                        int $id_turnos, int $id_salon, string $nomConexion)
        {
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
            $this->strNomConexion = $nomConexion;

            $sql = "SELECT * FROM t_salones_compuesto WHERE nombre_salon_compuesto = '$this->strNombre_SalonCompuesto' AND id != $this->intIdSalonesCompuestos";
            $request = $this->select_all($sql,$this->strNomConexion);

            if(empty($request))
            {
                $sql = "UPDATE t_salones_compuesto SET nombre_salon_compuesto = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ?, id_periodo = ?, id_grado = ?, id_grupo = ?, id_plantel = ?, id_turnos = ?, id_salon = ? WHERE id = $this->intIdSalonesCompuestos ";
                $arrData = array($this->strNombre_SalonCompuesto, $this->intEstatus, $this->intId_Usuario_Actualizacion, $this->intId_Periodos, $this->intId_Grados, $this->intId_Grupos, $this->intId_Planteles, $this->intId_Turnos, $this->intId_Salones);
                $request = $this->update($sql,$this->strNomConexion,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }


        //MODELO PARA ELIMINAR SALONES COMPUESTOS
        public function deleteSalonesCompu(int $IdSalonCom, string $nomConexion){
            $this->intIdSalonesCompuestos = $IdSalonCom;
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_inscripciones WHERE id_salon_compuesto = $this->intIdSalonesCompuestos";
            $request = $this->select_all($sql,$this->strNomConexion);
            if(empty($request))
            {
                $sql = "UPDATE t_salones_compuesto SET estatus = ? WHERE id = $this->intIdSalonesCompuestos";
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





        /*---------------------------------------SELECT PARA NUEVO----------------------------------------------*/
        public function selectSalonComPerio(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_periodos WHERE estatus != 0 ORDER BY nombre_periodo ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectSalonComGrado(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_grados WHERE estatus != 0 ORDER BY nombre_grado ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectSalonComGrupo(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_grupos WHERE estatus != 0 ORDER BY nombre_grupo ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectSalonComPlant(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_planteles WHERE estatus != 0 ORDER BY nombre_plantel ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectSalonComHorar(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_turnos WHERE estatus != 0 ORDER BY nombre_turno ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectSalonComSalon(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_salones WHERE estatus != 0 ORDER BY nombre_salon ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }
        /*-------------------------------------------------------------------------------------------------------*/


        /*---------------------------------------SELECT PARA EDITAR----------------------------------------------*/

        public function selectEditSalonComPerio(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_periodos WHERE estatus != 0 ORDER BY nombre_periodo ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectEditSalonComGrado(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_grados WHERE estatus != 0 ORDER BY nombre_grado ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectEditSalonComGrupo(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_grupos WHERE estatus != 0 ORDER BY nombre_grupo ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectEditSalonComPlant(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_planteles WHERE estatus != 0 ORDER BY nombre_plantel ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectEditSalonComHorar(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_turnos WHERE estatus != 0 ORDER BY nombre_turno ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }

        public function selectEditSalonComSalon(string $nomConexion){
            $this->strNomConexion = $nomConexion;
            $sql = "SELECT * FROM t_salones WHERE estatus != 0 ORDER BY nombre_salon ASC ";
            $request = $this->select_all($sql,$this->strNomConexion);
            return $request;
        }
        /*-------------------------------------------------------------------------------------------------------*/


    }
?>







