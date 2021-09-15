function validateRegister() {
	const formRegister = document.getElementById('form-register');
	const inputFullname = document.getElementById('input-fullname');
	const inputEmail = document.getElementById('input-email');
	const inputPassword = document.getElementById('input-password');
	const inputPasswordConfirm = document.getElementById('input-password-confirm');
	const inputCheckbox = document.getElementById('input-checkbox');

	formRegister.addEventListener('submit', e => {
		if (isError(inputFullname) || isError(inputEmail) || isError(inputPassword) || isError(inputPasswordConfirm) || !isChecked(inputCheckbox)) {
			e.preventDefault();
		}
	});
}

function validateLogin() {
	const formLogin = document.getElementById('form-login');
	const inputEmail = document.getElementById('input-email');
	const inputPassword = document.getElementById('input-password');

	formLogin.addEventListener('submit', e => {
		if (isError(inputEmail) || isError(inputPassword)) {
			e.preventDefault();
		}
	});
}

function validateForgotPassword() {
	const formForgot = document.getElementById('form-forgot');
	const inputEmail = document.getElementById('input-email');

	formForgot.addEventListener('submit', e => {
		if (isError(inputEmail)) {
			e.preventDefault();
		}
	})
}

function validateResetPassword() {
	const formReset = document.getElementById('form-reset');
	const inputPassword = document.getElementById('input-password');
	const inputPasswordConfirm = document.getElementById('input-password-confirm');

	formReset.addEventListener('submit', e => {
		if (isError(inputPassword) || isError(inputPasswordConfirm)) {
			e.preventDefault();
		}
	});
}

function validateFullname() {
	const inputFullname = document.getElementById('input-fullname');
	const valueFullname = inputFullname.value.trim();

	if (valueFullname === "")
		setError(inputFullname, 'Full name is required!');
	else 
		setSuccess(inputFullname);
}

function validateEmail() {
	const inputEmail = document.getElementById('input-email');
	const valueEmail = inputEmail.value.trim();

	if (valueEmail === "")
		setError(inputEmail, 'Email is required!');
	else if (!isEmail(valueEmail))
		setError(inputEmail, 'Invalid email address!');
	else
		setSuccess(inputEmail);
}

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

function validatePasswordConfirm() {
	const inputPasswordConfirm = document.getElementById('input-password-confirm');
	const valuePasswordConfirm = inputPasswordConfirm.value.trim();

	if (valuePasswordConfirm === "")
		setError(inputPasswordConfirm, 'Confirmation password is required!');
	else
		setSuccess(inputPasswordConfirm);
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

function isChecked(input) {
	if (input.checked === true)
		return true;
	return false;
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

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function isError(input) {
	if (input.parentElement.className !== 'form-control success')
		return true;
	return false;
}