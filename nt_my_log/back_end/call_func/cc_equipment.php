<?php
	include_once("./header.php");

	$perpage=10;


	if(isset($_POST['load_cc_equipment_detail'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where cc_contract.con_id=cc_equipment.con_id && cc_equipment.con_id='{$_POST['con_id']}' && cc_type.t_id=cc_customer.t_id && cc_equipment.c_id=cc_customer.c_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && cc_equipment.p_id=cc_product.p_id && cc_customer.c_id = '{$_POST['filter']}' ";
		}else{
			$option="where cc_contract.con_id=cc_equipment.con_id && cc_equipment.con_id='{$_POST['con_id']}' && cc_type.t_id=cc_customer.t_id && cc_equipment.c_id=cc_customer.c_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && cc_equipment.p_id=cc_product.p_id  limit {$start},{$perpage}";
		}

		echo $db->select("cc_equipment,cc_customer,cc_product,cc_type,cc_contract","*",$option);
	}else if(isset($_POST['cc_equipment_add'])){
		$fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_cc_equipment" && $value!="" && $key!="cc_equipment_add" && $key!="frm_mode" && $key!="price_total"){
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
		$res=json_decode($db->insert("cc_equipment",$fields_convert,$data_convert));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add cc_equipment",$log_data); 
		if($res->status){
			$fields_cc_equip_status="s_id,eq_id,e_id";
			$data_cc_equip_status="1,{$res->last_id},{$_POST['e_id']}";
			echo $db->insert("cc_equip_status",$fields_cc_equip_status,$data_cc_equip_status);
			
		}else{
			echo json_encode($res);
		}
	}else if(isset($_POST['cc_equipment_update'])){

		$data_convert="eq_date_y='{$_POST['eq_date_y']}',eq_date_m='{$_POST['eq_date_m']}',eq_date_d='{$_POST['eq_date_d']}',eq_date_install='{$_POST['eq_date_install']}',eq_base='{$_POST['eq_base']}',eq_des='{$_POST['eq_des']}',eq_code='{$_POST['eq_code']}',eq_price='{$_POST['eq_price']}',eq_discount='{$_POST['eq_discount']}'";
		echo $db->update("cc_equipment",$data_convert,"eq_id='{$_POST['eq_id']}'");
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit cc_equipment",$log_data); 
	}else if(isset($_POST['cc_equipment_del'])){	
		echo $db->delete("cc_equipment","eq_id='{$_POST['eq_id']}'");
		$db->log($_SESSION['name'],"remove cc_equipment","eq_id='{$_POST['eq_id']}'"); 
	}else if(isset($_POST['set_pagination_cc_equipment'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where cc_equipment.c_id=cc_customer.c_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && cc_equipment.p_id=cc_product.p_id && c_id like '%{$_POST['filter']}%'  ";
		}else{
			$where="where cc_equipment.c_id=cc_customer.c_id && cc_customer.pv_id='{$_SESSION['pv_id']}' && cc_equipment.p_id=cc_product.p_id ";
		}

		$total_page=ceil($db->count_rows("cc_equipment,cc_customer,cc_product","*",$where)/$perpage);
		$res=[
			"page"=>$total_page
		];
		echo json_encode($res);
	}else if(isset($_POST['dashboard_cc_equipment']) || isset($_GET['dashboard_cc_equipment'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where cc_equipment.c_id=cc_customer.c_id && cc_equipment.p_id=cc_product.p_id && cc_customer.c_id = '{$_POST['filter']}' ";
		}else{
			$option="where cc_equipment.c_id=cc_customer.c_id && cc_equipment.p_id=cc_product.p_id ";
		}

		echo $db->select("cc_equipment,cc_customer,cc_product","cc_product.p_id,p_name,p_sell",$option);

		
	}
?>