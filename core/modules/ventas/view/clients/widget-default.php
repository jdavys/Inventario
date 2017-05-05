<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newclient" class="btn btn-default"><i class='fa fa-smile-o'></i> Nuevo Cliente</a>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
</div>
		<h1>Directorio de Clientes</h1>

		<div class="clearfix"></div>
		<p><b>Buscar cliente por nombre o por codigo:</b></p>
			<form>
			<div class="row">
				<div class="col-md-6">
					<input type="hidden" name="view" value="clients">
					<input type="text" name="client" class="form-control">
				</div>
				<div class="col-md-3">
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
				</div>
			</div>
			</form>
		</div>
<br>
		<?php

		if(isset($_GET["client"])){
			$users = PersonData::getLike($_GET["client"]);
		
		}else{
			$users = PersonData::getClients();
		}


		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Direccion</th>
			<th>Email</th>
			<th>Telefono</th>
			<th>Agente</th>
			<th>Tipo</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name;?></td>
				<td><?php echo $user->address1; ?></td>
				<td><?php echo $user->email1; ?></td>
				<td><?php echo $user->phone1; ?></td>
				<td><?php if($user->agente_id!=null){echo $user->getAgente()->name;}else{ echo "<center>----</center>"; }  ?></td>
				<td><?php echo $user->tipoCliente; ?></td>
				<td style="width:120px;">
				<a href="index.php?view=editclient&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?view=delclient&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				</td>
				</tr>
				<?php

			}



		}else{
			echo "<p class='alert alert-danger'>No hay clientes</p>";
		}


		?>


	</div>
</div>