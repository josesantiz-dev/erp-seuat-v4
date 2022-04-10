<?php

	class Login extends Controllers{
		public function __construct()
		{
         session_start();
         if(isset($_SESSION['login']))
         {
            header('Location: '.base_url().'/dashboard');
         }
			parent::__construct();
		}

		public function login()
		{
			$data['page_tag'] = "Login - Escolar SEUAT";
			$data['page_title'] = "Login";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}

      public function loginUser(){
         //dep($_POST);
         if($_POST){
            if (empty($_POST['txtNickname']) || empty($_POST['txtPassword'])) {
               $arrResponse = array('estatus' => false, 'msg' => 'Error de datos');
            }else {
               $strUsuario = strtolower(strClean($_POST['txtNickname']));
               $strPassword = hash("SHA256", $_POST['txtPassword']);
               $requestUser = $this->model->loginUser($strUsuario, $strPassword);
               if (empty($requestUser)) {
                  $arrResponse = array('estatus' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
               }else {
                   $arrData = $requestUser;
                   if($arrData['estatus'] == 1){
                        $_SESSION['idUser'] = $arrData['id'];
                        $_SESSION['login'] = true;
                        $_SESSION['nom_user'] =  $this->model->selectDateUser($arrData['id']);
                        $arrResponse = array('estatus' => true, 'msg' => 'ok');
                   }else {
                      $arrResponse = array('estatus' => false, 'msg' => 'Usuario inactivo.');
                   }
               }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
         }
         die();
      }
      
	}
?>