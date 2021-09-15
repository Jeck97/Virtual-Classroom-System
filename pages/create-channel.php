<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>


<?php 

require_once '../controller/ChannelController.php';
require_once '../controller/Util.php';

if(isset($_POST ['submit'])){

	$message = "";
	$path = "";

	$channel = new ChannelController();
	$util = new Util();

	$id = $util->generateUID('channel');
	$name = strtolower(trim($_POST['channel-name']));
	$image_text = strtolower(trim($_FILES['image']['name']));
	$description = strtolower(trim($_POST['channel-description']));

	//code image upload
	if($_FILES['image']['name']){
		move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$_FILES['image']['name']);
	}


	$educator = $_SESSION['account']['id'];

	if ($channel->createChannel($id, $name, $description, $image_text, $educator) === true){
		$message = "Channel succesfully created!" ;
		$path= "channel.php";

	} else {
		$message = "Failed to create channel";
		$path = "channel.php";
	
	}

	if ($message != "")
		$util->displayMessage($message);

	if ($path != "")
		$util->redirect($path);

}



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
			<h1>Channel</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<h2>Add Channel</h2>
				</div>
				<div class="card-content">
					<form id="form-account" class="form" method="post" action="create-channel.php" enctype="multipart/form-data">
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Channel Name</label>
							</div>
							<div class="form-control">
								<input type="text" id="input-channel-name" class="form-input success" name="channel-name" required>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Description</label>
							</div>
							<div class="form-control">
								<textarea name="channel-description" class="form-input success" style="resize: none; height: 200px;"></textarea>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label">
								<label class="text-label">Icon</label>
							</div>
							<div class="form-control">
								<label id="image" class="form-input"></label>
								<label class="browse" for="input-icon-pic">Browse</label>
								<input onchange="showImageName(this);" type="file" id="input-icon-pic" name="image" hidden="hidden">
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
	<script type="text/javascript">
		function showImageName(obj){
			var inputFile = obj.value;
			var fileName = inputFile.split("\\");

			document.getElementById('image').innerHTML = fileName[fileName.length-1];

		}

	</script>
</body>
</html>