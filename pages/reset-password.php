<?php 
	include '../inc/config.php';
	include '../inc/header-auth.php';
?>
<?php  

	if (isset($_GET['key']) && isset($_GET['email']) && isset($_GET['action'])) {

		$message = "";
		$path = "";

		$key = $_GET['key'];
		$email = $_GET['email'];
		$action = $_GET['action'];

		$result = $auth->getTempKeyDate($email, $key, $action)[0];

		if ($result === false) {
			$message = "Invalid link.";
			$path = "welcome.php";
		} else {
			$exp_date = $result['exp_date'];
			$cur_date = date("Y-m-d H:i:s");

			if ($cur_date >= $exp_date) {
				$message = "Link has expired. Request new password";
				$path = "forgot-password.php";
				$auth->removeExpiredLink($cur_date, $action);
			}
		}
	} else {
		$message = "Invalid link.";
		$path = "welcome.php";
	}

	if ($message != "")
		$util->displayMessage($message);
	if ($path != "")
		$util->redirect($path);

?>
<!DOCTYPE html>
<html>
<head>
	<?php include '../inc/head.php' ?>
</head>
<body>
	<div id="container" class="container">
		<div class="header">
			<h1>Forgot Password | <br><b><a href="welcome.php"><?php echo $WEBSITE_NAME; ?></a></b></h1>
		</div>
		<form id="form-reset" class="form" action="../controller/manager/auth.php" method="post">
			<input type="hidden" name="email" value="<?php echo $email; ?>">
			<p>
				You are only one step a way from your new password, recover your password now.
			</p>
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
			<div class="row" style="margin-bottom: 10px;" >
				<button class="btn-primary" type="submit" name="submit" value="reset" onclick="validateResetPassword();">Request a new password</button>
			</div>
		</form>
	</div>
</body>
</html>