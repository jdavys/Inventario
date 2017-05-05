<?php $presenta = PresentaData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Presentacion</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatepresentation" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $presenta->name;?>" class="form-control" id="descripcion" placeholder="Descripcion">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="presenta_id" value="<?php echo $presenta->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Presentacion</button>
    </div>
  </div>
</form>
	</div>
</div>