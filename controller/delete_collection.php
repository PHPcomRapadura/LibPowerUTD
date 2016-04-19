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
$filters['book_id'] = $_POST['filter'];

//deletando acervo
Manager::delete("tb_collection", $filters);

//deletando livros emprestados do acervo
Manager::delete("tb_loan", $filters);
Manager::delete("tb_book", array('id_book'=>$filters['book_id']));

header("location: ".base_url()."/librarian.php?success=collection_deleted&option=collections");
?>