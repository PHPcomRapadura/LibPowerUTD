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
	$new_col['collection_quantity'] = $_POST['quantity'];

	//buscando pra ver se já existe
	$filters['book_id'] = $_POST['book'];
	$exists = Manager::select("tb_collection", null, $filters);
	
	if($exists == false){
		$new_col['book_id'] = $_POST['book'];
		Manager::insert("tb_collection", $new_col);
	}else{
		Manager::update("tb_collection", $new_col, $filters);
	}

	header("location: ".base_url()."/librarian.php?success=collection_updated&option=collections");

?>