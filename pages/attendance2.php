<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>


<?php 
require_once '../controller/AttendanceController.php';
require_once'../controller/ClassController.php';
require_once '../controller/ChannelController.php';
require_once '../controller/Util.php'; 

$attendanceController = new AttendanceController();
$classController = new ClassController();
$channelController = new ChannelController();
$util= new Util();

// $result = $channelController->displayChannels();
// $result2 = $classController->displayClass();

$channels = $channelController->displayEnrollByStudent($_SESSION['account']['id']);


if (isset($_GET['id'])) {

	$id = $_GET['id'];
	echo $id;
	
	$classes = $classController->displayClass($id);
}

?>


<!DOCTYPE html>
<html>
<head>
	<?php include '../inc/head.php'; ?>
</head>

<script >
	
function showUser(str) {
 
  var xmlhttp=new XMLHttpRequest();
  
  xmlhttp.open("GET","attendance2.php?id="+str,true);
  xmlhttp.send();
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
					<div style="width: 300px;">
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Channel</label>
							</div>
							<div style="width: 70%">
								<form>
								<select id="channel-dropdown" onchange=" showUser(this.value)" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled" value=""> Select </option>
									<?php foreach($channels as $channel) { ?>
									<option value="<?php echo $channel['channel']; ?>"><?php echo $channel['name']; ?> </option>
								<?php } ?>
								</select>
								</form>	
							</div>
						</div>
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Class</label>
							</div>
							<div style="width: 70%">
								<form>
								<select onchange=" showUser(this.value)" id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<?php foreach($classes as $class ) { ?>
									<option value="<?php echo $class ['name']; ?>"><?php echo $class['name']; ?></option>
								<?php } ?>
									
								</select>	
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="card-content">
					<table class="card-table" style="width:100%; border-collapse: collapse;">
						<tr style="padding: 10px;">
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>No.</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 40%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Student ID</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Status</span><i class="fa fa-caret-down" style="float: right;"></i></td>
							<td style="width: 20%; padding: 10px 20px; border-bottom: 1px solid black;"><span>Attendance Rate</span><i class="fa fa-caret-down" style="float: right;"></i></td>
						</tr>


						<?php 
						while($row = mysqli_fetch_array($id)){

							echo "<tr>";

							echo "<td>" . $row['id'] . "</td>";
							echo "<td>" . $row['student'] . "</td>";
							echo "<td>" . $row['class'] . "</td>";
							echo "<td>" . $row['student'] . "</td>";

							echo "</table>";
						}
						 ?>
						
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