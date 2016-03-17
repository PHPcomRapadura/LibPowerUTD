<?php 

	class Validate{
		//Validar mensagens de sucesso
		public static function success(){
			//testa se existe $_GET['success']
			if(!isset($_GET['success'])){
				return false;
			}

			$alert_class = "info";
			$alert_text = dictionary($_GET['success']);
			$alert_icon = "ok-sign";

			include base_server().'/view/alert.php';
		}

		//Validar mensagens de erro
		public static function error(){
			//testa se existe erro
			if(!isset($_GET['error'])){
				return false;
			}

			$alert_class = "danger";
			$alert_icon = "warning-sign";
			$alert_text = dictionary($_GET['error']);

			include base_server().'/view/alert.php';
		}

		//Validar açoes via $_GET
		public static function option(){
			//testa se existe opção
			if(!isset($_GET['option'])){
				include_once base_server().'/view/welcome.php';
				return false;
			}

			//ter acesso aos dados do usuário logado.
			global $user;

			//arquivos para manipular o banco
			include_once base_server().'/model/class/Connect.class.php';
			include_once base_server().'/model/class/Manager.class.php';

			switch($_GET['option']){
				case "add_user":
					if(isset($user) && $user->profile_name == "Administrador"){
						$profiles = Manager::select("tb_profile", null, null, " ORDER BY profile_name;");
					}

					include_once base_server().'/view/user/add_user.php';

					return true;
					break;

				case "profile":

					include_once base_server().'/view/user/edit_profile.php';

					return true;
					break;

				case "users":
					if($user->profile_name != "Administrador"){
						return false;
					}

					//buscar usuarios no banco
					$tables['tb_user'] = array();
					$tables['tb_profile'] = array("profile_name");
					$rel['tb_user.profile_id'] = "tb_profile.id_profile";
					$results = Manager::select_join($tables, $rel, null, " ORDER BY user_name;");

					//Opção para adicionar
					$add = "add_user";

					//Texto que aparecera
					$text = "Usuários";

					//quais elementos mostrar e como mostrar
					$titles = array(
						'id_user' => "ID",
						'user_name' => "Nome",
						'user_email' => "Email",
						'profile_name' => "Tipo de Conta",
						'user_created_in' => "Criado em",
					);  

					//são ações que permitem coisas extras
					// excluir e atualizar
					$actions['delete'] = array(
						'filter' => "id_user",
						'href' => "delete_user.php",
						'text' => "Excluir",
						'icon' => "trash",
						'class' => "danger",
					);
					//Atualizar/Editar
					$actions['update'] = array(
						'filter' => "id_user",
						'href' => "?option=update_user",
						'text' => "Editar",
						'icon' => "wrench",
						'class' => "warning",
					);

					include_once base_server().'/view/list.php';

					return true;
					break;

				case "update_user":
					if(!isset($user) || $user->profile_name != "Administrador"){
						return false;
					}

					if(!isset($_GET['filter'])){
						return false;
					}

					//buscando usuario do filtro...
					$tables['tb_user'] = array();
					$tables['tb_profile'] = array();
					$rel['tb_user.profile_id'] = "tb_profile.id_profile";
					$filters['id_user'] = $_GET['filter'];
					$data_user = Manager::select_join($tables, $rel, $filters);

					//buscando perfis(profiles)
					$profiles = Manager::select("tb_profile", null, null);

					//incluindo view(form_)
					include_once base_server().'/view/user/edit_user.php';

					return true;
					break;

				case "categories":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					//buscando as categorias
					$results = Manager::select("tb_category", null, null, " ORDER BY category_name");

					//texto da tabela
					$text = "Categorias";

					//titulos(th) da tabela
					$titles = array(
						'category_name' => "Categoria",
						'category_desc' => "Descrição",
					);

					//linkar o form de cadastro de categoria
					$add = "add_category";

					//opção de excluir
					$actions['delete'] = array(
						'icon' => "trash",
						'text' => "Excluir",
						'class' => "danger",
						'href' => "delete_category.php",
						'filter' => "id_category",
					);
					//opção de atualizar/editar
					$actions['update'] = array(
						'icon' => "wrench",
						'text' => "Editar",
						'class' => "warning",
						'href' => "?option=update_category",
						'filter' => "id_category",
					);

					include_once base_server().'/view/list.php';

					return true;
					break;

				case "add_category":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					include_once base_server().'/view/category/add_category.php';

					return true;
					break;

				case "update_category":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}
					if(!isset($_GET['filter'])){
						return false;
					}

					//buscar as informações da cat a ser editada
					$filters['id_category'] = $_GET['filter'];
					$cat_data = Manager::select("tb_category", null, $filters, " LIMIT 1");

					include_once base_server().'/view/category/edit_category.php';

					return true;
					break;

				case "books";
					if(!isset($user)){
						return false;
					}

					$tables['tb_book'] = array();
					$tables['tb_category'] = array('category_name');
					$rel['tb_book.category_id'] = "tb_category.id_category";
					$results = Manager::select_join($tables, $rel, null, " ORDER BY book_title");

					//titulos a serem mostrados
					$titles = array(
						'book_title' => "Título",
						'category_name' => "Categoria",
						'book_author' => "Autor",
						'book_publisher' => "Editora",
						'book_edition' => "Edição", 
						'book_year' => "Ano",
						'book_pages' => "Páginas",
						'book_country' => "País",
					);

					$text = "Livros";

					$add = "add_book";

					//opção de excluir
					$actions['delete'] = array(
						'icon' => "trash",
						'text' => "Excluir",
						'class' => "danger",
						'href' => "delete_book.php",
						'filter' => "id_book",
					);
					//opção de atualizar/editar
					$actions['update'] = array(
						'icon' => "wrench",
						'text' => "Editar",
						'class' => "warning",
						'href' => "?option=update_book",
						'filter' => "id_book",
					);

					include_once base_server().'/view/list.php';

					break;
					return true;

				case "add_book":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					$categories = Manager::select("tb_category", null, null);

					include_once base_server().'/view/book/add_book.php';

					return true;
					break;

				case "update_book":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}
					if(!isset($_GET['filter'])){
						return false;
					}
					$tables['tb_book'] = array();
					$tables['tb_category'] = array();
					$rel['tb_book.category_id'] = "tb_category.id_category";
					$filters['id_book'] = $_GET['filter'];

					$book_data = Manager::select_join($tables, $rel, $filters, " LIMIT 1");

					$categories = Manager::select("tb_category", null, null);



					include_once base_server().'/view/book/edit_book.php';

					return true;
					break;

				case "collections";
					if(!isset($user)){
						return false;
					}

					$tables['tb_collection'] = array();
					$tables['tb_book'] = array('book_title');
					$rel['tb_collection.book_id'] = "tb_book.id_book";
					$results = Manager::select_join($tables, $rel, null, " ORDER BY book_title");

					//titulos a serem mostrados
					$titles = array(
						'book_title' => "Título",
						'collection_quantity' => "Quantidade",
					);

					$text = "Livros no Estoque";

					if($user->profile_name == "Bibliotecario"){					$add = "add_collection";

					//opção de excluir
					$actions['delete'] = array(
						'icon' => "trash",
						'text' => "Excluir",
						'class' => "danger",
						'href' => "delete_collection.php",
						'filter' => "id_collection",
					);
					//opção de atualizar/editar
					$actions['update'] = array(
						'icon' => "wrench",
						'text' => "Editar",
						'class' => "warning",
						'href' => "?option=update_collection",
						'filter' => "id_collection",
					);
					}

					include_once base_server().'/view/list.php';

					break;
					return true;

				case "add_collection":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					$fields = array('id_book', 'book_title');
					$books = Manager::select("tb_book", $fields, null, " ORDER BY book_title");

					include_once base_server().'/view/collection/add_collection.php';

					return true;
					break;

				case "update_collection":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}
					if(!isset($_GET['filter'])){
						return false;
					}
					$tables['tb_collection'] = array();
					$tables['tb_book'] = array('book_title');
					$rel['tb_collection.book_id'] = "tb_book.id_book";
					$filters['id_collection'] = $_GET['filter'];

					$collection_data = Manager::select_join($tables, $rel, $filters, " LIMIT 1");

					include_once base_server().'/view/collection/edit_collection.php';

					return true;
					break;

				case "loans";
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					$tables['tb_loan'] = array();
					$tables['tb_book'] = array('book_title');
					$tables['tb_user'] = array('user_name');
					$rel['tb_loan.book_id'] = "tb_book.id_book";
					$rel['tb_loan.user_id'] = "tb_user.id_user";
					$results = Manager::select_join($tables, $rel, null, " ORDER BY book_title");


					//Atualizando Datas
					if($results != false){
						foreach ($results as $key => $value) {
							$results[$key]['loan_date'] = date("d/m/Y H:i:s", $value['loan_date']);

							if($value['loan_devolution_date'] != 0){
								$results[$key]['loan_devolution_date'] = date("d/m/Y H:i:s", $value['loan_devolution_date']);
								$results[$key]['loan_devolution'] = "Sim";
							}else{
								$results[$key]['loan_devolution'] = "Não";
							}


						}
					}

					//titulos a serem mostrados
					$titles = array(
						'loan_date' => "Emprestado em",
						'book_title' => "Título",
						'user_name' => "Leitor",
						'loan_devolution' => "Já devolveu?",
						'loan_devolution_date' => "Devolvido em",
					);

					$text = "Empréstimos";

					$add = "add_loan";

					
					//opção de atualizar/editar
					$actions['update'] = array(
						'icon' => "wrench",
						'text' => "Editar",
						'class' => "warning",
						'href' => "?option=update_loan",
						'filter' => "id_loan",
					);

					include_once base_server().'/view/list.php';

					break;
					return true;

				case "add_loan":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}

					$tables['tb_book'] = array('id_book', 'book_title');
					$tables['tb_collection'] = array('id_collection');
					$rel['tb_collection.book_id'] = "tb_book.id_book";
					$books = Manager::select_join($tables, $rel, null, " WHERE collection_quantity>0");

					$fields = array('id_user', 'user_name');
					$filters['profile_id'] = "3";
					$users = Manager::select("tb_user", $fields, $filters, " ORDER BY user_name");

					include_once base_server().'/view/loan/add_loan.php';

					return true;
					break;

				case "update_loan":
					if(!isset($user) || $user->profile_name != "Bibliotecario"){
						return false;
					}
					if(!isset($_GET['filter'])){
						return false;
					}
					$tables['tb_loan'] = array();
					$tables['tb_book'] = array('book_title');
					$tables['tb_user'] = array('user_name');
					$rel['tb_loan.book_id'] = "tb_book.id_book";
					$rel['tb_loan.user_id'] = "tb_user.id_user";
					$filters['id_loan'] = $_GET['filter'];

					$loan_data = Manager::select_join($tables, $rel, $filters, " LIMIT 1");

					include_once base_server().'/view/loan/edit_loan.php';

					return true;
					break;

				case "my_loans":	
					if(!isset($user) || $user->profile_name != "Leitor"){
						return false;
					}

					$tables['tb_loan'] = array();
					$tables['tb_book'] = array('book_title');
					$tables['tb_user'] = array('user_name');
					$rel['tb_loan.book_id'] = "tb_book.id_book";
					$rel['tb_loan.user_id'] = "tb_user.id_user";
					$filters['user_id'] = $user->id_user;
					$results = Manager::select_join($tables, $rel, $filters, " ORDER BY book_title");

					$text = "Empréstimos";


					//Atualizando Datas
					if($results != false){
						foreach ($results as $key => $value) {
							$results[$key]['loan_date'] = date("d/m/Y H:i:s", $value['loan_date']);

							if($value['loan_devolution_date'] != 0){
								$results[$key]['loan_devolution_date'] = date("d/m/Y H:i:s", $value['loan_devolution_date']);
								$results[$key]['loan_devolution'] = "Sim";
							}else{
								$results[$key]['loan_devolution'] = "Não";
							}


						}
					}

					//titulos a serem mostrados
					$titles = array(
						'loan_date' => "Emprestado em",
						'book_title' => "Título",
						'loan_devolution' => "Já devolveu?",
						'loan_devolution_date' => "Devolvido em",
					);

					include_once base_server().'/view/list.php';

					return true;
					break;
			}
		}
	}

 ?>