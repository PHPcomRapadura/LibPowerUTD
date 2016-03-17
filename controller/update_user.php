<?php
	include_once dirname(__DIR__).'/model/config.php';

	include_once base_server().'/model/class/Connect.class.php';

	include_once base_server().'/model/class/Manager.class.php';

	include_once base_server().'/model/class/User.class.php';

	//testando se existe usuário logado
	session_start();
	if(isset($_SESSION[md5('Lib-Administrador')])){
		$user = $_SESSION[md5('Lib-Administrador')];

	}elseif(isset($_SESSION[md5('Lib-Bibliotecario')])){
		$user = $_SESSION[md5('Lib-Bibliotecario')];

	}elseif(isset($_SESSION[md5('Lib-Leitor')])){
		$user = $_SESSION[md5('Lib-Leitor')];

	}else{
		header("location: ".base_url()."?error=permission_denied");
	}

	//Dados a serem atualizados
	$new_data['user_name'] = $_POST['name'];
	$new_data['user_email'] = $_POST['email'];

	//testa se usuario quer alterar senha
	if($_POST['password'] != ""){
		$new_data['user_password'] = sha1($_POST['password']);
	}

	if($user->profile_name == "Administrador" && isset($_POST['filter'])){
		$filters['id_user'] = $_POST['filter'];
		$new_data['profile_id'] = $_POST['profile'];
	
		//atualizar no banco
		Manager::update("tb_user", $new_data, $filters);
	}else{
		//filtro para atualizar apenas este usuario
		$filters['id_user'] = $user->id_user;
		
		//atualizar no banco
		Manager::update("tb_user", $new_data, $filters);

		//atualizar na sessao
		$user->user_name = $new_data['user_name'];
		$user->user_email = $new_data['user_email'];

		$_SESSION[md5("Lib-".$user->profile_name)] = $user;
	}

	//redirecionando
	header("location: ".base_url()."/".$user->profile_page."?success=user_updated");
?>