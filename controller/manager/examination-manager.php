<?php
require_once '../AuthController.php';
require_once '../Util.php';
require_once '../Session.php';

if (isset($_POST['submit'])) {

    $util = new Util();
    $auth = new AuthController();
    $session = new Session();

    if (!isset($_SESSION)) session_start();
    $message = "";
    $path = "";

    if ($_POST['submit'] === "create-examination") {
        $title = $_POST["title"];
        $date = $_POST["date-picker"];
        $time = $_POST["time-picker"];
        $hour = $_POST["hour"];
        $minute = $_POST["minute"];
        $channel = $_POST["channel"];

        $id = $util->generateUID("exam");
        $datetime = "$date $time:00";
        $duration = $hour * 60 + $minute;
        $param_value_array = array($id, $title, $datetime, $duration, $channel);

        $db = new DBController();
        $query = "INSERT INTO `exam`(`id`, `title`, `date_time`, `duration`, `channel`) VALUES (?,?,?,?,?)";
        $result = $db->runInsertUpdate($query, 'sssis', $param_value_array);

        if ($result) {
            $message = "Examination $title successfully created";
            $path = "../../pages/examination-questions.php?exam=$id";
        } else {
            $message = "Failed to create examination! Try again later";
            $path = "../../pages/create-examination.php";
        }
    }

    if ($_POST['submit'] === "add-question") {
        $param_value_array = array(
            $_POST["question"],
            $_POST["option1"],
            $_POST["option2"],
            $_POST["option3"],
            $_POST["option4"],
            $_POST["answer"],
            $_POST["exam-id"]
        );

        $db = new DBController();
        $query = "INSERT INTO `question`(`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam`) VALUES (null,?,?,?,?,?,?,?)";
        $result = $db->runInsertUpdate($query, 'sssssss', $param_value_array);

        $message = $result ?
            "Question successfully added" :
            "Failed to add question! Try again later";
        $path = "../../pages/examination-questions.php?exam=" . $_POST["exam-id"];
    }

    if ($_POST['submit'] === "update-question") {
        $param_value_array = array(
            $_POST["question"],
            $_POST["option1"],
            $_POST["option2"],
            $_POST["option3"],
            $_POST["option4"],
            $_POST["answer"],
            $_POST["question-id"]
        );

        $db = new DBController();
        $query = "UPDATE `question` SET `question`=?,`option1`=?,`option2`=?,`option3`=?,`option4`=?,`answer`=? WHERE `id`=?";
        $result = $db->runInsertUpdate($query, 'ssssssi', $param_value_array);

        $message = $result ?
            "Question successfully updated" :
            "Failed to update question! Try again later";
        $path = "../../pages/examination-questions.php?exam=" . $_POST["exam-id"];
    }

    if ($_POST['submit'] === "delete-question") {
        $db = new DBController();
        $query = "DELETE FROM `question` WHERE `id`=?";
        $result = $db->runInsertUpdate($query, 'i', array($_POST["question-id"]));

        $message = $result ?
            "Question successfully deleted" :
            "Failed to delete question! Try again later";
        $path = "../../pages/examination-questions.php?exam=" . $_POST["exam-id"];
    }

    if ($_POST["submit"] === "update-answers") {
        $option = $_POST["option"];
        $qid = $_POST["qid"];

        if ($option === $_POST["qanswer"]) {
            $_SESSION["exam"]["mark"]++;
        } else {
            if (isset($_SESSION["exam"]["answers"][$qid]) && $_SESSION["exam"]["answers"][$qid] === $_POST["qanswer"])
                $_SESSION["exam"]["mark"]--;
        }
        $_SESSION["exam"]["answers"][$qid] = $option;

        $db = new DBController();
        $query = "UPDATE `exam_student` SET `mark` = ?, `answers` = ? WHERE `exam`= ? AND `student` = ?";
        $result = $db->runInsertUpdate($query, 'dsss', array($_SESSION["exam"]["mark"], json_encode($_SESSION["exam"]["answers"]), $_POST["exam"], $_POST["student"]));
    }

    if ($_POST["submit"] === "submit-exam") {
        $db = new DBController();
        $query = "UPDATE `exam_student` SET `datetime_submit` = now(), `answers` = ? WHERE `exam`= ? AND `student` = ?";
        $result = $db->runInsertUpdate($query, 'sss', array(json_encode($_SESSION["exam"]["answers"]), $_POST["exam"], $_POST["student"]));

        if ($result) {
            $message = "Examination successfully submited";
            $path = "../../pages/student-examination.php?";
            unset($_SESSION["exam"]);
        } else {
            $message = "Failed to submit examination! Please contact your educator.";
            $path = "../../pages/student-examination-questions.php?exam=" . $_POST["exam"];
        }
    }

    if ($message != "")
        $util->displayMessage($message);

    if ($path != "")
        $util->redirect($path);
}
