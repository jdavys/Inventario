<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newpresentation" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Presentacion</a>
</div>
		<h1>Presentaciones</h1>
<br>
		<?php

		$presentas = PresentaData::getAll();
		if(count($presentas)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Descripcion</th>
			<th></th>
			</thead>
			<?php
			foreach($presentas as $presenta){
				?>
				<tr>
				<td><?php echo $presenta->name ?></td>
				<td style="width:130px;"><a href="index.php?view=editpresentation&id=<?php echo $presenta->id;?>" class="btn btn-warning btn-xs">Editar</a> <a href="index.php?view=delpresentation&id=<?php echo $presenta->id;?>" class="btn btn-danger btn-xs">Eliminar</a></td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay Presentaciones</p>";
		}


		?>


	</div>
</div>