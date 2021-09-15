<?php 
	include '../inc/config.php';
	include '../inc/header-auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include '../inc/head.php'; ?>
</head>
<body>
	<img src="../img/classroom-bg.jpg" class="bg" />
	<nav class="navbar">
		<ul class="navbar-nav">
			<li style="padding-left: 40px;"><img src="../img/edu-v-logo.png" class="logo" ></li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
			<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
		</ul>
	</nav>
	<div class="title">
		Welcome to <?php echo $WEBSITE_NAME; ?>
	</div>
	<div class="action">
		<a href="register.php"><button class="btn-primary btn-action">Get Started</button></a>
	</div>
</body>
</html>