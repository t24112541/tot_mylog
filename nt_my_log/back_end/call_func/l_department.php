<?php
	include_once("./header.php");

	$perpage=10;
    $search="where  d_name like '%{$_POST['filter']}%' || d_des like '%{$_POST['filter']}%'";
	if(isset($_POST['load_l_department'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option=$search;
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		echo $db->select("l_department","*",$option);
	}else if(isset($_POST['load_l_department_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where d_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("l_department","*",$option);
	}else if(isset($_POST['l_department_add'])){
		echo $db->insert("l_department","d_name,d_des","'{$_POST['d_name']}','{$_POST['d_des']}'");
		$db->log($_SESSION['name'],"add l_department","d_id='{$_POST['d_id']}' ,d_name='{$_POST['d_name']}',d_des='{$_POST['d_des']}'"); 

	}else if(isset($_POST['l_department_update'])){
	    echo $db->update("l_department","d_name='{$_POST['d_name']}',d_des='{$_POST['d_des']}'","d_id='{$_POST['d_id']}'");
		$db->log($_SESSION['name'],"edit l_department","d_id='{$_POST['d_id']}' ,d_name='{$_POST['d_name']}',d_des='{$_POST['d_des']}'"); 

	}else if(isset($_POST['l_department_del'])){
		echo $db->delete("l_department","d_id='{$_POST['d_id']}'");
		$db->log($_SESSION['name'],"remove l_department","d_id='{$_POST['d_id']}'"); 

	}else if(isset($_POST['set_pagination_l_department'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where=$search;
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("l_department","*",$where)/$perpage);
		echo json_encode($total_page);
	}
?>