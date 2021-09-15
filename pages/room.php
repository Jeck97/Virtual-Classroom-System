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
			<h1>Room</h1>
		</div>
		<div class="main-content">
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
								<label for="channel-dropdown">Class</label>
							</div>
							<div style="width: 70%">
								<select id="channel-dropdown" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option selected="selected" disabled="disabled">-- Select --</option>
									<option>Week 1</option>
									<option>Week 2</option>
									<option>Week 3</option>
								</select>	
							</div>
						</div>
					</div>
				</div>
				<div class="card-content">
					<div style="width: 100%; height: 300px; display: block; display: flex; align-items: center; justify-content: center;">
						<div style="width: 250px; height: 250px;">
							<img src="../img/michael-jordan.jpg" style="width: 250px; height: 250px; border-radius: 50%;">
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div style=" display: flex;">
						<div style=" margin: 0 5px;">
							<div style=" text-align: center;">
								<i class="fas fa-microphone fa-2x"></i>
							</div>
							<div>
								<span>Mic is on</span>
							</div>
						</div>
						<div style=" margin: 0 5px;">
							<div style=" text-align: center;">
								<i class="fas fa-volume-up fa-2x"></i>
							</div>
							<div>
								<span>Audio is on</span>
							</div>
						</div>
						<div style=" margin: 0 5px;">
							<div style=" text-align: center;">
								<i class="fas fa-video fa-2x"></i>
							</div>
							<div>
								<span>Video is on</span>
							</div>
						</div>
					</div>
					<button class="btn btn-secondary" name="start-meeting" value="start-meeting">Start Meeting</button>
				</div>
			</div>
		</form>
		</div>	
	</div>
</body>
</html>