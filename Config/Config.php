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
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_tuxtla',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
		'bd_tapa' => array( //base datos Tapachula
            'NAME' => 'Tapachula',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_tapachula',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
		'bd_camp' => array( //base datos Campeche	
			'NAME' => 'Campeche',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_campeche',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
        ),
        'bd_tapi' => array( //base datos Tapilula	
			'NAME' => 'Tapilula',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_tapilula',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_refo' => array( //base datos Reforma	
			'NAME' => 'Reforma',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_reforma',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_yaja' => array( //base datos Yajalon
			'NAME' => 'Yajalon',	
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_yajalon',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_oaxa' => array( //base datos Oaxaca	
			'NAME' => 'Oaxaca',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_oaxaca',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_pale' => array( //base datos Palenque	
			'NAME' => 'Palenque',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_palenque',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_comi' => array( //base datos Comitan	
			'NAME' => 'Comitán',
			'DB_HOST'=>'192.168.8.193',
			'DB_NAME' => 'erpseuat_comitan',
			'DB_USER' => 'usr_seuat',
			'DB_PASSWORD' => 'seuat21',
			'DB_CHARSET' => 'utf8'
		),
        'bd_chet' => array( //base datos Chetumal	
			'NAME' => 'Chetumal',
			'DB_HOST'=>'192.168.8.193',
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