<?php  
	class DBController {

		private $host = "localhost";
		private $username = "root";
		private $password = "";
		private $database = "vcdb";
		private $conn;
		
		function __construct() {
			$this->conn = $this->connectDB();
		}

		function connectDB() {
			$conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
			return $conn;
		}

		function runBaseQuery($query) {
			$result = mysqli_query($this->conn, $query);
			if ($result != false) {	
				while ($row = mysqli_fetch_assoc($result)) {
					$resultset[] = $row;
				}
			}

			if (!empty($resultset))
				return $resultset;
		}

		function runQuery($query, $param_type, $param_value_array) {
			$sql = $this->conn->prepare($query);
			$this->bindQuery($sql, $param_type, $param_value_array);
			$sql->execute();
			$result = $sql->get_result();

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$resultset[] = $row;
				}
			}

			if (!empty($resultset)) {
				return $resultset;
			}
			return false;
		}

		function runInsertUpdate($query, $param_type, $param_value_array) {
			$sql = $this->conn->prepare($query);
			$this->bindQuery($sql, $param_type, $param_value_array);
			$result = $sql->execute();
			echo mysqli_error($this->conn);
			if ($result)
				return true;
			return false;
		}		

		function bindQuery($sql, $param_type, $param_value_array) {
			$param_value_reference[] =& $param_type;
			for ($i = 0; $i < count($param_value_array); $i++) {
				$param_value_reference[] =& $param_value_array[$i];
			}
			call_user_func_array(array(
				$sql, 
				'bind_param'
			), $param_value_reference);
		}
		
	}
?>