<?php


include '../inc/config.php';
include '../inc/header.php';

$examId = $_GET["exam"];

$db = new DBController();
$queryExam = "SELECT * FROM `exam` WHERE `exam`.`id` = ?";
$exam = $db->runQuery($queryExam, 's', array($examId))[0];

$examStartDatetime = new DateTime($exam["date_time"]);
$examStartDatetime = $examStartDatetime->format("D j(S) M Y \&\\n\b\s\p\; h:i A");
$examStartDatetime = str_replace("(", "<sup>", $examStartDatetime);
$examStartDatetime = str_replace(")", "</sup>", $examStartDatetime);
$examInterval = new DateInterval("PT" . $exam["duration"] . "M");
$examDueDatetime = (new DateTime($exam["date_time"]))->add($examInterval);
$examDueTime = $examDueDatetime->format("h:i A");
$examDateTime = $examStartDatetime . " - " . $examDueTime;

$timestamp = strtotime($exam["date_time"]);
$currentTimestamp = strtotime(date("Y-m-d H:i:s"));
$display = $timestamp <= $currentTimestamp ? 'style="display: none;"' : '';

$queryQuestions = "SELECT * FROM `question` WHERE `exam` = ?";
$questions = $db->runQuery($queryQuestions, 's', array($examId)) ?? [];
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
                <div class="card-header">
                    <div>
                        <div>
                            <h2><?php echo $exam["title"]; ?></h2>
                        </div>
                        <div><?php echo $examDateTime; ?></div>
                    </div>
                    <div>
                        <h2>Total Questions: <?php echo count($questions); ?></h2>
                    </div>
                </div>
                <div class="card-content">
                    <?php
                    if (!empty($questions)) {
                        foreach ($questions as $key => $question) {
                            $index = $key + 1;
                            $questionId = $question["id"];
                            $questionAnswer = $question["answer"];
                            $radioStatus = array_map(fn ($i) => $question["answer"] === "option$i" ? 'checked' : 'onclick="this.checked = false;"', range(1, 4));
                            $json = json_encode($question);
                    ?>
                            <div class="list-item">
                                <div class="item-header">
                                    <span>Question<?php echo  $index ?></span>
                                    <div class="action" <?php echo  $display ?>>
                                        <i class="fas fa-pen" title="Edit question" onclick='updateQuestion(<?php echo $json ?>);'></i>
                                        <i class="fas fa-trash" title="Delete question" onclick='deleteQuestion(<?php echo $json ?>);'></i>
                                    </div>
                                </div>
                                <p><?php echo $question["question"] ?></p>
                                <div class="item-content">
                                    <div class="option">
                                        <input class="radio" type="radio" <?php echo $radioStatus[0] ?>>
                                        <label><?php echo $question["option1"] ?></label>
                                    </div>
                                    <div class="option">
                                        <input class="radio" type="radio" <?php echo $radioStatus[1] ?>>
                                        <label><?php echo $question["option2"] ?></label>
                                    </div>
                                    <div class="option">
                                        <input class="radio" type="radio" <?php echo  $radioStatus[2] ?>>
                                        <label><?php echo $question["option3"] ?></label>
                                    </div>
                                    <div class="option">
                                        <input class="radio" type="radio" <?php echo $radioStatus[3] ?>>
                                        <label><?php echo $question["option4"] ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div colspan="4" class="no-question">No Question</div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card-footer" <?php echo $display; ?>>
                    <i title="Add new question" class="fas fa-plus fa-2x" onclick="openCloseModal('add-question')"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-dialog" class="modal" style="display: none;">
        <div class="modal-container">
            <form id="modal-dialog-form" class="modal-form" method="post" action="../controller/manager/examination-manager.php">
                <div class="modal-header">
                    <h2 id="modal-dialog-title">Dialog Title</h2>
                    <h2 class="close-button" style="color: inherit;" onclick="openCloseModal();">&times;</h2>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="question-id" id="input-id">
                    <input type="hidden" name="exam-id" value="<?php echo $examId; ?>">
                    <textarea id="input-question" name="question" rows="3" placeholder="Question..." required></textarea>
                    <div class="item-content">
                        <div class="option">
                            <input class="radio" type="radio" id="input-answer1" name="answer" value="option1" required>
                            <input class="text" type="text" id="input-option1" name="option1" placeholder="Option 1" required>
                        </div>
                        <div class="option">
                            <input class="radio" type="radio" id="input-answer2" name="answer" value="option2" required>
                            <input class="text" type="text" id="input-option2" name="option2" placeholder="Option 2" required>
                        </div>
                        <div class="option">
                            <input class="radio" type="radio" id="input-answer3" name="answer" value="option3" required>
                            <input class="text" type="text" id="input-option3" name="option3" placeholder="Option 3" required>
                        </div>
                        <div class="option">
                            <input class="radio" type="radio" id="input-answer4" name="answer" value="option4" required>
                            <input class="text" type="text" id="input-option4" name="option4" placeholder="Option 4" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-danger" onclick="openCloseModal();">Cancel</div>
                    <button class="btn btn-success" type="submit" name="submit" id="modal-dialog-button">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-dialog-delete" class="modal" style="display: none;">
        <div class="modal-container">
            <form class="modal-form" method="post" action="../controller/manager/examination-manager.php">
                <div class="modal-header">
                    <h2>Delete Question</h2>
                    <h2 class="close-button" style="color: inherit;" onclick="deleteQuestion();">&times;</h2>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="question-id" id="input-delete-id">
                    <input type="hidden" name="exam-id" value="<?php echo $examId; ?>">
                    <p class="modal-text">Are you sure to delete this question?</p>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-danger" onclick="deleteQuestion();">Cancel</div>
                    <button class="btn btn-success" type="submit" name="submit" value="delete-question">Delete</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function openCloseModal(action) {
            const dialog = document.getElementById('modal-dialog');
            const title = document.getElementById('modal-dialog-title');
            const button = document.getElementById('modal-dialog-button');
            button.value = action;

            switch (action) {
                case "add-question":
                    title.innerHTML = "Add Question";
                    button.innerHTML = "Add";
                    break;
                case "update-question":
                    title.innerHTML = "Update Question";
                    button.innerHTML = "Update";
                    break;
                default:
                    break;
            }
            if (dialog.style.display == "none")
                dialog.style.display = "block";
            else {
                document.getElementById('modal-dialog-form').reset();
                dialog.value = "";
                dialog.style.display = "none";
            }
        }

        function deleteQuestion(question) {
            if (question != undefined)
                document.getElementById("input-delete-id").value = question["id"];
            const dialog = document.getElementById('modal-dialog-delete');
            dialog.style.display == "none" ? dialog.style.display = "block" : dialog.style.display = "none";
        }

        function updateQuestion(question) {
            document.getElementById("input-id").value = question["id"];
            document.getElementById("input-question").value = question["question"];
            document.getElementById("input-option1").value = question["option1"];
            document.getElementById("input-option2").value = question["option2"];
            document.getElementById("input-option3").value = question["option3"];
            document.getElementById("input-option4").value = question["option4"];

            for (let i = 1; i <= 5; i++) {
                if (question["answer"] === `option${i}`) {
                    document.getElementById(`input-answer${i}`).checked = true;
                    break;
                }
            }
            openCloseModal("update-question");
        }
    </script>
    <style type="text/css">
        .container .main-content .card .card-content {
            padding: 30px 40px;
        }

        .container .main-content .card .card-content .list-item {
            width: 100%;
            display: block;
        }

        .card-content .list-item .item-header {
            margin: 1rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .card-content .list-item .item-header span {
            font-size: larger;
            font-weight: bolder;
        }

        .card-content .list-item .item-header .action {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-content .list-item .item-header .action i {
            padding: 0 1rem;
            cursor: pointer;
        }

        .item-content {
            padding: 1rem;
        }

        .item-content .option {
            margin-bottom: 8px;
            display: flex;
        }

        .item-content .option input.radio {
            margin: 7px;
        }

        .item-content .option input.text {
            border: 1px solid grey;
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
        }

        .card-content .no-question {
            text-align: center;
            padding: 3rem;
            font-size: larger;
        }

        .card-footer i {
            float: right;
            position: relative;
            right: -98%;
            color: inherit;
        }

        .modal {
            position: fixed;
        }

        .modal .modal-container {
            width: 60%;
            min-width: 500px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .modal .modal-container .modal-form .modal-header,
        .modal .modal-container .modal-form .modal-body {
            color: black;
        }

        .modal .modal-container .modal-form .modal-body textarea {
            resize: none;
            width: 100%;
            border-radius: 4px;
            padding: 0.5rem;
            font-family: inherit;
            font-size: large;
        }
    </style>
</body>

</html>