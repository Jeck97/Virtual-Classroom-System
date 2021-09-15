<?php  
	require_once 'DBController.php';

	class EducatorController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function getEducator($educator) {
			$query = "SELECT * FROM account WHERE id = ?";
			$result = $this->db->runQuery($query, 's', array($educator));
			return $result;
		}
	}

?>