<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_employee'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where cc_employee.ps_id=cc_position.ps_id && cc_province.pv_id=cc_employee.pv_id && cc_employee.pv_id='{$_SESSION['pv_id']}' && e_name like '%{$_POST['filter']}%' limit {$start},{$perpage} ";
		}else{
			$option="where cc_employee.ps_id=cc_position.ps_id && cc_province.pv_id=cc_employee.pv_id && cc_employee.pv_id='{$_SESSION['pv_id']}' limit {$start},{$perpage}";
		}
		
		echo $db->select("cc_employee,cc_position,cc_province","*",$option);
	}else if(isset($_POST['load_e_name'])){
		$option="where e_id={$_SESSION['usr']} && cc_employee.ps_id=cc_position.ps_id && cc_province.pv_id=cc_employee.pv_id ";
		echo $db->select("cc_employee,cc_position,cc_province","*",$option);

	}else if(isset($_POST['load_cc_employee_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where e_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_employee","*",$option);
	}else if(isset($_POST['cc_employee_add'])){
		$chk=$db->count_rows("cc_employee","e_username","where e_username='{$_POST['e_username']}'");

		$fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_cc_employee" && $value!="" && $key!="cc_employee_add" && $key!="confirm_e_password" && $key!="frm_mode"){
				$fields.="$key,";
				$data.="\"{$value}\",";
					// echo $key." ".$value."<br>";
			}
		}
		for($i=0;$i<strlen($fields)-1;$i++){
			$fields_convert.= $fields[$i];
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}

		if($chk==0){
			echo $db->insert("cc_employee",$fields_convert,$data_convert);
			$log_data=$data_convert;
			$db->log($_SESSION['name'],"add cc_employee",$log_data); 
		}else{
			$res=[
				"msg"=>"พบรหัสพนักงานเดียวกันในระบบ"
			];
			echo json_encode($res);
		}
	}else if(isset($_POST['cc_employee_update'])){
		$data="";
		$data_convert="";
		$update="";
		foreach ($_POST as $key => $value) {
			if($key!="ps_id_usr" && $key!="pv_id_usr" && $key!="cc_employee_update" && $key!="e_password" && $key!="e_id" && $key!="frm_cc_employee" && $value!="" && $key!="cc_employee_add" && $key!="confirm_e_password" && $key!="frm_mode"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		// echo $data_convert;
		$data=json_decode($db->update("cc_employee",$data_convert,"e_id='{$_POST['e_id']}'"));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit cc_employee",$log_data); 
		if($data->status){
			if(isset($_POST['e_password']) && $_POST['e_password']!=""){
				$update="e_password='{$_POST['e_password']}'";
				echo $db->update("cc_employee",$update,"e_id='{$_POST['e_id']}'");
				$db->log($_SESSION['name'],"edit cc_employee",$update); 
			}else{
				echo json_encode($data);
			}
		}else{
			echo $data;
		}
		
	}else if(isset($_POST['cc_employee_del'])){

		if($_SESSION['usr']==$_POST['e_id']){
			$res=[
				"msg"=>"ไม่สามารถลบข้อมูลที่ใช้เข้าระบบได้"
			];
			echo json_encode($res);
		}else{
			echo $db->delete("cc_employee","e_id='{$_POST['e_id']}'");
			$db->log($_SESSION['name'],"remove cc_employee","e_id='{$_POST['e_id']}'"); 

		}
		
	}else if(isset($_POST['set_pagination_cc_employee'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where cc_employee.ps_id=cc_position.ps_id && cc_province.pv_id=cc_employee.pv_id && e_name like '%{$_POST['filter']}%'  ";
		}else{
			$where="where cc_employee.ps_id=cc_position.ps_id && cc_province.pv_id=cc_employee.pv_id ";
		}

		$total_page=ceil($db->count_rows("cc_employee,cc_position,cc_province","*",$where)/$perpage);
		$res=[
			"page"=>$total_page
		];
		echo json_encode($res);
	}
?>