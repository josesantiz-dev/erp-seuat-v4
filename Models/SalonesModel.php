<?php
    class SalonesModel extends Mysql{

        public $intIdSalon;
        public $strNombreSalon;
        public $intCantidadMax;
        public $intEstatus;
        public $intIdUser;

        public function __construct()
        {
            parent::__construct();
        }

        public function selectSalones()
        {
            $sql = "SELECT id, nombre_salon, cantidad_max_estudiantes, estatus FROM t_salones WHERE estatus <> 0 ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSalon(int $idSalon)
        {
            $sql = "SELECT * FROM t_salones WHERE id=$idSalon LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }

        public function insertSalon(string $nombreSalon, string $cantidadMax)
        {
            $this->intIdUser = $_SESSION['idUser'];
            $request;
            $this->strNombreSalon = $nombreSalon;
            $this->intCantidadMax = $cantidadMax;

            $sqlExist = "SELECT * FROM t_salones WHERE nombre_salon = '$this->strNombreSalon'";
            $requestExist = $this->select($sqlExist);
            if($requestExist)
            {
                $request['estatus'] = TRUE;
            }
            else
            {
                $query_insert = "INSERT INTO t_salones (nombre_salon, cantidad_max_estudiantes, estatus, fecha_creacion,id_usuario_creacion)
                VALUES(?,?,1,NOW(),?)";
                $arrData = array($this->strNombreSalon, $this->intCantidadMax,$this->intIdUser);
                $request_insert = $this->insert($query_insert,$arrData);
                $request['estatus'] = FALSE;
            }
            return $request;
        }

        public function updateSalon(int $idSalon, string $nombreSln, int $cantMax, int $estatus)
        {
            $this->intIdUser = $_SESSION['idUser'];
            $this->intIdSalon = $idSalon;
            $this->strNombreSalon = $nombreSln;
            $this->intCantidadMax = $cantMax;
            $this->intEstatus = $estatus;
            $request;
            $sql = "SELECT * FROM t_salones WHERE nombre_salon = '$this->strNombreSalon' AND id != $this->intIdSalon";
            $requestExists = $this->select($sql);
            if($requestExists){
                $request['estatus'] = TRUE;
            }
            else{
                $sql = "UPDATE t_salones SET nombre_salon = ?, cantidad_max_estudiantes = ?, estatus = ?, fecha_actualizacion=NOW(), id_usuario_actualizacion = ? WHERE id=$this->intIdSalon";
                $arrData = array($this->strNombreSalon, $this->intCantidadMax, $this->intEstatus, $this->intIdUser);
                $requestUpdate = $this->update($sql,$arrData);
                $request['estatus'] = FALSE;
            }
            return $request;
        }

        public function deleteSalon(int $idSln)
        {
            $this->intIdSalon = $idSln;
            $sql = "SELECT * FROM t_salones WHERE id=$this->intIdSalon";
            $request = $this->select_all($sql);
            if($request)
            {
                $sql = "UPDATE t_salones SET estatus = ? WHERE id=$this->intIdSalon";
                $arrData = array(0);
                $requestDel = $this->update($sql,$arrData);
                if($requestDel)
                {
                    $request = 'ok';
                }
                else
                {
                    $request = 'error';
                }
            }
            else
            {
                $request = 'exist';
            }
            return $request;
        }
    }
?>