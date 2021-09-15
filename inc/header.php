<?php 
	if ($session->isSessionExist() === false) 
		$util->redirect('welcome.php'); 
?>