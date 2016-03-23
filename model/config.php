<?php
	//habilitando erros
	ini_set('display_errors', 1);

	//endereço web da aplicação
	$GLOBALS['base_url'] = "http://".$_SERVER['SERVER_NAME']."/phpcomrapadura/LibPowerUTD";

	//endereço fisico da aplicação
	$GLOBALS['base_server'] = $_SERVER['DOCUMENT_ROOT']."phpcomrapadura/LibPowerUTD";

	function base_url(){
		return $GLOBALS['base_url'];
	}

	function base_server(){
		return $GLOBALS['base_server'];
	}

	function include_files(){
		include_once base_server().'/controller/Validate.class.php';
		include_once base_server().'/model/dictionary.php';
		include_once base_server().'/model/menu.php';
	}
	
?>