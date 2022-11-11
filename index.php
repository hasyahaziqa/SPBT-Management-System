<?php
session_start();

if (!isset($_SESSION['AUTHENTIFICATION'])) {
	$_SESSION['AUTHENTIFICATION'] = '-----';
}

if (isset($_SESSION['AUTHENTIFICATION'])) {
	
	
	
 	if ($_SESSION['AUTHENTIFICATION'] == 'admin') {
 		header('location: admin/index.php');
	}else if ($_SESSION['AUTHENTIFICATION'] == 'squad') {
    	include 'dashboard.php';
	}else {
		include 'login.php';
	}
}
?>
