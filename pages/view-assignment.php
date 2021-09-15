<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php  
	require_once '../controller/AssignmentController.php';
	require_once '../controller/SubmissionController.php';
	require_once '../controller/ChannelController.php';
	require_once '../controller/Util.php';

	$assignmentController = new AssignmentController();
	$submissionController = new SubmissionController();
	$channelController = new ChannelController();
	$util = new Util();

	$path = "";

	if (isset($_GET['id'])) {
		$assignmentId = $_GET['id'];

		$assignment = $assignmentController->getAssignment($assignmentId)[0];
		$totalSubmitted = $submissionController->getTotalSubmitted($assignmentId)[0]; 
		$students = $channelController->getStudents($assignment['channel']);
		$totalStudents = $channelController->getTotalStudents($assignment['channel'])[0]['total'];

		if ($assignment == false)
			$path = "assignment.php";

	} else {
		$path = "assignment.php";
	}

	if ($path != "")
		$util->redirect($path);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include '../inc/head.php'; ?>
</head>
<body>
	
	<?php include '../inc/top-nav.php'; ?>
	<?php include '../inc/side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Assignment</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<div>
						<div style="display: flex;"><h2><?php echo ucwords($assignment['title']); ?>&nbsp;</h2><a href="edit-assignment.php?id=<?php echo $assignment['id']; ?>"><i class="fas fa-edit" style="color: grey;"></i></a></div>
						<div><?php echo "Due on " .$util->formatDate($assignment['due_date']); ?></div>
					</div>
					<div>
						<h2>Total Submission: <?php echo $totalSubmitted['total']; ?>/<?php echo $totalStudents; ?></h2>
					</div>
				</div>
				<div class="card-content">
<?php 	if ($students != false) { ?>
<?php 		foreach ($students as $student) { ?>
<?php  			$submission = $submissionController->getSubmissions($assignmentId, $student['id'])[0]; ?>
					<div style="display: flex; justify-content: space-between; padding: 20px; background-color: #E7E6E6; border-radius: 10px; margin-bottom: 20px;">
						<div style="display: flex;">	
							<div style="border: 1px solid black; border-radius: 10px; width: 100px; margin-right: 10px; background-color: white; display: flex; padding: 0 10px;">
								<div style="width: 49%; display: flex;align-items: flex-start; justify-content: center;">
									<span style="font-size: 25pt;"><?php if ($submission['marks'] != NULL ) { echo $submission['marks']; } else { echo "-"; } ?></span>
								</div>
								<div style="width: 2%; display: flex; align-items: center; justify-content: center;">
									<span style="border-left: 1px solid black; height: 100px; display: inline-block; margin: 0 10px; transform: rotate(45deg);"></span>
								</div>
								<div style="width: 49%; display: flex; align-items: flex-end; justify-content: center;">
									<span style="font-size: 25pt;"><?php echo $assignment['total_marks']; ?></span>
								</div>
							</div>
							<div style="padding: 10px 20px;">
								<div style="height: 40%;">
									<span style="font-size: 16pt;"><?php echo ucwords($student['name']); ?></span>
								</div>
								<div style="height: 40%;">
									<span style="font-size: 14pt;"><?php echo $student['email']; ?></span>
								</div>
								<div style="height: 20%;">
									<span style="font-size: 12pt;"><a href="../file/<?php echo $submission['attachment']; ?>" download="download"><?php echo $submission['attachment']; ?></span></a>
								</div>
							</div>
						</div>
						<div style="padding: 10px 20px; text-align: right;">
							<div style="height: 40%;">
								<?php if ($submission['date_submit'] == NULL) { ?>
								<span style="font-size: 16pt; color: blue;">ASSIGNED</span>
								<?php } else { ?>
									<?php if ($submission['marks'] != NULL) { ?>
									<span style="font-size: 16pt; color: green;">MARKED</span>
									<?php } else { ?>
										<?php if (date_create($submission['date_submit']) <= date_create($assignment['due_date'])) { ?>
										<span style="font-size: 16pt; color: blue;">HANDED IN</span>
										<?php } else { ?>
										<span style="font-size: 16pt; color: red;">HANDED IN LATE</span>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="height: 40%;">
								<?php if ($submission['date_submit'] != NULL) { ?>
								<span style="font-size: 14pt;"><?php echo $util->formatDate($submission['date_submit']); ?></span>
								<?php } ?>
							</div>
							<div style="height: 20%;">
								<?php if ($submission['date_submit'] != NULL) { ?>
								<a href="#" onclick="editMarks('<?php echo $submission['id']; ?>')" style="text-decoration: none; color: black; font-size: 10pt;"><b>Edit mark >></b></a>
								<?php } ?>
							</div>
						</div>
					</div>
<?php 		} ?>
<?php 	} ?>
				</div>
			</div>
		</div>	
	</div>

	<div id="modal-marks" class="modal" style="display: none;">
		<div class="modal-container">
			<form class="modal-form" method="post" action="../controller/manager/submission-manager.php">
				<div class="modal-header">
					<input type="hidden" name="assignment-id" value="<?php echo $assignmentId; ?>">
					<input id="submission-id" type="hidden" name="submission-id">
					<h2>Enter the mark</h2>
					<h2 class="close-button" onclick="editMarks();">&times;</h2>
				</div>
				<div class="modal-body" style="display: flex;">
					<input type="text" style="font-size: 35pt; text-align: right;" name="marks" class="modal-input" placeholder="Marks...">
					<input type="text" style="font-size: 35pt;" class="modal-input" value="<?php echo ' / ' .$assignment['total_marks']; ?>" disabled="disabled">
				</div>
				<div class="modal-footer">
					<div class="btn btn-danger" onclick="editMarks();">Cancel</div>
					<button class="btn btn-success" type="submit" name="submit" value="update-marks">Save</button>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		function editMarks(value) {
			var modal = document.getElementById('modal-marks');
			var id = document.getElementById('submission-id');

			if (modal.style.display == "none") {
				modal.style.display = "block";
				id.value = value;
			} else {
				modal.style.display = "none";
			}
		}
	</script>
</body>
</html>