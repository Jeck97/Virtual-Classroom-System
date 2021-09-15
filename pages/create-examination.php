<?php
include '../inc/config.php';
include '../inc/header.php';

if (!isset($_SESSION)) session_start();
$educatorId = $_SESSION['account']['id'];

$db = new DBController();
$query = "SELECT * FROM channel WHERE educator = ?";
$results = $db->runQuery($query, 's', array($educatorId));

$options = "";
if ($results != null)
	foreach ($results as $result)
		$options .= '<option value="' . $result["id"] . '">' . $result["name"] . '</option>';
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
			<h1>Examination</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<form id="form-create-exam" method="post" action="../controller/manager/examination-manager.php">
					<div class="card-header">
						<h2>Create Examination</h2>
					</div>
					<div class="card-content">
						<div class="form">
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-title" class="text-label">Title</label>
								</div>
								<div class="form-control">
									<input type="text" id="input-title" class="form-input" name="title" onkeyup="validateTitle();">
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-date-picker" class="text-label">Start Date</label>
								</div>
								<div class="form-control">
									<!-- <label class="form-input"></label>
									<label class="browse" for="input-date-picker" style="width: 117px;">Select Date</label> -->
									<input type="date" id="input-date-picker" class="form-input" name="date-picker" min="<?php echo date('Y-m-d', strtotime(date("Y-m-d") . ' + 1 days')); ?>" max="<?php echo date('Y-m-d', strtotime(date("Y-m-d") . ' + 1 years')); ?>" onchange="validateDate();">
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-time-picker" class="text-label">Start Time</label>
								</div>
								<div class="form-control">
									<!-- <label class="form-input"></label>
									<label class="browse" for="input-time-picker" style="width: 117px;">Select Date</label> -->
									<input type="time" id="input-time-picker" class="form-input" name="time-picker" onchange="validateTime();">
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-hour" class="text-label">Duration</label>
								</div>
								<div style="display: flex; width: 80%; justify-content: space-between;">
									<div class="form-control" style="width: 45%; align-items: center;">
										<input type="number" id="input-hour" class="form-input" name="hour" style="width: 80%;" min="0" onkeyup="validateHour();">
										<label for="input-hour" style="margin-left: 20px;">Hour</label>
										<i style="right: 80px;" class="fas fa-check-circle"></i>
										<i style="right: 80px;" class="fas fa-exclamation-circle"></i>
										<small>Error message</small>
									</div>
									<div class="form-control" style="width: 45%; align-items: center;">
										<input type="number" id="input-minute" class="form-input" name="minute" style="width: 80%;" min="0" onkeyup="validateMinute();" onblur="convertToHour();">
										<label for="input-minute" style="margin-left: 20px;">Minute</label>
										<i style="right: 80px" class="fas fa-check-circle"></i>
										<i style="right: 80px;" class="fas fa-exclamation-circle"></i>
										<small>Error message</small>
									</div>
								</div>
							</div>
							<div class="input-group">
								<div class="input-label" style="padding-bottom: 20px;">
									<label for="input-channel" class="text-label">Channel</label>
								</div>
								<div class="form-control">
									<select id="input-channel" class="form-input" name="channel" onchange="validateChannel();">
										<option selected="selected" disabled="disabled" value="">-- Select --</option>
										<?php echo $options; ?>
									</select>
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<small>Error message</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div style="visibility: hidden;"></div>
						<button class="btn btn-success" type="submit" name="submit" value="create-examination" onclick="validateSave();">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function validateTitle() {
			const inputTitle = document.getElementById('input-title');
			const valueTitle = inputTitle.value.trim();

			if (valueTitle === "")
				setError(inputTitle, 'Title is required!');
			else
				setSuccess(inputTitle);
		}

		function validateDate() {
			const inputDatePicker = document.getElementById('input-date-picker');
			if (inputDatePicker.value === "")
				setError(inputDatePicker, 'Start date is required!');
			else
				setSuccess(inputDatePicker);
		}

		function validateTime() {
			const inputTimePicker = document.getElementById('input-time-picker');
			const valueTime = inputTimePicker.value;
			const valueTimes = valueTime.split(':');
			if (valueTime === "")
				setError(inputTimePicker, 'Start time is required!');
			else if (valueTimes[0] < 8)
				setError(inputTimePicker, 'Start time cannot be earlier than 8:00 AM!');
			else if (valueTimes[0] > 22 || (valueTimes[0] == 22 && valueTimes[1] != 0))
				setError(inputTimePicker, 'Start time cannot be later than 10:00 PM!');
			else
				setSuccess(inputTimePicker);
		}

		function validateHour() {
			const inputHour = document.getElementById('input-hour');
			const valueHour = inputHour.value;
			const inputMinute = document.getElementById('input-minute');
			const valueMinute = inputMinute.value;

			if (valueHour === "")
				setError(inputHour, 'Duration hour is required!');
			else if (valueHour < 0)
				setError(inputHour, 'Duration hour cannot be negative!');
			else if (valueHour == 0 && valueMinute == 0)
				setError(inputHour, 'Duration cannot be 0!');
			else {
				setSuccess(inputHour);
				if (valueMinute !== "" && valueMinute >= 0)
					setSuccess(inputMinute);
			}
		}

		function validateMinute() {
			const inputHour = document.getElementById('input-hour');
			const valueHour = inputHour.value;
			const inputMinute = document.getElementById('input-minute');
			const valueMinute = inputMinute.value;

			if (valueMinute === "")
				setError(inputMinute, 'Duration minute is required!');
			else if (valueMinute < 0)
				setError(inputMinute, 'Duration minute cannot be negative!');
			else if (valueHour == 0 && valueMinute == 0)
				setError(inputMinute, 'Duration cannot be 0!');
			else {
				setSuccess(inputMinute);
				if (valueHour !== "" && valueHour >= 0)
					setSuccess(inputHour);
			}
		}

		function validateChannel() {
			const inputChannel = document.getElementById('input-channel');
			const valueChannel = inputChannel.value;

			if (valueChannel === "")
				setError(inputChannel, 'Channel is required!');
			else
				setSuccess(inputChannel);
		}

		function convertToHour() {
			const inputHour = document.getElementById('input-hour');
			const valueHour = inputHour.value;
			const inputMinute = document.getElementById('input-minute');
			const valueMinute = inputMinute.value;

			if (valueMinute >= 60) {
				const convertedHour = parseInt(valueMinute / 60);
				const convertedMinute = valueMinute % 60;
				console.log(convertedHour);
				console.log(convertedMinute);
				valueHour === "" ? inputHour.value = convertedHour : inputHour.value += convertedHour;
				inputMinute.value = convertedMinute;
				setSuccess(inputHour);
			}
		}

		function validateSave() {
			const formCreateExam = document.getElementById('form-create-exam');
			const inputTitle = document.getElementById('input-title');
			const inputDatePicker = document.getElementById('input-date-picker');
			const inputTimePicker = document.getElementById('input-time-picker');
			const inputHour = document.getElementById('input-hour');
			const inputMinute = document.getElementById('input-minute');
			const inputChannel = document.getElementById('input-channel');

			formCreateExam.addEventListener('submit', e => {
				if (isError(inputTitle) || isError(inputDatePicker) || isError(inputTimePicker) || isError(inputHour) || isError(inputMinute) || isError(inputChannel)) {
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

		.container .main-content .card .card-content .form .input-group .form-control select {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-appearance: none;
			-moz-appearance: none;
			background-image:
				linear-gradient(45deg, transparent 50%, gray 50%),
				linear-gradient(135deg, gray 50%, transparent 50%),
				linear-gradient(to right, #ccc, #ccc);
			background-position:
				calc(100% - 20px - 22px) calc(1em + 2px),
				calc(100% - 15px - 22px) calc(1em + 2px),
				calc(100% - 2.5em - 22px) 0.5em;
			background-size:
				5px 5px,
				5px 5px,
				1px 1.5em;
			background-repeat: no-repeat;
		}
	</style>
</body>

</html>