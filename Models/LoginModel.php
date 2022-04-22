<?php

class LoginModel extends Mysql
{
	private $intIdUsuario;
	private $strUsuario;
	private $strPassword;
    private $strNomConexion;
	private $strToken;

	public function __construct()
	{
		parent::__construct();
	}

	public function loginUSer(string $usuario, string $password, string $nomConexion)
	{
		$this->strUsuario = $usuario;
		$this->strPassword = $password;
        $this->strNomConexion = $nomConexion;
		$sql = "SELECT id,estatus FROM t_usuarios WHERE 
		nickname = '$this->strUsuario' and 
		password = '$this->strPassword' and 
		estatus != 0 ";
		$request = $this->select($sql, $this->strNomConexion);
		return $request;
	}
	public function selectDateUser(int $idUser, string $nomConexion){
        $this->intIdUsuario = $idUser;
        $this->strNomConexion = $nomConexion;
		$sql = "SELECT per.nombre_persona,per.ap_paterno,per.ap_materno, per.id_rol,r.nombre_rol,r.clave_rol FROM t_personas AS per 
		INNER JOIN t_usuarios AS us ON us.id_persona = per.id 
		INNER JOIN t_roles AS r ON per.id_rol = r.id 
		WHERE us.id = $idUser LIMIT 1";
		$request = $this->select($sql, $this->strNomConexion);
		return $request;
	}
}
?>