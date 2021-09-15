<?php 

require_once 'DBController.php';

class ClassController{

	private $db;

	function __construct(){
		$this->db = new DBController();
	}

	function createClass($id, $name, $description, $date, $time, $channel){
		$query = "INSERT INTO class (id, name, description, `date`, `time`, channel) VALUES (?,?,?,?,?,?)";

		$result = $this->db->runInsertUpdate($query, 'ssssss', array($id, $name, $description, $date, $time, $channel));
		return $result;
	}

	function displayClass($id){

		$query = "SELECT * FROM class WHERE channel = ?";
		$result=$this->db->runQuery($query, 's', array($id));
		return $result;
	}


}

 ?>