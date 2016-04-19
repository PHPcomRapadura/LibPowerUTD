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
	$new_book['book_title'] = $_POST['title'];
	$new_book['category_id'] = $_POST['category'];
	$new_book['book_author'] = $_POST['author'];
	$new_book['book_year'] = $_POST['year'];
	$new_book['book_edition'] = $_POST['edition'];
	$new_book['book_pages'] = $_POST['pages'];
	$new_book['book_publisher'] = $_POST['publisher'];
	$new_book['book_country'] = $_POST['country'];

	Manager::insert("tb_book", $new_book);


	header("location: ".base_url()."/librarian.php?success=book_created&option=books");
?>