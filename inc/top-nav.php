	<nav id="navbar" class="navbar">
		<div class="navbar-nav">
			<div class="nav-item">
				<i class="nav-link fa fa-bars fa-2x" aria-hidden="true" onclick="sideNav();" ></i>
			</div>
		</div>
		<div class="navbar-nav">
			<div class="nav-item">
				<a href="dashboard.php" class="nav-link <?php if ($CURRENT_PAGE === 'dashboard') echo 'active'; ?>"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a>
			</div>
			<!-- <div class="nav-item">
				<a href="notification.php" class="nav-link <?php if ($CURRENT_PAGE === 'notification') echo 'active'; ?>"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></a>
			</div> -->
			<div class="nav-item">
				<a href="logout.php" class="nav-link"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a>
			</div>
		</div>
	</nav>