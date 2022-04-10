<?php

	//define("BASE_URL", "http://localhost/erp-seuat-v1/");
	const BASE_URL = "http://localhost/erp-seuat-v2";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//const LIBS = "Libraries/";
	//const VIEWS = "Views/";
	const DB_HOST = "10.10.0.45";
	const DB_NAME = "erpseuat";
	const DB_USER = "user_seuat";
	const DB_PASSWORD = "seuat21";
	const DB_CHARSET = "utf8";

	//Delimitadores decimal y millar Ej. 27,1985.00
	const SPD = "."; //Separador de decimales
	const SPM = ","; //Separador de millares

	//Simbolo de moneda
	const SMONEDA = "$";

?>