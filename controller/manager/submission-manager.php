<?php  
	date_default_timezone_set("Asia/Kuala_Lumpur");

	require_once '../SubmissionController.php';
	require_once '../Util.php';

	$submissionController = new SubmissionController();
	$util = new Util();

	if (isset($_POST['submit'])) {

		$message = "";
		$path = "";

		if ($_POST['submit'] === "update-marks") {
			$assignmentId = $_POST['assignment-id'];
			$submissionId = $_POST['submission-id'];
			$marks = $_POST['marks'];

			if ($submissionController->updateSubmission($submissionId, $marks) === true) {
				$message = "Successfully updated marks";
				$path = "../../pages/view-assignment.php?id=$assignmentId";
			} else {
				$message = "Failed to update marks";
				$path = "../../pages/view-assignment.php?id=$assignmentId";
			}
		}

		if ($_POST['submit'] === "create-submission") {
			session_start();

			$targetDir = "../../file/";
			$targetFile = basename($_FILES['attachment']['name']);

			$id = $util->generateUID('submission');
			$student = $_SESSION['account']['id'];
			$assignment = $_POST['assignment-id'];
			$dateSubmit = date('h:i:s a d-M-Y');
			$attachment = $targetFile;

			move_uploaded_file($_FILES['attachment']['tmp_name'], $targetDir . $targetFile);

			if ($submissionController->createSubmission($id, $student, $assignment, $dateSubmit, $attachment) === true) {
				$message = "Successfully added submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			} else {
				$message = "Failed to add submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			}
		}

		if ($_POST['submit'] === "update-submission") {
			session_start();

			$targetDir = "../../file/";
			$targetFile = basename($_FILES['attachment']['name']);

			$id = $_POST['submission-id'];
			$student = $_SESSION['account']['id'];
			$assignment = $_POST['assignment-id'];
			$dateSubmit = date('h:i:s a d-M-Y');
			$attachment = $targetFile;

			move_uploaded_file($_FILES['attachment']['tmp_name'], $targetDir . $targetFile);

			if ($submissionController->editSubmission($id, $student, $assignment, $dateSubmit, $attachment) === true) {
				$message = "Successfully updated submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			} else {
				$message = "Failed to update submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			}
		}

		if ($_POST['submit'] === "remove-submission") {

			$id = $_POST['submission-id'];
			$assignment = $_POST['assignment-id'];

			if ($submissionController->removeSubmission($id) === true) {
				$message = "Successfully remove submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			} else {
				$message = "Failed to remove submission";
				$path = "../../pages/student-view-assignment.php?id=$assignment";
			}
		}

		if ($message != "")
			$util->displayMessage($message);
		if ($path != "")
			$util->redirect($path);
	}
?>