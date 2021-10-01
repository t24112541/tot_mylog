<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['priority_check'])){
		echo json_decode($_SESSION['p_priority']);
	}
?>