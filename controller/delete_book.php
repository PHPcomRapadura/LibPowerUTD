<?php
include_once dirname(__DIR__).'/model/config.php';

include_once base_server().'/model/class/Connect.class.php';

include_once base_server().'/model/class/Manager.class.php';

//testa se existe usuario e se é admin
session_start();

if(!isset($_SESSION[md5("Lib-Bibliotecario")])){
	header("location: ".base_url()."?error=permission_denied");
}

//receber os dados via post
$filters['id_book'] = $_POST['filter'];

Manager::delete("tb_book", $filters);

header("location: ".base_url()."/librarian.php?success=book_deleted&option=books");
?>