<?php

	//incluindo o arquivo de endereços
	include_once 'model/config.php';

	include_once 'model/class/User.class.php';

	//Requisitando arquivos importantes
	include_files();

	//inicia a sessão.
	session_start();

	//se não existir admin logado: permissão negada
	if(!isset($_SESSION[md5("Lib-Leitor")])){
		header("location: index.php?error=permission_denied");
	}

	//resgatar os dados que estão na session.
	$user = $_SESSION[md5("Lib-Leitor")];


	//definir o titulo da pagina
	$page_title = "Area do Leitor";

	//define se é um menu ou login
	function page_sidebar(){
		//qual menu aparecera
		$m = $GLOBALS['menu']['reader'];

		include_once base_server()."/view/menu.php";
	}

	//define conteúdo da página
	function page_content(){
		Validate::success();
		Validate::error();
		Validate::option();
		
	}

	//incluir a base do template
	include_once 'view/base.php';

?>