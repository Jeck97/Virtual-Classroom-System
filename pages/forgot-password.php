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
	<div id="container" class="container">
		<div class="header">
			<h1>Forgot Password | <br><b><a href="welcome.php"><?php echo $WEBSITE_NAME; ?></a></b></h1>
		</div>
		<form id="form-forgot" class="form" action="../controller/manager/auth.php" style="padding-bottom: 0;" method="post">
			<p>
				You forgot your password? Here you can easily retrieve a new password.
			</p>
			<div class="form-control">
				<input type="email" style="padding: 15px 10px; font-size: 1rem;" placeholder="Email..." id="input-email" onkeyup="validateEmail();" name="email" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="row" style="margin-bottom: 10px;" >
				<button class="btn-primary" type="submit" name="submit" value="forgot" onclick="validateForgotPassword();">Request a new password</button>
			</div>
		</form>
		<div class="row" style="padding: 0 3rem 2rem 3rem;">
			<a href="login.php"><button class="btn-secondary">Sign In</button></a>
		</div>
	</div>
</body>
</html>