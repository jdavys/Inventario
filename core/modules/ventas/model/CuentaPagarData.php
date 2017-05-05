<?php
class CuentaPagar {
	public static $tablename = "cuenta_pagar";

	public function CuentaPagar(){
		$this->id_prove = "";
		$this->id_compra = "";
		$this->num_fact = "";
		$this->fecha = "";
		$this->fecha_vence = "";
		$this->monto_inicial = "";
		$this->saldo_fact = "";
		$this->sal_glo_d="0";
		$this->sal_glo_c="0";
		$this->moneda="";
		$this->tipoP="";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_proveedor,id_compra,num_factura,fecha,fecha_vence,monto_inicial,saldo_factura,saldo_global_c,saldo_global_d,moneda,tipo_pago) ";
		$sql .= "value ($this->id_prove,$this->id_compra,'$this->num_fact','$this->fecha','$this->fecha_vence',$this->monto_inicial,$this->saldo_fact,$this->sal_glo_d,$this->sal_glo_c,'$this->moneda','$this->tipoP')";
		//return $sql;
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where num_factura='{$id}'";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where num_fact=$this->num_fact";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto OperationData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set product_id=\"$this->product_id\",q=\"$this->q\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateSaldoG($id){
		$saldoGC=self::getByIdProveC($id);
		$saldoGD=self::getByIdProveD($id);
		$sql = "update ".self::$tablename." set saldo_global_c=$saldoGC,saldo_global_d=$saldoGD where id_proveedor=$id";
		Executor::doit($sql);
		//return $sql;
	}


	public static function getByIdProveC($id){
		$saldoG=0;
		$sql = "select * from ".self::$tablename." where id_proveedor=$id and tipo_pago='Credito' and moneda='Colones'";
		$query = Executor::doit($sql);
		
		while($r = $query[0]->fetch_array()){
			
			$saldoG += $r['saldo_factura'];
			
		}
		return $saldoG;
	}

	public static function getByIdProveD($id){
		$saldoD=0;
		$sql = "select * from ".self::$tablename." where id_proveedor={$id} and tipo_pago='Credito' and moneda='Dolares'";
		$query = Executor::doit($sql);
		
		while($r = $query[0]->fetch_array()){
			
			$saldoD += $r['saldo_factura'];
			
		}
		return $saldoD;
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new OperationData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->product_id = $r['product_id'];
			$data->q = $r['q'];
			$data->bodega_id = $r['bodega_id'];
			$data->cut_id = $r['cut_id'];
			$data->operation_type_id = $r['operation_type_id'];
			$data->sell_id = $r['sell_id'];
			$data->created_at = $r['created_at'];
			$found = $data;
			break;
		}
		return $found;
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->bodega_id = $r['bodega_id'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$cnt++;
		}
		return $array;
	}



	public static function getAllByDateOfficial($start,$end){
 $sql = "select * from ".self::$tablename." where date(created_at) > \"$start\" and date(created_at) <= \"$end\" and is_oficial=1 order by created_at desc";
		if($start == $end){
		 $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
		}
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->is_oficial = $r['is_oficial'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByDateOfficialBP($product, $start,$end){
 $sql = "select * from ".self::$tablename." where date(created_at) > \"$start\" and date(created_at) <= \"$end\" and is_oficial=1 and product_id=$product order by created_at desc";
		if($start == $end){
		 $sql = "select * from ".self::$tablename." where date(created_at) = \"$start\" order by created_at desc";
		}
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}



	public function getProduct(){
		return ProductData::getById($this->product_id);
	}

	public function getBodega($idb){
		
		return BodegaData::getById($idb);
	}

	public function getOperationType(){
		return OperationTypeData::getById($this->operation_type_id);
	}


////////////////////////////////////////////////////////////////////
	public static function getQ($product_id,$cut_id){
		$q=0;
		$operations = self::getAllByProductIdCutId($product_id,$cut_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}


	public static function getQYesF($product_id){
		$q=0;
		$operations = self::getAllByProductId($product_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
				if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
				else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getBods($product_id){
		//$array = array();
		//$cnt = 0;
		$operations = self::getAllByProductId($product_id);
		
		/*foreach($operations- as $operation){
				$array[$cnt]->product_id=$operation['product_id'];
				$array[$cnt]->name=$operation['name'];
				$cnt++;
		}*/
		if( empty($operations[0])){ 
			$b=5;
			
		}else{
			$b= $operations[0]->bodega_id;
		}
		
		//print_r($operations[0]->bodega_id);
		return $b;
		
	}

	public static function getQNoF($product_id,$cut_id){
		$q = self::getQ($product_id,$cut_id);
		$f = self::getQYesF($product_id,$cut_id);
		return $q-$f;

	}


	public static function getAllByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id  order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->bodega_id = $r['bodega_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


	public static function getAllByProductIdCutIdOficial($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and is_oficial=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getAllByProductIdCutIdUnOficial($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and is_oficial=0 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->is_oficial = $r['is_oficial'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


	public static function getAllProductsBySellId($sell_id){
		$sql = "select * from ".self::$tablename." where sell_id=$sell_id order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


	public static function getAllByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and is_oficial=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
						$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

////////////////////////////////////////////////////////////////////
	public static function getOutputQ($product_id,$cut_id){
		$q=0;
		$operations = self::getOutputByProductIdCutId($product_id,$cut_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getOutputQYesF($product_id){
		$q=0;
		$operations = self::getOutputByProductId($product_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getOutputQNoF($product_id,$cut_id){
		$q=0;
		$operations = self::getOutputByProductIdCutIdNoF($product_id,$cut_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}


	public static function getOutputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


	public static function getOutputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

////////////////////////////////////////////////////////////////////
	public static function getInputQ($product_id,$cut_id){
		$q=0;
		$operations = self::getInputByProductIdCutId($product_id,$cut_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}

	public static function getInputQYesF($product_id){
		$q=0;
		$operations = self::getInputByProductId($product_id);
		$input_id = OperationTypeData::getByName("entrada")->id;
		$output_id = OperationTypeData::getByName("salida")->id;
		foreach($operations as $operation){
			if($operation->operation_type_id==$input_id){ $q+=$operation->q; }
			else if($operation->operation_type_id==$output_id){  $q+=(-$operation->q); }
		}
		// print_r($data);
		return $q;
	}


	public static function getInputByProductIdCutId($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getInputByProductId($product_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getInputByProductIdCutIdYesF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and is_oficial=1 and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}

	public static function getInputByProductIdCutIdNoF($product_id,$cut_id){
		$sql = "select * from ".self::$tablename." where product_id=$product_id and cut_id=$cut_id and is_oficial=0 and operation_type_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new OperationData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->product_id = $r['product_id'];
			$array[$cnt]->q = $r['q'];
			$array[$cnt]->cut_id = $r['cut_id'];
			$array[$cnt]->operation_type_id = $r['operation_type_id'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}
////////////////////////////////////////////////////////////////////////////


}

?>