<form action="controller/insert_loan.php" method="POST">
	<legend>Novo Empréstimo</legend>
	<label>Livro</label>
	<select class="form-control" required name="book">
		<option value="" selected> -- Selecione -- </option>
		<?php 
			foreach($books as $bo){
				echo '<option value="',$bo['id_book'],'">',$bo['book_title'],'</option>';
			}
		?>
	</select><br>

	<label>Leitor</label>
	<select class="form-control" required name="user">
		<option value="" selected> -- Selecione -- </option>
		<?php 
			foreach($users as $us){
				echo '<option value="',$us['id_user'],'">',$us['user_name'],'</option>';
			}
		?>
	</select><br>


	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>