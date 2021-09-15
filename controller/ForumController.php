<?php 
		
		require_once 'DBController.php';

		class ForumController{


			private $db;

			function __construct() {
				$this->db = new DBController();
			}


		function addForum($id, $comment, $class, $student){
			$query = "INSERT INTO forum  (id, comment, class, student) VALUES (?,?,?,?)";
			$result = $this->db->runInsertUpdate($query, 'ssss', array($id, $comment, $class, $student));
			return $result;

		}


		function addForumEducator($id, $comment, $class, $educator){
			$query = "INSERT INTO forum  (id, comment, class, educator) VALUES (?,?,?,?)";
			$result = $this->db->runInsertUpdate($query, 'ssss', array($id, $comment, $class, $educator));
			return $result;

		}


		function getComments($classid){

			$query = "SELECT * FROM `forum` WHERE class = ?";
			$result = $this->db->runQuery($query, 's', array($classid));
			return $result;


		}
	

	}

 ?>