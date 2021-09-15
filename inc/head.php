<title><?php echo $PAGE_TITLE; ?> <?php if ($CURRENT_PAGE != "welcome") { ?>| <?php echo $WEBSITE_NAME; } ?></title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<script src="https://kit.fontawesome.com/c6247777a6.js" crossorigin="anonymous"></script>


<?php if ($CURRENT_PAGE === "welcome" || $CURRENT_PAGE === "login" || $CURRENT_PAGE === "register" || $CURRENT_PAGE === "forgot" || $CURRENT_PAGE === "reset" || $CURRENT_PAGE === "verified") { ?>
		
		<link rel="stylesheet" type="text/css" href="../css/auth.css">

		<script type="text/javascript" src="../js/auth.js"></script>

<?php } else { ?>

		<script src="../js/edu-v.js"></script>
		
		<link rel="stylesheet" type="text/css" href="../css/header.css">
		<link rel="stylesheet" type="text/css" href="../css/edu-v.css">

		

<?php } ?>