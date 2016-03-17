<?php
	include_once dirname(__DIR__).'/model/config.php';

	//inicia a sessao
	session_start();

	//destroi a sessao, ou seja, faz logout.
	session_destroy();

	header("location: ".base_url()."?success=user_logout");

?>