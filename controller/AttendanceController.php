<?php 

require_once 'DBController.php';

class AttendanceController{

	private $db;

	function __construct(){
		$this->db = new DBController();

	}

	function createAttendance($id, $student, $class, $date, $time){

		$query = "INSERT INTO attendance (id, student, class, `date`, `time`) VALUES (?,?,?,?,?)";
		$result = $this->db->runInsertUpdate($query, 'sssss', array($id,$student, $class, $date, $time));
		return $result;

	}

}

 ?>