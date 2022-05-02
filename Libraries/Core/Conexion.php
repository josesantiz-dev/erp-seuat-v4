<?php
class Conexion{
	//private $conect;
	public function __construct(){
        /* foreach (conexiones as $key => $conexion) {
            try{
                $this->conect[$key] = new PDO("mysql:host=".$conexion['DB_HOST'].";dbname=".$conexion['DB_NAME'].";charset=".$conexion['DB_CHARSET'],$conexion['DB_USER'],$conexion['DB_PASSWORD']);
                $this->conect[$key]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                $this->conect[$key] = 'Error de conexión';
                echo "ERROR: " . $e->getMessage();
  
            }
        } */
	}

	/* public function conect($bd){
		return $this->conect[$bd];
	} */
    public function conect($bd){
        try{
            $c = new PDO("mysql:host=".conexiones[$bd]['DB_HOST'].";dbname=".conexiones[$bd]['DB_NAME'].";charset=".conexiones[$bd]['DB_CHARSET'],conexiones[$bd]['DB_USER'],conexiones[$bd]['DB_PASSWORD']);
            $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $c;
        }catch(PDOException $e){
            $msg = 'Error de conexión';
            return $msg;
            echo "ERROR: " . $e->getMessage();
        }
    }
}

?>