<?php

class SeguimientoModel extends Mysql{

    public $intIdPers;
    public $intIdPros;
    public $strNombrePers; //$strNombreP
    public $strApePat; //$strApellidoPaP
    public $strApeMat; //$strApellidoMaP
    public $strTelCel; //$strTelcelP
    public $strEmail; //$strEmailP
    public $intIdNvlCarrInte; //$intNivelEstudiosInteresP
    public $intIdCarrInte; //$intCarreaInteresP
    public $intIdPltInte; //$intPlantelInteresP
    public $intCatPer; //$intIdCategoriaPersona
    public $intNotificacion;
    public $intEstatus;
    public $intRespRap;
    public $strComentario;
    public $intIdUsuario; //$intIdUsuarioCreacion - //$intIdUsuarioActualizacion
    public $strOcupacion; //$strOcupacionP
    public $strEstadoCivil; //$strEstadoCivilP
    public $strSexo; //$strSexoP
    public $intEdad; //$intEdad
    public $intEstado; //$intEstadoP
    public $intMunicipio; //$intMunicipioP
    public $intLocalidad; //$intLocalidadP
    public $strDireccion;//$strDireccionP
    public $strColonia; //$strColoniaP
    public $intCodigoPostal; //$intCpP
    public $strTelfijo; //$strTelFiP
    public $strPlantelProcedencia; //$strPlantelProcedenciaP
    public $intMedioCaptacion;
    public $strAlias;
    public $strFechaNacimiento;
    public $intEscolaridad;
    public $intIdSubcampania;


    public function __construct(){
        parent::__construct();
    }

