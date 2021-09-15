<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>
<?php  
	require_once '../controller/ChannelController.php';

	$channelController = new ChannelController();

	$channels = $channelController->getChannels($_SESSION['account']['id']);
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
			<h1>Assignment</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<h2>Add Assignment</h2>
				</div>
				<div class="card-content">
					<form id="form-account" class="form" method="post" action="../controller/manager/assignment-manager.php">
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Channel</label>
							</div>
							<div class="form-control">
								<select name="channel" class="form-input">
									<option disabled="display" selected="selected" value="">-- Select Channel --</option>
								<?php foreach($channels as $channel) { ?>
									<option value="<?php echo $channel['id']; ?>"><?php echo strtoupper($channel['name']); ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Title</label>
							</div>
							<div class="form-control">
								<input type="text" id="input-title" class="form-input success" name="title">
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Description</label>
							</div>
							<div class="form-control">
								<textarea name="description" class="form-input success" style="resize: none; height: 200px;"></textarea>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display:flex; align-items: flex-start;">
								<label class="text-label">Total Marks</label>
							</div>
							<div class="form-control">
								<input type="text" name="total-marks" class="form-input success">
							</div>
						</div>
						<div class="input-group">
							<div class="input-label">
								<label class="text-label">Due Date</label>
							</div>
							<div class="form-control">
								<!-- <label class="form-input"></label>
								<label class="browse" for="input-date-picker" style="width: 117px;">Select Date</label> -->
								<input type="datetime-local" id="input-date-picker" name="date-due" class="form-input success">
							</div>
						</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-danger" type="submit" name="submit" value="delete-account" style="visibility: hidden;">Delete Account</button>
					<button class="btn btn-success" type="submit" name="submit" value="create-assignment">Save</button>
				</div>
			</div>
		</form>
		</div>	
	</div>
</body>
</html>