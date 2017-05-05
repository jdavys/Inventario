<?php
/**
* 
*/
class PresentaData 
{
	public static $tablename = "presentacion";

	function PresentaData()
	{
		$this->name = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into presentacion (descripcion,created_at) ";
		$sql .= "value (\"$this->name\",$this->created_at)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set descripcion=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new PresentaData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->name = $r['descripcion'];
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
			$array[$cnt] = new PresentaData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['descripcion'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PresentaData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['descripcion'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;
		}
		return $array;
	}
}
?>