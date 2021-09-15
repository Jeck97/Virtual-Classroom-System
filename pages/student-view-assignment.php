<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php  
	require_once '../controller/AssignmentController.php';
	require_once '../controller/SubmissionController.php';
	require_once '../controller/Util.php';

	$assignmentController = new AssignmentController();
	$submissionController = new SubmissionController();
	$util = new Util();

	$path = "";

	if (isset($_GET['id'])) {
		$assignmentId = $_GET['id'];

		$assignment = $assignmentController->getAssignment($assignmentId)[0];
		$submission = $submissionController->getSubmissions($assignmentId, $_SESSION['account']['id'])[0];

		if ($assignment == NULL)
			$path = "student-assignment.php";
	} else {
		$path = "student-assignment.php";
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
	
	<?php include '../inc/student-top-nav.php'; ?>
	<?php include '../inc/student-side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Assignment</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<div>
						<div><h2><?php echo strtoupper($assignment['title']); ?></h2></div>
						<div>Posted on <?php echo $util->formatDate($assignment['date_assigned']); ?></div>
					</div>
					<div>
						<h2>Total Marks: <?php echo $assignment['total_marks']; ?></h2>
					</div>
				</div>
				<div class="card-content">
					<div>
						<label><?php echo $assignment['description']; ?></label>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h2>Submission status</h2>
				</div>
				<div class="card-content">
					<table class="table">
						<tr>
							<td class="col20">
								<label>Submission status</label>
							</td>
							<td class="col80">
								<?php if ($submission['date_submit'] == NULL) { ?>
								<span style="color: blue;">Assigned</span>
								<?php } else { ?>
									<?php if ($submission['marks'] != NULL) { ?>
									<span style="color: green;">Marked</span>
									<?php } else { ?>
										<?php if (date_create($submission['date_submit']) <= date_create($assignment['due_date'])) { ?>
										<span style="color: blue;">Handed in</span>
										<?php } else { ?>
										<span style="color: red;">Handed in late</span>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="col20">
								<label>Marks</label>
							</td>
							<td class="col80">
								<label><?php if ($submission['marks'] != NULL) { echo $submission['marks']. " / " .$assignment['total_marks']; } else { echo "Not graded"; } ?></label>
							</td>
						</tr>
						<tr>
							<td class="col20">
								<label>Due date</label>
							</td>
							<td class="col80">
								<?php echo $util->formatDate($assignment['due_date']); ?>
							</td>
						</tr>
						<!-- <tr>
							<td class="col20">
								<label>Time remaining</label>
							</td>
							<td class="col80">
								
							</td>
						</tr> -->
<?php if ($submission['date_submit'] != NULL) {  ?>
						<tr>
							<td class="col20">
								<label>Last modified</label>
							</td>
							<td class="col80">
								<label><?php echo $util->formatDate($submission['date_submit']); ?></label>
							</td>
						</tr>
<?php } ?>
						<tr>
							<td class="col20">
								<label>File submission</label>
							</td>
							<td class="col80">
<?php if ($submission['attachment'] != NULL) { ?>
	 <a href="../file/<?php echo $submission['attachment']; ?>"><?php echo $submission['attachment']; ?></a> 
<?php } else { ?>
	 <label>No attachment</label> 
<?php } ?>
							</td>
						</tr>
					</table>
				</div>
<?php if ($submission['marks'] == NULL) { ?>
				<div class="card-footer" style="flex-direction: column;">
	<?php if ($submission['attachment'] == NULL) { ?>
					<button class="btn btn-info" style="width: 100%;" onclick="addSubmission();">Add Submission</button>
	<?php } else { ?>
					<button class="btn btn-info" style="width: 100%;" onclick="addSubmission();">Edit Submission</button>
					<form action="../controller/manager/submission-manager.php" method="post">
						<input type="hidden" name="submission-id" value="<?php echo $submission['id']; ?>">
						<input type="hidden" name="assignment-id" value="<?php echo $assignment['id']; ?>">
						<button type="submit" name="submit" value="remove-submission" class="btn btn-danger" style="width: 100%;">Delete Submission</button>	
					</form>
	<?php } ?>
				</div>
<?php } ?>
			</div>
		</div>	
	</div>

	<div id="modal-submission" class="modal" style="display: none;">
		<div class="modal-container">
			<form class="modal-form" method="post" action="../controller/manager/submission-manager.php" enctype="multipart/form-data">
				<input type="hidden" name="assignment-id" value="<?php echo $assignment['id']; ?>">
				<input type="hidden" name="submission-id" value="<?php echo $submission['id']; ?>">
				<div class="modal-header">
					<h2><?php if ($submission['attachment'] == NULL) { ?> Add <?php } else { ?> Edit <?php } ?> submission</h2>
					<h2 class="close-button" onclick="addSubmission();">&times;</h2>
				</div>
				<div class="modal-body">
					<div style="display: flex;">	
						<label id="filename" class="input-group" style="background-color: #cccccc; width: 100%; display: flex; align-items: center; padding-left: 10px; color: black;"><?php echo $submission['attachment']; ?></label>
						<label for="file" class="btn btn-secondary" style="border-radius: unset;">Upload</label>
						<input id="file" type="file" name="attachment" onchange="getFileName();" hidden="hidden">
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn btn-danger" onclick="addSubmission();">Cancel</div>
					<button class="btn btn-success" type="submit" name="submit" value="<?php if ($submission['attachment'] == NULL) { echo 'create-submission'; } else { echo 'update-submission'; } ?>">Save</button>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		function addSubmission() {
			var modal = document.getElementById('modal-submission');

			if (modal.style.display == "none") {
				modal.style.display = "block";
			} else {
				modal.style.display = "none";
			}
		}

		function getFileName() {
			var fullPath = document.getElementById('file').value;
			
			if (fullPath) {
				var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
				var filename = fullPath.substring(startIndex);
			
				if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
					filename = filename.substring(1);
				}
				document.getElementById('filename').innerHTML = filename;
			}
		}
	</script>
</body>
</html>