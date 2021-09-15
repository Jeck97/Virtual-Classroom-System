<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

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
			<h1>Notification</h1>
		</div>
		<div class="main-content" style="display: flex; justify-content: center;">
			<div class="no-content">
				<p class="no-content-text">You have no notification</p>
			</div>
			<div class="card">
				<div class="card-content">
					<a href="#" class="list-item">
						<div class="item-col-image">
							<img src="../img/steph-curry.jpg" class="image">
						</div>
						<div class="item-col-desc">
							<div class="item-message">
								<p><b>Stephen Curry</b> has submitted Assignment 1</p>
							</div>
							<div class="item-duration">
								<small>1 min ago</small>
							</div>
						</div>
					</a>
					<a href="#" class="list-item">
						<div class="item-col-image">
							<img src="../img/james-harden.jpg" class="image">
						</div>
						<div class="item-col-desc">
							<div class="item-message">
								<p><b>James Harden</b> has submitted Assignment 1</p>
							</div>
							<div class="item-duration">
								<small>1 min ago</small>
							</div>
						</div>
					</a>
					<a href="#" class="list-item read">
						<div class="item-col-image">
							<img src="../img/lebron-james.jpg" class="image">
						</div>
						<div class="item-col-desc">
							<div class="item-message">
								<p><b>Lebron James</b> has submitted Assignment 1</p>
							</div>
							<div class="item-duration">
								<small>10 min ago</small>
							</div>
						</div>
					</a>
					<a href="#" class="list-item read">
						<div class="item-col-image">
							<img src="../img/kevin-durrant.jpg" class="image">
						</div>
						<div class="item-col-desc">
							<div class="item-message">
								<p><b>Kevin Durrant</b> has submitted Assignment 1</p>
							</div>
							<div class="item-duration">
								<small>13 min ago</small>
							</div>
						</div>
					</a>
					<a href="#" class="list-item read">
						<div class="item-col-image">
							<img src="../img/gianis-antetokounmpo.jpg" class="image">
						</div>
						<div class="item-col-desc">
							<div class="item-message">
								<p><b>Gianis Antetokounmpo</b> has submitted Assignment 1</p>
							</div>
							<div class="item-duration">
								<small>45 min ago</small>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>