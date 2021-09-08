<?php
	include_once("./header.php");
    for($i=0;$i<=100;$i++){
        $e_name="e_name".$i;
        $e_lname="e_lname".$i;
        $ps_id=1;
        $e_tel="e_tel".$i;
        $e_username="e_username".$i;
        $e_password="e_password".$i;
        
		echo $db->insert("cc_product","p_name","'{$e_name}'");
    }
?>