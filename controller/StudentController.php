<?php 
	require_once 'DBController.php';

	class StudentController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function getTotalStudentByEducator($educator) {
			$query = "SELECT COUNT(*) as total FROM student_channel a JOIN channel b ON a.channel = b.id WHERE educator = ?";
			$result = $this->db->runQuery($query, 's', array($educator));
			return $result;
		}

		function getStudent($id) {
			$query= "SELECT * FROM student WHERE id = ?";
			$result = $this->db->runQuery($query, 's', array($id));
			return $result;
		}
	}

?>