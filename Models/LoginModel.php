<?php

class LoginModel extends Mysql
{
	private $intIdUsuario;
	private $strUsuario;
	private $strPassword;
	private $strToken;

	public function __construct()
	{
		parent::__construct();
	}

	public function loginUSer(string $usuario, string $password)
	{
		$this->strUsuario = $usuario;
		$this->strPassword = $password;
		$sql = "SELECT id,estatus FROM t_usuarios WHERE 
		nickname = '$this->strUsuario' and 
		password = '$this->strPassword' and 
		estatus != 0 ";
		$request = $this->select($sql);
		return $request;
	}
	public function selectDateUser(int $idUser){
		$sql = "SELECT per.nombre_persona,per.ap_paterno,per.ap_materno FROM t_personas AS per INNER JOIN t_usuarios AS us ON us.id_persona = per.id WHERE us.id = $idUser LIMIT 1";
		$request = $this->select($sql);
		return $request;
	}
}
?>