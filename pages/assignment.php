<?php include_once '../inc/config.php'; ?>
<?php include_once '../inc/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once '../inc/head.php'; ?>
</head>
<body>
	
	<?php include_once '../inc/top-nav.php'; ?>
	<?php include_once '../inc/side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Assignment</h1>
		</div>
		<div class="main-content">
			<div class="no-content">
				<p class="no-content-text">You have no assignment</p>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Your assignment</h2>
				</div>
				<div class="card-content">

					<a href="view-assignment.php" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><b>Week 2...</b></div>
							<small>Total Submission:</small>
							<div class="item-title-col" style="font-size: 25px;"><span style="color: red;">239</span>&nbsp;/&nbsp;<span style="color: green;">275</span></div>
						</div>
					</a>
					<a href="#" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><b>Week 3...</b></div>
							<small>Total Submission:</small>
							<div class="item-title-col" style="font-size: 25px;"><span style="color: green;">Complete</span></div>
						</div>
					</a>
					<a href="#" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><b>Test your..</b></div>
							<small>Total Submission:</small>
							<div class="item-title-col" style="font-size: 25px;"><span style="color: red;">0</span>&nbsp;/&nbsp;<span style="color: green;">16</span></div>
						</div>
					</a>
						
				</div>
				<div class="card-footer">
					<a href="create-assignment.php" style="float: right; position: relative; right: -98%; color: inherit;">
						<i class="fas fa-plus fa-2x"></i>
					</a>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>