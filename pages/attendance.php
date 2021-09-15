<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

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
			<h1>Attendance</h1>
		</div>
		<div class="main-content">
			<div class="no-content">
				<p class="no-content-text">You have no assignment</p>
			</div>
			<div class="card">
				<div class="card-header">
					<div style="width: 300px;">
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Channel</label>
							</div>
							<div style="width: 70%">
								<select id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<option>2021 Bulls Training Camp</option>
									<option>Business Management Class</option>
									<option>Cooking Masterclass</option>
								</select>	
							</div>
						</div>
						<div style="display: flex; width: 100%; margin: 10px 0;">
							<div style="width: 30%">
								<label for="channel-dropdown">Date</label>
							</div>
							<div style="width: 70%">
								<select id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<option>04/03/2021</option>
									<option>13/03/2021</option>
									<option>30/03/2021</option>
								</select>	
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
					</table>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>