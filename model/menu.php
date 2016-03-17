<?php
	//Administrador
	$GLOBALS['menu']['admin'] = array(
		//gerenciar usuarios
		'users' => array(
			'icon' => "user",
			'text' => "Usuários",
			'href' => "users",
		),
	);

	//Bibliotecario
	$GLOBALS['menu']['librarian'] = array(
		//gerenciar livros
		'books' => array(
			'icon' => "book",
			'text' => "Livros",
			'href' => "books",
		),

		'categories' => array(
			'icon' => "tags",
			'text' => "Categorias",
			'href' => "categories",
		),

		'collections' => array(
			'icon' => "th-list",
			'text' => "Acervo",
			'href' => "collections",
		),

		'loans' => array(
			'icon' => "transfer",
			'text' => "Empréstimos",
			'href' => "loans",
		),
	);

	//Leitor
	$GLOBALS['menu']['reader'] = array(
		//gerenciar usuarios
		'collections' => array(
			'icon' => "th-list",
			'text' => "Acervo",
			'href' => "collections",
		),
		'my_loans' => array(
			'icon' => "transfer",
			'text' => "Empréstimos",
			'href' => "my_loans",
		),
	);

?>