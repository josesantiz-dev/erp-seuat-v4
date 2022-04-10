<?php
	class PlantelModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		//Funcion para consultar lista de Categorias
		public function selectCategorias(){
			$sql = "SELECT *FROM t_categoria_carreras";
			$request = $this->select_all($sql);
			return $request;
		}
		//Funcion para consultar lista de Planteles
        public function selectPlanteles(){
            $sql = "SELECT *FROM t_planteles WHERE estatus = 1 ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }

		//Funcion para consultar Datos de un Plantel por ID
		public function selectPlantel(int $idPlantel){
			$sql = "SELECT *FROM t_planteles WHERE id = $idPlantel";
			$request = $this->select($sql);
			return $request;
		}

		//Funcion para consultar Lista de Estados de Mexico
		public function selectEstados(){
			$sql = "SELECT id,nombre FROM t_estados";
			$request = $this->select_all($sql);
			return $request;
		}
		//Funcion para consultar Lista de Municipios por ID de Estado
		public function selectMunicipios($data){
			$sql = "SELECT id,nombre FROM t_municipios WHERE id_estados = $data";
			$request = $this->select_all($sql);
			return $request;
		}
		//Funcion para consultar Lista de Localidades por ID de Municipio
		public function selectLocalidades($data){
			$sql = "SELECT *FROM t_localidades WHERE id_municipio = $data";
			$request = $this->select_all($sql);
			return $request;
		}
		//Funcion para Insertar Nuevo Plantel
		public function insertPlantel($data,$files){
			$idUser = $_SESSION['idUser'];
            $nombrePlantel = $data['txtNombrePlantelNuevo'];
            $abreviacionPlantel = $data['txtAbreviacionPlantelNuevo'];
            $nombreSistema = $data['txtNombreSistemaNuevo'];
            $abreviacionSistema = $data['txtAbreviacionSistemaNuevo'];
            $regimen = $data['txtRegimenNuevo'];
            $servicio = $data['txtServicioNuevo'];
            $idCategoria = $data['txtCategoriaNuevo'];
            //$acuerdoIncorporacion = $data['txtAcuerdoIncorporacionNuevo'];
            $claveCentroTrabajo = $data['txtClaveCentroTrabajoNuevo'];
            $idEstado = $data['listEstadoNuevo'];
            $idMunicipio = $data['listMunicipioNuevo'];
            $idLocalidad = $data['listLocalidadNuevo'];
            $domicilio = $data['txtDomicilioNuevo'];
			$latitud = $data['txtLatitudNuevo'];
			$longitud = $data['txtLongitudNuevo'];
            $colonia = $data['txtColoniaNuevo'];
            $zonaEscolar = $data['txtZonaEscolarNuevo'];
            $codigoPostal = $data['txtCodigoPostalNuevo'];
			$cedulaFuncionamiento = $data['txtCedulaFuncionamientoNuevo'];
			//$cveDGP = $data['txtClaveDGPNuevo'];
			$cveInstitucionDGP = $data['txtClaveInstitucionDGPNuevo'];

			$sqlNomEstado = "SELECT nombre FROM t_estados WHERE id = $idEstado LIMIT 1";
			$requestNomEstado = $this->select($sqlNomEstado);
			$sqlNomMunicipio = "SELECT nombre FROM t_municipios WHERE id = $idMunicipio LIMIT 1";
			$requestNomMunicipio = $this->select($sqlNomMunicipio);
			$sqlNomLocalidad = "SELECT nombre FROM t_localidades WHERE id = $idLocalidad LIMIT 1";
			$requestNomLocalidad = $this->select($sqlNomLocalidad);


            $nombreImagenPlantel = time().'-'.$abreviacionPlantel . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImagePlantel"]["name"], PATHINFO_EXTENSION);
			$nombreImagenSistema = time().'-'.$abreviacionSistema . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImageSistema"]["name"], PATHINFO_EXTENSION);
            $direccionLogos = 'Assets/images/logos/';
			$nombreImagenPlantelFile = $direccionLogos . basename($nombreImagenPlantel);
			$nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema);
			$request;
			$sqlExist = "SELECT *FROM t_planteles WHERE cve_centro_trabajo = '$claveCentroTrabajo'";
			$requestExist = $this->select($sqlExist);
			if($requestExist){
				$request['estatus'] = TRUE;
			}else{
				if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile) && 
					move_uploaded_file($files["profileImageSistema"]["tmp_name"],$nombreImagenSistemaFile)){
                	$sqlNew = "INSERT INTO t_planteles(nombre_plantel, abreviacion_plantel, nombre_sistema, abreviacion_sistema, regimen, servicio, categoria, 
					cve_centro_trabajo, estado, municipio, localidad, domicilio, colonia, zona_escolar, cod_postal, latitud, longitud, 
					logo_plantel, logo_sistema, cedula_funcionamiento, cve_institucion_dgp, estatus,
					fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion) VALUES(?,?,?,?,?,?,?,?,?,
                    	?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?)";
			    	$requestNew = $this->insert($sqlNew,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
                        $claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
                        $nombreImagenPlantel,$nombreImagenSistema,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
            	}
				$request['estatus'] = FALSE;
			}
			return $request;
		}
		//Funcion para Actualizar un Plantel
		public function updatePlantel($idPlantelEdit,$data,$files){
			$idUser = $_SESSION['idUser'];
			$nombrePlantel = $data['txtNombrePlantelEdit'];
            $abreviacionPlantel = $data['txtAbreviacionPlantelEdit'];
            $nombreSistema = $data['txtNombreSistemaEdit'];
            $abreviacionSistema = $data['txtAbreviacionSistemaEdit'];
            $regimen = $data['txtRegimenEdit'];
            $servicio = $data['txtServicioEdit'];
            $idCategoria = $data['txtCategoriaEdit'];
            //$acuerdoIncorporacion = $data['txtAcuerdoIncorporacionEdit'];
            $claveCentroTrabajo = $data['txtClaveCentroTrabajoEdit'];
            $idEstado = $data['listEstadoEdit'];
            $idMunicipio = $data['listMunicipioEdit'];
            $idLocalidad = $data['listLocalidadEdit'];
            $domicilio = $data['txtDomicilioEdit'];
            $colonia = $data['txtColoniaEdit'];
            $zonaEscolar = $data['txtZonaEscolarEdit'];
            $codigoPostal = $data['txtCodigoPostalEdit'];
			$latitud = $data['txtLatitudEdit'];
			$longitud = $data['txtLongitudEdit'];
			$cedulaFuncionamiento = $data['txtCedulaFuncionamientoEdit'];
			//$cveDGP = $data['txtClaveDGPEdit'];
			$cveInstitucionDGP = $data['txtClaveInstitucionDGPEdit'];

        
			$sqlNomEstado = "SELECT nombre FROM t_estados WHERE id = $idEstado LIMIT 1";
			$requestNomEstado = $this->select($sqlNomEstado);
			$sqlNomMunicipio = "SELECT nombre FROM t_municipios WHERE id = $idMunicipio LIMIT 1";
			$requestNomMunicipio = $this->select($sqlNomMunicipio);
			$sqlNomLocalidad = "SELECT nombre FROM t_localidades WHERE id = $idLocalidad LIMIT 1";
			$requestNomLocalidad = $this->select($sqlNomLocalidad);

            $nombreImagenPlantel = time() .'-'.$abreviacionPlantel . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImagePlantel"]["name"], PATHINFO_EXTENSION);
			$nombreImagenSistema = time() .'-'.$abreviacionSistema . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImageSistema"]["name"], PATHINFO_EXTENSION);
            $direccionLogos = 'Assets/images/logos/';
			$nombreImagenPlantelFile = $direccionLogos . basename($nombreImagenPlantel);
			$nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema);

			$request;
			$sqlExist = "SELECT *FROM t_planteles WHERE cve_centro_trabajo = '$claveCentroTrabajo' AND id != $idPlantelEdit";
			$requestExist = $this->select($sqlExist);
			if($requestExist){
				$request['estatus'] = TRUE;
			}else{
				if($files["profileImagePlantel"]["name"] == "" || $files["profileImageSistema"]["name"] == ""){
					if($files["profileImagePlantel"]["name"] != ""){
						if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile)){
							$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
						logo_plantel = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenPlantel,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
						}
					}else if($files["profileImageSistema"]["name"] != ""){
						if(move_uploaded_file($files["profileImageSistema"]["tmp_name"],$nombreImagenSistemaFile)){
							$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
						logo_sistema = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenSistema,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
						}
					}else{
						$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
					cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?, longitud = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,
					estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
					$requestUpdate = $this->update($sqlUpdate,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
							$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,$cedulaFuncionamiento,$cveInstitucionDGP,
							1,$idUser,$idUser));
					}
				}else{
					if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile) || 
					move_uploaded_file($files["profileImageSistema"]["tmp_name"],$nombreImagenSistemaFile)){
						$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?, longitud = ?,logo_plantel = ?,
						logo_sistema=?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantel";
						$requestUpdate = $this->update($sqlUpdate,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenPlantel,$nombreImagenSistema,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
					}
				}
				$request['estatus'] = FALSE;
			}
			return $request;  	
		}
		public function deletePlantel(int $idPlantel){
			$sql = "SELECT * FROM t_planteles WHERE id = $idPlantel";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_planteles SET estatus = ? WHERE id = $idPlantel";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request){
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}
		return $request;	
		}
		public function getTablasRef(){
			$sqlTablasRef = "SELECT TABLE_NAME AS tablas FROM INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS WHERE REFERENCED_TABLE_NAME = 't_planteles'";
			$requestTablasRef = $this->select_all($sqlTablasRef);
			return $requestTablasRef;
		}
		public function estatusRegistroTabla(string $nombreTabla,int $idPlantel){
			$sqlEstatusRegistro = "SELECT * FROM t_planteles
			RIGHT JOIN $nombreTabla ON $nombreTabla.id_plantel = t_planteles.id
			WHERE t_planteles.id = $idPlantel AND  $nombreTabla.estatus != 0";
			$requestEstatusRegistro = $this->select_all($sqlEstatusRegistro);
			return $requestEstatusRegistro;
		}
		public function selectColumn(string $nombreTabla){
            $sql = "SHOW COLUMNS FROM $nombreTabla LIKE 'estatus'";
            $request = $this->select($sql);
            return $request;
        }
	}
?>