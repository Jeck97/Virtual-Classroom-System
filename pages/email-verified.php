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
		$status = "active";

		$result = $auth->getTempKeyDate($email, $key, $action);

		if ($result === false) {
			$message = "Invalid link.";
			$path = "welcome.php";
		} else {
			$auth->removeUsedLink($email, $action);
			$auth->updateAccountStatus($email, $status);
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
	<?php include '../inc/head.php'; ?>
</head>
<body>
	<div id="container" class="container" style="width: 40%; min-width: 330px;">
		<div class="header">
			<div class="icon" style="position: relative;">
				<i class="fas fa-check-circle fa-10x"></i>
			</div>
			<div class="subtitle" style="position: relative;">
				<h1>Your email address has been verified!</h1>
			</div>

			<a href="login.php" class="action" style="position: relative;">
				<div style="display: flex;" class="btn-primary btn-action">
					<div style="padding: 10px;">
						Login
					</div>
					<div style="padding: 10px; ">
						<i class="fas fa-arrow-right"></i>
					</div> 
				</div>	
			</a>
		</div>
	</div>
</body>
</html>