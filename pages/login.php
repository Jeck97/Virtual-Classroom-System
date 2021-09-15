<?php 
	include_once '../inc/config.php';
	include_once '../inc/header-auth.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once '../inc/head.php'; ?>
</head>
<body>
	<div id="container" class="container">
		<div class="header">
			<h1>Sign In | <br><b><a href="welcome.php"><?php echo $WEBSITE_NAME; ?></a></b></h1>
		</div>
		<form id="form-login" class="form" action="../controller/manager/auth.php" method="post">
			<div class="form-control">
				<input type="email" style="padding: 15px 10px; font-size: 1rem;" placeholder="Email..." id="input-email" onkeyup="validateEmail();" name="email" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="form-control">
				<input type="password" style="padding: 15px 10px; font-size: 1rem;" placeholder="Password..." id="input-password" onkeyup="validatePassword();" name="password" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="row">
				<div class="form-control success" style="flex: 0 0 auto; width: 66.67%; padding: 0;">
					<label class="checkbox-group">
						Remember me <input type="checkbox" name="remember" id="input-checkbox" checked="checked" ><span class="checkmark" ></span>
					</label>
				</div>
				<div style="flex: 0 0 auto; width: 33.33%; padding: 0;">
					<button class="btn-primary" type="submit" name="submit" value="login" onclick="validateLogin();">Sign In</button>
				</div>
			</div>
			<p>
				<a href="forgot-password.php">Forgot password</a>
			</p>
			<p>
				Don't have an account? <a href="register.php">Sign Up</a>
			</p>
				
			
		</form>
	</div>
</body>
</html>