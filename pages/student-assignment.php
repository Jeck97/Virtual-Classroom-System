<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php
require_once '../controller/AssignmentController.php';
require_once '../controller/SubmissionController.php';

$assignmentController = new AssignmentController();
$submissionController = new SubmissionController();

$assignments = $assignmentController->getAssignmentsByStudent($_SESSION['account']['id']);
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
			<?php if ($assignments === false) { ?>
				<div class="no-content">
					<p class="no-content-text">You have no assignment</p>
				</div>
			<?php	} else { ?>
				<div class="card">
					<div class="card-header">
						<h2>Your assignment</h2>
					</div>
					<div class="card-content">
						<?php foreach ($assignments as $assignment) { ?>
							<?php $submission = $submissionController->getSubmissions($assignment['id'], $_SESSION['account']['id'])[0]; ?>
							<a href="student-view-assignment.php?id=<?php echo $assignment['id']; ?>" class="box-item">
								<div class="box-item-container">
									<div class="item-image-col"><b><?php echo substr(ucwords($assignment['title']), 0, 20) . "..."; ?></b></div>
									<small>Progress:</small>
									<div class="item-title-col" style="font-size: 25px;">
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
								</div>
							</a>
						<?php 	} ?>
					<?php } ?>
					</div>
				</div>
		</div>
	</div>
</body>

</html>