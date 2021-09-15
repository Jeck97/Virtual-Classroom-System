<?php

include '../inc/config.php';
include '../inc/header.php';

$db = new DBController();

if (!isset($_SESSION)) session_start();
$studentEmail = $_SESSION['account']['email'];
$queryStudent = "SELECT * FROM `student` WHERE `email` = ?";
$studentId = $db->runQuery($queryStudent, 's', array($studentEmail))[0]["id"];

$examId = $_GET["exam"];
$queryExam = "SELECT *, `channel`.`name` AS 'channel_name' FROM `exam` JOIN `channel` ON `channel`.`id` = `exam`.`channel` WHERE `exam`.`id` = ?";
$exam = $db->runQuery($queryExam, 's', array($examId))[0];

$queryQuestions = "SELECT * FROM `question` WHERE `exam` = ?";
$questions = $db->runQuery($queryQuestions, 's', array($examId)) ?? [];

$queryExamStudent = "SELECT * FROM `exam_student` WHERE `exam_student`.`exam` = ? AND `exam_student`.`student` = ?";
$examStudent = $db->runQuery($queryExamStudent, 'ss', array($examId, $studentId));
if ($examStudent) {
    $examStudent = $examStudent[0];
    $_SESSION["exam"]["mark"] = $examStudent["mark"];
    $_SESSION["exam"]["answers"] = json_decode($examStudent["answers"], true);
} else {
    $_SESSION["exam"]["mark"] = 0;
    $_SESSION["exam"]["answers"] = array();
}

