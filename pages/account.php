<?php
include_once '../inc/config.php';
include_once '../inc/header.php';
$account = $_SESSION['account'];
?>


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
			<h1>My Profile</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<form id="form-account" method="post" action="../controller/manager/account-manager.php" enctype="multipart/form-data">
					<div class="card-header">
						<h2>Edit your profile</h2>
					</div>
					<div class="card-content">
						<div class="form">
							<div class="input-group">
								<div class="input-label">
									<label for="input-fullname" class="text-label">Full Name</label>
								</div>
								<div class="form-control">
									<input type="text" id="input-fullname" class="form-input success" name="fullname" value="<?php echo ucwords($account['name']); ?>" required>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label">
									<label for="input-email" class="text-label">Email</label>
								</div>
								<div class="form-control">
									<input type="email" id="input-email" class="form-input" name="email" value="<?php echo $account['email']; ?>" disabled="disabled">
									<p class="btn btn-change" id="change-email" onclick="modalPassword('goto-change-email');">Change</p>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label">
									<label for="input-password" class="text-label">Password</label>
								</div>
								<div class="form-control">
									<input type="password" id="input-password" class="form-input" name="password" value="<?php echo $account['password']; ?>" disabled="disabled">
									<p class="btn btn-change" id="change-password" onclick="modalPassword('goto-change-password');">Change</p>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label">
									<label for="label-profile-pic" class="text-label">Profile Pic</label>
								</div>
								<div class="form-control">
									<label class="form-input" id="label-profile-pic"><?php echo $account['image']; ?></label>
									<label class="browse" for="input-profile-pic">Browse</label>
									<input type="file" id="input-profile-pic" name="profile-pic" hidden="hidden" accept="image/*" onchange="onFileSelected();">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-danger" type="button" onclick="modalPassword('deactive-account');">Deactive Account</button>
						<button class="btn btn-success" type="submit" name="submit" value="update-name-pic">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="modal-password" class="modal" style="display: none;">
		<div class="modal-container">
			<form class="modal-form" method="post" action="../controller/manager/account-manager.php">
				<div class="modal-header">
					<h2>Enter your password</h2>
					<h2 class="close-button" onclick="modalPassword();">&times;</h2>
				</div>
				<div class="modal-body">
					<p class="modal-text">For security reasons, please enter your password to reauthenticate with credential.</p>
					<input class="modal-input" type="password" name="password" id="input-modal-password" placeholder="Password..." required>
				</div>
				<div class="modal-footer">
					<div class="btn btn-danger" onclick="modalPassword();">Cancel</div>
					<button class="btn btn-success" type="submit" name="submit" id="modal-password-submit">Submit</button>
				</div>
			</form>
		</div>
	</div>


	<script type="text/javascript">
		function modalPassword(action) {

			let modalPassword = document.getElementById('modal-password');
			let btnSavePassword = document.getElementById('modal-password-submit');
			btnSavePassword.value = action;

			if (modalPassword.style.display == "none")
				modalPassword.style.display = "block";
			else {
				let inputPassword = document.getElementById('input-modal-password');
				inputPassword.value = "";
				modalPassword.style.display = "none";
			}
		}

		function onFileSelected() {
			let labelProfilePic = document.getElementById('label-profile-pic');
			let inputProfilePic = document.getElementById('input-profile-pic');
			let picName = inputProfilePic.value.replace(/.*[\/\\]/, '');
			labelProfilePic.innerText = picName;
		}
	</script>
</body>

</html>