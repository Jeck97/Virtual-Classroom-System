<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) 
		$uri = 'https://';
	else 
		$uri = 'http://';

	$uri .= $_SERVER['HTTP_HOST'];
	
	header('Location: '.$uri.'/Virtual-Classroom-System-v1.2/pages/welcome.php');
	
	exit;
?>
