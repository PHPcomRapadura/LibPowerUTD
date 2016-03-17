<table class="table">
	<tr>
		<th>Tipo de Conta</th>
		<td><?php echo $user->profile_name; ?></td>

		<th>Criado em</th>
		<td><?php echo $user->user_created_in; ?></td>

		<th>Último Acesso</th>
		<td><?php echo date("d/m/Y H:i:s", $user->user_last_access); ?></td>
	</tr>
	
	<form action="controller/update_user.php" method="POST">
	<tr>
		<td colspan="3"><br>
		<label>Seu Nome</label>
		<input class="form-control" name="name" value="<?php echo $user->user_name; ?>" required>
			
		<br>

		<label>Seu Email</label>
		<input type="email" name="email" value="<?php echo $user->user_email; ?>" class="form-control" required>
		
		<br>

		<label>Sua Senha</label>
		<input type="password" name="password" placeholder="Digite para alterar" class="form-control">
		
		<br>

		<button class="btn btn-primary btn-lg btn-block"> Atualizar Dados </button>

		</td>
	</tr>
	</form>
</table>