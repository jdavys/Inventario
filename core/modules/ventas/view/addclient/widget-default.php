<?php

if(count($_POST)>0){
	$user = new PersonData();
	$user->name = $_POST["name"];
	//$user->lastname = $_POST["lastname"];
	$user->address1 = $_POST["address1"];
	$user->email1 = $_POST["email1"];
	$user->phone1 = $_POST["phone1"];
	$agente_id="\"\"";
  	if($_POST["agente_id"]!=""){ $agente_id=$_POST["agente_id"];}
  	$user->agente_id=$agente_id;
  	$user->tipoCliente=$_POST['tipoCliente'];
  	$user->comision=$_POST['comision'];

  	//print_r($user);
	$user->add_client();

print "<script>window.location='index.php?view=clients';</script>";


}


?>