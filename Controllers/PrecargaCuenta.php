<?php
	class PrecargaCuenta extends Controllers{

		private $idUser;
		private $nomConexion;
		private $rol;

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			$this->idUser = $_SESSION['idUser'];
			$this->nomConexion = $_SESSION['nomConexion'];
			// $this->rol = $_SESSION['claveRol'];
		}
		//Funcion para la Vista de Planteles
		public function precargacuenta()
		{
			$data['page_tag'] = "Precarga cuenta";
			$data['page_title'] = "Precarga cuenta";
			$data['page_name'] = "Precarga cuenta";
			$data['page_content'] = "";
            $data['planteles'] = $this->model->selectPlanteles($this->nomConexion);
			// $data['niveles'] = $this->model->selectNiveles($this->nomConexion);
            $data['periodos'] = $this->model->selectPeriodos($this->nomConexion);
            $data['grados'] = $this->model->selectGrados($this->nomConexion);
			$data['page_functions_js'] = "functions_precarga_cuenta.js";
			$this->views->getView($this,"precargaCuenta",$data);
		}
        public function getPlanEstudios($arrgs){
			$args = explode(",",$arrgs);
			$idPlantel = $args[0];
			// $idNivel = $args[1];
            $idNivel = intval($args[1]);
            if($idPlantel == 'Todos'){
				if($idNivel == 'null'){
					$arrData = $this->model->selectPlanEstudios($this->nomConexion);
				}else{
					$arrData = $this->model->selectPlanEstudiosByNivel($idNivel,$this->nomConexion);
				}
            }
			else{
                $idPlantel = intval($idPlantel);
				if($idNivel == 'null' || $idNivel == 'Todos'){
					$arrData = $this->model->selectPlanEstudiosByPlantel($idPlantel,$this->nomConexion);
				}
				else{
					$arrData = $this->model->selectPlanEstudiosByPlantelNivel($idPlantel,$idNivel,$this->nomConexion);
				}
            }
            for($i = 0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = "<button type='button' class='btn btn-primary btn-xs center' onclick='fnSeleccionarPlanEstudios(".$arrData[$i]['id_plantel'].",".$arrData[$i]['id'].")'>Seleccionar</button>";
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		
        public function getServicios(int $idPlantel){
            $idPlantel = intval($idPlantel);
            $arrData = $this->model->selectServicios($idPlantel,$this->nomConexion);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

		public function getNivelesByPlantel($idPlantel){
			if($idPlantel == 'Todos'){
				$arrData = $this->model->seletNiveles($this->nomConexion);
			}else{
				$idPlantel = intval($idPlantel);
				$arrData = $this->model->selectNivelesByPlantel($idPlantel,$this->nomConexion);
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setPrecarga($args){
			$params = explode(",",$args);
			$idPlantel = intval($params[0]);
			$idPlanEstudios = $params[1];
			$idNivel = intval($params[2]);
			$idPeriodo = intval($params[3]);
			$idGrado = intval($params[4]);
			$idServicio = intval($params[5]);
            $precioNuevo = $params[6];
            $fechaLimitePago = $params[7];
            if(empty($idPlantel) && empty($idPlanEstudios) && empty($idNivel) && empty($idPeriodo) && empty($idGrado) && empty($idServicio) ){
                $arrResponse = array('estatus' => false, 'msg' => 'Error en los datos.');
            }else{
                $arrData = $this->model->insertPrecargaCuenta($idPlantel,$idPlanEstudios,$idNivel,$idPeriodo,$idGrado,$idServicio,$precioNuevo,$fechaLimitePago,$_SESSION['idUser'],$this->nomConexion);
                $option = 1;
            }
            if($arrData > 0)
            {
                if($option == 1)
                    {
                        // $arrResponse = true;
                        $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
                    }
                
            }else if($arrData == 'exist'){

                $arrResponse = array('estatus' => false, 'msg' => 'La precarga ya existe.');
            }else{
                $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
            }
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}


        // public function setPrecarga($args){
		// 	$params = explode(",",$args);
		// 	$idPlantel = intval($params[0]);
		// 	$idPlanEstudios = $params[1];
		// 	$idNivel = intval($params[2]);
		// 	$idPeriodo = intval($params[3]);
		// 	$idGrado = intval($params[4]);
		// 	$idServicio = intval($params[5]);
        //     $precioNuevo = $params[6];
        //     $fechaLimitePago = $params[7];
        //     if(empty($idPlantel) && empty($idPlanEstudios) && empty($idNivel) && empty($idPeriodo) && empty($idGrado) && empty($idServicio) && empty($precioNuevo) && empty($fechaLimitePago)){
        //         $arrResponse = array('estatus' => false, 'msg' => 'Error en los datos.');
        //     }else{
        //         $arrData = $this->model->insertPrecargaCuenta($idPlantel,$idPlanEstudios,$idNivel,$idPeriodo,$idGrado,$idServicio,$precioNuevo,$fechaLimitePago,$_SESSION['idUser'],$this->nomConexion);
        //         if($arrData){
        //             $arrResponse = true;
        //         }else{
        //             $arrResponse = false;
        //         }
        //     }
		// 	echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		// 	die();
		// }

		public function getServiciosByInput($valueInput){
			$input = strClean($valueInput);
			if($input != ""){
				$arrData = $this->model->selectServiciosByInput($input,$this->nomConexion);
				for($i = 0; $i<count($arrData); $i++){
					$arrData[$i]['numeracion'] = $i+1;
					$arrData[$i]['precio'] = '$'.formatoMoneda($arrData[$i]['precio_unitario']);
					$arrData[$i]['options'] = '<button type="button" class="btn btn-primary btn-xs" n="'.$arrData[$i]['nombre_servicio'].'" c="'.$arrData[$i]['codigo_servicio'].'" onclick="fnSeleccionarServicio(this,'.$arrData[$i]['id'].','.$arrData[$i]['precio_unitario'].')">Agregar</button>';
				}
			}else{
				// $arrData = null; estaba antes
				$arrData = true;
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		//PARA ENLISTAR TODAS LAS PRECARGAS
        public function getPrecargas(){
            $arrData = $this->model->selectPrecargas($this->nomConexion);
            for($i=0; $i < count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                if($arrData[$i]['est'] == 1){
                    $arrData[$i]['est'] = '<span class="badge badge-dark">Activo</span>';
                }else{
                    $arrData[$i]['est'] = '<span class="badge badge-secondary">Inactivo</span>';
                }
                $arrData[$i]['options'] = '
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalonesComp" onClick="fntEditPrecargaCuentas(this,'.$arrData[$i]['idPre'].')" title="Editar"> &nbsp;&nbsp;
                                                        <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalonesComp" onClick="fntDelPrecargaCuentas('.$arrData[$i]['idPre'].')" title="Eliminar"> &nbsp;&nbsp;
                                                        <i class="far fa-trash-alt "></i> &nbsp; Eliminar
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

		//EDITAR PRECARGA
        public function getPrecargaCuenta($id){
            $intIdPrecarga = intval(strClean($id));
            if($intIdPrecarga > 0)
            {
                $arrData = $this->model->selectPrecargaCuenta($intIdPrecarga, $this->nomConexion);
                if(empty($arrData))
                {
                    $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('estatus' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


		//PARA ACTUALIZAR PRECARGA CUENTA
        public function setPrecargaCuentas_up()
        {
			// dep($_POST);
            if($_POST)
            {
                if(empty($_POST['intNuevo_precio_precarg_edit']) || empty($_POST['txtFecha_limite_pago_pre_edit']) || 
					empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']))
                {
                    $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $intIdPrecargaCuenta = intval($_POST['intId_precarga_edit']);
                    // $strPrecioActual = strClean($_POST['txtPrecio_actual_precarg_edit']);
					$intNuevoPrecio = intval($_POST['intNuevo_precio_precarg_edit']);
					$strFechaLimCobro = strClean($_POST['txtFecha_limite_pago_pre_edit']);
                    $intEstatus = intval($_POST['listEstatusUp']);
                    $strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
                    $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
                    $request_Precarga_cuenta = "";

                    if($intIdPrecargaCuenta <> 0)
                    {
                        $request_Precarga_cuenta = $this->model->updatePrecargaCuentas($intIdPrecargaCuenta,
                                                                                //    $strPrecioActual,
																				   $intNuevoPrecio,
																				   $strFechaLimCobro,
                                                                                   $intEstatus,
                                                                                   $strFecha_Actualizacion,
                                                                                   $intId_Usuario_Actualizacion,
                                                                                   $this->nomConexion);
                                                                                   $option = 1;
                    }

                    if($request_Precarga_cuenta > 0 )
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
                        }
                    }else{
                        $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


		//PARA ELIMINAR PRECARGA
        public function delPrecargaCuenta(){
            if($_POST)
            {
                $intIdPrecargaCuenta = intval($_POST['idPre']);
                $requestDelete = $this->model->deletePrecargaCuenta($intIdPrecargaCuenta, $this->nomConexion);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el precarga correctamente.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una precarga asociado a un estado de cuenta activo.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el precarga.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

	}
?>