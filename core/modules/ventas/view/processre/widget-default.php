<?php
if(isset($_SESSION["reabastecer"])){
	$cart = $_SESSION["reabastecer"];
	if(count($cart)>0){

$process = true;

$plazo=$_POST['plazo'];
$fact=$_POST['num_fact'];
$moneda=$_POST['moneda'];
$tipo=$_POST['tipoP'];
$prove=$_POST["client_id"];
$tot=$_POST['money'];
$fec=date('d-m-Y',strtotime($_POST['fecha']));
//print_r($_POST);
//print_r($_SESSION);
date_default_timezone_set('America/Costa_Rica');

$fecPlazo=strtotime("+$plazo day",strtotime($fec));
$fecPlazo = date ( 'd-m-Y' , $fecPlazo );

//var_dump($fecPlazo);
//var_dump($_POST);
/////////////////////////////////
		if($process==true){
			$sell = new SellData();
			$sell->user_id = $_SESSION["user_id"];
			 if(isset($_POST["client_id"]) && $_POST["client_id"]!=""){
			 	$sell->person_id=$_POST["client_id"];
 				$s = $sell->add_re_with_client();
 				
			 }else{
 				$s = $sell->add_re();
			 }


		     $cuentaP= new CuentaPagar();

		     $cuentaP->id_prove=$prove;
		     $cuentaP->id_compra=$s[1];
		     $cuentaP->num_fact=$fact;
		     $cuentaP->fecha=$fec;
		     $cuentaP->fecha_vence=$fecPlazo;
		     $cuentaP->monto_inicial=$tot;
		     $cuentaP->saldo_fact=$tot;
		     $cuentaP->moneda=$moneda;
		     $cuentaP->tipoP=$tipo;
		     
		     $cuentaP->add();

		     $cuentaP->updateSaldoG($prove);
		

		foreach($cart as  $c){


			$op = new OperationData();
			 $op->product_id = $c["product_id"] ;
			 $op->operation_type_id=1; // 1 - entrada
			 $op->sell_id=$s[1];
			 $op->q= $c["q"];
			 $op->bodega_id=1; //la virgen

			if(isset($_POST["is_oficial"])){
				$op->is_oficial = 1;
			}
			
			
			$add = $op->add();	
				 		

		}
		unset($_SESSION["reabastecer"]);
		setcookie("selled","selled");

print "<script>window.location='index.php?view=onere&id=$s[1]';</script>";
		}
	}
}


?>
