<?php
	include_once("./header.php");

    if(isset($_GET['get_log']) || isset($_POST['get_log'])){
		echo $db->get_log();
	}
?>