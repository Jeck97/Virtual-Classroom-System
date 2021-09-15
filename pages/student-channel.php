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
			<h1>Channel</h1>
		</div>
		<div class="main-content">
			<div class="no-content">
				<p class="no-content-text">You have no assignment</p>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Your channel</h2>
				</div>
				<div class="card-content">

					<a href="student-view-channel.php" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><i class="fas fa-basketball-ball fa-2x" style="color: #e3580e;"></i></div>
							<div class="item-title-col"><p class="item-title">2021 Bulls Training Camp</p></div>
						</div>
					</a>
					<a href="#" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><i class="fas fa-briefcase fa-2x" style="color: #59290d;"></i></div>
							<div class="item-title-col"><p class="item-title">Business Management Class</p></div>
						</div>
					</a>
					<a href="#" class="box-item">
						<div class="box-item-container">
							<i class="item-option fas fa-ellipsis-h"></i>
							<div class="item-image-col"><i class="fas fa-utensils fa-2x" style="color: #c7c7c7;"></i></div>
							<div class="item-title-col"><p class="item-title">Cooking Masterclass</p></div>
						</div>
					</a>
						
				</div>
				<div class="card-footer">
					<!-- <a href="create-channel.php" style="float: right; position: relative; right: -98%; color: inherit;">
						<i class="fas fa-plus fa-2x"></i> -->
					</a>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>