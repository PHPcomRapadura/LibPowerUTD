<?php
include_once dirname(__DIR__).'/model/config.php';

include_once base_server().'/model/class/Connect.class.php';

include_once base_server().'/model/class/Manager.class.php';

//testa se existe usuario e se é admin
session_start();

if(!isset($_SESSION[md5("Lib-Administrador")])){
	header("location: ".base_url()."?error=permission_denied");
}

//receber os dados via post
$filters['id_user'] = $_POST['filter'];

Manager::delete("tb_user", $filters);

header("location: ".base_url()."/admin.php?success=user_deleted");
?>