<?php  
	
	require_once 'DBController.php';

	class AssignmentController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function createAssignment($id, $title, $description, $dateAssigned, $dateDue, $totalMarks, $channel) {
			$query = "INSERT INTO assignment (id, title, description, date_assigned, due_date, total_marks, channel) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$result = $this->db->runInsertUpdate($query, 'sssssss', array($id, $title, $description, $dateAssigned, $dateDue, $totalMarks, $channel));
			return $result;
		}

		function updateAssignment($id, $title, $description, $dateDue, $totalMarks, $channel) {
			$query = "UPDATE assignment SET title = ?, description = ?, due_date = ?, total_marks = ?, channel = ? WHERE id = ?";
			$result = $this->db->runInsertUpdate($query, 'ssssss', array($title, $description, $dateDue, $totalMarks, $channel, $id));
			return $result;
		}

		function getAssignments($educator) {
			$query = "SELECT * FROM channel b JOIN assignment a WHERE ((a.channel = b.id) AND (educator = ?))";
			$result = $this->db->runQuery($query, 's', array($educator));
			return $result;
		}

		function getAssignmentsByStudent($student) {
			$query = "SELECT * FROM student_channel c JOIN channel b JOIN assignment a WHERE ((a.channel = b.id) AND (b.id = c.channel) AND (student = ?))";
			$result = $this->db->runQuery($query, 's', array($student));
			return $result;
		}

		function getAssignment($id) {
			$query = "SELECT * FROM assignment WHERE id = ?";
			$result = $this->db->runQuery($query, 's', array($id));
			return $result;
		}

		
	}

?>