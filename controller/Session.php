<?php	
	require_once 'Util.php';

	class Session {

		private $util;

		function __construct() {
			$this->util = new Util();
		}

		function updateSession($account) {
			session_start();
			$_SESSION['account'] = $account;
		}

		function destroySession() {
			session_start();
			session_unset();
			session_destroy();

			$this->util->redirect('../pages/welcome.php');
		}

		function isSessionExist() {
			session_start();

			if (isset($_SESSION['account'])) {
				return true;
			}
			return false;
		}
	}
?>