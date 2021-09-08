<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_product'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where cc_product.pv_id=cc_province.pv_id && cc_product.pv_id='{$_SESSION['pv_id']}' && p_name like '%{$_POST['filter']}%' || p_serial_number like '%{$_POST['filter']}%' limit {$start},{$perpage} ";
		}else{
			$option="where cc_product.pv_id=cc_province.pv_id && cc_product.pv_id='{$_SESSION['pv_id']}' limit {$start},{$perpage}";
		}
		
		echo $db->select("cc_product,cc_province","*",$option);
	}else if(isset($_POST['load_cc_product_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_product","*",$option);
	}else if(isset($_POST['cc_product_add'])){
		$fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_cc_product" && $value!="" && $key!="cc_product_add" && $key!="frm_mode"){
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
		echo $db->insert("cc_product",$fields_convert,$data_convert);
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add cc_product",$log_data); 

	}else if(isset($_POST['cc_product_update'])){
		$data="";
		$data_convert="";
		$update="";
		foreach ($_POST as $key => $value) {
			if($key!="cc_product_update" && $key!="p_id" && $key!="frm_cc_product" && $value!="" && $key!="frm_mode"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		echo $db->update("cc_product",$data_convert,"p_id='{$_POST['p_id']}'");
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit cc_product",$log_data); 

		
	}else if(isset($_POST['cc_product_del'])){	
		echo $db->delete("cc_product","p_id='{$_POST['p_id']}'");
		$db->log($_SESSION['name'],"remove cc_product","p_id='{$_POST['p_id']}'"); 

	}else if(isset($_POST['set_pagination_cc_product'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where  cc_product.pv_id=cc_province.pv_id && cc_product.pv_id='{$_SESSION['pv_id']}' && p_name like '%{$_POST['filter']}%' || p_serial_number like '%{$_POST['filter']}%'  ";
		}else{
			$where="where cc_product.pv_id=cc_province.pv_id && cc_product.pv_id='{$_SESSION['pv_id']}' ";
		}

		$total_page=ceil($db->count_rows("cc_product,cc_province","*",$where)/$perpage);
		$res=[
			"page"=>$total_page
		];
		echo json_encode($res);
	}
?>