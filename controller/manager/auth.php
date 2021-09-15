<?php
require_once '../AuthController.php';
require_once '../Util.php';
require_once '../Session.php';

if (isset($_POST['submit'])) {

	$auth = new AuthController();
	$util = new Util();
	$session = new Session();

	$message = "";
	$path = "";

	if ($_POST['submit'] === "register") {

		$role = trim($_POST['role']);
		$fullname = strtolower(trim($_POST['fullname']));
		$email = strtolower(trim($_POST['email']));
		$password = trim($_POST['password']);

		if ($auth->isExist($email) != false) {
			$message = "Account already exist. Please log in.";
			$path = "../../pages/login.php";
		} else {
			$table = $role;
			$id = $util->generateUID($table);
			$encryptedPassword = $auth->encryptPassword($password);

			$action = "verify";
			$key = $util->generateKey($email);
			$expDate = "";
			$auth->storeTempKey($email, $expDate, $key, $action);

			$to = $email;
			$subject = "Email Verification";
			// MODIFIED: link v1.1 -> v1.2
			$link = "http://localhost/Virtual-Classroom-System-v1.2/pages/email-verified.php?email=" . $email . "&key=" . $key . "&action=" . $action;

			if (($auth->registerUser($id, $fullname, $email, $encryptedPassword, $role) === true) && (mail($to, $subject, $link) === true)) {
				$message = "Successfully registered!";
				$path = "../../pages/login.php";
			} else {
				$message = "Failed to register!";
				$path = "../../pages/register.php";
			}
		}
	}

	if ($_POST['submit'] === "login") {

		$email = strtolower(trim($_POST['email']));
		$password = trim($_POST['password']);
		$remember = $_POST['remember'];
		$account = $auth->isExist($email)[0];

		if ($account != false) {
			if (password_verify($password, $account['password']) == 1) {
				if ($account['status'] === "active") {
					$session->updateSession($account);
					$message = "Welcome " . ucwords($account['name']) . ".";
					if ($account["role"] == "educator")
						$path = "../../pages/dashboard.php";
					else
						$path = "../../pages/student-dashboard.php";
				} else {

					// MODIFIED: Checking the exist of link verification
					$action = "verify";
					$query = "SELECT COUNT(*) AS 'count' FROM `key_temp` WHERE `email` = ? AND `action` = ?";
					$result = (new DBController())->runQuery($query, 'ss', array($email, $action))[0]['count'];
					if ($result == 0) {
						$key = $util->generateKey($email);
						$expDate = "";
						$auth->storeTempKey($email, $expDate, $key, $action);

						$to = $email;
						$subject = "Email Verification";
						$link = "http://localhost/Virtual-Classroom-System-v1.2/pages/email-verified.php?email=" . $email . "&key=" . $key . "&action=" . $action;
						mail($to, $subject, $link);
					} // END MODIFIED

					$message = "Please verify your email. Verfication link has been sent to your email.";
					$path = "../../pages/login.php";
				}
			} else {
				$message = "Incorrect password.";
				$path = "../../pages/login.php";
			}
		} else {
			$message = "Account does not exist.";
			$path = "../../pages/login.php";
		}
	}

	// FIXME: inactive email also can reset the password
	// FIXME: Duplicate temp_key
	if ($_POST['submit'] === "forgot") {

		$email = strtolower(trim($_POST['email']));
		$account = $auth->isExist($email)[0];
		$action = "reset";

		if ($account != false) {

			$key = $util->generateKey($email);
			$expDate = $util->generateExpiredDate();
			$auth->storeTempKey($email, $expDate, $key, $action);

			// MODIFIED: link v1.1 -> v1.2
			$output = "http://localhost/Virtual-Classroom-System-v1.2/pages/reset-password.php?key=" . $key . "&email=" . $email . "&action=" . $action;

			$to = $email;
			$subject = "Password Recovery";
			$message = $output;

			if (mail($to, $subject, $message) === true) {
				$message = "Check your email to recover your password.";
				$path = "../../pages/login.php";
			} else {
				$message = "Failed to send email.";
				$path = "../../pages/forgot-password.php";
			}
		} else {
			$message = "Account does not exist.";
			$path = "../../pages/forgot-password.php";
		}
	}

	if ($_POST['submit'] === "reset") {

		$email = strtolower(trim($_POST['email']));
		$password = $_POST['password'];
		$encryptedPassword = $auth->encryptPassword($password);
		$action = "reset";

		if ($auth->updatePassword($email, $encryptedPassword) === true) {
			$auth->removeUsedLink($email, $action);
			$message = "Password successfully updated";
			$path = "../../pages/login.php";
		} else {
			$message = "Failed to update password! Try again later";
			$path = "../../pages/welcome.php";
		}
	}

	if ($message != "")
		$util->displayMessage($message);

	if ($path != "")
		$util->redirect($path);
}
