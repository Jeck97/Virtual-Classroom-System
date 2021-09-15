<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php 

require_once '../controller/ClassController.php';
require_once '../controller/Util.php';

if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
}

if (isset($_POST['submit'])){

	$message ="";
	$path = "";

	$class = new ClassController();
	$util = new Util();

	$id = $util->generateUID('class');
	$name = strtolower(trim($_POST['class-name']));
	$description = strtolower(trim($_POST['class-description']));
	$date = strtolower(trim($_POST['date']));
	$time = strtolower(trim($_POST['time']));
	$channel = strtolower(trim($_POST['channel']));



	if ($class->createClass($id, $name, $description, $date, $time, $channel) === true){
		$message = "Class succesfully created!" ;
		$path= "view-channel.php?id=$channel";

	} 
	
	else {
		$message = "Failed to create class";
		$path = "create-class.php";
	
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
					<h2>Add Class</h2>
				</div>
				<div class="card-content">
					<form id="form-account" class="form" method="post" action="create-class.php">
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Class Name</label>
							</div>
							<div class="form-control">
								<input type="text" id="input-class-name" class="form-input success" name="class-name" required>
							</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Description</label>
							</div>
							<div class="form-control">
								<textarea name="class-description" class="form-input success" style="resize: none; height: 200px;" required></textarea>
							</div>
						</div>
						<div class="input-group">
						 	<div class="input-label" style="display: flex; align-items: flex-start;" >
									<label class="text-label">Date</label>
						 	</div>
						 	<div class="form-control">
						 		<input type="date" name="date" class="form-input success" style="resize: none; height:30px" min="<?php echo date ("Y-m-d")?>" required>
						 	</div>
						</div>
						<div class="input-group">
							<div class="input-label" style="display: flex; align-items: flex-start;">
								<label class="text-label">Time</label>
							</div>
							<div class="form-control">
						 		<input type="time" name="time" class="form-input success" style="resize: none; height:30px" required>
						 	</div>

						</div>
				</div>
				<div class="card-footer">
					<input type="hidden" name="channel" value="<?php echo $id; ?>">
					<button class="btn btn-danger" type="submit" name="submit" value="delete-account" style="visibility: hidden;">Delete Account</button>
					<button class="btn btn-success" type="submit" name="submit" value="update-fullname">Save</button>
				</div>
			</div>
		</form>
		</div>	
	</div>
</body>
</html>