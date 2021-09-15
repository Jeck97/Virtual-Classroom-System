<?php  

	class AuthController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function encryptPassword($password) {
			return password_hash($password, PASSWORD_DEFAULT);
		}

		function verifyPassword($password, $hash) {
			$result = false;

			if (password_verify($password, $hash) == 1)
				$result = true;

			return $result;
		}

		function isExist($email) {
			$query = "SELECT * FROM account WHERE email = ? UNION SELECT * FROM student WHERE email = ?";
			$result = $this->db->runQuery($query, 'ss', array($email, $email));

			if (isset($result))
				return $result;
			return false;
		}

		function registerUser($id, $name, $email, $password, $role) {
			$query = "INSERT INTO account (id, name, email, password, role) VALUES (?, ?, ?, ?, ?)";
			$result = $this->db->runInsertUpdate($query, 'sssss', array($id, $name, $email, $password, $role));
			return $result;
		}

		function storeTempKey($email, $expDate, $key, $action) {
			$query = "INSERT INTO key_temp (email, exp_date, key_session, action) VALUES (?, ?, ?, ?)";
			$result = $this->db->runInsertUpdate($query, 'ssss', array($email, $expDate, $key, $action));
			return $result;
		}

		function getTempKeyDate($email, $key, $action) {
			$query = "SELECT exp_date FROM key_temp WHERE ((email = ?) AND (key_session = ?) AND (action = ?))";
			$result = $this->db->runQuery($query, 'sss', array($email, $key, $action));

			if (isset($result))
				return $result;
			return false;
		}

		function removeExpiredLink($cur_date, $action) {
			$query = "DELETE FROM key_temp WHERE ((exp_date <= ?) AND (action = ?))";
			$result = $this->db->runInsertUpdate($query, 'ss', array($cur_date, $action));
			return $result;
		}

		function removeUsedLink($email, $action) {
			$query = "DELETE FROM key_temp WHERE ((email = ?) AND (action = ?))";
			$result = $this->db->runInsertUpdate($query, 'ss', array($email, $action));
			return $result;	
		}

		function updatePassword($email, $password) {
			$query = "UPDATE account SET password = ? WHERE email = ?";
			$result = $this->db->runInsertUpdate($query, 'ss', array($password, $email));
			return $result;
		}

		function updateAccountStatus($email, $status) {
			$query = "UPDATE account SET status = ? WHERE email = ?";
			$result = $this->db->runInsertUpdate($query, 'ss', array($status, $email));
			return $result;	
		}
	}

?>