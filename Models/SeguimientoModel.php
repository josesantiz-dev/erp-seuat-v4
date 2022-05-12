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
    public $strPltInteres; //$intPlantelInteresP
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
    public $nomConx;
    private $strUser;
    private $strPass;


    public function __construct(){
        parent::__construct();
    }

    public function loginSesion(string $usr, string $pass, string $plnt)
    {
        $this->strUser = $usr;
        $this->strPass = $pass;
        $this->nomConx = $plnt;
        $sql = "SELECT id,estatus FROM t_usuarios WHERE nickname = '$this->strUser' and 
		password = '$this->strPass' and estatus != 0 ";
        $request = $this->select($sql, $this->nomConx);
        return $request;
    }

    public function selectMedioCaptacion(string $nomConexion)
    {
        $sql = "SELECT * FROM t_medio_captacion";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectPlanteles(string $nomConexion){
        $sql = "SELECT id, nombre_plantel FROM t_planteles";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectNivelInteres(string $nomConexion){
        $sql = "SELECT id, nombre_nivel_educativo FROM t_nivel_educativos";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectCarreraInteres(string $nomConexion)
    {
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectCarrera($idNivel,string $nomConexion){
        $idNvl = $idNivel;
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes WHERE id_nivel_educativo = $idNvl";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectProspectos(string $nomConexion){
        $sql = "SELECT pe.id, CONCAT(pe.nombre_persona, ' ', pe.ap_paterno, ' ', pe.ap_materno) as nombre_completo, cat_per.nombre_categoria, pe.alias,
        pe.tel_celular, pros.plantel_interes, crr_int.nombre_carrera, med.medio_captacion
        FROM t_personas as pe
        INNER JOIN t_asignacion_categoria_persona as asig_cat ON asig_cat.id_persona = pe.id 
        INNER JOIN t_categoria_personas as cat_per ON asig_cat.id_categoria_persona = cat_per.id 
        INNER JOIN t_prospectos as pros ON pros.id_persona = pe.id
        INNER JOIN t_carrera_interes as crr_int ON pros.id_carrera_interes = crr_int.id 
        INNER JOIN t_medio_captacion as med ON pros.id_medio_captacion = med.id
        WHERE pe.estatus != 0 AND asig_cat.id_categoria_persona = 1 OR asig_cat.id_categoria_persona = 5
        ORDER BY pe.id DESC";
        $request = $this->select_all($sql, $nomConexion);
        return $request;
    }

    public function selectPlantelInteres(int $id, string $nomConexion)
    {
        $this->intIdPltInte = $id;
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes WHERE id_nivel_carrera = $this->intIdPltInte";
        $request = $this->select($sql,$nomConexion);
        return $request;
    }

    public function selectProspecto(int $id,string $nomConexion){
        $this->intIdPers = $id;
        $sql = "SELECT per.id as per_id, per.nombre_persona, per.ap_paterno, per.ap_materno,
        per.tel_celular,
        per.email,
        pro.plantel_interes,
        pro.id_nivel_carrera_interes,
        pro.id_carrera_interes,
        pro.id as pro_id
        FROM t_personas as per
        INNER JOIN t_prospectos AS pro ON pro.id_persona = per.id
        WHERE per.id = $this->intIdPers";
        $request = $this->select($sql,$nomConexion);
        return $request;
    }

    public function updatePersona(string $nombre, string $apPat, string $apMat, string $tel_celular, string $email, string $pltInteres, int $nvlInteres, int $carrInteres, int $idPro, int $idPer, int $idUsr, string $nomConexion)
    {
        $this->strNombrePers = $nombre;
        $this->strApePat = $apPat;
        $this->strApeMat = $apMat;
        $this->strTelCel = $tel_celular;
        $this->strEmail = $email;
        $this->intIdPltInte = $pltInteres;
        $this->intIdNvlCarrInte = $nvlInteres;
        $this->intIdCarrInte = $carrInteres;
        $this->intIdUsuario = $idUsr;
        $this->intIdPers = $idPer;
        $this->intIdPros = $idPro;
        $request;
        $sql = "UPDATE t_personas SET nombre_persona = ?, ap_paterno = ?, ap_materno = ?, tel_celular = ?, email = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id=$this->intIdPers";
        $sql2 = "UPDATE t_prospectos SET id_nivel_carrera_interes = ?, plantel_interes = ?, id_carrera_interes = ? WHERE id=$this->intIdPros";
        $arrData = array($this->strNombrePers, $this->strApePat, $this->strApeMat, $this->strTelCel, $this->strEmail, $this->intIdUsuario);
        $arrData2 = array($this->intIdNvlCarrInte, $this->intIdPltInte, $this->intIdCarrInte);
        $rquestUpdate = $this->update($sql,$nomConexion,$arrData);
        $requestUpdate2 = $this->update($sql2, $nomConexion, $arrData2);
        $request['estatus'] = TRUE;
        return $request;
    }

    public function insertAgendaProspecto(int $idPersona, int $idUsuarioAtendidoAgenda, string $fechaPrograma, string $fechaRegistro, string $horaActualizacion, string $AsuntoLlamada, string $detalleLlamada,string $nomConexion){
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
        $request = $this->insert($sql,$nomConexion, $arrData);
        return $request;
    }

    public function selectEgresado(int $idCatPer, int $idPers, string $nomConexion)
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
        $request = $this->select($sql,$nomConexion);
        return $request;
    }

    public function selectPersonaSeguimiento(int $idPer,string $nomConexion)
    {
        $this->intIdPers = $idPer;
        $sql = "SELECT pe.id, CONCAT(pe.nombre_persona, ' ',pe.ap_paterno, ' ', pe.ap_materno) AS nombre_persona, pe.tel_celular,
        pe.email, mun.nombre AS municipio, est.nombre AS estado, CONCAT(pe2.nombre_persona, ' ', pe2.ap_paterno, ' ', pe2.ap_materno) as nombre_comisionista, pe2.tel_celular as tel_comisionista, pe.fecha_creacion, med.medio_captacion, nvl.nombre_nivel_educativo, crr.nombre_carrera, pros.id as id_pro
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
        $request = $this->select($sql,$nomConexion);
        return $request;
    }

    public function insertSeguimientoProspectoInd(int $respuesta_rap, string $comentario, int $idPros, string $nomConexion)
    {
        $this->intRespRap = $respuesta_rap;
        $this->strComentario = $comentario;
        $this->intIdPros = $idPros;
        $this->intIdUsuario = $_SESSION['idUser'];
        $sql = "INSERT INTO t_seguimiento_prospecto(fecha_de_seguimiento,comentario,id_usuario_atendio,id_respuesta_rapida,id_prospecto) VALUES (NOW(), ?, ?, ? ,?)";
        $arrData = array($this->strComentario, $this->intIdUsuario, $this->intRespRap, $this->intIdPros);
        $request = $this->insert($sql,$nomConexion,$arrData);
        return $request;
    }


    public function selectSeguimientoProspecto(int $idPer,string $nomConexion){
        $this->intIdPers = $idPer;
        $sql = "SELECT DATE_FORMAT(sp.fecha_de_seguimiento,'%d-%m-%Y') AS fecha_de_seguimiento, sp.comentario, CONCAT(per2.nombre_persona, ' ', per2.ap_paterno,' ', per2.ap_materno) as nombre_asesor, resp.respuesta_rapida
        FROM t_seguimiento_prospecto AS sp
        LEFT JOIN t_prospectos AS p ON sp.id_prospecto = p.id
        INNER JOIN t_personas AS per ON p.id_persona = per.id
        INNER JOIN t_respuesta_rapida as resp ON sp.id_respuesta_rapida = resp.id
        INNER JOIN t_personas as per2 ON sp.id_usuario_atendio = per2.id
        WHERE per.id = $this->intIdPers
        ORDER BY fecha_de_seguimiento DESC;";
        $request = $this->select_all($sql, $nomConexion);
        return $request;
    }

    public function selectRespuestasRapidas(string $nomConexion){
        $sql = "SELECT * FROM t_respuesta_rapida";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function insertProspecto(string $nom, string $apeP, string $apeM, string $ali, string $edo_civil, string $ocup, string $fecha_nac, int $escol, int $ed, string $sex, int $loc, string $telc, string $telf, string $correo, string $plantProc, string $plantInt, int $nivelInt, int $carrInt, int $med, string $coment, int $idSub, int $idUsr, string $nomConexion)
    {
        $this->strNombrePers = $nom;
        $this->strApePat = $apeP;
        $this->strApeMat = $apeM;
        $this->strAlias = $ali;
        $this->strEstadoCivil = $edo_civil;
        $this->strOcupacion = $ocup;
        $this->strFechaNacimiento = $fecha_nac;
        $this->intEscolaridad = $escol;
        $this->intEdad = $ed;
        $this->strSexo = $sex;
        $this->intLocalidad = $loc;
        $this->strTelCel = $telc;
        $this->strTelfijo = $telf;
        $this->strEmail = $correo;
        $this->strPltInteres = $plantInt;
        $this->strPlantelProcedencia = $plantProc;
        $this->intIdNvlCarrInte = $nivelInt;
        $this->intIdCarrInte = $carrInt;
        $this->intMedioCaptacion = $med;
        $this->strComentario = $coment;
        $this->intIdUsuario = $idUsr;
        $this->intIdSubcampania = $idSub;
        $this->nomConx = $nomConexion;

        $sqlPersona = "INSERT INTO t_personas(nombre_persona, ap_paterno, ap_materno, sexo, alias, edad, edo_civil, ocupacion, id_escolaridad,fecha_nacimiento, estatus, id_localidad, tel_celular, tel_fijo, email, fecha_creacion, id_usuario_creacion, id_rol) 
        VALUES(?,?,?,?,?,?,?,?,?,?,1,?,?,?,?,NOW(),?,1)";
        $arrPersona = array($this->strNombrePers,$this->strApePat,$this->strApeMat,$this->strSexo,$this->strAlias, $this->intEdad,$this->strEstadoCivil, $this->strOcupacion, $this->intEscolaridad,$this->strFechaNacimiento,$this->intLocalidad,$this->strTelCel,$this->strTelfijo, $this->strEmail,$this->intIdUsuario);
        $requestPersona = $this->insert($sqlPersona,$this->nomConx,$arrPersona);
        if($requestPersona)
        {
            $idPersona = $requestPersona;
            $sqlAsignacion = "INSERT INTO t_asignacion_categoria_persona(fecha_alta,validacion_datos_personales,validacion_doctos,estatus,fecha_creacion,id_usuario_creacion,id_persona,id_categoria_persona) values(NOW(),0,0,1,NOW(),?,?,1)";
            $arrDataAsig = array($this->intIdUsuario, $idPersona);
            $requestAsig = $this->insert($sqlAsignacion,$this->nomConx,$arrDataAsig);
            if($requestAsig)
            {
                $sqlProspecto = "INSERT INTO t_prospectos(escuela_procedencia,observaciones, plantel_interes,id_nivel_carrera_interes,id_carrera_interes,id_medio_captacion,id_persona) VALUES(?,?,?,?,?,?,?)";
                $arrDataProspecto = array($this->strPlantelProcedencia, $this->strComentario, $this->strPltInteres, $this->intIdNvlCarrInte, $this->intIdCarrInte, $this->intMedioCaptacion, $idPersona);
                $requestProspecto = $this->insert($sqlProspecto,$this->nomConx,$arrDataProspecto);
            }
        }
        return $requestProspecto;
    }

    

    public function selectEstados(string $nomConexion){

        $sql = "SELECT * FROM t_estados";
        $request = $this->select_all($sql,$nomConexion);
        return $request;

    }

    public function selectMunicipios(int $idEstado,string $nomConexion){

        $idEstado = $idEstado;
        $sql = "SELECT *FROM t_municipios WHERE id_estados = $idEstado";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectLocalidades($idMunicipio, string $nomConexion){

        $idMunicipio = $idMunicipio;
        $sql = "SELECT *FROM t_localidades WHERE id_municipio = $idMunicipio";
        $request = $this->select_all($sql,$nomConexion);
        return $request;

    }

    public function selectMediosCaptacion(string $nomConexion){

        $sql = "SELECT * FROM t_medio_captacion";
        $request = $this->select_all($sql,$nomConexion);
        return $request;

    }

    public function selectEscolaridad(string $nomConexion){
        $sql = "SELECT id, nombre_escolaridad FROM t_escolaridad";
        $request = $this->select_all($sql,$nomConexion);
        return $request;
    }

    public function selectCampania(string $nomConexion){

        $sql = "SELECT id, nombre_campania FROM t_campanias WHERE id = (SELECT MAX(id) from t_campanias)";
        $request = $this->select_all($sql,$nomConexion);
        return $request;

    }

    public function selectSubcampania(string $nomConexion){
        $sql = "SELECT * FROM t_subcampania WHERE estatus = 1 ORDER BY fecha_fin DESC LIMIT 1";
        $request = $this->select($sql,$nomConexion);
        return $request;
    }

}