    public function selectPlanteles(){
        $sql = "SELECT id, nombre_plantel FROM t_planteles";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectNiveles(){
        $sql = "SELECT id, nombre_nivel_educativo FROM t_nivel_educativos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCarreras()
    {
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCarrera($idNivel){
        $idNvl = $idNivel;
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes WHERE id_nivel_educativo = $idNvl";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectProspectos(){
        $sql = "SELECT pe.id,CONCAT(pe.nombre_persona,' ',pe.ap_paterno,' ', pe.ap_materno) as nombre_completo, cat_pe.nombre_categoria, pe.alias, pe.tel_celular, plt.nombre_plantel, crr.nombre_carrera, med.medio_captacion
        FROM t_personas as pe
        INNER JOIN t_categoria_personas as cat_pe ON pe.id_categoria_persona = cat_pe.id
        INNER JOIN t_prospectos as pro ON pro.id_persona = pe.id
        LEFT JOIN t_planteles as plt ON pro.id_plantel_interes = plt.id
        LEFT JOIN t_carrera_interes as crr ON pro.id_carrera_interes = crr.id
        INNER JOIN t_medio_captacion as med ON pro.id_medio_captacion = med.id
        WHERE pe.estatus != 0 AND pe.id_categoria_persona = 1 OR pe.id_categoria_persona = 5
        ORDER BY pe.id DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPlantelInteres(int $id)
    {
        $this->intIdPltInte = $id;
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes WHERE id_nivel_carrera = $this->intIdPltInte";
        $request = $this->select($sql);
        return $request;
    }

    public function selectProspecto(int $id){
        $this->intIdPers = $id;
        $sql = "SELECT per.id as per_id, per.nombre_persona, per.ap_paterno, per.ap_materno,
        per.tel_celular,
        per.email,
        pro.id_plantel_interes,
        pro.id_nivel_carrera_interes,
        pro.id_carrera_interes,
        pro.id as pro_id
        FROM t_personas as per
        INNER JOIN t_prospectos AS pro ON pro.id_persona = per.id
        WHERE per.id = $this->intIdPers";
        $request = $this->select($sql);
        return $request;
    }

    public function updatePersona(string $nombre, string $apPat, string $apMat, string $tel_celular, string $email, int $pltInteres, int $nvlInteres, int $carrInteres, int $idPer, int $idPro)
    {
        $this->strNombrePers = $nombre;
        $this->strApePat = $apPat;
        $this->strApeMat = $apMat;
        $this->strTelCel = $tel_celular;
        $this->strEmail = $email;
        $this->intIdPltInte = $pltInteres;
        $this->intIdNvlCarrInte = $nvlInteres;
        $this->intIdCarrInte = $carrInteres;
        $this->intIdPers = $idPer;
        $this->intIdPros = $idPro;
        $request;
        $sql = "UPDATE t_personas SET nombre_persona = ?, ap_paterno = ?, ap_materno = ?, tel_celular = ?, email = ? WHERE id=$this->intIdPers";
        $sql2 = "UPDATE t_prospectos SET id_nivel_carrera_interes = ?, id_plantel_interes = ?, id_carrera_interes = ? WHERE id=$this->intIdPros";
        $arrData = array($this->strNombrePers, $this->strApePat, $this->strApeMat, $this->strTelCel, $this->strEmail);
        $arrData2 = array($this->intIdNvlCarrInte, $this->intIdPltInte, $this->intIdCarrInte);
        $rquestUpdate = $this->update($sql,$arrData);
        $requestUpdate2 = $this->update($sql2, $arrData2);
        $request['estatus'] = TRUE;
        return $request;
    }

    public function insertAgendaProspecto(int $idPersona, int $idUsuarioAtendidoAgenda, string $fechaPrograma, string $fechaRegistro, string $horaActualizacion, string $AsuntoLlamada, string $detalleLlamada){
        $request = "";
        $this->intIdPers = $idPersona;
        $this->intIdUsuarioAtendio = $idUsuarioAtendidoAgenda;
        $this->strFechaProgramada = $fechaPrograma;
        $this->strFechaRegistro = $fechaRegistro;
        $this->strHoraProgramada = $horaActualizacion;
        $this->strAsunto = $AsuntoLlamada;
        $this->intNotificacion = 0;
        $this->intEstatus = 1;
        $this->strDetalle = $detalleLlamada;
        $sql = "INSERT INTO t_agenda(fecha_registro, fecha_programada, hora_programada, asunto, detalle, notificacion, estatus, id_usuario_atendio, id_persona) VALUES(?,?,?,?,?,?,?,?,?)";
        $arrData = array($this->strFechaRegistro, $this->strFechaProgramada, $this->strHoraProgramada, $this->strAsunto, $this->strDetalle,$this->intNotificacion, $this->intEstatus, $this->intIdUsuarioAtendio, $this->intIdPers);
        $request = $this->insert($sql,$arrData);
        return $request;
    }

    public function selectEgresado(int $idCatPer, int $idPers)
    {
        $this->intIdCatPer = $idCatPer;
        $this->intIdPers = $idPers;
        $sql = "SELECT per.id, per.nombre_persona, per.ap_paterno, per.ap_materno, crr.nombre_carrera, per.nombre_empresa,
        avg(ins.promedio), plan.nombre_carrera
        FROM t_personas as per
        INNER JOIN t_carrera_interes as crr
        ON per.id_carrera_interes = crr.id
        INNER JOIN t_inscripciones as ins
        ON per.id = ins.id_personas
        INNER JOIN t_plan_estudios as plan
        ON ins.id_plan_estudios = plan.id
        WHERE id_categoria_persona = $this->intIdCarPer
        AND ins.id_personas = $this->intIdPers
        AND ins.tipo_ingreso = 'Reinscripcion'";
        $request = $this->select($sql);
        return $request;
    }

    public function selectPersonaSeguimiento(int $idPer)
    {
        $this->intIdPers = $idPer;
        $sql = "SELECT pe.id, CONCAT(pe.nombre_persona, ' ',pe.ap_paterno, ' ', pe.ap_materno) AS nombre_persona, pe.tel_celular,
        pe.email, mun.nombre AS municipio, est.nombre AS estado, CONCAT(pe2.nombre_persona, ' ', pe2.ap_paterno, ' ', pe2.ap_materno) as nombre_comisionista,
        pe2.tel_celular as tel_comisionista, pe.fecha_creacion, med.medio_captacion, nvl.nombre_nivel_educativo, crr.nombre_carrera, pros.id as id_pro
        FROM t_personas AS pe
        INNER JOIN t_localidades AS loc ON pe.id_localidad = loc.id
        INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
        INNER JOIN t_estados AS est ON mun.id_estados = est.id
        INNER JOIN t_prospectos AS pros ON pros.id_persona = pe.id
        INNER JOIN t_personas AS pe2 ON pe.id_usuario_creacion = pe2.id
        INNER JOIN t_medio_captacion AS med ON pros.id_medio_captacion = med.id
        INNER JOIN t_nivel_educativos AS nvl ON pros.id_nivel_carrera_interes = nvl.id
        LEFT JOIN t_carrera_interes AS crr ON pros.id_carrera_interes = crr.id
        WHERE pe.id = $this->intIdPers";
        $request = $this->select($sql);
        return $request;
    }

    //insertSeguimientoProspectoInd($intResp,$strComent,$intIdPro)
    public function insertSeguimientoProspectoInd(int $respuesta_rap, string $comentario, int $idPros)
    {
        $this->intRespRap = $respuesta_rap;
        $this->strComentario = $comentario;
        $this->intIdPros = $idPros;
        $this->intIdUsuario = $_SESSION['idUser'];
        $sql = "INSERT INTO t_seguimiento_prospecto(fecha_de_seguimiento,comentario,id_usuario_atendio,id_respuesta_rapida,id_prospecto) VALUES (NOW(), ?, ?, ? ,?)";
        $arrData = array($this->strComentario, $this->intIdUsuario, $this->intRespRap, $this->intIdPros);
        $request = $this->insert($sql,$arrData);
        return $request;
    }


    public function selectSeguimientoProspecto(int $idPer){
        $this->intIdPers = $idPer;
        $sql = "SELECT sp.fecha_de_seguimiento, sp.comentario, CONCAT(per2.nombre_persona, ' ', per2.ap_paterno,' ', per2.ap_materno) as nombre_asesor, resp.respuesta_rapida
        FROM t_seguimiento_prospecto AS sp
        LEFT JOIN t_prospectos AS p ON sp.id_prospecto = p.id
        INNER JOIN t_personas AS per ON p.id_persona = per.id
        INNER JOIN t_respuesta_rapida as resp ON sp.id_respuesta_rapida = resp.id
        INNER JOIN t_personas as per2 ON sp.id_usuario_atendio = per2.id
        WHERE per.id = $this->intIdPers
        ORDER BY fecha_de_seguimiento DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRespuestasRapidas(){
        $sql = "SELECT * FROM t_respuesta_rapida";
        $request = $this->select_all($sql);
        return $request;
    }

    public function insertProspecto(string $nombre, string $apellidoPa, string $apellidoMa, string $alias, string $edoCivil, string $ocupacion, string $fechaNacimiento, int $escolaridad, string $sexo, int $localidad,string $telcel, string $telFi, string $email, string $plantelProcedencia, int $plantelInteres, int $nivelEstudiosInteres, int $carreaInteres,int $medioCaptacion, string $comentario, int $idSubcampania ){

      $request = "";
      $requestIdPer = "";
      $requestPer = "";
      $requestPro = "";
      //<Datos Personales Prospecto>
      $this->strNombrePers = $nombre;
      $this->strApePat = $apellidoPa;
      $this->strApeMat = $apellidoMa;
      $this->strSexo = $sexo;
      $this->strAlias = $alias;
      $this->strEdoCivil = $edoCivil;
      $this->strOcupacion = $ocupacion;
      $this->strFechaNacimiento = $fechaNacimiento;
      $this->intEscolaridad = $escolaridad;
      //<Recidencia Prospecto>
      $this->intLocalidad = $localidad;
      //<Contacto>
      $this->strTelCel = $telcel;
      $this->strTelfijo = $telFi;
      $this->strEmail = $email;
      //<Prospecto>
      $this->strPlantelProcedencia = $plantelProcedencia;
      $this->intIdPltInte = $plantelInteres;
      $this->intIdNvlCarrInte = $nivelEstudiosInteres;
      $this->intIdCarrInte = $carreaInteres;
      //<medio_captacion Prospecto>
      $this->trComentario = $comentario;
      $this->intMedioCaptacion = $medioCaptacion;
      //<Otris Datos>
      $this->intIdUsuario = $_SESSION['idUser'];
      $this->intEstatus = 1;
      $this->intCatPer = 1;
      $this->intIdSubcampania = $idSubcampania;

      $sqlPersona = "INSERT INTO t_personas(nombre_persona, ap_paterno, ap_materno, alias, sexo, id_localidad, tel_celular, tel_fijo, email, id_categoria_persona, estatus, id_usuario_creacion, fecha_creacion, fecha_actualizacion, edo_civil, ocupacion, fecha_nacimiento, id_escolaridad) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, ?)";
      $arrData = array($this->strNombrePers, $this->strApePat, $this->strApeMat, $this->strAlias, $this->strSexo, $this->intLocalidad, $this->strTelfijo, $this->strTelCel, $this->strEmail, $this->intCatPer, $this->intIdUsuario, $this->intEstatus, $this->strEdoCivil, $this->strOcupacion, $this->strFechaNacimiento, $this->intEscolaridad);
      $requestPer = $this->insert($sqlPersona,$arrData);

      $sqlIdPer = "SELECT MAX(id) AS id FROM t_personas";
      $requestIdPer = $this->select($sqlIdPer);
      $this->intIdPers = $requestIdPer['id'];

      $sqlPros = "INSERT INTO t_prospectos(escuela_procedencia, id_plantel_interes, id_nivel_carrera_interes, id_carrera_interes, id_persona, id_medio_captacion, observaciones, id_subcampania) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
      $arrData2 = array($this->strPlantelProcedencia, $this->intIdPltInte, $this->intIdNvlCarrInte, $this->intIdCarrInte, $this->intIdPers, $this->intMedioCaptacion, $this->trComentario, $this->intIdSubcampania);
      $requestPro = $this->insert($sqlPros, $arrData2);
      return $requestPro;

    }

    public function selectEstados(){

      $sql = "SELECT * FROM t_estados";
      $request = $this->select_all($sql);
      return $request;

    }

    public function selectMunicipios($idEstado){

      $idEstado = $idEstado;
      $sql = "SELECT *FROM t_municipios WHERE id_estados = $idEstado";
      $request = $this->select_all($sql);
      return $request;

    }

    public function selectLocalidades($idMunicipio){

      $idMunicipio = $idMunicipio;
      $sql = "SELECT *FROM t_localidades WHERE id_municipio = $idMunicipio";
      $request = $this->select_all($sql);
      return $request;

    }

    public function selectMediosCaptacion(){

      $sql = "SELECT * FROM t_medio_captacion";
      $request = $this->select_all($sql);
      return $request;

    }

    public function selectEscolaridad(){
        $sql = "SELECT id, nombre_escolaridad FROM t_escolaridad";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCampania(){

      $sql = "SELECT id, nombre_campania FROM t_campanias WHERE id = (SELECT MAX(id) from t_campanias)";
      $request = $this->select_all($sql);
      return $request;

    }

    public function selectSubcampanaia(int $id){

      $this->intIdSubcampania = $id;
      $sql = "SELECT id, nombre_sub_campania, fecha_inicio, fecha_fin FROM t_subcampania WHERE id_campania = $this->intIdSubcampania";
      $request = $this->select_all($sql);
      return $request;

    }

}
