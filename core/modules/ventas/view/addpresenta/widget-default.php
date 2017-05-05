<?php

if(count($_POST)>0){
	$presenta = new PresentaData();
	$presenta->name = $_POST["name"];
	$presenta->add();

print "<script>window.location='index.php?view=presentations';</script>";

}


?>