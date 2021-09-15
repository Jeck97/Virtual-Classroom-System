<?php
require_once '../AuthController.php';
require_once '../Util.php';
require_once '../Session.php';

if (isset($_POST['submit'])) {

    $util = new Util();
    $auth = new AuthController();
    $session = new Session();

    if (!isset($_SESSION)) session_start();
    $account = $_SESSION['account'];
    $message = "";
    $path = "";

    if ($_POST['submit'] === "send") {
        $message = $_POST['message'];

        $db = new DBController();
        $query = "SELECT reply FROM chatbot WHERE query LIKE '%$message%' AND (role = ? OR role = 'all')";
        $results = $db->runQuery($query, 's', array($account["role"]));
        echo $results != null ? $results[0]["reply"] : "Sorry, I don't understand it...";
    }

    if ($message != "")
        $util->displayMessage($message);

    if ($path != "")
        $util->redirect($path);
}
