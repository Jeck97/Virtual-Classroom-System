<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

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
			<h1>Dashboard</h1>
		</div>
		<div class="main-content">
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<div class="header-item" style="background-color: #0d6efd;">
						<div class="icon-container">
							<i class="fas fa-folder-open fa-5x"></i>
						</div>
						<div class="info-container">
							<div class="info-title">
								<p class="info-text">Assignment Due</p>
							</div>
							<div class="info-value"> 
								<p class="info-text">3</p>
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
								<p class="info-text">3</p>
							</div>
							<div class="info-link">
								<a href="#"><p class="info-text">See More >></p></a>
							</div>
						</div>
					</div>
					<div class="header-item" style="background-color: #ffc107;">
						<div class="icon-container">
							<i class="fas fa-file-alt fa-5x"></i>
						</div>
						<div class="info-container">
							<div class="info-title">
								<p class="info-text">Upcoming Examination</p>
							</div>
							<div class="info-value"> 
								<p class="info-text">2</p>
							</div>
							<div class="info-link">
								<a href="#"><p class="info-text">See More >></p></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Attendance Analysis</h2>
				</div>
				<div class="card-content">
					
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Upcoming Event</h2>
				</div>
				<div class="card-content">
					
				</div>
			</div>	
		</div>
	</div>
</body>
</html>