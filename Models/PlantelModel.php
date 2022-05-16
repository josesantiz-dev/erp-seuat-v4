<?php
	class PlantelModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		//Funcion para consultar lista de Categorias
		public function selectCategorias(string $nomConexion){
			$sql = "SELECT *FROM t_categoria_carreras";
			$request = $this->select_all($sql, $nomConexion);
			return $request;
		}
		//Funcion para consultar lista de Planteles
        public function selectPlanteles(string $nomConexion){
            $sql = "SELECT *FROM t_planteles WHERE estatus = 1 ORDER BY id DESC";
            $request = $this->select_all($sql, $nomConexion);
            return $request;
        }

		//Funcion para consultar Datos de un Plantel por ID
		public function selectPlantel(int $idPlantel, string $nomConexion){
			$sql = "SELECT *FROM t_planteles WHERE id = $idPlantel";
			$request = $this->select($sql, $nomConexion);
			return $request;
		}

		//Funcion para consultar Lista de Estados de Mexico
		public function selectEstados(string $nomConexion){
			$sql = "SELECT id,nombre FROM t_estados";
			$request = $this->select_all($sql, $nomConexion);
			return $request;
		}
		//Funcion para consultar Lista de Municipios por ID de Estado
		public function selectMunicipios($data, string $nomConexion){
			$sql = "SELECT id,nombre FROM t_municipios WHERE id_estados = $data";
			$request = $this->select_all($sql, $nomConexion);
			return $request;
		}
		//Funcion para consultar Lista de Localidades por ID de Municipio
		public function selectLocalidades($data, string $nomConexion){
			$sql = "SELECT *FROM t_localidades WHERE id_municipio = $data";
			$request = $this->select_all($sql, $nomConexion);
			return $request;
		}
		//Funcion para Insertar Nuevo Plantel
		public function insertPlantel($data,$files, string $nomConexion){
			$idUser = $_SESSION['idUser'];
			$idSistemaEducativo = $data['select_sistema_educativo'];
            $nombrePlantel = $data['txtNombrePlantelNuevo'];
            $abreviacionPlantel = $data['txtAbreviacionPlantelNuevo'];
            //$nombreSistema = $data['txtNombreSistemaNuevo'];
            //$abreviacionSistema = $data['txtAbreviacionSistemaNuevo'];
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
			$requestNomEstado = $this->select($sqlNomEstado, $nomConexion);
			$sqlNomMunicipio = "SELECT nombre FROM t_municipios WHERE id = $idMunicipio LIMIT 1";
			$requestNomMunicipio = $this->select($sqlNomMunicipio, $nomConexion);
			$sqlNomLocalidad = "SELECT nombre FROM t_localidades WHERE id = $idLocalidad LIMIT 1";
			$requestNomLocalidad = $this->select($sqlNomLocalidad, $nomConexion);


            $nombreImagenPlantel = time().'-'.$abreviacionPlantel . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImagePlantel"]["name"], PATHINFO_EXTENSION);
			//$nombreImagenSistema = time().'-'.$abreviacionSistema . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImageSistema"]["name"], PATHINFO_EXTENSION);
            $direccionLogos = 'Assets/images/logos/';
			$nombreImagenPlantelFile = $direccionLogos . basename($nombreImagenPlantel);
			//$nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema);
			$request = [];
			$sqlExist = "SELECT *FROM t_planteles WHERE cve_centro_trabajo = '$claveCentroTrabajo'";
			$requestExist = $this->select($sqlExist, $nomConexion);
			if($requestExist){
				$request['estatus'] = TRUE;
				$request['imagen'] = null;
			}else{
				if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile)){
                	$sqlNew = "INSERT INTO t_planteles(id_sistema,nombre_plantel, abreviacion_plantel,regimen, servicio, categoria, 
					cve_centro_trabajo, estado, municipio, localidad, domicilio, colonia, zona_escolar, cod_postal, latitud, longitud, 
					logo_plantel,cedula_funcionamiento, cve_institucion_dgp, estatus,
					fecha_creacion,id_usuario_creacion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
			    	$requestNew = $this->insert($sqlNew,$nomConexion,array($idSistemaEducativo,$nombrePlantel,$abreviacionPlantel,$regimen,$servicio,$idCategoria,
                        $claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
                        $nombreImagenPlantel,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser));
						$request['estatus'] = FALSE;
						$request['imagen'] = true;
            	}else{
					$request['estatus'] = FALSE;
					$request['imagen'] = false;
				}
			}
			return $request;
		}
		//Funcion para Actualizar un Plantel
		public function updatePlantel($idPlantelEdit,$data,$files, string $nomConexion){
			$idUser = $_SESSION['idUser'];
			$idSistemaEducativo = $data['select_sistema_educativo_edit'];
			$nombrePlantel = $data['txtNombrePlantelEdit'];
            $abreviacionPlantel = $data['txtAbreviacionPlantelEdit'];
            //$nombreSistema = $data['txtNombreSistemaEdit'];
            //$abreviacionSistema = $data['txtAbreviacionSistemaEdit'];
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
			$requestNomEstado = $this->select($sqlNomEstado, $nomConexion);
			$sqlNomMunicipio = "SELECT nombre FROM t_municipios WHERE id = $idMunicipio LIMIT 1";
			$requestNomMunicipio = $this->select($sqlNomMunicipio, $nomConexion);
			$sqlNomLocalidad = "SELECT nombre FROM t_localidades WHERE id = $idLocalidad LIMIT 1";
			$requestNomLocalidad = $this->select($sqlNomLocalidad, $nomConexion);

            $nombreImagenPlantel = time() .'-'.$abreviacionPlantel . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImagePlantel"]["name"], PATHINFO_EXTENSION);
			/* $nombreImagenSistema = time() .'-'.$abreviacionSistema . '-' . $requestNomEstado['nombre'] . '-' . $requestNomMunicipio['nombre']. '.' .pathinfo($files["profileImageSistema"]["name"], PATHINFO_EXTENSION); */
            $direccionLogos = 'Assets/images/logos/';
			$nombreImagenPlantelFile = $direccionLogos . basename($nombreImagenPlantel);
			/* $nombreImagenSistemaFile = $direccionLogos . basename($nombreImagenSistema); */

			$request = [];
			$sqlExist = "SELECT *FROM t_planteles WHERE cve_centro_trabajo = '$claveCentroTrabajo' AND id != $idPlantelEdit";
			$requestExist = $this->select($sqlExist, $nomConexion);
			if($requestExist){
				$request['estatus'] = TRUE;
				
			}else{
				if($files["profileImagePlantel"]["name"] == ""){
					$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,regimen = ?,servicio = ?,categoria = ?,
					cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
					logo_plantel = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? ,id_sistema = ? WHERE id = $idPlantelEdit";
					$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$regimen,$servicio,$idCategoria,
						$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
						$nombreImagenPlantel,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idSistemaEducativo));
					$request['estatus'] = FALSE;
				}else{
					if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile)){
						$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?, regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
						logo_plantel = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ?, id_sistema = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenPlantel,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idSistemaEducativo));
						$request['estatus'] = FALSE;
					}
				}
