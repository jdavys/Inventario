<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newbodega" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Bodega</a>
</div>
		<h1>Bodegas</h1>
<br>
		<?php

		$bodegas = BodegaData::getAll();
		if(count($bodegas)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre</th>
			<th></th>
			</thead>
			<?php
			foreach($bodegas as $bodega){
				?>
				<tr>
				<td><?php echo $bodega->name; ?></td>
				<td style="width:130px;"><a href="index.php?view=editbodega&id=<?php echo $bodega->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delbodega&id=<?php echo $bodega->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Bodegas</p>";
		}


		?>


	</div>
</div>