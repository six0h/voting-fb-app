<?php

class Db {

	private		$m = '',
			$db_name = DB_NAME,
			$last_id;

	public function __construct() {

        	$uri = "mongodb://" . DB_USER . ":" . DB_PASS . "@localhost/" . DB_NAME; 
		$this->m = new Mongo($uri);	
		$m = $this->m;
		$db_name = $this->db_name;
		$this->db = $m->$db_name;

	}

	public function select($collection,$crit = array(),$options = array()) {
		$record = $this->db->$collection->find($crit);
		foreach($options as $key => $value) $$key = $value;
			if(isset($limit)) $record->limit($limit);
			if(isset($sort)) $record->sort($sort);
		return $record;
	}

	public function count($collection,$crit) {
		$count = $this->db->$collection->count($crit);
		return $count;
	}

	public function insert($collection,$data) {
		$this->db->$collection->insert($data);
		$this->last_id = $data['_id'];
		return $data;
	}

	public function update($collection,$crit,$data) {
		$this->db->$collection->update($crit,$data);
		return $data;
	}

	public function remove($collection,Array $crit) {
		$this->db->$collection->remove($crit);
	}

	public function lastId() {
		return $this->lastId;
	}

}

$db = new Db(); 

?>
