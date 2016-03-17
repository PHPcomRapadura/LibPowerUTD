<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">
			<span class="glyphicon glyphicon-list">
			</span>
			<strong>Menu</strong>
		</div>
	</div><!-- heading -->

	<div class="panel-body">
		<?php
			if(isset($_GET['option'])){
				$$_GET['option'] = "active";
				$k = "";
			}else{
				$k = "active";
			}
		?>
		<div class="sidebar">
			<ul class="nav nav-pills nav-stacked">
				
				<li class="<?php echo $k; ?>">
					<a href="<?php echo base_url(); ?>"> 
					<span class="glyphicon glyphicon-home"></span>
					Home 
					</a>
				</li>

<?php
foreach($m as $k=>$op){
	echo '<li class="',$$k,'">';
		echo '<a href="?option=',$op['href'],'">';
		echo '<span class="glyphicon glyphicon-',$op['icon'],'"></span> ';
		echo $op['text'];
		echo '</a>';
	echo '</li>';
}
?>

			</ul>
		</div>

	</div><!-- body !-->
</div>