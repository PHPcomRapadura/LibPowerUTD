<?php if(isset($add)){ ?>
<a href="?option=<?php echo $add; ?>" class="btn btn-default">
	<span class="glyphicon glyphicon-plus-sign"></span>
	 Adicionar Novo
</a>
<br><br>
<?php } ?>



<script>
	$(function () {
	  $('[id="tooltip"]').tooltip()
	});

	function erase(filter){
		$('#filter').val(filter);
	}
</script>
<?php
if($results == false){
	echo '<div class="alert alert-warning">';
		echo '<strong>Não Existem Resultados!</strong>';
	echo '</div>';
}else{

	echo '<h3>',count($results), " <strong>$text</strong> Encontrados(as)!</h3>";

	echo '<div class="table-responsive">';
	echo '<table class="table table-hover">';
		echo '<thead>';
			echo '<tr>';
			foreach($titles as $value){
				echo '<th>',$value,'</th>';
			}

			//testar se existe actions(excluir/atualizar)
			if(isset($actions)){
				echo '<th>Ações</th>';
			}

			echo '</tr>';
		echo '</thead>';

		echo '<tbody>';
			foreach ($results as $k => $v) {
				echo '<tr>';
				foreach ($titles as $key => $value) {
					echo '<td>',$v[$key],'</td>';
				}

				echo '<td>';
				//testando se existe ações
				if(isset($actions['delete'])){
					$ac = $actions['delete'];	
					echo '<a id="tooltip" title="',$ac['text'],'" onclick="erase(',$v[$ac['filter']],')" href="#delete" data-toggle="modal" class="btn btn-xs btn-',$ac['class'],'">';
					echo '<span class="glyphicon glyphicon-',$ac['icon'],'"></span>';
					echo '</a>';

				}

				if(isset($actions['update'])){
					$ac = $actions['update'];
					
					echo ' <a id="tooltip" title="',$ac['text'],'" href="',$ac['href'],'&filter=',$v[$ac['filter']],'" class="btn btn-xs btn-',$ac['class'],'">';
					echo '<span class="glyphicon glyphicon-',$ac['icon'],'"></span>';
					echo '</a>';

				}
				echo '</td>';

				echo '</tr>';
			}
		echo '</tbody>';
	echo '</table>';
	echo '</div>';
}
?>


<div class="modal fade" id="delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Você tem certeza? </h4>
			</div>

			<div class="modal-body text-center">
				<form action="<?php echo base_url()."/controller/".$actions['delete']['href']; ?>" method="POST">

					<input type="hidden" name="filter" id="filter">

					<button class="btn btn-danger btn-lg">Sim!</button>

					<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Não</button>
				</form>
			</div>
		</div><!-- content -->
	</div><!-- dialog -->
</div><!-- modal -->