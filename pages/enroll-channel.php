	<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php 

	  require_once '../controller/ChannelController.php'; 
	  require_once '../controller/Util.php';

	  //initialize object
	  $channelController = new ChannelController();
	  $util = new Util();
	  $path = "";

	  $channels = $channelController->displayChannels();
	  

	  if (isset($_GET['id'])) {

	  	$channelid = $_GET['id'];
	  	$studentid = $_SESSION['account']['id'];
	  	$channelController->enrollChannel($studentid, $channelid);
	  	

	  	 $path = "student-channel.php";

	  	
	  }

	  if ($path != "") {
	  	
	  	$util->redirect($path);
	  }
?>

<!DOCTYPE html>
<html>
<head>
	<?php include '../inc/head.php'; ?>
</head>
<body>
	 
	<?php include '../inc/student-top-nav.php'; ?>
	<?php include '../inc/student-side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Channel</h1>
		</div>
		<div class="main-content">
			<?php if ($channels != false){ ?> 
			

				<div class="card">
					<div class="card-header">
						<h2>Enroll Your Channel</h2>
					</div>
					<div class="card-content">

						<table width="100%">
							<tr>
								
								<th colspan="2">Channel Name</th>

							</tr>
							<?php foreach ($channels as $channel) { ?>

								<?php $enrolled = $channelController -> isStudentEnrolled($_SESSION['account']['id'], $channel['id'])[0]; ?>

 									<tr>
										<td><?php echo $channel['name']; ?></td>
										
				
									<?php if (!isset($enrolled)) { ?>	

											<td><a href="enroll-channel.php?id=<?php echo $channel['id']; ?>"><button type="submit" name="enroll">Enroll</button></a></td>
										
									 <?php  } else{ ?> 	

									 	<td>Enrolled</td>


									<?php } ?>

										
										
									
										
									</tr>

						

								
								<!-- <div class="item-image-col"><img style="border-radius: 50%; height:40px; width:40px" ></img>
								</div>
								<div class="item-title-col"><p class="item-title"></p></div> -->
							<!-- </div> -->
							<?php  } ?>
						</table>

						<!-- </a> -->
						

					</div>
					<!-- <div class="card-footer">
						<a href="create-channel.php" style="float: right; position: relative; right: -98%; color: inherit;">
							<i class="fas fa-plus fa-2x"></i>
						</a>
					</div> -->
				</div>	

			<?php } else { ?>

				<div class="no-content">
					<p class="no-content-text">You have no channel</p>
				</div>

			<?php } ?>
			
			
		
		</div>	
	</div>
</body>
</html>