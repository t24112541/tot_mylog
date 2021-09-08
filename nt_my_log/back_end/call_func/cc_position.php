<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_position'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where ps_id like '%{$_POST['filter']}%' || ps_name like '%{$_POST['filter']}%' || ps_des like '%{$_POST['filter']}%'";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		echo $db->select("cc_position","*",$option);
	}else if(isset($_POST['load_cc_position_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where ps_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_position","*",$option);
	}else if(isset($_POST['cc_position_add'])){
		echo $db->insert("cc_position","ps_name,ps_des","'{$_POST['ps_name']}','{$_POST['ps_des']}'");
		$db->log($_SESSION['name'],"add cc_position","ps_id='{$_POST['ps_id']}' ,ps_name='{$_POST['ps_name']}',ps_des='{$_POST['ps_des']}'"); 

	}else if(isset($_POST['cc_position_update'])){
	    echo $db->update("cc_position","ps_name='{$_POST['ps_name']}',ps_des='{$_POST['ps_des']}'","ps_id='{$_POST['ps_id']}'");
		$db->log($_SESSION['name'],"edit cc_position","ps_id='{$_POST['ps_id']}' ,ps_name='{$_POST['ps_name']}',ps_des='{$_POST['ps_des']}'"); 

	}else if(isset($_POST['cc_position_del'])){
		echo $db->delete("cc_position","ps_id='{$_POST['ps_id']}'");
		$db->log($_SESSION['name'],"remove cc_position","ps_id='{$_POST['ps_id']}'"); 

	}else if(isset($_POST['set_pagination_cc_position'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where t_cc_position = '{$_POST['filter']}' || ps_name like '%{$_POST['filter']}%' || ps_des like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("cc_position","*",$where)/$perpage);
		echo json_encode($total_page);
	}
?>