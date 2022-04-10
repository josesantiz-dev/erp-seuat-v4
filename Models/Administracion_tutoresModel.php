<?php
    class Administracion_tutoresModel extends Mysql{

        public $intIdAdminisTurores;
        public $strNombreTutor;
        public $strApellidoPatTutor;
        public $strApellidoMatTutor;
        public $strDirreccion;
        public $strTelCelular;
        public $strTelFijo;
        public $strCorreo;
        public $intEstatus;
        public $strFecha_Actualizacion;
        public $intId_Usuario_Actualizacion;

        public function __construct()
        {
            parent::__construct();
        }



        //EXTRAER SALONES ADMINISTRACION MATRICULAS TUTORES
        public function selectAdministTutores()
        {
            $sql = "SELECT tut.id AS idTut, CONCAT(tut.nombre_tutor,' ', tut.appat_tutor,' ', tut.apmat_tutor) as nombre_tutor, 
                            tut.direccion, tut.tel_celular, tut.tel_fijo, tut.email, tut.estatus AS Estatus 
                    FROM t_tutores as tut
                    WHERE tut.estatus !=0
                    ";
            $request = $this->select_all($sql);
            return $request;
        }


        //PARA EDITAR TUTORES
        public function selectAdminisTut (int $intIdAdminisTurores)
        {
            //BUSCAR TUTORES
            $this->intIdAdminisTurores = $intIdAdminisTurores;
            $sql = "SELECT * FROM t_tutores WHERE id = $this->intIdAdminisTurores";
            $request = $this->select($sql);
            return $request;
        }


        //MODELO PARA ACTUALIZAR
        public function updateAdministTutores(int $id, string $nombre_tutor, string $appat_tutor, string $apmat_tutor, string $direccion, string $tel_celular, string $tel_fijo, string $email, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion){

            $this->intIdAdminisTurores = $id;
            $this->strNombreTutor = $nombre_tutor;
            $this->strApellidoPatTutor = $appat_tutor;
            $this->strApellidoMatTutor = $apmat_tutor;
            $this->strDirreccion = $direccion;
            $this->strTelCelular = $tel_celular;
            $this->strTelFijo = $tel_fijo;
            $this->strCorreo = $email;
            $this->intEstatus = $estatus;
            //$this->strFecha_Actualizacion = $fecha_actualizacion;
            $this->intId_Usuario_Actualizacion = $id_usuario_actualizacion;
    
            $sql = "SELECT * FROM t_tutores WHERE nombre_tutor = '$this->strNombreTutor' AND id != $this->intIdAdminisTurores";
            $request = $this->select_all($sql);
    
            if(empty($request))
            {
                $sql = "UPDATE t_tutores SET nombre_tutor = ?, appat_tutor = ?, apmat_tutor = ?, direccion = ?, tel_celular = ?, tel_fijo = ?, email = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdAdminisTurores ";
                $arrData = array($this->strNombreTutor, $this->strApellidoPatTutor, $this->strApellidoMatTutor, $this->strDirreccion, $this->strTelCelular, $this->strTelFijo, $this->strCorreo, $this->intEstatus, $this->intId_Usuario_Actualizacion);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;			
          }


        //MODELO PARA ELIMINAR TUTORES
        public function deleteAdministTutores(int $idTut){
            $this->intIdAdminisTurores = $idTut;
            $sql = "SELECT * FROM t_inscripciones WHERE id_tutores = $this->intIdAdminisTurores";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE t_tutores SET estatus = ? WHERE id = $this->intIdAdminisTurores";
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


    }
?>