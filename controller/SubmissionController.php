<?php  
	require_once 'DBController.php';

	class SubmissionController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function getSubmissions($assignmentId, $studentId) {
			$query = "SELECT * FROM student b JOIN submission a ON a.student = b.id WHERE ((assignment = ?) AND (student = ?))";
			$result = $this->db->runQuery($query, 'ss', array($assignmentId, $studentId));
			return $result;
		}

		function updateSubmission($id, $marks) {
			$query = "UPDATE submission SET marks = ? WHERE id = ?";
			$result = $this->db->runInsertUpdate($query, 'ss', array($marks, $id));
			return $result;
		}

		function getTotalSubmitted($assignmentId) {
			$query = "SELECT COUNT(*) as total FROM submission WHERE assignment = ?";
			$result = $this->db->runQuery($query, 's', array($assignmentId));
			return $result;
		}

		function createSubmission($id, $student, $assignment, $dateSubmit, $attachment) {
			$query = "INSERT INTO submission (id, student, assignment, date_submit, attachment) VALUES (?, ?, ?, ?, ?)";
			$result = $this->db->runInsertUpdate($query, 'sssss', array($id, $student, $assignment, $dateSubmit, $attachment));
			return $result;
		}

		function editSubmission($id, $student, $assignment, $dateSubmit, $attachment) {
			$query = "UPDATE submission SET student = ?, assignment = ?, date_submit = ?, attachment = ? WHERE id = ?";
			$result = $this->db->runInsertUpdate($query, 'sssss', array($student, $assignment, $dateSubmit, $attachment, $id));
			return $result;
		}

		function removeSubmission($id) {
			$query = "DELETE FROM submission WHERE id = ?";
			$result = $this->db->runInsertUpdate($query, 's', array($id));
			return $result;
		}
	}

?>