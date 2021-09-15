<?php
include '../inc/config.php';
include '../inc/header.php';

if (!isset($_SESSION)) session_start();
$studentEmail = $_SESSION['account']['email'];
$isSessionExamExist = isset($_SESSION["exam"]);

$queryFilter = "";
$selectedChannel = "all";
if (isset($_POST["channel"])) {
    $selectedChannel = $_POST["channel"];
    if ($selectedChannel !== "all") {
        $queryFilter = "AND `exam`.`channel` = '$selectedChannel'";
    }
}

$db = new DBController();
$queryStudent = "SELECT * FROM `student` WHERE `email` = ?";
$studentId = $db->runQuery($queryStudent, 's', array($studentEmail))[0]["id"];

$queryChannel = "SELECT `channel`.* FROM `student_channel` JOIN `channel` ON `student_channel`.`channel` = `channel`.`id` WHERE `student_channel`.`student` = ?";
$channels = $db->runQuery($queryChannel, 's', array($studentId));
$channelOptions = "";
if ($channels != null) {
    foreach ($channels as $channel) {
        $channelId = $channel["id"];
        $channelName = $channel["name"];
        $isSelected = $channelId === $selectedChannel ? "selected" : "";

        $channelOptions .= <<<HTML
        <option value="$channelId" $isSelected>$channelName</option>
        HTML;
    }
}

$query = "SELECT `exam`.*, `exam_student`.`mark` FROM `exam` JOIN `student_channel` ON `student_channel`.`channel` = `exam`.`channel` LEFT JOIN `exam_student` ON `exam_student`.`exam` = `exam`.`id` AND `exam_student`.`student` = `student_channel`.`student` WHERE `student_channel`.`student` = ? $queryFilter ORDER BY `exam`.`date_time` DESC";
$results = $db->runQuery($query, 's', array($studentId));
?>

<!DOCTYPE html>
<html>

<head>
    <?php include '../inc/head.php'; ?>
</head>

