<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php
require_once '../controller/AttendanceController.php';
require_once '../controller/ClassController.php';
require_once '../controller/ChannelController.php';
require_once '../controller/Util.php';

$attendanceController = new AttendanceController();
$classController = new ClassController();
$channelController = new ChannelController();
$util = new Util();

// $result = $attendanceController-> createAttendance();
// $result = $channelController->displayChannels();
// $result2 = $classController->displayClass();

$channels = $channelController->displayChannels();
if (isset($_POST['channel'])) {
	$id = $_POST['channel'];
	// $channel = $channelController->displayChannel($id)[0];
	$classes = $classController->displayClass($id);
}

?>


<!DOCTYPE html>
<html>

<head>
	<?php include '../inc/head.php'; ?>
</head>

<script type="text/javascript">
	function la(src) {
		window.location = src;
	}
</script>

<body>

	<?php include '../inc/top-nav.php'; ?>
	<?php include '../inc/side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Attendance</h1>
		</div>
		<div class="main-content">
			<!-- <div class="no-content">
				<p class="no-content-text">You have no assignment</p>
			</div> -->
			<div class="card">
				<div class="card-header">
					<input type="hidden" name="room" value="<?php echo $id; ?>">
					<form id="form" style="width: 300px;" method="POST" action="">
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Channel</label>
							</div>
							<div style="width: 70%">
								<select name="channel" id="channel-dropdown" onchange="document.getElementById('form').submit();" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<?php foreach ($channels as $channel) { ?>
										<option value="<?php echo $channel['id']; ?>"><?php echo $channel['name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Class</label>
							</div>
							<div style="width: 70%">
								<select id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<?php foreach ($classes as $class) { ?>
										<option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
									<?php } ?>

								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="card-content">
					<table class="card-table" style="width:100%; border-collapse: collapse;">
						<tr style="padding: 10px;">
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>No.</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 40%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Student ID</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Status</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Attendance Rate</span><i class="fa fa-caret-down" style="float: right;"></i></td>
						</tr>
					</table>
				</div>
				<div class="card-footer">
					<a href="create-attendance.php" style="float: right; position: relative; right: -98%; color: inherit;">
						<i class="fas fa-plus fa-2x"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>