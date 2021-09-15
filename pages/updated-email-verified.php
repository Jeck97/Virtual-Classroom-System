<?php
include_once '../inc/config.php';
?>
<?php

if (isset($_GET['key']) && isset($_GET['email']) && isset($_GET['action']) && isset($_GET['current-email'])) {

    $message = "";
    $path = "";

    $key = $_GET['key'];
    $email = $_GET['email'];
    $action = $_GET['action'];
    $oldEmail = $_GET['current-email'];

    $result = $auth->getTempKeyDate($email, $key, $action);

    if ($result === false) {
        $message = "Invalid link.";
        $path = "../index.php";
    } else {
        $db = new DBController();
        $query = "UPDATE account SET email = ? WHERE email = ?";
        $result = $db->runInsertUpdate($query, 'ss', array($email, $oldEmail));
        if ($result) {
            if ($session->isSessionExist()) {
                $account = $auth->isExist($email)[0];
                $session->updateSession($account);
            }
        } else {
            $message = "Failed to update email! Try again later";
            $path = "../index.php";
        }
        $auth->removeUsedLink($email, $action);
    }
} else {
    $message = "Invalid link.";
    $path = "../index.php";
}

if ($message != "")
    $util->displayMessage($message);
if ($path != "")
    $util->redirect($path);

?>


<!DOCTYPE html>
<html>

<head>
    <title><?php echo $PAGE_TITLE; ?> <?php if ($CURRENT_PAGE != "welcome") { ?>| <?php echo $WEBSITE_NAME;
                                                                                } ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://kit.fontawesome.com/c6247777a6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/auth.css">
    <script type="text/javascript" src="../js/auth.js"></script>
</head>

<body>
    <div id="container" class="container" style="width: 40%; min-width: 330px;">
        <div class="header">
            <div class="icon" style="position: relative;">
                <i class="fas fa-check-circle fa-10x"></i>
            </div>
            <div class="subtitle" style="position: relative;">
                <h1>Your email address has been verified and updated!</h1>
            </div>

            <a href="../index.php" class="action" style="position: relative;">
                <div style="display: flex;" class="btn-primary btn-action">
                    <div style="padding: 10px;">
                        Process
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