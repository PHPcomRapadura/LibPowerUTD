<form action="controller/insert_collection.php" method="POST">
	<legend>Nova Quantidade de Livros</legend>
	<label>Livro</label>
	<select class="form-control" name="book">
		<option value="" selected> -- Selecione -- </option>
		<?php 
			foreach($books as $bo){
				echo '<option value="',$bo['id_book'],'">',$bo['book_title'],'</option>';
			}
		?>
	</select><br>


	<label>Quantidade</label>
	<input type="text" name="quantity" placeholder="Quantidade de Livros" required class="form-control">
	<br>

	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>