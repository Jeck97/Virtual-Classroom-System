<?php  
	date_default_timezone_set('Asia/Kuala_Lumpur');

	require_once '../AssignmentController.php';
	require_once '../Util.php';

	$assignmentController = new AssignmentController();
	$util = new Util();

	if ($_POST['submit']) {

		$message = "";
		$path = "";

		if ($_POST['submit'] === "create-assignment") {

			$id = $util->generateUID('assignment');
			$title = strtolower(trim($_POST['title']));
			$description = strtolower(trim($_POST['description']));
			$totalMarks = $_POST['total-marks'];
			$dateAssigned = date('h:i:s a d-M-Y');
			$dateDue = date_format(date_create($_POST['date-due']), 'h:i:s a d-M-Y');
			$channel = $_POST['channel'];

			if ($assignmentController->createAssignment($id, $title, $description, $dateAssigned, $dateDue, $totalMarks, $channel) === true) {
				$message = "Assignment added.";
				$path = "../../pages/assignment.php";
			} else {
				$message = "Failed to create assignment.";
				$path = "../../pages/assignment.php";
			}

		}

		if ($_POST['submit'] === "update-assignment") {
			$id = $_POST['assignment-id'];
			$title = strtolower(trim($_POST['title']));
			$description = strtolower(trim($_POST['description']));
			$totalMarks = $_POST['total-marks'];
			$dateDue = date_format(date_create($_POST['date-due']), 'h:i:s a d-M-Y');
			$channel = $_POST['channel'];

			if ($assignmentController->updateAssignment($id, $title, $description, $dateDue, $totalMarks, $channel) === true) {
				$message = "Assignment updated.";
				$path = "../../pages/assignment.php";
			} else {
				$message = "Failed to update assignment.";
				$path = "../../pages/assignment.php";
			}
		}

		if ($message != "")
			$util->displayMessage($message);
		if ($path != "")
			$util->redirect($path);
	}
?>