$start = strtotime($exam["date_time"]);
$now = strtotime(date("Y-m-d H:i:s"));
$end = $start + $exam["duration"] * 60;
if ($now >= $start && $now <= $end) {
    $endTimestamp = $end * 1000;
    $timer = "<script>startTimer($endTimestamp);</script>";
    $footer = '<div class="card-footer"><div></div><button class="btn btn-success" type="submit" name="submit" value="submit-exam" id="btn-submit">Submit</button></div>';
    if ($examStudent == null) {
        $queryInsert = "INSERT INTO `exam_student`(`id`, `exam`, `student`, `mark`, `datetime_submit`, `answers`) VALUES (null,?,?,?,null,?)";
        $db->runInsertUpdate($queryInsert, "ssds", array($examId, $studentId, 0.00, json_encode($_SESSION["exam"]["answers"])));
    }
} else if ($now > $end) {
    $info = "Total Marks: " .  $_SESSION["exam"]["mark"] . "/" . count($questions);
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../inc/head.php'; ?>
</head>

<body>

    <?php include '../inc/top-nav.php'; ?>
    <?php include '../inc/side-nav.php'; ?>

    <div id="container" class="container">
        <div class="header">
            <h1>Examination Questions</h1>
        </div>
        <div class="main-content">
            <div class="card">
                <form action="../controller/manager/examination-manager.php" method="post">
                    <div class="card-header">
                        <div>
                            <div>
                                <h2><?php echo $exam["title"]; ?></h2>
                            </div>
                            <div><?php echo $exam["channel_name"]; ?></div>
                        </div>
                        <div>
                            <h2 id="info"><?php echo $info ?? ""; ?></h2>
                        </div>
                    </div>
                    <div class="card-content">
                        <?php
                        foreach ($questions as $key => $question) {
                            $questionId = $question["id"];
                            $questionAnswer = $question["answer"];

                            $index = $key + 1;
                            $radioName = "question$index";

                            if ($now >= $start && $now <= $end) {
                                $onClick = "updateAnswer($index, this.value, $questionId, '$questionAnswer');";
                                $optionStatus = array_map(fn () => '', range(1, 4));
                                $radioStatus = array_map(fn ($i) => isset($_SESSION["exam"]["answers"][$questionId]) && $_SESSION["exam"]["answers"][$questionId] === "option$i" ? 'checked ' . 'onclick="' . $onClick . '"' : 'onclick="' . $onClick . '"', range(1, 4));
                                $borderColor = isset($_SESSION["exam"]["answers"][$questionId]) ? "answered" : "";
                            } else if ($now > $end) {
                                $optionStatus = array_map(fn ($i) => $questionAnswer === "option$i" ? 'correct-answer' : '', range(1, 4));
                                $radioStatus = array_map(fn ($i) => isset($_SESSION["exam"]["answers"][$questionId]) && $_SESSION["exam"]["answers"][$questionId] === "option$i" ? 'checked' : 'onclick="this.checked = false;"', range(1, 4));
                                $borderColor = isset($_SESSION["exam"]["answers"][$questionId]) && $_SESSION["exam"]["answers"][$questionId] === $questionAnswer ? "correct" : "wrong";
                            }
                        ?>
                            <div id="list-item-<?php echo $index ?>" class="list-item <?php echo $borderColor ?>">
                                <div class="item-header">
                                    <span>Question <?php echo $index ?></span>
                                </div>
                                <p><?php echo $question["question"] ?></p>
                                <div class="item-content">
                                    <div class="option <?php echo $optionStatus[0] ?>">
                                        <input class="radio" type="radio" name="<?php echo $radioName ?>" id="<?php echo $radioName ?>-answer1" value="option1" <?php echo $radioStatus[0] ?> required>
                                        <label for="<?php echo $radioName ?>-answer1"><?php echo $question["option1"] ?></label>
                                    </div>
                                    <div class="option <?php echo $optionStatus[1] ?>">
                                        <input class="radio" type="radio" name="<?php echo $radioName ?>" id="<?php echo $radioName ?>-answer2" value="option2" <?php echo $radioStatus[1] ?> required>
                                        <label for="<?php echo $radioName ?>-answer2"><?php echo $question["option2"] ?></label>
                                    </div>
                                    <div class="option <?php echo $optionStatus[2] ?>">
                                        <input class="radio" type="radio" name="<?php echo $radioName ?>" id="<?php echo $radioName ?>-answer3" value="option3" <?php echo $radioStatus[2] ?> required>
                                        <label for="<?php echo $radioName ?>-answer3"><?php echo $question["option3"] ?></label>
                                    </div>
                                    <div class="option <?php echo $optionStatus[3] ?>">
                                        <input class="radio" type="radio" name="<?php echo $radioName ?>" id="<?php echo $radioName ?>-answer4" value="option4" <?php echo $radioStatus[3] ?> required>
                                        <label for="<?php echo $radioName ?>-answer4"><?php echo $question["option4"] ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php echo $footer ?? ""; ?>
                    <input type="hidden" name="exam" value="<?php echo $examId; ?>">
                    <input type="hidden" name="student" value="<?php echo $studentId; ?>">
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function startTimer(endTimestamp) {
            // Update the count down every 1 second
            const x = setInterval(() => {

                // Get today's date and time
                let now = new Date().getTime();

                // Find the distance between now and the count down date
                let distance = endTimestamp - now;

                // Time calculations for days, hours, minutes and seconds
                let hours = Math.floor(distance / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("info").innerHTML = "Timer: " + ('0' + hours).slice(-2) + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("info").innerHTML = "TIME'S UP";
                    const button = document.getElementById("btn-submit");
                    button.setAttribute('formnovalidate', 'formnovalidate')
                    button.click();
                }
            }, 1000);
        }

        function updateAnswer(index, option, questionId, questionAnswer) {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(`list-item-${index}`).className = "list-item answered";
                }
            };
            xhttp.open("POST", "../controller/manager/examination-manager.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`submit=update-answers&option=${option}&qid=${questionId}&qanswer=${questionAnswer}&exam=<?php echo $examId; ?>&student=<?php echo $studentId; ?>`);
        }
    </script>
    <?php echo $timer ?? "" ?>
    <style type="text/css">
        .container .main-content .card .card-content {
            padding: 30px 40px;
        }

        .container .main-content .card .card-content .list-item {
            width: 100%;
            display: block;
            border-left: 4px solid grey;
        }

        .container .main-content .card .card-content .list-item.answered {
            border-left: 4px solid black;
        }

        .container .main-content .card .card-content .list-item.correct {
            border-left: 4px solid #70AD47;
        }

        .container .main-content .card .card-content .list-item.wrong {
            border-left: 4px solid red;
        }

        .card-content .list-item .item-header {
            margin: 1rem 0;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .card-content .list-item .item-header span {
            font-size: larger;
            font-weight: bolder;
        }

        .item-content {
            padding: 1rem;
        }

        .item-content .option {
            margin-bottom: 8px;
            display: flex;
        }

        .item-content .option.correct-answer {
            font-weight: bolder;
            color: #70AD47;
        }

        .item-content .option input.radio {
            margin: 7px;
        }
    </style>
</body>

</html>