/* 
				if($files["profileImagePlantel"]["name"] == "" || $files["profileImageSistema"]["name"] == ""){
					if($files["profileImagePlantel"]["name"] != ""){
						if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile)){
							$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
						logo_plantel = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenPlantel,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
						}
					}else if($files["profileImageSistema"]["name"] != ""){
						if(move_uploaded_file($files["profileImageSistema"]["tmp_name"],$nombreImagenSistemaFile)){
							$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?,longitud = ?,
						logo_sistema = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenSistema,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
						}
					}else{
						$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
					cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?, longitud = ?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,
					estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
					$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
							$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,$cedulaFuncionamiento,$cveInstitucionDGP,
							1,$idUser,$idUser));
					}
				}else{
					if(move_uploaded_file($files["profileImagePlantel"]["tmp_name"],$nombreImagenPlantelFile) || 
					move_uploaded_file($files["profileImageSistema"]["tmp_name"],$nombreImagenSistemaFile)){
						$sqlUpdate = "UPDATE t_planteles SET nombre_plantel = ?,abreviacion_plantel = ?,nombre_sistema = ?,abreviacion_sistema = ?,regimen = ?,servicio = ?,categoria = ?,
						cve_centro_trabajo = ?,estado = ?,municipio = ?,localidad = ?,domicilio = ?,colonia = ?,zona_escolar = ?,cod_postal = ?,latitud = ?, longitud = ?,logo_plantel = ?,
						logo_sistema=?,cedula_funcionamiento = ?,cve_institucion_dgp = ?,estatus = ?,fecha_actualizacion = NOW(),id_usuario_creacion = ?,id_usuario_actualizacion = ? WHERE id = $idPlantelEdit";
						$requestUpdate = $this->update($sqlUpdate,$nomConexion,array($nombrePlantel,$abreviacionPlantel,$nombreSistema,$abreviacionSistema,$regimen,$servicio,$idCategoria,
								$claveCentroTrabajo,$requestNomEstado['nombre'],$requestNomMunicipio['nombre'],$requestNomLocalidad['nombre'],$domicilio,$colonia,$zonaEscolar,$codigoPostal,$latitud,$longitud,
								$nombreImagenPlantel,$nombreImagenSistema,$cedulaFuncionamiento,$cveInstitucionDGP,1,$idUser,$idUser));
					}
				}
				$request['estatus'] = FALSE; */
			}
			return $request;  	
		}
		public function deletePlantel(int $idPlantel, string $nomConexion){
			$sql = "SELECT * FROM t_planteles WHERE id = $idPlantel";
			$request = $this->select_all($sql, $nomConexion);
			if($request){
				$sql = "UPDATE t_planteles SET estatus = ? WHERE id = $idPlantel";
				$arrData = array(0);
				$request = $this->update($sql,$nomConexion,$arrData);
				if($request){
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}
		return $request;	
		}
		public function getTablasRef(string $nomConexion){
			$sqlTablasRef = "SELECT TABLE_NAME AS tablas FROM INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = '".conexiones[$nomConexion]['DB_NAME']."' AND REFERENCED_TABLE_NAME = 't_planteles'";
			$requestTablasRef = $this->select_all($sqlTablasRef, $nomConexion);
			return $requestTablasRef;
		}
		public function estatusRegistroTabla(string $nombreTabla,int $idPlantel, string $nomConexion){
			$sqlEstatusRegistro = "SELECT * FROM t_planteles
			RIGHT JOIN $nombreTabla ON $nombreTabla.id_plantel = t_planteles.id
			WHERE t_planteles.id = $idPlantel AND  $nombreTabla.estatus != 0";
			$requestEstatusRegistro = $this->select_all($sqlEstatusRegistro, $nomConexion);
			return $requestEstatusRegistro;
		}
		public function selectColumn(string $nombreTabla, string $nomConexion){
            $sql = "SHOW COLUMNS FROM $nombreTabla LIKE 'estatus'";
            $request = $this->select($sql, $nomConexion);
            return $request;
        }

		public function selectSistemasEducativos(string $nomConexion)
		{
			$sql = "SELECT *FROM t_sistemas_educativos WHERE estatus = 1";
			$request = $this->select_all($sql, $nomConexion);
			return $request;
		}

		public function selectSistemaEducativo(int $idSistema, string  $nomConexion)
		{
			$sql = "SELECT *FROM t_sistemas_educativos WHERE id = $idSistema LIMIT 1";
			$request = $this->select($sql,$nomConexion);
			return $request;
		}
	}
?>