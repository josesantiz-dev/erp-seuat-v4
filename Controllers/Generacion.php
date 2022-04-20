<?php
  class Generacion extends Controllers{

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

    public function Generacion()
    {
        $data['page_tag'] = "Generaciones";
        $data['page_name'] = "Generaciones";
        $data['page_title'] = "Generaciones";
        $data['page_functions_js'] = "functions_generaciones.js";
        $this->views->getView($this, "generacion", $data);
    }


    //PARA ENLISTAR TODOS LOS USUARIOS EN LA TABLA VISTA
    public function getGeneraciones(){
        $arrData = $this->model->selectGeneraciones($this->nomConexion);
        for($i=0; $i < count($arrData); $i++){
          // $arrData[$i]['id_guardado'] = $arrData[$i]['id'];
          // $arrData[$i]['id'] = $i+1;
          $arrData[$i]['numeracion'] = $i+1;
          if($arrData[$i]['est'] == 1){
            $arrData[$i]['est'] = '<span class="badge badge-dark">Activo</span>';
          }else{
            $arrData[$i]['est']= '<span class="badge badge-secondary">Inactivo</span>';
          }
          $arrData[$i]['options'] = '
                                      <div class="text-center">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                          </button>
                                          <div class="dropdown-menu">
                                            <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditGeneracion" onClick="fntEditGeneraciones(this,'.$arrData[$i]['idGen'].')" title="Editar"> &nbsp;&nbsp;
                                              <i class="fas fa-pencil-alt"></i> &nbsp; Editar
                                            </button>
                                          <div class="dropdown-divider"></div>
                                            <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelGeneracion" onClick="fntDelGeneraciones('.$arrData[$i]['idGen'].')" title="Eliminar"> &nbsp;&nbsp;
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


    //EDITAR
    public function getGeneracion($id){
        $intIdGeneraciones = intval(strClean($id)); //intval(strClean($idrol));
        if($intIdGeneraciones > 0)
        {
          $arrData = $this->model->selectGeneracion($intIdGeneraciones,$this->nomConexion);
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


    //PARA GUARADAE DATOS
    public function setGeneracion(){
      if($_POST){

              /* dep($_POST); */
        if(empty($_POST['txtNombre_Generacion']) || empty($_POST['txtFecha_inicio']) || empty($_POST['txtFecha_fin']) || 
           empty($_POST['listEstatus'])  || empty($_POST['txtId_usuario_creacion']))
          {
            $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
          }else{

            $intIdGeneraciones = intval($_POST['idGeneraciones']);
            $strNombre_Generacion =  strClean($_POST['txtNombre_Generacion']);
            $strFecha_inicio = strClean($_POST['txtFecha_inicio']);
            $strFecha_fin = strClean($_POST['txtFecha_fin']);
            $intEstatus = intval($_POST['listEstatus']);
            $intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
            $intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_Actualizacion']);
            $strFecha_Creacion = strClean($_POST['txtFecha_Creacion']);
            $strFecha_Actualizacion = strClean($_POST['txtFecha_Actualizacion']);

            if($intIdGeneraciones == 0)
            {
                
              $request_generacion = $this->model->insertGeneracion($strNombre_Generacion, 
                                                                              $strFecha_inicio, 
                                                                              $strFecha_fin, 
                                                                              $intEstatus,
                                                                              $intId_usuario_creacion,
                                                                              $intId_Usuario_Actualizacion,
                                                                              $strFecha_Creacion,
                                                                              $strFecha_Actualizacion, $this->nomConexion);
                                                                              $option = 1;
            } 

            if($request_generacion > 0 )
            {
              if($option == 1)
              {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
              }
            }else if($request_generacion == 'exist'){
                
              $arrResponse = array('estatus' => false, 'msg' => '¡Atención! La generación ya existe.');
            }else{
              $arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
            }
          }
          echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
          
      }
      die();
    }


    //PARA ACTUALIZAR DATOS
    public function setGeneraciones_up()
			{
				if($_POST)
				{ //dep ($_POST); die();
				//if($_SESSION['permisosMod']['w']){
						if(empty($_POST['txtNombre_GeneracionUp']) || empty($_POST['txtFecha_inicioUp']) || empty($_POST['txtFecha_finUp']) || empty($_POST['listEstatusUp']) || empty($_POST['txtId_Usuario_ActualizacionUp']))
						{
							$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
						}else{
							$intIdGeneraciones = intval($_POST['idGeneracionesUp']);
							$strNombre_Generacion =  strClean($_POST['txtNombre_GeneracionUp']);
              $strFecha_inicio = strClean($_POST['txtFecha_inicioUp']);
              $strFecha_fin = strClean($_POST['txtFecha_finUp']);
							$intEstatus = intval($_POST['listEstatusUp']);
							$strFecha_Actualizacion = strClean($_POST['txtFecha_ActualizacionUp']);
							$intId_Usuario_Actualizacion = intval($_POST['txtId_Usuario_ActualizacionUp']);
							$request_generacion = "";

								if($intIdGeneraciones <> 0)
								{
									$request_generacion = $this->model->updateGeneraciones($intIdGeneraciones, 
																											                   $strNombre_Generacion,
                                                                         $strFecha_inicio, 
                                                                         $strFecha_fin,
																											                   $intEstatus, 
																											                   $strFecha_Actualizacion, 
																											                   $intId_Usuario_Actualizacion, $this->nomConexion);
																											                   $option = 1;
								}

								if($request_generacion > 0 )
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
				 //}
				}
				die();
			}


    //PARA ELIMINAR
    public function delGeneraciones()
		{
			if($_POST)
			{
					$intIdGeneraciones = intval($_POST['idGeneraciones']);
					$requestDelete = $this->model->deleteGeneraciones($intIdGeneraciones, $this->nomConexion);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la generación correctamente.');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una generación asociado a un ciclo activo.');
					}else{
						$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la generación.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


    // public function delGeneraciones(){
    //   if($_POST)
    //   {
    //       $intIdGeneraciones = intval($_POST['idGen']);
    //       $requestDelete = $this->model->deleteGeneraciones($intIdGeneraciones,$this->nomConexion);
    //       if($requestDelete == 'ok')
    //       {
    //           $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la generación correctamente.');
    //       }else if($requestDelete == 'exist'){
    //           $arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una generación asociado a un ciclo activo.');
    //       }else{
    //           $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la generacion.');
    //       }
    //       echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    //   }
    //   die();
    // }

    
    
  }

?>