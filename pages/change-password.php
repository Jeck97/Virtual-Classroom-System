<?php include_once '../inc/config.php'; ?>
<?php include_once '../inc/header.php'; ?>

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
				<form id="form-account" method="post" action="../controller/manager/account-manager.php">
					<div class="card-header">
						<h2>Update password</h2>
					</div>
					<div class="card-content">
						<div class="form">
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-password" class="text-label">Password</label>
								</div>
								<div class="form-control">
									<input type="password" id="input-password" class="form-input" name="password" onkeyup="validatePassword(); comparePassword();">
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-password-confirm" class="text-label">Confirmation Password</label>
								</div>
								<div class="form-control">
									<input type="password" id="input-password-confirm" class="form-input" name="password-confirm" onkeyup="validatePassword(); comparePassword();">
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="account.php" class="btn btn-danger">Cancel</a>
						<button class="btn btn-success" type="submit" name="submit" value="update-password">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function validatePassword() {
			const inputPassword = document.getElementById('input-password');
			const valuePassword = inputPassword.value.trim();

			if (valuePassword === "")
				setError(inputPassword, 'Password is required!');
			else if (valuePassword.length <= 6)
				setError(inputPassword, 'Password must be more than 6 characters!');
			else
				setSuccess(inputPassword);
		}

		function comparePassword() {
			const inputPassword = document.getElementById('input-password');
			const inputPasswordConfirm = document.getElementById('input-password-confirm');
			const valuePassword = inputPassword.value.trim();
			const valuePasswordConfirm = inputPasswordConfirm.value.trim();

			if (valuePassword === '' && valuePasswordConfirm === '')
				setDefault(inputPasswordConfirm);
			else if (valuePassword !== valuePasswordConfirm)
				setError(inputPasswordConfirm, 'Password not match!');
			else
				setSuccess(inputPasswordConfirm);
		}

		function validateChange() {
			const formAccount = document.getElementById('form-account');
			const inputEmail = document.getElementById('input-email');
			const inputPassword = document.getElementById('input-password');
			const inputPasswordConfirm = document.getElementById('input-password-confirm');

			formAccount.addEventListener('submit', e => {
				if (isError(inputEmail) || isError(inputPassword) || isError(inputPasswordConfirm)) {
					e.preventDefault();
				}
			});
		}

		function setSuccess(input) {
			const formControl = input.parentElement;
			formControl.className = 'form-control success';
		}

		function setError(input, message) {
			const formControl = input.parentElement;
			const small = formControl.querySelector('small');
			formControl.className = 'form-control error';
			small.innerText = message;
		}

		function setDefault(input) {
			const formControl = input.parentElement;
			formControl.className = 'form-control';
		}

		function isError(input) {
			if (input.parentElement.className !== 'form-control success')
				return true;
			return false;
		}
	</script>

	<style type="text/css">
		.container .main-content .card .card-content .form .input-group .form-control {
			padding-bottom: 20px;
			position: relative;
		}

		.container .main-content .card .card-content .form .input-group .form-control .form-input {
			border: 2px solid #f0f0f0;
			padding-right: 30px;
			height: 3rem;
		}

		.container .main-content .card .card-content .form .input-group .form-control .form-input:focus {
			outline: 0;
			border-color: #777;
		}

		.container .main-content .card .card-content .form .input-group .form-control.success .form-input {
			border-color: #2ecc71;
		}

		.container .main-content .card .card-content .form .input-group .form-control.error .form-input {
			border-color: #e74c3c;
		}

		.container .main-content .card .card-content .form .input-group .form-control i {
			visibility: hidden;
			position: absolute;
			top: 15px;
			right: 10px;
		}

		.container .main-content .card .card-content .form .input-group .form-control.success i.fa-check-circle {
			color: #2ecc71;
			visibility: visible;
		}

		.container .main-content .card .card-content .form .input-group .form-control.error i.fa-exclamation-circle {
			color: #e74c3c;
			visibility: visible;
		}

		.container .main-content .card .card-content .form .input-group .form-control small {
			color: #e74c3c;
			position: absolute;
			bottom: 0;
			left: 0;
			visibility: hidden;
			padding-left: 10px;
		}

		.container .main-content .card .card-content .form .input-group .form-control.error small {
			visibility: visible;
		}
	</style>
</body>

</html>