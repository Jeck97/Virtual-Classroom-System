<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php  
	require_once '../controller/Util.php';
	require_once '../controller/StudentController.php';
	require_once '../controller/ChannelController.php';

	$util = new Util();
	$studentController = new StudentController();
	$channelController = new ChannelController();

	$path = "";

	if ($_SESSION['account']['role'] === "student")
		$path = "student-dashboard.php";

	if ($path != "")
		$util->redirect($path);

	$totalStudents = $studentController->getTotalStudentByEducator($_SESSION['account']['id'])[0]['total'];
	$totalChannels = $channelController->getTotalChannels($_SESSION['account']['id'])[0]['total'];

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
			<h1>Dashboard</h1>
		</div>
		<div class="main-content">
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<div class="header-item" style="background-color: #0d6efd;">
						<div class="icon-container">
							<i class="fas fa-users fa-5x"></i>
						</div>
						<div class="info-container">
							<div class="info-title">
								<p class="info-text">Total Student</p>
							</div>
							<div class="info-value"> 
								<p class="info-text"><?php echo $totalStudents; ?></p>
							</div>
							<div class="info-link">
								<a href="#"><p class="info-text">See More >></p></a>
							</div>
						</div>
					</div>
					<div class="header-item" style="background-color: #dc3545;">
						<div class="icon-container">
							<i class="fas fa-chalkboard-teacher fa-5x"></i>
						</div>
						<div class="info-container">
							<div class="info-title">
								<p class="info-text">Total Channel</p>
							</div>
							<div class="info-value"> 
								<p class="info-text"><?php echo $totalChannels; ?></p>
							</div>
							<div class="info-link">
								<a href="#"><p class="info-text">See More >></p></a>
							</div>
						</div>
					</div>
					<div class="header-item" style="background-color: #ffc107;">
						<div class="icon-container">
							<i class="fas fa-chart-pie fa-5x"></i>
						</div>
						<div class="info-container">
							<div class="info-title">
								<p class="info-text">Overall Attendance</p>
							</div>
							<div class="info-value"> 
								<p class="info-text">95%</p>
							</div>
							<div class="info-link">
								<a href="#"><p class="info-text">See More >></p></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="display: flex; align-items: flex-start; width: 100%;">
				<div class="card" style="margin: 0px 10px 0 0;">
					<div class="card-header">
						<h2>Attendance Analysis</h2>
					</div>
					<div class="card-content">
						
					</div>
				</div>
				<div class="card" style="width: 40%; margin: 0 0 0 10px;">
					<div class="card-header">
						<h2>Upcoming Event</h2>
					</div>
					<div class="card-content">
						<div style="margin-bottom: 20px;">
							<div><h3>Today</h3></div>
							<div style="display: flex; flex-direction: column; background-color: #dddddd; padding: 10px; border-radius: 10px; margin: 10px 0;">
								<label>Assignment 1</label>
								<small>Today</small>
							</div>
							<div style="display: flex; flex-direction: column; background-color: #cccccc; padding: 10px; border-radius: 10px; margin: 10px 0;">
								<label>Assignment 1</label>
								<small>Today</small>
							</div>	
						</div>
						<div style="margin-bottom: 20px;">
							<div><h3>Tomorrow</h3></div>
							<div style="display: flex; flex-direction: column; background-color: #cccccc; padding: 10px; border-radius: 10px; margin: 10px 0;">
								<label>Assignment 1</label>
								<small>Today</small>
							</div>
							<div style="display: flex; flex-direction: column; background-color: #cccccc; padding: 10px; border-radius: 10px; margin: 10px 0;">
								<label>Assignment 1</label>
								<small>Today</small>
							</div>	
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>