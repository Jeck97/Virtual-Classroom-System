<?php
include_once '../inc/config.php';
include_once '../inc/header.php';
if (!isset($_SESSION)) session_start();
$account = $_SESSION['account'];
?>

<!DOCTYPE html>
<html>

<head>
	<?php include_once '../inc/head.php'; ?>
</head>

<body>

	<?php include_once '../inc/student-top-nav.php'; ?>
	<?php include_once '../inc/student-side-nav.php'; ?>

	<div id="container" class="container">
		<div class="header">
			<h1>Chatbot</h1>
		</div>
		<div class="main-content">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; align-items: center; height: 50px; ">
						<div style="display: flex; align-items: center; justify-content: center; width: 70px; height: 100px;">
							<div style="width: 50px; height: 50px; border-radius: 50%;">
								<img src="../img/chat-icon.png" style="height: inherit; width: inherit; border-radius: 50%; box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);">
							</div>
							<div style="height: 15px; width: 15px; background-color: #70AD47; border-radius: 50%; position: relative; top: 15px; right: 15px;"></div>
						</div>
						<div>
							<div>
								<h3>edu-v chatbot</h3>
							</div>
							<div>
								<small>Online</small>
							</div>
						</div>
					</div>
				</div>
				<div id="card-content" class="card-content">
					<div class="bot-inbox inbox">
						<img src="../img/chat-icon.png" class="icon">
						<div class="msg-header">
							<p>Hello <?php echo ucwords($account['name']) ?>, how can I help you?</p>
						</div>
					</div>
				</div>
				<div class="card-footer" style="padding: 10px 20px;">
					<div style="width: calc(100% - 40px); margin-right: 10px;">
						<input id="input-message" type="text" name="message" placeholder="Type your message here..." style="padding: 10px 20px; width: 100%; border-radius: 10px; background-color: #F2F2F2; border: none;" required>
					</div>
					<div style="width: 40px;">
						<button id="send" hidden="hidden" onclick="onSend();"></button>
						<label for="send"><i class="fa fa-paper-plane fa-2x"></i></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	const input = document.getElementById("input-message");
	input.addEventListener("keyup", function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			document.getElementById("send").click();
		}
	});

	function onSend() {
		const inputMessage = document.getElementById("input-message");
		const message = inputMessage.value.trim();
		if (message === "") return;
		const content = document.getElementById("card-content");
		content.innerHTML += `
		<div class="user-inbox inbox">
			<div class="msg-header ">
				<p>${message}</p>
			</div>
		</div>`;
		inputMessage.value = "";
		content.scrollTop = content.scrollHeight;

		const xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				content.innerHTML += `
				<div class="bot-inbox inbox">
					<img src="../img/chat-icon.png" class="icon">
					<div class="msg-header">
						<p>${this.responseText}</p>
					</div>
				</div>`;
				content.scrollTop = content.scrollHeight;
			}
		};
		xhttp.open("POST", "../controller/manager/chatbot-manager.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(`submit=send&message=${message}`);
	}
</script>
<style type="text/css">
	::-webkit-scrollbar {
		width: 3px;
		border-radius: 25px;
	}

	::-webkit-scrollbar-track {
		background: #f1f1f1;
	}

	::-webkit-scrollbar-thumb {
		background: #ddd;
	}

	::-webkit-scrollbar-thumb:hover {
		background: #ccc;
	}

	.card-content {
		min-height: 400px;
		max-height: 400px;
		overflow-y: auto;
	}

	.card-content .inbox {
		width: 100%;
		display: flex;
		align-items: baseline;
	}

	.card-content .user-inbox {
		justify-content: flex-end;
		margin: 13px 0;
	}

	.card-content .inbox .icon {
		height: 40px;
		width: 40px;
	}

	.card-content .inbox .msg-header {
		max-width: 60%;
		margin-left: 10px;
	}

	.card-content .inbox .msg-header p {
		color: #fff;
		background: #70AD47;
		border-radius: 0 10px 10px 10px;
		padding: 8px 10px;
		font-size: 14px;
	}

	.card-content .user-inbox .msg-header p {
		border-radius: 10px 0 10px 10px;
		color: #333;
		background: #f2f2f2;
	}

	.card-footer .fa-paper-plane {
		color: #595959;
		cursor: pointer;
	}

	.card-footer .fa-paper-plane:hover {
		color: #404040;
	}
</style>

</html>