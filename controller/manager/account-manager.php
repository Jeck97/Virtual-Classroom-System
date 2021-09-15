<?php
require_once '../AuthController.php';
require_once '../Util.php';
require_once '../Session.php';

if (isset($_POST['submit'])) {

    $util = new Util();
    $auth = new AuthController();
    $session = new Session();

    if (!isset($_SESSION)) {
        session_start();
    }
    $account = $_SESSION['account'];
    $role = $account["role"] === "educator" ? "" : "student-";
    $message = "";
    $path = "";

    if ($_POST['submit'] === "goto-change-email") {

        $password = trim($_POST['password']);

        if (password_verify($password, $account['password']) == 1) {
            $path = "../../pages/change-email.php";
        } else {
            $message = "Incorrect password.";
            $path = "../../pages/" . $role . "account.php";
        }
    }

    if ($_POST['submit'] === "goto-change-password") {

        $password = trim($_POST['password']);

        if (password_verify($password, $account['password']) == 1) {
            $path = "../../pages/change-password.php";
        } else {
            $message = "Incorrect password.";
            $path = "../../pages/" . $role . "account.php";
        }
    }

    if ($_POST['submit'] === "update-email") {

        $db = new DBController();
        $email = strtolower(trim($_POST['email']));
        $oldEmail = $account['email'];

        if ($auth->isExist($email) != false) {
            $message = "Email already exist.";
            $path = "../../pages/change-email.php";
        } else {

            $action = "update";
            $query = "SELECT * FROM key_temp WHERE ((email = ?) AND (action = ?))";
            $result = $db->runQuery($query, 'ss', array($email, $action));

            if ($result != false) {
                $message = "The verification link has already been sent to this email address, please check the email again.";
                $path = "../../pages/" . $role . "account.php";
            } else {

                $key = $util->generateKey($email);
                $expDate = "";
                $auth->storeTempKey($email, $expDate, $key, $action);

                $to = $email;
                $subject = "Updated Email Verification";
                $message = "http://localhost/Virtual-Classroom-System-v1.3/pages/updated-email-verified.php?email=" . $email . "&key=" . $key . "&action=" . $action . "&current-email=" . $oldEmail;

                if (mail($to, $subject, $message) === true) {
                    $message = "Please verify your email. Verfication link has been sent to your email.";
                    $path = "../../pages/" . $role . "account.php";
                } else {
                    $message = "Failed to send email.";
                    $path = "../../pages/change-email.php";
                }
            }
        }
    }

    if ($_POST['submit'] === "update-password") {

        $password = trim($_POST['password']);
        $encryptedPassword = $auth->encryptPassword($password);
        $email = $account['email'];

        $result = $auth->updatePassword($email, $encryptedPassword);

        if ($result) {
            $account = $auth->isExist($email)[0];
            $session->updateSession($account);
            $message = "Password successfully updated";
        } else
            $message = "Failed to update password! Try again later";

        $path = "../../pages/" . $role . "account.php";
    }

    if ($_POST['submit'] === "update-name-pic") {

        $path = "../../pages/" . $role . "account.php";
        $name = strtolower(trim($_POST['fullname']));
        $oldName = $account['name'];
        $email = $account['email'];
        $db = new DBController();

        if ($name != $oldName) {
            $queryName = "UPDATE account SET name = ? WHERE email = ?";
            $resultName = $db->runInsertUpdate($queryName, 'ss', array($name, $email));
            if ($resultName) {
                $account = $auth->isExist($email)[0];
                $session->updateSession($account);
                $message = "Name successfully updated\\n";
            } else
                $message = "Failed to update name! Try again later\\n";
        }

        if ($_FILES["profile-pic"]['size'] != 0) {
            $oldImageName = $account['image'];
            $imageName = basename($_FILES["profile-pic"]["name"]);
            $target_dir = "../../img/";
            $target_file = $target_dir . $imageName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profile-pic"]["tmp_name"]);

            if ($check !== false) {

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $message .= "Only JPG, JPEG, PNG & GIF files are allowed.";
                }

                // Check file size max=10MB
                else if ($_FILES["profile-pic"]["size"] > 10485760) {
                    $message .= "Your file is too large.";
                }

                // Check if file already exists
                else if (file_exists($target_file)) {
                    $message .= "File already exists.";
                }

                // if everything is ok, try to upload file
                else if (move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file)) {
                    unlink($target_dir . $oldImageName);
                    $queryPic = "UPDATE account SET image = ? WHERE email = ?";
                    $resultPic = $db->runInsertUpdate($queryPic, 'ss', array($imageName, $email));

                    if ($resultPic) {
                        $account = $auth->isExist($email)[0];
                        $session->updateSession($account);
                        $message .= "Profile picture successfully updated";
                    } else
                        $message .= "Failed to update profile picture! Try again later";
                }

                // Other error occured
                else {
                    $message .= "There was an error uploading your file.";
                }
            } else {
                $message .= "File is not an image.";
            }
        }
    }

    if ($_POST['submit'] === "deactive-account") {
        $db = new DBController();
        $email = $account['email'];

        $query = "UPDATE `account` SET `status`= ? WHERE `email`= ?";
        $result = $db->runInsertUpdate($query, 'ss', array("inactive", $email));

        if ($result === true) {
            if (!isset($_SESSION)) session_start();
            session_unset();
            session_destroy();

            $message = "Your account $email had been deactivated. You can re-activate the account after verifying your email.";
            $path = "../../pages/welcome.php";
        } else {
            $message = "Failed to deactive account! Try again later";
            $path = "../../pages/" . $role . "account.php";
        }
    }

    if ($message != "")
        $util->displayMessage($message);

    if ($path != "")
        $util->redirect($path);
}
