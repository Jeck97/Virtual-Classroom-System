<?php
include '../inc/config.php';
include '../inc/header.php';

$examId = $_GET["exam"];

$db = new DBController();
$queryExam = "SELECT * FROM `exam` WHERE id = ?";
$exam = $db->runQuery($queryExam, 's', array($examId))[0];
$examTitle = $exam["title"];
$examDuration = new DateInterval("PT" . $exam["duration"] . "M");
$examDue = (new DateTime($exam["date_time"]))->add($examDuration);
$examDue = $examDue->format("j(S) F Y h:i A");
$examDue = str_replace("(", "<sup>", $examDue);
$examDue = str_replace(")", "</sup>", $examDue);
$examChannelId = $exam["channel"];

$queryCountQuestion = "SELECT COUNT(*) AS 'total' FROM `question` WHERE `exam` = '$examId'";
$countQuestion = $db->runBaseQuery($queryCountQuestion)[0]["total"];

$queryCountStudent = "SELECT COUNT(*) AS 'total' FROM `student_channel` WHERE `channel` = '$examChannelId'";
$countStudent = $db->runBaseQuery($queryCountStudent)[0]["total"];

$queryExamStudents = "SELECT `student`.`id`, `student`.`name`, `exam_student`.`mark`, `exam_student`.`datetime_submit` FROM `exam` JOIN `exam_student` ON `exam`.`id` = `exam_student`.`exam` JOIN `student` ON `student`.`id` = `exam_student`.`student` WHERE `exam_student`.`exam` = ?";
$results = $db->runQuery($queryExamStudents, 's', array($examId));
$totalParticipant = 0;
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
			<h1>Examination</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<div>
						<div>
							<h2><?php echo $examTitle; ?></h2>
						</div>
						<div>Due on <?php echo $examDue; ?></div>
					</div>
					<div>
						<h2>Total Participant: <?php echo $totalParticipant . "/" . $countStudent; ?></h2>
					</div>
				</div>
				<div class="card-content">
					<?php
					if ($results != null) {
						$totalParticipant = count($results);
						foreach ($results as $result) {
							$studentId = strtoupper($result["id"]);
							$studentName = strtoupper($result["name"]);
							$studentMark = $result["mark"];
							$datetimeSubmit = new DateTime($result["datetime_submit"]);
							$datetimeSubmit = $datetimeSubmit->format("j(S) F Y h:i A");
							$datetimeSubmit = str_replace("(", "<sup>", $datetimeSubmit);
							$datetimeSubmit = str_replace(")", "</sup>", $datetimeSubmit);
					?>
							<div class="exam-student">
								<div style="display: flex;">
									<div class="mark-container">
										<div class="mark obtained"><span><?php echo $studentMark ?></span></div>
										<div class="mark-divider"><span></span></div>
										<div class="mark total"><span><?php echo $countQuestion ?></span></div>
									</div>
									<div class="student-container">
										<div class="name"><span><?php echo $studentName ?></span></div>
										<div class="id"><span><?php echo $studentId ?></span></div>
										<div class="hidden"></div>
									</div>
								</div>
								<div class="datetime-container">
									<div class="hidden datetime"></div>
									<div class="datetime">
										<span><?php echo $datetimeSubmit ?></span>
									</div>
									<div class="hidden"></div>
								</div>
							</div>
						<?php
						}
					} else {
						?>
						<div class="no-participant">No Participant</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.exam-student {
			display: flex;
			justify-content: space-between;
			padding: 20px;
			background-color: #E7E6E6;
			border-radius: 10px;
			margin-bottom: 20px;
		}

		.exam-student .mark-container {
			border: 2px solid black;
			border-radius: 10px;
			width: 100px;
			margin-right: 10px;
			background-color: white;
			display: flex;
		}

		.exam-student .mark-container .mark {
			width: 49%;
			display: flex;
			justify-content: center;
		}

		.exam-student .mark-container .mark.obtained {
			align-items: flex-start;
		}

		.exam-student .mark-container .mark.total {
			align-items: flex-end;
			margin-right: 8px;
		}

		.exam-student .mark-container .mark>span {
			font-size: 24pt;
		}

		.exam-student .mark-container .mark-divider {
			width: 2%;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.exam-student .mark-container .mark-divider>span {
			border-left: 2px solid black;
			height: 100px;
			display: inline-block;
			margin: 0 10px;
			transform: rotate(45deg);
		}

		.exam-student .student-container {
			padding: 10px 20px;
		}

		.exam-student .student-container .name,
		.exam-student .student-container .id {
			height: 40%;
		}

		.exam-student .student-container .name>span {
			font-size: 16pt;
		}

		.exam-student .student-container .id>span {
			font-size: 14pt;
		}

		.exam-student .student-container .hidden {
			height: 20%;
			visibility: hidden;
		}

		.exam-student .datetime-container {
			padding: 10px 20px;
			text-align: right;
		}

		.exam-student .datetime-container .hidden {
			visibility: hidden;
		}

		.exam-student .datetime-container .datetime {
			height: 40%;
		}

		.exam-student .datetime-container .datetime span {
			font-size: 14pt;
		}

		.no-participant {
			text-align: center;
			padding: 3rem;
			font-size: larger;
		}
	</style>
</body>

</html>