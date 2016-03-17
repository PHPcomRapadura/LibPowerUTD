<?php 
//dicionario
$GLOBALS['dictionary'] = array(
	'error' => "Erro 404 - Informação não encontrada",
	'permission_denied' => "Permissão Negada",
	'insert_error' => "Erro ao inserir no banco de dados",
	'user_not_found' => "Usuário não encontrado",
	'password_incorrect' => "Senha Incorreta",
	'user_logout' => "Você foi desconectado",
	'user_inative' => "Usuário Inativa",
	'user_created' => "Usuario Criado com sucesso",
	'user_deleted' => "Usuário Excluído",
	'user_updated' => "Usuário Atualizado",
	'category_created' => "Categoria Criada",
	'category_deleted' => "Categoria Excluída",
	'category_updated' => "Categoria Atualizada",
	'book_created' => "Novo Livro Inserido",
	'book_deleted' => "Livro Excluído",
	'book_updated' => "Livro Atualizado",
	'collection_deleted' => "Acervo Zerado",
	'collection_updated' => "Acervo Atualizado",
	'loan_created' => "Novo Empréstimo realizado",
	'loan_updated' => "Empréstimo Atualizado",
	
);

function dictionary($msg){
	if(isset($GLOBALS['dictionary'][$msg])){
	return $GLOBALS['dictionary'][$msg];
	}else{
		return $GLOBALS['dictionary']['error'];
	}
	
}

?>