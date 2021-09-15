<?php 
	require_once 'DBController.php';
	 
	class Util {

		private $db;

		function __construct() {
			$this->db = new DBController();	
		}

		function displayMessage($message) {
			echo "<script>alert('" .$message. "');</script>";
		}

		function redirect($path) {
			echo "<script>window.location.assign('" .$path. "')</script>;";
		}

		function generateUID($table) {
			$randStr = "";
			
			do {
				$randStr = uniqid($table, true);
			} while ($this->isUIDExist($table, $randStr));

			return $randStr;
		}

		function generateKey($email) {
			$key = md5($email);
			$addKey = substr(md5(uniqid(rand(),1)),3,10);
			$key = $key . $addKey;
			return $key;
		}

		function isUIDExist($table, $randStr) {
			$query = "SELECT * FROM $table WHERE id = $randStr";
			$result = $this->db->runBaseQuery($query);

			if (isset($result))
				return true;
			else 
				return false;
		}

		function generateExpiredDate() {
			date_default_timezone_set('Asia/Kuala_Lumpur');
			$expFormat = mktime( date("H"), date("i")+30, date("s"), date("m") ,date("d"), date("Y"));
			$expDate = date("Y-m-d H:i:s",$expFormat);
			return $expDate;
		}

	}
?>