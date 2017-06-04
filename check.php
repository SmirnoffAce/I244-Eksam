<?php
if(!isset($_SESSION)){
	session_start();
}

if((!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) && $_SESSION['loginStatus'] != "L0G!N"){
	header("Location: index.php");
	die();
}


?>