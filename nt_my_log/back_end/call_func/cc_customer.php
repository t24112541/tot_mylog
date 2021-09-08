<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_customer'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where cc_customer.t_id=cc_type.t_id && cc_province.pv_id=cc_customer.pv_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && c_name like '%{$_POST['filter']}%' limit {$start},{$perpage} ";
		}else{
			$option="where cc_customer.t_id=cc_type.t_id && cc_province.pv_id=cc_customer.pv_id && cc_customer.pv_id='{$_SESSION['pv_id']}' limit {$start},{$perpage}";
		}
		
		echo $db->select("cc_customer,cc_type,cc_province","*",$option);
	}else if(isset($_POST['load_cc_customer_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where c_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_customer","*",$option);
	}else if(isset($_POST['cc_customer_add'])){
		$fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_cc_customer" && $value!="" && $key!="cc_customer_add" && $key!="frm_mode"){
				$fields.="$key,";
				$data.="\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($fields)-1;$i++){
			$fields_convert.= $fields[$i];
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		echo $db->insert("cc_customer",$fields_convert,$data_convert);
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add cc_customer",$log_data); 
	}else if(isset($_POST['cc_customer_update'])){
		$data="";
		$data_convert="";
		$update="";
		foreach ($_POST as $key => $value) {
			if($key!="cc_customer_update" && $key!="c_id" && $key!="frm_cc_customer" && $value!="" && $key!="frm_mode"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		echo $db->update("cc_customer",$data_convert,"c_id='{$_POST['c_id']}'");
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit cc_customer",$log_data); 
		
	}else if(isset($_POST['cc_customer_del'])){	
		$data=json_decode($db->delete("cc_customer","c_id='{$_POST['c_id']}'"));
		if($data->status){
			echo $db->delete("cc_equipment","c_id='{$_POST['c_id']}'");
			$db->log($_SESSION['name'],"remove cc_equipment","c_id='{$_POST['c_id']}'"); 

		}else{
			echo json_encode($data);
		}
		
	}else if(isset($_POST['set_pagination_cc_customer'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where cc_customer.t_id=cc_type.t_id && cc_province.pv_id=cc_customer.pv_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && c_name like '%{$_POST['filter']}%'  ";
		}else{
			$where="where cc_customer.t_id=cc_type.t_id && cc_province.pv_id=cc_customer.pv_id && cc_customer.pv_id='{$_SESSION['pv_id']}' ";
		}

		$total_page=ceil($db->count_rows("cc_customer,cc_type,cc_province","*",$where)/$perpage);
		$res=[
			"page"=>$total_page
		];
		echo json_encode($res);
	}
?>