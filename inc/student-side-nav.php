	<aside id="sidebar" class="sidebar" style="left: 0px;">
		<div class="brand">
			<a href="student-dashboard.php" class="brand-container center">
				<img src="../img/edu-v-logo.png" class="brand-logo">
			</a>
		</div>
		<div class="user-panel">
			<a href="student-account.php" class="user-panel-container">
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
				<a href="student-channel.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-channel" || $CURRENT_PAGE == "student-view-channel" || $CURRENT_PAGE == "create-class" || $CURRENT_PAGE == "create-channel" || $CURRENT_PAGE == "edit-channel") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-chalkboard-teacher fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Channel</label>
					</div>
				</a>
			</div>
			<!-- <div class="side-nav-item">
				<a href="student-attendance.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-attendance") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-clipboard-list fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Attendance</label>
					</div>
				</a>
			</div> -->
			<div class="side-nav-item">
				<a href="student-assignment.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-view-assignment" || $CURRENT_PAGE == "student-assignment" ) { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-folder-open fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Assignment</label>
					</div>
				</a>
			</div>
			<div class="side-nav-item">
				<a href="student-examination.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-examination" || $CURRENT_PAGE == "create-examination" || $CURRENT_PAGE == "view-examination") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-file-alt fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Exam</label>
					</div>
				</a>
			</div>
			<!-- <div class="side-nav-item">
				<a href="student-room.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-room" || $CURRENT_PAGE == "create-room") { ?> active <?php } ?> ">
					<div class="image-col center">
						<i class="fas fa-users fa-2x"></i>
					</div>
					<div class="name-col">
						<label class="label-sm">Room</label>
					</div>
				</a>
			</div> -->
			<div class="side-nav-item">
				<a href="student-chatbot.php" class="side-nav-link <?php if ($CURRENT_PAGE == "student-chatbot") { ?> active <?php } ?>">
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