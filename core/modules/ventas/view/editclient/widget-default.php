<?php $user = PersonData::getById($_GET["id"]);
//print_r($user);
$agentes = AgenteData::getAll();

?>

<div class="row">
	<div class="col-md-12">
	<h1>Editar Cliente</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateclient" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <!--<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>-->
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address1" value="<?php echo $user->address1;?>" class="form-control" required id="username" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email1" value="<?php echo $user->email1;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone1"  value="<?php echo $user->phone1;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Agente</label>
    <div class="col-md-6">
      <select name="agente_id" class="form-control">
    <option value="">-- NINGUNA --</option>
    <?php foreach($agentes as $agente):?>
      <option value="<?php echo $agente->id;?>" <?php if($user->agente_id!=null&& $user->agente_id==$agente->id){ echo "selected";}?>><?php echo $agente->name;?></option>
    <?php endforeach;?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo Cliente</label>
    <div class="col-md-6">
      <select name="tipoCliente" class="form-control">
        <option value="">-- NINGUNA --</option>
        <option value="<?php echo $user->tipoCliente;?>" selected><?php echo $user->tipoCliente;?></option>
        <?php if($user->tipoCliente=='Contado'){
          echo "<option value='Credito'>Credito</option>";
        }else{
          echo "<option value='Contado'>Contado</option>";
        }
       ?>
    
      </select>
      
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
    <div class="col-md-6">
      <input type="text" name="comision"  <?php if(empty($user->comision)){echo "value = '0'";}else{echo "value = $user->comision";} ?>  class="form-control" id="inputEmail1" placeholder="Comision">
    </div>
  </div>


  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </div>
  </div>
</form>
	</div>
</div>