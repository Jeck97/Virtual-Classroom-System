	<aside id="sidebar" class="sidebar" style="left: 0px;">
		<div class="brand">
			<a href="dashboard.php" class="brand-container center">
				<img src="../img/edu-v-logo.png" class="brand-logo">
			</a>
		</div>
		<div class="user-panel">
			<a href="account.php" class="user-panel-container">
				<div class="image-col center">
					<img src="../img/<?php echo $_SESSION['account']['image']; ?>" class="user-image">
				</div>
				<div class="name-col center">
					<label class="label"><?php echo strtoupper($_SESSION['account']['name']); ?></label>
				</div>
			</a>
		</div>
		<nav class="side-navbar">
			<div class="side-nav-item">
				<a href="channel.php" class="side-nav-link <?php if ($CURRENT_PAGE == "channel" || $CURRENT_PAGE == "view-channel" || $CURRENT_PAGE == "create-class" || $CURRENT_PAGE == "create-channel" || $CURRENT_PAGE == "edit-channel") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-chalkboard-teacher fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Channel</label>
					</div>
				</a>
			</div>
			<!-- <div class="side-nav-item">
				<a href="attendance.php" class="side-nav-link <?php if ($CURRENT_PAGE == "attendance") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-clipboard-list fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Attendance</label>
					</div>
				</a>
			</div> -->
			<div class="side-nav-item">
				<a href="assignment.php" class="side-nav-link <?php if ($CURRENT_PAGE == "assignment" || $CURRENT_PAGE == "create-assignment" || $CURRENT_PAGE == "edit-assignment" || $CURRENT_PAGE == "view-assignment") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-folder-open fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Assignment</label>
					</div>
				</a>
			</div>
			<div class="side-nav-item">
				<a href="examination.php" class="side-nav-link <?php if ($CURRENT_PAGE == "examination" || $CURRENT_PAGE == "create-examination" || $CURRENT_PAGE == "view-examination" || $CURRENT_PAGE == "examination-questions") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-file-alt fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Exam</label>
					</div>
				</a>
			</div>
			<!-- <div class="side-nav-item">
				<a href="room.php" class="side-nav-link <?php if ($CURRENT_PAGE == "room" || $CURRENT_PAGE == "create-room") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-users fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Room</label>
					</div>
				</a>
			</div> -->
			<div class="side-nav-item">
				<a href="chatbot.php" class="side-nav-link <?php if ($CURRENT_PAGE == "chatbot") { ?> active <?php } ?>">
					<div class="image-col center">
						<i class="fas fa-comment-dots fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Chatbot</label>
					</div>
				</a>
			</div>
		</nav>
	</aside>