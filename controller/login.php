<?php
include_once dirname(__DIR__).'/model/config.php';

//conexão
include_once base_server().'/model/class/Connect.class.php';

//Gerenciador do banco
include_once base_server().'/model/class/Manager.class.php';

//Classe de Usuário
include_once base_server().'/model/class/User.class.php';

//recebendo dados do form
$email = $_POST['email'];
$password = sha1($_POST['password']);

//primeiro buscar por email
$tables['tb_user'] = array(); //todas as colunas
$tables['tb_profile'] = array();
$rel['tb_user.profile_id'] = "tb_profile.id_profile";
$filters['user_email'] = $email;

//realizando busca.
$login = Manager::select_join($tables, $rel, $filters, " LIMIT 1;");

//testa se algum usuario foi encontrado.
if($login == false){
	//se não foi encontrado, gera erro.
	header("location: ".base_url()."?error=user_not_found");
}elseif($login[0]['user_status'] != 1){
	//se status for diferente de true, gera erro.
	header("location: ".base_url()."?error=user_inative");

//senão, testa a senha pra ver se pode entrar.
}elseif($login[0]['user_password'] != $password){
	//caso a senha seja diferente: senha incorreta
	header("location: ".base_url()."?error=password_incorrect");
}else{
	//caso não entre nos anteriores, é pq deu certo.

	//atualizar a data de ultimo acesso do usuario
	$new_date['user_last_access'] = strtotime(date("Y-m-d H:i:s"));

	//atualizando no banco
	Manager::update("tb_user", $new_date, $filters);

	//habilita o serviço de sessão...
	session_start();

	//criar o objeto com os dados do usuário
	$user = new User($login[0]['user_name'], $email, $password);
	//setar os atributor restantes
	foreach ($login[0] as $k => $v) {
		$user->$k = $v;
	}

	//criando sessão de acordo com o perfil do usuario
	//exemplo: Lib-Leitor, Lib-Administrador
	//sessão recebe os dados do Objeto usuário.
	$_SESSION[md5("Lib-".$user->profile_name)] = $user;

	//redirecionando pra página do usuário.
	header("location: ".base_url()."/".$user->profile_page);
}
?>