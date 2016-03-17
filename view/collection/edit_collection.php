<form action="controller/insert_collection.php" method="POST">
	<?php $col = $collection_data[0]; ?>

	<legend>Nova Quantidade de Livros</legend>
	<label>Livro</label>
	<select class="form-control" name="book">
		<option value="<?php echo $col['book_id']; ?>" selected> <?php echo $col['book_title']; ?> </option>
		
	</select><br>

	<label>Quantidade</label>
	<input type="text" name="quantity" value="<?php echo $col['collection_quantity']; ?>" placeholder="Quantidade de Livros" required class="form-control">
	<br>

	<input type="hidden" name="filter" value="<?php echo $col['id_collection']; ?>">

	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>