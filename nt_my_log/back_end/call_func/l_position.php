<?php
	include_once("./header.php");

	$perpage=100;

	if(isset($_POST['load_l_position'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_id like '%{$_POST['filter']}%' || p_name like '%{$_POST['filter']}%' || p_des like '%{$_POST['filter']}%'";
		}else{
			$option="where p_priority>='{$_SESSION['p_priority']}' limit {$start},{$perpage}";
		}
		echo $db->select("l_position","*",$option);
	}else if(isset($_POST['load_l_position_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("l_position","*",$option);
	}else if(isset($_POST['l_position_add'])){
		echo $db->insert("l_position","p_name,p_des,p_priority","'{$_POST['p_name']}','{$_POST['p_des']}','{$_POST['p_priority']}'");
		$db->log($_SESSION['name'],"add l_position","p_id='{$_POST['p_id']}' ,p_name='{$_POST['p_name']}',p_des='{$_POST['p_des']}',p_priority='{$_POST['p_priority']}'"); 

	}else if(isset($_POST['l_position_update'])){
	    echo $db->update("l_position","p_name='{$_POST['p_name']}',p_des='{$_POST['p_des']}',p_priority='{$_POST['p_priority']}'","p_id='{$_POST['p_id']}'");
		$db->log($_SESSION['name'],"edit l_position","p_id='{$_POST['p_id']}' ,p_name='{$_POST['p_name']}',p_des='{$_POST['p_des']}',p_priority='{$_POST['p_priority']}'"); 

	}else if(isset($_POST['l_position_del'])){
		echo $db->delete("l_position","p_id='{$_POST['p_id']}'");
		$db->log($_SESSION['name'],"remove l_position","p_id='{$_POST['p_id']}'"); 

	}else if(isset($_POST['set_pagination_l_position'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where l_position = '{$_POST['filter']}' || p_name like '%{$_POST['filter']}%' || p_des like '%{$_POST['filter']}%' ";
		}else{
			$where="where p_priority>='{$_SESSION['p_priority']}' ";
		}

		$total_page=ceil($db->count_rows("l_position","*",$where)/$perpage);
		echo json_encode($total_page);
	}
?>