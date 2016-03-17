<form action="controller/update_book.php" method="POST">
	<legend>Editar Livro</legend>
	
	<?php $bo = $book_data[0]; ?>

	<label>Categoria</label>
	<select class="form-control" name="category">
		<option value="<?php echo $bo['category_id']; ?>" selected> <?php echo $bo['category_name']; ?> </option>
		<?php 
			foreach($categories as $cat){
				echo '<option value="',$cat['id_category'],'">',$cat['category_name'],'</option>';
			}
		?>
	</select><br>

	<label>Titulo</label>
	<input type="text" name="title" value="<?php echo $bo['book_title']; ?>" placeholder="Titulo do Livro" required class="form-control">
	<br>

	<label>Autor</label>
	<input type="text" name="author" value="<?php echo $bo['book_author']; ?>" placeholder="Nome do Autor" required class="form-control">
	<br>

	<label>Ano</label>
	<input type="number" name="year" value="<?php echo $bo['book_year']; ?>" placeholder="Ano de Publicação" required class="form-control">
	<br>

	<label>Edição</label>
	<input type="number" name="edition" value="<?php echo $bo['book_edition']; ?>" placeholder="Número da Edição" required class="form-control">
	<br>

	<label>Editora</label>
	<input type="text" name="publisher" value="<?php echo $bo['book_publisher']; ?>" placeholder="Nome da Editora" required class="form-control">
	<br>

	<label>Número de Páginas</label>
	<input type="pages" name="pages" value="<?php echo $bo['book_pages']; ?>" placeholder="Número de Páginas" required class="form-control">
	<br>

	<label>País</label>
	<input type="pages" name="country" value="<?php echo $bo['book_country']; ?>" placeholder="País de Publicação" required class="form-control">
	<br>

	<input type="hidden" name="filter" value="<?php echo $bo['id_book']; ?>">

	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>