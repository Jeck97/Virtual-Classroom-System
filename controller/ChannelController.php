<?php  

	require_once 'DBController.php';

	class ChannelController {

		private $db;

		function __construct() {
			$this->db = new DBController();
		}

		function getChannels($educatorId) {
			$query = "SELECT * FROM channel WHERE educator = ?";
			$result = $this->db->runQuery($query, 's', array($educatorId));
			return $result;
		}

		function getTotalChannels($educatorId) {
			$query = "SELECT COUNT(*) as total FROM channel WHERE educator = ?";
			$result = $this->db->runQuery($query, 's', array($educatorId));
			return $result;
		}

		function getStudents($channelId) {
			$query = "SELECT * FROM student_channel a JOIN student b ON a.student = b.id WHERE channel = ?";
			$result = $this->db->runQuery($query, 's', array($channelId));
			return $result;
		}

		function getTotalStudents($channelId) {
			$query = "SELECT COUNT(*) as total FROM student_channel WHERE channel = ?";
			$result = $this->db->runQuery($query, 's', array($channelId));
			return $result;
		}


	function createChannel($id, $name, $description, $image_text, $educator){
		$query = "INSERT INTO channel (id, name, description, image_text, educator) VALUES (?,?,?,?,?)";
		$result = $this->db->runInsertUpdate($query, 'sssss', array($id, $name, $description, $image_text, $educator));
		return $result;
	}

	//display channel
	function displayChannels(){

		$query= "SELECT * FROM channel";
		$result = $this->db->runBaseQuery($query);
		if (isset($result))
			return $result;
		return false;

	}

	function displayChannel($id){

		$query= "SELECT * FROM channel WHERE id = ?";
		$result = $this->db->runQuery($query,'s',array($id));
		return $result;

	}

	function updateChannel($id, $name, $description, $image_text){
		$query = "UPDATE channel SET name = ?, description = ?,
		image_text = ? WHERE id = ?;" ;
		$result = $this->db->runInsertUpdate($query, 'ssss', array( $name, $description, $image_text, $id));
		return $result;	
	}


	function enrollChannel($id, $student, $channel){
		$query = "INSERT INTO student_channel (id, student, channel) VALUES (?,?,?)";
		$result = $this->db->runInsertUpdate($query, 'sss', array ($id, $student, $channel));
		return $result;

	}

	function displayEnrollByStudent($studentid)
	{
		$query = "SELECT * FROM student_channel a JOIN channel b ON a.channel = b.id WHERE student=?";
		$result = $this->db->runQuery($query,'s', array ($studentid));
		return $result;

	}

	function isStudentEnrolled($studentid, $channelid){

		$query = "SELECT * FROM student_channel WHERE student=? AND channel=?";
		$result = $this->db->runQuery($query,'ss', array ($studentid, $channelid));
		return $result;
	}
}
?>