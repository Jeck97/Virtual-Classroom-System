<?php include_once '../inc/config.php'; ?>
<?php include_once '../inc/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once '../inc/head.php'; ?>
</head>
<body>
	
	<?php include_once '../inc/top-nav.php'; ?>
	<?php include_once '../inc/side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Channel</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<h2>Add Channel</h2>
				</div>
				<div class="card-content">
					<form id="form-account" class="form" method="post" action="channel.php">
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Channel Name</label>
							</div>
							<div class="form-control">
								<input type="text" id="input-channel-name" class="form-input success" name="channel-name">
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Description</label>
							</div>
							<div class="form-control">
								<textarea name="class-description" class="form-input success" style="resize: none; height: 200px;"></textarea>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label">
								<label class="text-label">Icon</label>
							</div>
							<div class="form-control">
								<label class="form-input"></label>
								<label class="browse" for="input-icon-pic">Browse</label>
								<input type="file" id="input-icon-pic" name="icon-pic" hidden="hidden">
							</div>
						</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-danger" type="submit" name="submit" value="delete-account" style="visibility: hidden;">Delete Account</button>
					<button class="btn btn-success" type="submit" name="submit" value="update-fullname">Save</button>
				</div>
			</div>
		</form>
		</div>	
	</div>
</body>
</html>