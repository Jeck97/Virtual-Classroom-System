<?php
include '../inc/config.php';
include '../inc/header.php';

if (!isset($_SESSION)) session_start();
$educatorId = $_SESSION['account']['id'];

$db = new DBController();
$query = "SELECT `exam`.* FROM `exam` JOIN `channel` ON `exam`.`channel` = `channel`.`id` JOIN `account` ON `account`.`id` = `channel`.`educator` WHERE `account`.`id` = ? ORDER BY `date_time`";
$results = $db->runQuery($query, 's', array($educatorId));
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
					<h2>Upcoming examination</h2>
				</div>
				<div class="card-content">
					<table id="exam-table" class="card-table">
						<tr style="padding: 10px;">
							<th>
								<span>No.</span>
								<i id="exam-table-i-0" class="fa fa-caret-down" title="Sort by number" onclick="sortTable(0, true);"></i>
								<input id="exam-table-input-0" type="hidden" value="asc">
							</th>
							<th style="width: 40%;">
								<span>Examination Title</span>
								<i id="exam-table-i-1" class="fa fa-caret-down" title="Sort by title" onclick="sortTable(1, false);"></i>
								<input id="exam-table-input-1" type="hidden" value="asc">
							</th>
							<th>
								<span>Date</span>
								<i id="exam-table-i-2" class="fa fa-caret-down" title="Sort by date" onclick="sortTable(2, true);"></i>
								<input id="exam-table-input-2" type="hidden" value="asc">
							</th>
							<th>
								<span>Time</span>
								<i id="exam-table-i-3" class="fa fa-caret-down" title="Sort by time" onclick="sortTable(3, true);"></i>
								<input id="exam-table-input-3" type="hidden" value="asc">
							</th>
							<th>
								<span>Action</span>
							</th>
						</tr>
						<?php
						if ($results != null) {
							$i = 0;
							foreach ($results as $result) {
								$i++;
								$examId = $result["id"];
								$title = $result["title"];
								$datetime = date_create($result["date_time"]);
								$date = date_format($datetime, "Y/m/d");
								$time = date_format($datetime, "h:i A");

								$timestamp = strtotime($result["date_time"]);
								$timeInNum = date_format($datetime, "his");
								$currentTimestamp = strtotime(date("Y-m-d H:i:s"));

								if ($timestamp <= $currentTimestamp) {
									$icon = "eye";
									$tooltip = "View questions";
								} else {
									$icon = "edit";
									$tooltip = "Add questions";
								}
						?>
								<tr>
									<td>
										<span><?php echo $i ?></span>
										<input type="hidden" value="<?php echo $i ?>">
									</td>
									<td>
										<a href="view-examination.php?exam=<?php echo $examId ?>"><?php echo $title ?></a>
										<input type="hidden" value="<?php echo $title ?>">
									</td>
									<td>
										<span><?php echo $date ?></span>
										<input type="hidden" value="<?php echo $timestamp ?>">
									</td>
									<td>
										<span><?php echo $time ?></span>
										<input type="hidden" value="<?php echo $timeInNum ?>">
									</td>
									<td class="action">
										<a href="examination-questions.php?exam=<?php echo $examId ?>">
											<i title="<?php echo $tooltip ?>" class="fas fa-<?php echo $icon ?>"></i>
										</a>
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
				<div class="card-footer">
					<a href="create-examination.php">
						<i class="fas fa-plus fa-2x" title="Add examination"></i>
					</a>
				</div>
			</div>
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
	</script>
	<style type="text/css">
		.card-table {
			width: 100%;
			border-collapse: collapse;
		}

		.card-table th {
			text-align: start;
			padding: 10px 20px;
			border-bottom: 1px solid black;
		}

		.card-table th i {
			float: right;
			cursor: pointer;
			border-radius: 50%;
			padding: 8px 10px;
		}

		.card-table th i:hover {
			background-color: #ededed;
		}

		.card-table td {
			padding: 10px 20px;
		}

		.card-table td a {
			text-decoration: none;
			color: inherit;
		}

		.card-table td.action {
			text-align: center;
		}

		.card-table .no-exam {
			text-align: center;
			padding: 3rem;
			font-size: larger;
		}

		.card-footer a {
			float: right;
			position: relative;
			right: -98%;
			color: inherit;
		}
	</style>
</body>

</html>