<body>

    <?php include '../inc/student-top-nav.php'; ?>
    <?php include '../inc/student-side-nav.php'; ?>

    <div class="container">
        <div class="header">
            <h1>Examination</h1>
        </div>
        <div class="main-content">
            <div class="card">
                <div class="card-header">
                    <form id="form-filter-channel" action="student-examination.php" method="POST">
                        <label for="channel-dropdown">Channel</label>
                        <select name="channel" onchange="document.getElementById('form-filter-channel').submit();">
                            <option selected="selected" value="all">All Channels</option>
                            <?php echo $channelOptions; ?>
                        </select>
                    </form>
                </div>
                <div class="card-content">
                    <table id="exam-table" class="card-table">
                        <tr>
                            <th>
                                <span>Title</span>
                                <i id="exam-table-i-0" class="fa fa-caret-down" title="Sort by title" onclick="sortTable(0, false);"></i>
                                <input id="exam-table-input-0" type="hidden" value="asc">
                            </th>
                            <th style="width: 40%;">
                                <span>Date</span>
                                <i id="exam-table-i-1" class="fa fa-caret-down" title="Sort by date" onclick="sortTable(1, true);"></i>
                                <input id="exam-table-input-1" type="hidden" value="asc">
                            </th>
                            <th>
                                <span>Duration</span>
                                <i id="exam-table-i-2" class="fa fa-caret-down" title="Sort by duration" onclick="sortTable(2, true);"></i>
                                <input id="exam-table-input-2" type="hidden" value="asc">
                            </th>
                            <th>
                                <span>Status</span>
                                <i id="exam-table-i-3" class="fa fa-caret-down" title="Sort by status" onclick="sortTable(3, false);"></i>
                                <input id="exam-table-input-3" type="hidden" value="asc">
                            </th>
                        </tr>
                        <?php
                        if ($results != null) {
                            foreach ($results as $result) {
                                $json = json_encode($result);
                                $examId = $result["id"];
                                $examTitle = $result["title"];
                                $examDurationMinutes = $result["duration"];

                                $examStartDatetime = new DateTime($result["date_time"]);
                                $examStartDate = $examStartDatetime->format("D j(S) M Y");
                                $examStartDate = str_replace("(", "<sup>", $examStartDate);
                                $examStartDate = str_replace(")", "</sup>", $examStartDate);
                                $examStartTime = $examStartDatetime->format("h:i A");
                                $examDate = $examStartDate;

                                $examInterval = new DateInterval("PT" . $examDurationMinutes . "M");
                                $examDueDatetime = (new DateTime($result["date_time"]))->add($examInterval);
                                $examDueTime = $examDueDatetime->format("h:i A");
                                $examTime = $examStartTime . " - " . $examDueTime;

                                $examDuration;
                                if ($examDurationMinutes < 60) {
                                    $examDuration =  "$examDurationMinutes minute";
                                    if ($examDurationMinutes > 1) $examDuration .= "s";
                                } else {
                                    $durationHour = floor($examDurationMinutes / 60);
                                    $durationMinute = $examDurationMinutes % 60;

                                    $examDuration = "$durationHour hour";
                                    if ($durationHour > 1) $examDuration .= "s";
                                    if ($durationMinute > 0) {
                                        $examDuration .= "<br>$durationMinute minute";
                                        if ($durationMinute > 1) $examDuration .= "s";
                                    }
                                }

                                $examStatus;
                                $examStatusValue;
                                $examStatusColor;
                                $start = strtotime($result["date_time"]);
                                $now = strtotime(date("Y-m-d H:i:s"));
                                $end = $start + $examDurationMinutes * 60;

                                if ($now >= $start && $now <= $end) {
                                    $examStatus = "Started";
                                    $examStatusValue = "starting";
                                    $examStatusColor = "#fa6602";
                                } else if ($now < $start) {
                                    $examStatus = "Upcoming";
                                    $examStatusValue = "upcoming";
                                    $examStatusColor = "#FFC000";
                                } else if ($now > $end) {
                                    if (isset($result["mark"])) {
                                        $examStatus = "Completed";
                                        $examStatusValue = "completed";
                                        $examStatusColor = "green";
                                    } else {
                                        $examStatus = "Miss";
                                        $examStatusValue = "miss";
                                        $examStatusColor = "red";
                                    }
                                }
                        ?>
                                <tr>
                                    <td>
                                        <span class="title" onclick='openCloseModal(<?php echo $json ?>, <?php echo $isSessionExamExist ?>);'><?php echo $examTitle ?></span>
                                        <input type="hidden" value="<?php echo $examTitle ?>">
                                    </td>
                                    <td>
                                        <span><?php echo $examDate ?><br><?php echo $examTime ?></span>
                                        <input type="hidden" value="<?php echo $start ?>">
                                    </td>
                                    <td>
                                        <span><?php echo $examDuration ?></span>
                                        <input type="hidden" value="<?php echo $examDurationMinutes ?>">
                                    </td>
                                    <td>
                                        <span class="status" style="color: <?php echo $examStatusColor ?>;"><?php echo $examStatus ?></span>
                                        <input type="hidden" value="<?php echo $examStatusValue ?>">
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" class="no-exam">No examination</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-dialog" class="modal" style="display: none;">
        <div class="modal-container">
            <form id="modal-form" class="modal-form" method="get" action="student-examination-questions.php">
                <div class="modal-header">
                    <h3 id="modal-dialog-title"></h3>
                    <h2 class="close-button" style="color: inherit;" onclick="openCloseModal();">&times;</h2>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="exam" id="input-exam-id">
                    <p class="modal-text" id="modal-dialog-content"></p>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-danger" onclick="openCloseModal();" id="button-negative">Cancel</div>
                    <button class="btn btn-success" type="submit" id="button-positive">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function sortTable(column, isNum) {
            let rows, switching, i, x, y, shouldSwitch;
            const table = document.getElementById("exam-table");
            const iconAsc = document.getElementById(`exam-table-i-${column}`);
            const inputAsc = document.getElementById(`exam-table-input-${column}`);
            iconAsc.className = inputAsc.value === "asc" ? "fa fa-caret-up" : "fa fa-caret-down";
            inputAsc.value = inputAsc.value === "asc" ? "desc" : "asc";
            switching = true;
            // Make a loop that will continue until no switching has been done:
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                // Loop through all table rows (except the first, which contains table headers):
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    // Get the two elements you want to compare, one from current row and one from the next:
                    x = rows[i].getElementsByTagName("input")[column].value;
                    y = rows[i + 1].getElementsByTagName("input")[column].value;
                    if (isNum) {
                        x = parseInt(x);
                        y = parseInt(y);
                    }
                    //check if the two rows should switch place:
                    const sortDirection = inputAsc.value === "asc" ? x > y : x < y;
                    if (sortDirection) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    // If a switch has been marked, make the switch and mark that a switch has been done:
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function openCloseModal(exam, isExamExist) {
            if (exam) {
                document.getElementById("input-exam-id").value = exam["id"];

                const startTimestamp = new Date(exam["date_time"]).getTime();
                const endTimestamp = startTimestamp + exam["duration"] * 60000;
                const currentTimestamp = new Date().getTime();

                const title = document.getElementById("modal-dialog-title");
                const content = document.getElementById("modal-dialog-content");
                const btnNegative = document.getElementById("button-negative");
                const btnPositive = document.getElementById("button-positive");

                if (currentTimestamp >= startTimestamp && currentTimestamp <= endTimestamp) {
                    btnPositive.type = "submit";
                    btnPositive.onclick = null;

                    if (exam["mark"] == null) {
                        btnNegative.style.visibility = "visible";
                        btnPositive.innerHTML = "Start";
                        title.innerHTML = "Start Exam";
                        content.innerHTML = "Once you had start the examination, the timer will start to countdown. Are you sure to start the examination?";
                    } else {
                        let examStatus = isExamExist;
                        console.log(examStatus);
                        if (examStatus === 1) {
                            btnNegative.style.visibility = "visible";
                            btnPositive.innerHTML = "Continue";
                            title.innerHTML = "Continue Exam";
                            content.innerHTML = "You had started the examination before. Click continue to rejoin the examination.";
                        } else {
                            btnNegative.style.visibility = "hidden";
                            btnPositive.innerHTML = "OK";
                            btnPositive.type = "button";
                            btnPositive.onclick = openCloseModal;
                            title.innerHTML = "Exam Done";
                            content.innerHTML = "You had done the examination, you can review your answers after examination finish.";
                        }
                    }
                } else if (currentTimestamp < startTimestamp) {
                    let comingTime = "";
                    let comingMinute = Math.floor((endTimestamp - currentTimestamp) / 60000);
                    if (comingMinute < 60) {
                        comingTime = `${comingMinute} minutes`;
                        if (comingMinute > 1) comingTime += "s";
                    } else if (comingMinute < 1440) {
                        let comingHour = Math.floor(comingMinute / 60);
                        comingMinute %= 60;
                        comingTime = `${comingHour} hour`;
                        if (comingHour > 1) comingTime += "s";
                        if (comingMinute > 0) {
                            comingTime += ` ${comingMinute} minute`;
                            if (comingMinute > 1) comingTime += "s";
                        }
                    } else {
                        let comingHour = Math.floor(comingMinute / 60);
                        let comingDay = Math.floor(comingHour / 24);
                        comingHour %= 24;
                        comingTime = `${comingDay} day`;
                        if (comingDay > 1) comingTime += "s";
                        if (comingHour > 0) {
                            comingTime += ` ${comingHour} hour`;
                            if (comingHour > 1) comingTime += "s";
                        }
                    }
                    btnPositive.type = "button";
                    btnPositive.onclick = openCloseModal;
                    btnNegative.style.visibility = "hidden";
                    btnPositive.innerHTML = "OK";
                    title.innerHTML = "Exam Upcoming";
                    content.innerHTML = `The examination haven't start yet, please wait after ${comingTime}.`;
                } else if (currentTimestamp > endTimestamp) {
                    document.getElementById("modal-form").submit();
                    return;
                }
            }
            const dialog = document.getElementById('modal-dialog');
            dialog.style.display == "none" ? dialog.style.display = "block" : dialog.style.display = "none";
        }
    </script>
    <style type="text/css">
        .card-header form {
            display: flex;
            width: 400px;
            margin: 10px 0;
        }

        .card-header label {
            width: 30%;
        }

        .card-header select {
            width: 70%;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .card-content .card-table {
            width: 100%;
            border-collapse: collapse;
        }

        .card-content .card-table tr {
            padding: 10px;
        }

        .card-content .card-table tr th {
            width: 20%;
            padding: 10px 20px;
            border-bottom: 1px solid black;
            text-align: start;
        }

        .card-content .card-table tr th i {
            float: right;
            cursor: pointer;
            border-radius: 50%;
            padding: 8px 10px;
        }

        .card-content .card-table tr th i:hover {
            background-color: #ededed;
        }

        .card-content .card-table tr td {
            padding: 10px 20px;
        }

        .card-content .card-table tr td .title {
            cursor: pointer;
        }

        .card-content .card-table tr td .status {
            font-weight: bolder;
        }

        .card-content .card-table .no-exam {
            text-align: center;
            padding: 3rem;
            font-size: larger;
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

        .modal .modal-container .modal-form .modal-header {
            color: black;
            padding: 8px 26px;
        }

        .modal .modal-container .modal-form .modal-body {
            color: black;
        }
    </style>
</body>

</html>