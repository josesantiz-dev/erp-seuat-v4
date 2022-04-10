<?php

  class AgendaProspectoModel extends Mysql{

    public $intId;
    public $strFechaRegistro;
    public $strFechaProgramada;
    public $strHoraProgramada;
    public $strAsunto;
    public $strDetalle;
    public $intEstatus;
    public $intNotificacion;
    public $intLectura;
    public $intIdUsuarioAtendio;
    public $intIdPersona;
    public $strFechaActualizacion;
    public $intEstado;

    public function __construct(){
      parent::__construct();
    }

    public function selectAgendaProspectos(){
      $sql = "SELECT id, fecha_programada, hora_programada, asunto, estatus FROM t_agenda";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectAgendaProspecto(int $intIdAgenda_guardado){
      $this->intId = $intIdAgenda_guardado;
      $sql = "SELECT t_personas.nombre_persona, t_personas.ap_paterno, t_personas.ap_materno, t_personas.tel_celular, t_personas.tel_fijo, t_agenda.id, t_agenda.fecha_registro, t_agenda.fecha_programada, t_agenda.hora_programada, t_agenda.asunto, t_agenda.detalle, t_agenda.estatus, t_agenda.id_usuario_atendio FROM t_agenda INNER JOIN t_personas ON t_agenda.id_persona = t_personas.id WHERE t_agenda.id = $this->intId";
      $request = $this->select($sql);
      return $request;
    }

    public function estatusUpdate(int $idA, int $estatus){

      $this->intIdAgenda = $idA;
      $this->intEstatus = $estatus;

      $sql = "UPDATE t_agenda SET estatus = ? WHERE id = ?";
      $arrData = array($this->intEstatus, $this->intIdAgenda);
      $request = $this->update($sql,$arrData);

      return $request;

    }

    public function selectNombreUsuairoCreacion(int $id){

      $this->intIdUsuarioAtendio = $id;
      $sql = "SELECT t_personas.nombre_persona, t_personas.ap_paterno, t_personas.ap_materno FROM t_personas
              INNER JOIN t_usuarios ON t_usuarios.id_persona = t_personas.id
              WHERE t_personas.id = $this->intIdUsuarioAtendio";
      $request = $this->select($sql);
      return $request;

    }

  }

?>
