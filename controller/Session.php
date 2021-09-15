<?php	
	require_once 'Util.php';

	class Session {

		private $util;

		function __construct() {
			$this->util = new Util();
		}

		// MODIFIED: add condition to check whether session is start
		function updateSession($account) {
			if(!isset($_SESSION)) { 
				session_start(); 
			} 
			$_SESSION['account'] = $account;
		}

		function destroySession() {
			if(!isset($_SESSION)) { 
				session_start(); 
			} 
			session_unset();
			session_destroy();

			$this->util->redirect('../pages/welcome.php');
		}

		function isSessionExist() {
			if(!isset($_SESSION)) { 
				session_start(); 
			} 
			if (isset($_SESSION['account'])) {
				return true;
			}
			return false;
		}
	}
