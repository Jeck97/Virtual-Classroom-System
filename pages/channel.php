<?php include '../inc/config.php'; ?>
<?php include '../inc/header.php'; ?>

<?php

require_once '../controller/ChannelController.php';
require_once '../controller/Util.php';

//initialize object
$channelController = new ChannelController();
$util = new Util();

$result = $channelController->displayChannels();

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
			<?php if ($result != false) { ?>

				<div class="card">
					<div class="card-header">
						<h2>Your channel</h2>
					</div>
					<div class="card-content">
						<?php foreach ($result as $channel) { ?>

							<a href="view-channel.php?id=<?php echo $channel['id']; ?>" class="box-item">
								<div class="box-item-container">
									<i class=" item-option"></i>
									<div class="item-image-col"><img style="border-radius: 50%; height:40px; width:40px" src="../img/<?php echo $channel['image_text'] ?>"></img>
									</div>
									<div class="item-title-col">
										<p class="item-title"><?php echo $channel['name']; ?></p>
									</div>
								</div>
							</a>

						<?php } ?>

					</div>
					<div class="card-footer">
						<a href="create-channel.php" style="float: right; position: relative; right: -98%; color: inherit;">
							<i class="fas fa-plus fa-2x"></i>
						</a>
					</div>
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