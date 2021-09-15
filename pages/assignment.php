<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php 
	require_once '../controller/AssignmentController.php';
	require_once '../controller/SubmissionController.php';
	require_once '../controller/ChannelController.php';

	$assignmentController = new AssignmentController();
	$submissionController = new SubmissionController();
	$channelController = new ChannelController();

	$assignments = $assignmentController->getAssignments($_SESSION['account']['id']);
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
<?php  	if ($assignments === false) { ?>
			<div class="no-content">
				<p class="no-content-text">You have no assignment</p>
				<div><a href="create-assignment.php" class="btn btn-primary">Create Assignment</a></div>
			</div>
<?php	} else { ?>
			<div class="card">
				<div class="card-header">
					<h2>Your assignment</h2>
				</div>
				<div class="card-content">
<?php 	foreach ($assignments as $assignment) { ?>
<?php $totalSubmitted = $submissionController->getTotalSubmitted($assignment['id'])[0]; $totalStudent = $channelController->getTotalStudents($assignment['channel'])[0]['total']; ?>
					<a href="view-assignment.php?id=<?php echo $assignment['id']; ?>" class="box-item">
						<div class="box-item-container">
							<div class="item-image-col"><b><?php echo substr(ucwords($assignment['title']), 0, 20). "..."; ?></b></div>
							<small>Total Submission:</small>
							<div class="item-title-col" style="font-size: 25px;">
<?php 	if ($totalSubmitted['total'] == $totalStudent) { ?>
								<span style="color: green;">Complete</span>
<?php 	} else { ?>
								<span style="color: red;"><?php echo $totalSubmitted['total']; ?></span>&nbsp;/&nbsp;<span style="color: green;"><?php echo $totalStudent; ?></span>
<?php  } ?>
							</div>
						</div>
					</a>
<?php 	} ?>
				</div>
				<div class="card-footer">
					<a href="create-assignment.php" style="float: right; position: relative; right: -98%; color: inherit;">
						<i class="fas fa-plus fa-2x"></i>
					</a>
				</div>
			</div>
<?php } ?>
		</div>	
	</div>
</body>
</html>