<?php

	//define("BASE_URL", "http://localhost/erp-seuat-v1/");
	const BASE_URL = "http://localhost/erp-seuat-v4";
	const VERSION_NAME = "v1.0.1Alpha";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');
	//const LIBS = "Libraries/";
	//const VIEWS = "Views/";
    //const basedatos = "Cam";
	const conexiones = array(
		'bd_tuxg' => array( //base datos Tuxtla
            'NAME' => 'Tuxtla',
			'SIGLA' => 'TUXG',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_tuxtla',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
  		'bd_tapa' => array( //base datos Tapachula
            'NAME' => 'Tapachula',
			'SIGLA' => 'TAPA',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_tapachula',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
 		'bd_camp' => array( //base datos Campeche	
			'NAME' => 'Campeche',
			'SIGLA' => 'CAMP',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_campeche',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
        ),
        'bd_tapi' => array( //base datos Tapilula	
			'NAME' => 'Tapilula',
			'SIGLA' => 'TAPI',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_tapilula',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_refo' => array( //base datos Reforma	
			'NAME' => 'Reforma',
			'SIGLA' => 'REFO',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_reforma',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_yaja' => array( //base datos Yajalon
			'NAME' => 'Yajalon',
			'SIGLA' => 'YAJA',	
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_yajalon',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_oaxa' => array( //base datos Oaxaca	
			'NAME' => 'Oaxaca',
			'SIGLA' => 'OAXA',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_oaxaca',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_pale' => array( //base datos Palenque	
			'NAME' => 'Palenque',
			'SIGLA' => 'PALE',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_palenque',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_comi' => array( //base datos Comitan	
			'NAME' => 'Comitán',
			'SIGLA' => 'COMI',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_comitan',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_chet' => array( //base datos Chetumal	
			'NAME' => 'Chetumal',
			'SIGLA' => 'CHET',
			'DB_HOST'=>'192.168.8.218',
			'DB_NAME' => 'erpseuat_chetumal',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		)
        
	);
	//Delimitadores decimal y millar Ej. 27,1985.00
	const SPD = "."; //Separador de decimales
	const SPM = ","; //Separador de millares

	//Simbolo de moneda
	const SMONEDA = "$";

?>