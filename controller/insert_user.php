<?php
	//incluindo arquivo de configuração.
	include_once dirname(__DIR__).'/model/config.php';

	//responsavel pela conexão com o banco.
	include_once base_server().'/model/class/Connect.class.php';

	//responsavel por manipular o banco(insert, select...)
	include_once base_server().'/model/class/Manager.class.php';
	

	//recebendo dados do form
	$new_user['user_name'] = $_POST['name'];
	$new_user['user_email'] = $_POST['email'];
	$new_user['user_password'] = sha1($_POST['password']);
	//dados complementares

	session_start();
	if(isset($_SESSION[md5("Lib-Administrador")])){
		$new_user['profile_id'] = $_POST['profile'];
		$page = "admin.php";
	}else{
		$new_user['profile_id'] = 3; //perfil de Leitor
		$page = "";
	}
	$new_user['user_status'] = 1;

	//inserindo
	$confirm = Manager::insert("tb_user", $new_user);

	//validação
	if($confirm != false){
	header("location: ".base_url()."/".$page."?success=user_created");
	}else{
		header("location: ".base_url()."?error=insert_error");
	}
?>