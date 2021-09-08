<?php 
    include_once("./header.php");
    if(isset($_POST['login'])){
		$data= $db->login($_POST['e_username'],$_POST['e_password']);
		echo $data;

		$obj2=json_decode($data);
		foreach ($obj2 as $key => $val ){   
		  $_SESSION[$key]=$val;

		}
		

	}else if(isset($_POST['chk_login']) || isset($_GET['chk_login'])){
		echo $_SESSION['status'];
		echo $_SESSION['auth']."<br>";
		echo $_SESSION['usr'];
	}
?>