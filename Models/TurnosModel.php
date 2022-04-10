<?php
class TurnosModel extends Mysql
{
    public $intIdTurno;
    public $strNombreTurno;
    public $strAbreviatura;
    public $tmHoraEnt;
    public $tmHoraSal;
    public $intLu;
    public $intMa;
    public $intMi;
    public $intJu;
    public $intVi;
    public $intSa;
    public $intDo;
    public $estatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectTurnos()
    {
        $sql = "SELECT id, nombre_turno, abreviatura, hora_entrada, hora_salida, estatus 
        FROM t_turnos WHERE estatus <> 0 ORDER BY id DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectTurno(int $intIdTurno)
    {
        $sql = "SELECT id, nombre_turno, abreviatura, hora_entrada, hora_salida, lu, ma, mi, ju, vi, sa, do, estatus FROM t_turnos WHERE id = $intIdTurno LIMIT 1";
        $request = $this->select($sql);
        return $request;
    }
    
    public function insertTurno(string $nombreTurno, string $abreviatura, string $horaEnt, string $horaSal, int $lun, int $mar, int $mie, int $jue, int $vie, int $sab, int $dom)
    {
        $this->intIdUser = $_SESSION['idUser'];
        $request;
        $this->strNombreTurno = $nombreTurno;
        $this->strAbreviatura = $abreviatura;
        $this->tmHoraEnt = $horaEnt;
        $this->tmHoraSal = $horaSal;
        $this->intLu = $lun;
        $this->intMa = $mar;
        $this->intMi = $mie;
        $this->intJu = $jue;
        $this->intVi = $vie;
        $this->intSa = $sab;
        $this->intDo = $dom;

        $sql = "SELECT * FROM t_turnos where nombre_turno = '$this->strNombreTurno' OR abreviatura = '$this->strAbreviatura'";
        $requestExist = $this->select($sql);
        if($requestExist){
            $request['estatus'] = TRUE;
        }
        else{
            $query_insert = "INSERT INTO t_turnos (nombre_turno, abreviatura, hora_entrada, hora_salida, lu, ma, mi, ju, vi, sa, do, estatus, id_categoria_persona, id_usuario_creacion, fecha_creacion) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,2,?,NOW())";
            $arrData = array($this->strNombreTurno, $this->strAbreviatura, $this->tmHoraEnt, $this->tmHoraSal, $this->intLu, $this->intMa, $this->intMi, $this->intJu, $this->intVi, $this->intSa, $this->intDo, $this->intIdUser);
            $request_insert = $this->insert($query_insert,$arrData);
            $request['estatus'] = FALSE;
        }
        return $request;
    }

    public function updateTurno(int $idTurno, string $nombreTurno, string $abreviatura, string $horaEnt, string $horaSal, int $lun, int $mar, int $mie, int $jue, int $vie, int $sab, int $dom, int $estatus)
    {
        $this->intIdUser = $_SESSION['idUser'];
        $this->intIdTurno = $idTurno;
        $this->strNombreTurno = $nombreTurno;
        $this->strAbreviatura = $abreviatura;
        $this->tmHoraEnt = $horaEnt;
        $this->tmHoraSal = $horaSal;
        $this->intLu = $lun;
        $this->intMa = $mar;
        $this->intMi = $mie;
        $this->intJu = $jue;
        $this->intVi = $vie;
        $this->intSa = $sab;
        $this->intDo = $dom;
        $this->estatus = $estatus;
        $request;

        $sqlExistNombre = "SELECT * FROM t_turnos WHERE nombre_turno = '$this->strNombreTurno' AND id != $this->intIdTurno";
        $requestExistNom = $this->select($sqlExistNombre);
        if($requestExistNom){
            $sqlExistAbr = "SELECT * FROM t_turnos WHERE abreviatura = '$this->strAbreviatura' AND id != $this->intIdTurno";
            $requestAbre = $this->select($sqlExistAbr);
            $request['estatus'] = TRUE;
            $request['msg'] = 'Nombre existente en los registros';
            if($requestAbre){
                $request['estatus'] = TRUE;
                $request['msg'] = 'Nombre y abreviatura existen en los registros';
            }
            else{
                $request['estatus'] = TRUE;
                $request['msg'] = 'Nombre ya existe en los registros';
            }
        } 
        else{
            $sqlExisteAbre = "SELECT * FROM t_turnos WHERE abreviatura = '$this->strAbreviatura' AND id != $this->intIdTurno";
            $requestExistAbre = $this->select($sqlExisteAbre);
            if($requestExistAbre){
                $request['estatus'] = TRUE;
                $request['msg'] = 'Abreviatura existente en los registros';
            }
            else{
                $sql = "UPDATE t_turnos SET nombre_turno = ?, abreviatura = ?, hora_entrada = ?, hora_salida = ?, lu = ?, ma = ?, mi = ?, ju = ?, vi = ?, sa = ?, do = ?, estatus = ? , id_usuario_actualizacion = ? , fecha_actualizacion = NOW() WHERE id=$this->intIdTurno";
                $arrData = array($this->strNombreTurno, $this->strAbreviatura, $this->tmHoraEnt, $this->tmHoraSal, $this->intLu, $this->intMa, $this->intMi, $this->intJu, $this->intVi, $this->intSa, $this->intDo, $this->estatus, $this->intIdUser);
                $requestUpdate = $this->update($sql,$arrData); 
                $request['estatus'] = FALSE;
                $request['msg'] = "";
            }
        }

        return $request; 
        /*$sql = "SELECT * FROM t_turnos WHERE nombre_turno = '$this->strNombreTurno' AND id != $this->intIdTurno";
        $requestExist = $this->select($sql);
        if($requestExist){
            $request['estatus'] = TRUE;
        }
        else{
            $sql = "UPDATE t_turnos SET nombre_turno = ?, abreviatura = ?, hora_entrada = ?, hora_salida = ?, lu = ?, ma = ?, mi = ?, ju = ?, vi = ?, sa = ?, do = ?, estatus = ? , id_usuario_actualizacion = ? , fecha_actualizacion = NOW() WHERE id=$this->intIdTurno";
            $arrData = array($this->strNombreTurno, $this->strAbreviatura, $this->tmHoraEnt, $this->tmHoraSal, $this->intLu, $this->intMa, $this->intMi, $this->intJu, $this->intVi, $this->intSa, $this->intDo, $this->estatus, $this->intIdUser);
            $requestUpdate = $this->update($sql,$arrData);
            $request['estatus'] = FALSE;
        }*/
    }

    public function deteleTurno(int $idTrn)
    {
        $this->intIdTurno = $idTrn;
        $sql = "SELECT * FROM t_turnos WHERE id=$this->intIdTurno";
        $request = $this->select_all($sql);
        if($request)
        {
            $sql = "UPDATE t_turnos SET estatus = ? WHERE id=$this->intIdTurno";
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