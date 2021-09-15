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
			<h1>Sign Up | <br><b><a href="welcome.php"><?php echo $WEBSITE_NAME; ?></a></b></h1>
		</div>
		<form id="form-register" class="form" action="../controller/manager/auth.php" method="post">
			<div class="form-control" style="display: flex;">
				<label for="input-role" style="width: 8rem; padding: 10px 0px;">I am a/an </label>
				<select id="input-role" name="role" class="select">
					<option value="educator">Educator</option>
					<option value="student">Student</option>
				</select>
			</div>
			<div class="form-control">
				<input type="text" style="padding: 15px 20px 15px 10px; font-size: 1rem;" placeholder="Full name..."id="input-fullname" onkeyup="validateFullname();" name="fullname" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="form-control">
				<input type="email" style="padding: 15px 10px; font-size: 1rem;" placeholder="Email..." id="input-email" onkeyup="validateEmail();" name="email" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="form-control">
				<input type="password" style="padding: 15px 10px; font-size: 1rem;" placeholder="Password..." id="input-password" onkeyup="validatePassword(); comparePassword();" name="password" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="form-control">
				<input type="password" placeholder="Re-enter password..." style="padding: 15px 10px; font-size: 1rem;" id="input-password-confirm" onkeyup="validatePasswordConfirm(); comparePassword();" />
				<i class="fas fa-check-circle"></i>
				<i class="fas fa-exclamation-circle"></i>
				<small>Error message</small>
			</div>
			<div class="row">
				<div class="form-control success" style="flex: 0 0 auto; width: 66.67%; padding: 0;">
					<label class="checkbox-group">
						I agree to the <a href="#">term</a>. <input type="checkbox" name="agreement" id="input-checkbox"><span class="checkmark" ></span>
					</label>
					<small>Error message</small>
				</div>
				<div style="flex: 0 0 auto; width: 33.33%; padding: 0;">
					<button class="btn-primary" type="submit" name="submit" value="register" onclick="validateRegister();">Sign Up</button>	
				</div>
			</div>
			<p>
				Already a member? <a href="login.php">Sign In</a>
			</p>
		</form>
	</div>
	
</body>
</html>