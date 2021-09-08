<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_province'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where pv_id like '%{$_POST['filter']}%' || pv_name like '%{$_POST['filter']}%' || pv_des like '%{$_POST['filter']}%'";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		echo $db->select("cc_province","*",$option);
	}else if(isset($_POST['load_cc_province_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where pv_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_province","*",$option);
	}else if(isset($_POST['cc_province_add'])){
		echo $db->insert("cc_province","pv_id,pv_name,pv_des","'{$_POST['pv_id']}','{$_POST['pv_name']}','{$_POST['pv_des']}'");
		$db->log($_SESSION['name'],"add cc_province","pv_id='{$_POST['pv_id']}',pv_name='{$_POST['pv_name']}',pv_des='{$_POST['pv_des']}'"); 
	}else if(isset($_POST['cc_province_update'])){
	    echo $db->update("cc_province","pv_name='{$_POST['pv_name']}',pv_des='{$_POST['pv_des']}'","pv_id='{$_POST['pv_id']}'");
		$db->log($_SESSION['name'],"edit cc_province","pv_id='{$_POST['pv_id']}' pv_name='{$_POST['pv_name']}',pv_des='{$_POST['pv_des']}'"); 

	}else if(isset($_POST['cc_province_del'])){
		echo $db->delete("cc_province","pv_id='{$_POST['pv_id']}'");
		$db->log($_SESSION['name'],"remove cc_province","pv_id='{$_POST['pv_id']}'"); 

	}else if(isset($_POST['set_pagination_cc_province'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where pv_id = '{$_POST['filter']}' || pv_name like '%{$_POST['filter']}%' || pv_des like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("cc_province","*",$where)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($total_page);
	}
?>