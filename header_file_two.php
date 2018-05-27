<?php
	session_start();
	if(!isset($_SESSION['ADMIN'])){
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Admin Panel</title>
        <meta name="description" content="CloudCoder SMS">
        <meta name="author" content="Dennis Ji">
      
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link rel="stylesheet" type="text/css" href="modal/css/bootstrap.min.css">
	   <script type="text/javascript" src="modal/js/jquery.min.js"></script>
	   <script type="text/javascript" src="modal/js/bootstrap.min.js"></script>
	   
	    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--<link id="base-style" href="css/style.css" rel="stylesheet">--->
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <!-- end: CSS -->
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->
        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->
        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->
    </head>
    <body>