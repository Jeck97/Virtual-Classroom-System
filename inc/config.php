<?php
	require_once '../controller/Session.php';
	require_once '../controller/AuthController.php';
	
	$session = new Session();
	$util = new Util();
	$auth = new AuthController();

	date_default_timezone_set('Asia/Kuala_Lumpur');

	$PAGE_TITLE = "";
	$CURRENT_PAGE = "";
	$WEBSITE_NAME = "EDU-V Virtual Classroom";
	$VERSION = "1.3.0";
	$PAGE_PATH = "/Virtual-Classroom-System-v1.3/pages/";

	switch ($_SERVER['SCRIPT_NAME']) {
		case $PAGE_PATH. 'welcome.php':
			$PAGE_TITLE = "Welcome to " .$WEBSITE_NAME;
			$CURRENT_PAGE = "welcome";
			break;
		case $PAGE_PATH. 'login.php':
			$PAGE_TITLE = "Login";
			$CURRENT_PAGE = "login";
			break;
		case $PAGE_PATH. 'register.php':
			$PAGE_TITLE = "Register";
			$CURRENT_PAGE = "register";
			break;
		case $PAGE_PATH. 'forgot-password.php':
			$PAGE_TITLE = "Forgot Password";
			$CURRENT_PAGE = "forgot";
			break;
		case $PAGE_PATH. 'reset-password.php':
			$PAGE_TITLE = "Reset Password";
			$CURRENT_PAGE = "reset";
			break;
		case $PAGE_PATH. 'email-verified.php':
			$PAGE_TITLE = "Email Verified";
			$CURRENT_PAGE = "verified";
			break;
		case $PAGE_PATH. 'dashboard.php':
			$PAGE_TITLE = "Dashboard";
			$CURRENT_PAGE = "dashboard";
			break;
		case $PAGE_PATH. 'account.php':
			$PAGE_TITLE = "Account";
			$CURRENT_PAGE = "account";
			break;
		case $PAGE_PATH. 'change-email.php':
			$PAGE_TITLE = "Change Email";
			$CURRENT_PAGE = "change-email";
			break;
		case $PAGE_PATH. 'change-password.php':
			$PAGE_TITLE = "Change Password";
			$CURRENT_PAGE = "change-password";
			break;
		case $PAGE_PATH. 'notification.php':
			$PAGE_TITLE = "Notification";
			$CURRENT_PAGE = "notification";
			break;
		case $PAGE_PATH. 'channel.php':
			$PAGE_TITLE = "Channel";
			$CURRENT_PAGE = "channel";
			break;
		case $PAGE_PATH. 'assignment.php':
			$PAGE_TITLE = "Assignment";
			$CURRENT_PAGE = "assignment";
			break;
		case $PAGE_PATH. 'attendance.php':
			$PAGE_TITLE = "Attendance";
			$CURRENT_PAGE = "attendance";
			break;
		case $PAGE_PATH. 'view-channel.php':
			$PAGE_TITLE = "View Channel";
			$CURRENT_PAGE = "view-channel";
			break;
		case $PAGE_PATH. 'create-class.php':
			$PAGE_TITLE = "Create Class";
			$CURRENT_PAGE = "create-class";
			break;
		case $PAGE_PATH. 'create-channel.php':
			$PAGE_TITLE = "Create Channel";
			$CURRENT_PAGE = "create-channel";
			break;
		case $PAGE_PATH. 'edit-channel.php':
			$PAGE_TITLE = "Edit Channel";
			$CURRENT_PAGE = "edit-channel";
			break;
		case $PAGE_PATH. 'create-assignment.php':
			$PAGE_TITLE = "Create Assignment";
			$CURRENT_PAGE = "create-assignment";
			break;
		case $PAGE_PATH. 'edit-assignment.php':
			$PAGE_TITLE = "Edit Assignment";
			$CURRENT_PAGE = "edit-assignment";
			break;
		case $PAGE_PATH. 'view-assignment.php':
			$PAGE_TITLE = "View Assignment";
			$CURRENT_PAGE = "view-assignment";
			break;
		case $PAGE_PATH. 'examination.php':
			$PAGE_TITLE = "Examination";
			$CURRENT_PAGE = "examination";
			break;
		case $PAGE_PATH. 'create-examination.php':
			$PAGE_TITLE = "Create Examination";
			$CURRENT_PAGE = "create-examination";
			break;
		case $PAGE_PATH. 'view-examination.php':
			$PAGE_TITLE = "View Examination";
			$CURRENT_PAGE = "view-examination";
			break;
		case $PAGE_PATH. 'room.php':
			$PAGE_TITLE = "Room";
			$CURRENT_PAGE = "room";
			break;
		case $PAGE_PATH. 'create-room.php':
			$PAGE_TITLE = "Create Room";
			$CURRENT_PAGE = "create-room";
			break;
		case $PAGE_PATH. 'student-channel.php':
			$PAGE_TITLE = "Student Channel";
			$CURRENT_PAGE = "student-channel";
			break;
		case $PAGE_PATH. 'student-view-channel.php':
			$PAGE_TITLE = "Student View Channel";
			$CURRENT_PAGE = "student-view-channel";
			break;
		case $PAGE_PATH. 'student-attendance.php':
			$PAGE_TITLE = "Student Attendance";
			$CURRENT_PAGE = "student-attendance";
			break;	
		case $PAGE_PATH. 'student-assignment.php':
			$PAGE_TITLE = "Assignments";
			$CURRENT_PAGE = "student-assignment";
			break;
		case $PAGE_PATH. 'student-view-assignment.php':
			$PAGE_TITLE = "Assignment";
			$CURRENT_PAGE = "student-view-assignment";
			break;
		case $PAGE_PATH. 'student-examination.php':
			$PAGE_TITLE = "Student Exam";
			$CURRENT_PAGE = "student-examination";
			break;
		case $PAGE_PATH. 'student-room.php':
			$PAGE_TITLE = "Student Room";
			$CURRENT_PAGE = "student-room";
			break;
		case $PAGE_PATH. 'chatbot.php':
			$PAGE_TITLE = "Chatbot";
			$CURRENT_PAGE = "chatbot";
			break;
		case $PAGE_PATH. 'student-chatbot.php':
			$PAGE_TITLE = "Student-Chatbot";
			$CURRENT_PAGE = "student-chatbot";
			break;
		default:
			break;
	}	
?>