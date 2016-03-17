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
	$new_loan['loan_date'] = strtotime(date("d-m-Y H:i:s"));
	$new_loan['user_id'] = $_POST['user'];
	$new_loan['book_id'] = $_POST['book'];

	Manager::insert("tb_loan", $new_loan);


	//diminuindo no acervo
	$filters['book_id'] = $_POST['book'];
	$collection = Manager::select("tb_collection", null, $filters, "LIMIT 1");
	$new_col['collection_quantity'] = $collection[0]['collection_quantity'] - 1; 
	Manager::update("tb_collection", $new_col, $filters);

	header("location: ".base_url()."/librarian.php?success=loan_created&option=loans");

?>