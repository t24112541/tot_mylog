<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_status'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where s_name like '%{$_POST['filter']}%'";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		echo $db->select("cc_status","*",$option);
	}else if(isset($_POST['load_cc_status_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where s_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_status","*",$option);
	}else if(isset($_POST['cc_status_add'])){
		echo $db->insert("cc_status","s_name,s_des","'{$_POST['s_name']}','{$_POST['s_des']}'");
	}else if(isset($_POST['cc_status_update'])){
	    echo $db->update("cc_status","s_name='{$_POST['s_name']}',s_des='{$_POST['s_des']}'","s_id='{$_POST['s_id']}'");
	}else if(isset($_POST['cc_status_del'])){
		echo $db->delete("cc_status","s_id='{$_POST['s_id']}'");
	}else if(isset($_POST['set_pagination_cc_status'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where s_name like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("cc_status","*",$where)/$perpage);
		echo json_encode($total_page);
	}
?>