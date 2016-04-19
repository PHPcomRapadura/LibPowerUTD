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
	$new_cat['category_name'] = $_POST['name'];
	$new_cat['category_desc'] = $_POST['desc'];

	$filters['id_category'] = $_POST['filter'];
	Manager::update("tb_category", $new_cat, $filters);

	header("location: ".base_url()."/librarian.php?success=category_updated&option=categories");

?>