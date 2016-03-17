<form action="controller/update_loan.php" method="POST">
	<legend>Novo Empréstimo</legend>

	<?php $loan = $loan_data[0]; ?>

	<label>Livro</label>
	<select class="form-control" required name="book">
		<option value="<?php echo $loan['book_id']; ?>" selected> <?php echo $loan['book_title']; ?> </option>
	</select><br>

	<label>Leitor</label>
	<select class="form-control" required>
		<option value="<?php echo $loan['id_user']; ?>" selected><?php echo $loan['user_name']; ?></option>
	</select><br>

	
	<label>Devolução</label>
	<select class="form-control" required>
		<option value="1" selected>Sim</option>
	</select><br>

	<input type="hidden" name="filter" value="<?php echo $loan['id_loan']; ?>">

	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>