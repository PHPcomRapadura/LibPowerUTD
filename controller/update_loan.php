<?php
	include_once dirname(__DIR__).'/model/config.php';

	include_once base_server().'/model/class/Connect.class.php';
	include_once base_server().'/model/class/Manager.class.php';

	//validar se existe usuario bibliotecario
	session_start();
	if(!isset($_SESSION[md5('Lib-Bibliotecario')])){
		header("location: ".base_url()."?error=permission_denied");
	}

	//receber os dados do form
	$new_loan['loan_devolution_date'] = strtotime(date("d-m-Y H:i:s"));
	$new_loan['loan_devolution'] = 1;

	$filters['id_loan'] = $_POST['filter'];
	Manager::update("tb_loan", $new_loan, $filters);

	//devolvendo ao acervo
	$filters_c['book_id'] = $_POST['book'];
	$collection = Manager::select("tb_collection", null, $filters_c, "LIMIT 1");
	$new_col['collection_quantity'] = $collection[0]['collection_quantity'] + 1; 
	Manager::update("tb_collection", $new_col, $filters_c);

	header("location: ".base_url()."/librarian.php?success=loan_updated&option=loans");

?>