<?php

if(count($_POST)>0){
	$presenta = PresentaData::getById($_POST["presenta_id"]);
	$presenta->name = $_POST["name"];
	$presenta->update();
print "<script>window.location='index.php?view=presentations';</script>";


}


?>