<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php 

require_once '../controller/ChannelController.php';
require_once '../controller/ClassController.php';
require_once '../controller/ForumController.php';
require_once '../controller/StudentController.php';
require_once '../controller/EducatorController.php';

$channelController = new ChannelController();
$classController = new ClassController();
$forumController = new ForumController();
$studentController = new StudentController();
$educatorController = new EducatorController();


if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$channel = $channelController->displayChannel($id)[0];
	
	$classes = $classController->displayClass($id);
	// $room = $roomController->displayRoom($id);
}

if(isset($_POST ['reply'])){

	$message = "";
	$path= "";

	$forum = new ForumController();
	$util = new Util();

	$id = $util->generateUID('forum');
	$comment = strtolower(trim($_POST['comment']));
	$class = strtolower(trim($_POST['class']));
	$educator = $_SESSION['account']['id'];
	$student = $_SESSION['account']['id'];

	if ($_SESSION['account']['role'] === "educator") {
		if ($forum-> addForumEducator($id, $comment, $class, $educator) === true){
			$message = "Commented!" ;
			
		}
		else{
			$message = "Failed";
		}
	} else {
		if ($forum-> addForum($id, $comment, $class, $student) === true){
			$message = "Commented!" ;
			
		}
		else{
			$message = "Failed";
		}
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
<script type="text/javascript">
	
	function la(src){
        window.location = src;
    }
	// function getSelectedValue(){

	// 		var selectedValue = document.getElementById("class-dropdown").value;
	// 		console.log(selectedValue);
	// 	}
</script>
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
					<!-- <input type="hidden" name="room" value="<?php echo $id; ?>"> -->
					<h2 ><?php echo strtoupper( $channel['name']); ?>
						<a style="font-size:15px" href="edit-channel.php?id=<?php echo $channel['id']; ?>">
							<i class="fas fa-edit" >					
							</i>
						</a>	
					</h2>
					<div style="display: flex; width: 450px; align-items: center; justify-content: center;">
						<div style="display: flex; width: 70%; margin: 10px;">
							<!-- <div style="width: 15%;">
								<label for="class-dropdown">Class</label>	
							</div>
							<div style="width: 85%">
								<select id="class-dropdown" onchange=" la(this.value)" style="padding: 5px 10px; border-radius: 5px; width: 100%;">
									<option value="general">General</option>
									<?php foreach($classes as $class ) { ?>
									<option value="<?php echo $class ['name']; ?>"><?php echo strtoupper($class['name']); ?></option>
								<?php } ?>
								</select>
							</div> -->
						</div>
						<div style="width: 30%;">
							<a href="create-class.php?id=<?php echo $id;?>"><button class="btn btn-secondary">Create Class</button></a>
						</div>
					</div>
				</div>
				<?php if ($classes != NULL) { ?>
				<?php foreach($classes as $class ) {?>
				<div class="card-content">

					<div style="margin-bottom: 0px;">
						<div style="display: flex; justify-content: space-between; background-color: #D0CECE;padding: 20px; border-top-right-radius: 10px; border-top-left-radius: 10px;">
							<div>
								<div style="display: flex;">
									<div style="margin-right: 10px;">
										
										<span style="font-size: 16pt; font-weight: bolder;"><?php echo strtoupper($class['name']); ?></span>
									</div>
								</div>
								<div style="display: flex; align-items: flex-end;">
										<span style="font-size: .8em;"><?php echo $class['time']. " | ". $class['date']; ?></span>
									</div>
								
							</div>
							<!-- <div>
								<div style="padding: 10px 0;">
									<span style="font-weight: bolder; color: #FFC000;">MEETING END</span>
								</div>
								<div style="visibility: hidden;">
									<button class="btn btn-light" style="float: right;">START</button>
								</div>
							</div> -->
						</div>
						<?php $comments = $forumController->getComments($class['id']); ?>


						<div style="background-color: #F2F2F2; padding: 20px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
							<div style="padding: 10px; overflow: auto; height: 100px; font-size: 10pt; display: flex; flex-direction: column;">
								<?php foreach ($comments as $comment){ ?>


								<?php if ($comment['student'] != NULL) { $student = $studentController->getStudent($comment['student'])[0]; ?>
									<span style="padding: 2px 0px;"><b><?php echo $student['name']; ?>:</b>&nbsp;<?php echo $comment['comment']; ?></span>
								<?php } ?>

								<?php if ($comment['educator'] != NULL) { $educator = $educatorController->getEducator($comment['educator'])[0]; ?>
									<span style="padding: 2px 0px;"><b><?php echo $educator['name']; ?>:</b>&nbsp;<?php echo $comment['comment']; ?></span>
								<?php } ?>
					
								<?php } ?>
								<br>

								<form id="form-account" class="form" method="post"  >
								<span><input type="text" name="comment"><input type="hidden" name="class" value="<?php echo $class['id']; ?>"> <input type="hidden" value="<?php echo $_SESSION['account']['id']; ?>" name=""><button type="submit" name="reply">Reply</button></input></span>
							</form>
								

							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
			</div>
		</div>	
	</div>
</body>
</html>