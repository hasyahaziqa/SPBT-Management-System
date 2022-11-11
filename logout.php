<?php 
	session_start();
	include 'db.php';
	if (isset($_SESSION['AUTHENTIFICATION'])) {
		if ($_SESSION['AUTHENTIFICATION'] !== '-----') {
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			foreach ($_USER as $key => $value) {
				unset($_USER[$key]);
			}
			session_destroy();
			header('location: index.php');
		}else {header('location: login.php');}
	}else {header('location: login.php');}
