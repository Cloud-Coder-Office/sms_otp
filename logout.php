<?php
	session_start();
	unset($_SESSION['ADMIN']);
	unset($_SESSION['NAME']);
	unset($_SESSION['PHONE']);
	unset($_SESSION['UID']);
	unset($_SESSION['ID']);
	unset($_SESSION['ACCESS']);
	session_destroy();
	header('Location: index.php');
?>