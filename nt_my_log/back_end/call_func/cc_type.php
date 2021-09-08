<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_type'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where t_id like '%{$_POST['filter']}%' || t_name like '%{$_POST['filter']}%' || t_des like '%{$_POST['filter']}%'";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		echo $db->select("cc_type","*",$option);
	}else if(isset($_POST['load_cc_type_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where t_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_type","*",$option);
	}else if(isset($_POST['cc_type_add'])){
		echo $db->insert("cc_type","t_name,t_des","'{$_POST['t_name']}','{$_POST['t_des']}'");
		$db->log($_SESSION['name'],"add cc_type","t_id='{$_POST['t_id']}' ,t_name='{$_POST['t_name']}',t_des='{$_POST['t_des']}'"); 

	}else if(isset($_POST['cc_type_update'])){
	    echo $db->update("cc_type","t_name='{$_POST['t_name']}',t_des='{$_POST['t_des']}'","t_id='{$_POST['t_id']}'");
		$db->log($_SESSION['name'],"edit cc_type","t_id='{$_POST['t_id']}' ,t_name='{$_POST['t_name']}',t_des='{$_POST['t_des']}'"); 

	}else if(isset($_POST['cc_type_del'])){
		echo $db->delete("cc_type","t_id='{$_POST['t_id']}'");
		$db->log($_SESSION['name'],"remove cc_type","t_id='{$_POST['t_id']}'"); 

	}else if(isset($_POST['set_pagination_cc_type'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where t_cc_type = '{$_POST['filter']}' || t_name like '%{$_POST['filter']}%' || t_des like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("cc_type","*",$where)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($total_page);
	}
?>