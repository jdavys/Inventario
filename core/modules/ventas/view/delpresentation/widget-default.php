<?php

$presenta = PresentaData::getById($_GET["id"]);
$products = ProductData::getAllByPresentationId($presenta->id);
foreach ($products as $product) {
	$product->del_presentation();
}

$presenta->del();
Core::redir("./index.php?view=presentations");


?>