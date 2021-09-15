<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php 

require_once '../controller/ChannelController.php';
require_once '../controller/ClassController.php';


$channelController = new ChannelController();
$classController = new ClassController();


if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$channel = $channelController->displayChannel($id)[0];
	
}

if (isset($_POST['submit'])){

	$name_update = $_POST['channel-name'];
	$description_update = $_POST['channel-description'];
	$image_text_update = $_FILES['icon-pic']['name'];
	$id = $_POST['channel-id'];

	
	if($_FILES['icon-pic']['name']){
		move_uploaded_file($_FILES['icon-pic']['tmp_name'], "../img/".$_FILES['icon-pic']['name']);
	}

	  if($channelController->updateChannel($id, $name_update, $description_update, $image_text_update) == true){

	  		echo "<script>alert('Succesfully update');</script>";
	  		echo "<script>window.location.assign('channel.php')</script>";

	  }
	  else {

	  		echo "<script>alert('Failed to update')";
	  		echo "<script>window.location.assign('edit-channel.php')</script>";
	  }
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
					<h2>Edit Channel</h2>
				</div>
				<div class="card-content">
					<form id="form-account" class="form" method="post" action="edit-channel.php" enctype="multipart/form-data">
						<input type="hidden" name="channel-id" value="<?php echo $id; ?>">
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Channel Name</label>
							</div>
							<div class="form-control">
								<input type="text" id="input-channel-name" class="form-input success" name="channel-name" value="<?php echo $channel ['name']; ?>">
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Description</label>
							</div>
							<div class="form-control">
								<input name="channel-description" class="form-input success" style="resize: none; height: 200px;" value="<?php echo $channel ['description']; ?>"></input>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label">
								<label class="text-label">Icon</label>
							</div>
							<div class="form-control">
								<input id="icon-pic" class="form-input" value="<?php echo $channel ['image_text'] ?>"></input>
								<label class="browse" for="input-icon-pic">Browse</label>
								<input onchange="showImageName(this);" type="file" id="input-icon-pic" name="icon-pic" hidden="hidden">
							</div>
						</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-danger" type="submit" name="submit" value="delete-account" style="visibility: hidden;">Delete Account</button>
					<button class="btn btn-success" type="submit" name="submit" value="save">Save</button>
				</div>
			</div>
		</form>
		</div>	
	</div>

	<script type="text/javascript">
		function showImageName(obj){
			var inputFile = obj.value;
			var fileName = inputFile.split("\\");

			document.getElementById('icon-pic').innerHTML = fileName[fileName.length-1];

		}



	</script>

</body>
</html>