<form action="controller/update_category.php" method="POST">
	<?php $cat = $cat_data[0]; ?>

	<legend>Editar Categoria</legend>
	<label>Nome</label>
	<input type="text" value="<?php echo $cat['category_name']; ?>" name="name" placeholder="Nome da Categoria" required class="form-control">
	<br>

	<label>Descrição</label>
	<textarea name="desc" placeholder="Descrição da Categoria" required class="form-control"><?php echo $cat['category_desc']; ?></textarea>
	<br>

	<input type="hidden" value="<?php echo $cat['id_category']; ?>" name="filter">

	<button class="btn btn-primary btn-lg btn-block">
		<span class="glyphicon glyphicon-ok-sign"></span>
		 Enviar Dados
	</button>

</form>