<?php 
$agentes = AgenteData::getAll();
?>

<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Cliente</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addclient" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <!--<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>-->
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address1" class="form-control" required id="address1" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email1" class="form-control" id="email1" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
    <div class="col-md-6">
      <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Telefono">
    </div>
  </div>
 <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo Pago*</label>
    <div class="col-md-6">
      <select name="tipoCliente" class="form-control" id="tipoCliente">
        <option value="Credito" selected>CREDITO</option>
        <option value="Contado">CONTADO</option>
      </select>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Agente*</label>
    <div class="col-md-6">
      <select name="agente_id" class="form-control">
    <option value="">-- NINGUNA --</option>
    <?php foreach($agentes as $agente):?>
      <option value="<?php echo $agente->id;?>"><?php echo $agente->name;?></option>
    <?php endforeach;?>
      </select>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Comisión*</label>
    <div class="col-md-6">
      <input type="text" name="comision" value="0" class="form-control" id="comision" placeholder="Comision">
    </div>
  </div>


  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Cliente</button>
    </div>
  </div>
</form>
	</div>
</div>