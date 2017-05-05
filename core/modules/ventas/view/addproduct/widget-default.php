<?php

if(count($_POST)>0){
  $product = new ProductData();
  $product->name = $_POST["name"];
  $product->price_in = $_POST["price_in"];
  $product->price_out = $_POST["price_out"];
  $product->unit = $_POST["unit"];
  $product->description = $_POST["description"];
  $presenta_id="\"\"";
   if($_POST["presentation_id"]!=""){ $presenta_id=$_POST["presentation_id"];}
  //$product->presentation = $_POST["presentation_id"];
  //$product->inventary_min = $_POST["inventary_min"];
  $category_id="\"\"";
  if($_POST["category_id"]!=""){ $category_id=$_POST["category_id"];}
  $inventary_min="\"\"";
  if($_POST["inventary_min"]!=""){ $inventary_min=$_POST["inventary_min"];}
  $bodega_id="\"\"";
  if($_POST["bodega_id"]!=""){ $bodega_id=$_POST["bodega_id"];}

  $product->category_id=$category_id;
  $product->presentation_id=$presenta_id;
  $product->inventary_min=$inventary_min;
  $product->user_id = Session::getUID();


  if(isset($_FILES["image"])){
    $image = new Upload($_FILES["image"]);
    if($image->uploaded){
      $image->Process("storage/products/");
      if($image->processed){
        $product->image = $image->file_dst_name;
        $product->add_with_image();
      }
    }else{
      //print_r($product->add());

      $product= $product->add();
    }
  }
  else{
    //print_r($product);
    $product= $product->add();

  }


if($_POST["q"]!="" || $_POST["q"]!="0"){
 $op = new OperationData();
 $op->product_id = $product[1] ;
 $op->operation_type_id=OperationTypeData::getByName("entrada")->id;
 $op->q= $_POST["q"];
 $op->bodega_id= $bodega_id;
 $op->sell_id="NULL";
$op->is_oficial=1;
$op->add();
}

print "<script>window.location='index.php?view=products';</script>";


}


?>