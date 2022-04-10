<?php

	class Permisos extends Controllers{
		public function __construct()
		{
			parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
		}

		public function getPermisosRol(int $idrol)
		{
            $rolid = intval($idrol);
            if($rolid > 0)
            {
                $arrModulos = $this->model->selectModulos();
                $arrPermisosRol = $this->model->selectPermisosRol($rolid);
                $arrPermisos = array('r'=> 0, 'w' => 0, 'u' => 0, 'd' => 0);
                $arrPermisoRol = array('idrol' => $rolid);
                //dep($arrModulos);
                //dep($arrPermisosRol);
                if(empty($arrPermisosRol))
                {
                    for ($i=0; $i < count($arrModulos); $i++){
                        
                        $arrModulos[$i]['permisos'] = $arrPermisos;
                    }
                }else{
                    for ($i=0; $i < count($arrModulos); $i++) {
                        $arrPermisos = array('r'=> 0, 'w' => 0, 'u' => 0, 'd' => 0);
                        if (isset($arrPermisosRol[$i])) {
                            $arrPermisos = array('r' => $arrPermisosRol[$i]['r'],
                                                 'w' => $arrPermisosRol[$i]['w'],
                                                 'u' => $arrPermisosRol[$i]['u'],
                                                 'd' => $arrPermisosRol[$i]['d']
                                                );
                        //if($arrMoldulos[$i]['id_modulo'] == $arrPermisosRol[$i]['moduloid'])
                        }
                        $arrModulos[$i]['permisos'] = $arrPermisos;
                        
                    }
                }
                $arrPermisoRol['modulos'] = $arrModulos;
                $html = getModal('Permisos/modalPermisos', $arrPermisoRol);
                //getModal('Permisos/modalPermisos',$data);
                //dep($arrPermisoRol);
            }
            die();
		}

        public function setPermisos()
        {
            //dep($_POST);
            //die();
            if($_POST) 
            {
                $intIdrol = intval($_POST['idrol']);
                $modulos = $_POST['modulos'];

                $this->model->deletePermisos($intIdrol);
                foreach ($modulos as $modulo){
                    $idModulo = $modulo['id'];
                    $r = empty($modulo['r']) ? 0 : 1;
                    $w = empty($modulo['w']) ? 0 : 1;
                    $u = empty($modulo['u']) ? 0 : 1;
                    $d = empty($modulo['d']) ? 0 : 1;
                    $requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
                }
                if($requestPermiso > 0)
                {
                    $arrResponse = array('estatus' => true, 'msg' => 'Permisos asignados correctamente.');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible asignar los permisos');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
	}
?>