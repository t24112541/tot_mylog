<?php
	include_once("./header.php");

	$perpage=10;

	if($_SESSION['p_priority']==1){
		$sql_normal="
			where 
				l_users.p_id=l_position.p_id && 
				l_department.d_id=l_users.d_id && 
				l_province.pv_id=l_users.pv_id && 
				l_position.p_id=l_users.p_id && 
				l_users.pv_id='{$_SESSION['pv_id']}' && 
				l_users.u_id!='{$_SESSION['usr']}' && 
				l_users.d_id='{$_SESSION['d_id']}' 
		";
		$sql_search="
			where 
				l_users.p_id=l_position.p_id && 
				l_department.d_id=l_users.d_id && 
				l_province.pv_id=l_users.pv_id && 
				l_position.p_id=l_users.p_id && 
				l_users.pv_id='{$_SESSION['pv_id']}' && 
				l_users.u_id!='{$_SESSION['usr']}' && 
				l_users.d_id='{$_SESSION['d_id']}' &&
				u_fullname like '%{$_POST['filter']}%' 
		";
	}else if($_SESSION['p_priority']==0){
		$sql_normal="
			where 
				l_users.p_id=l_position.p_id && 
				l_department.d_id=l_users.d_id && 
				l_province.pv_id=l_users.pv_id && 
				l_position.p_id=l_users.p_id && 
				l_users.pv_id='{$_SESSION['pv_id']}' && 
				l_users.u_id!='{$_SESSION['usr']}' 
		";
		$sql_search="
			where 
				l_users.p_id=l_position.p_id && 
				l_department.d_id=l_users.d_id && 
				l_province.pv_id=l_users.pv_id && 
				l_position.p_id=l_users.p_id && 
				l_users.pv_id='{$_SESSION['pv_id']}' && 
				l_users.u_id!='{$_SESSION['usr']}' && 
				u_fullname like '%{$_POST['filter']}%'
		";
	}
		
	if(isset($_POST['load_l_users'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option=$sql_search."limit {$start},{$perpage}";
		}else{
			$option=$sql_normal."limit {$start},{$perpage}";
		}
		
		echo $db->select("l_users,l_position,l_province,l_department","*",$option);
	}else if(isset($_POST['load_u_name'])){
		$option="where u_id={$_SESSION['usr']} "; //&& l_users.p_id=l_position.p_id && l_province.pv_id=l_users.pv_id 
		echo $db->select("l_users","u_fullname,u_id,pv_id,d_id",$option); //,l_position,l_province

	}else if(isset($_POST['load_l_users_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where u_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("l_users","*",$option);
	}else if(isset($_POST['l_users_add'])){
		$chk=$db->count_rows("l_users","u_code","where u_code='{$_POST['u_code']}'");
		$fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_l_users" && $value!="" && $key!="l_users_add" && $key!="confirm_u_password" && $key!="frm_mode"){
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
			echo $db->insert("l_users",$fields_convert,$data_convert);
			$log_data=$data_convert;
			$db->log($_SESSION['name'],"add l_users",$log_data); 
		}else{
			$res=[
				"msg"=>"พบรหัสพนักงานเดียวกันในระบบ"
			];
			echo json_encode($res);
		}
	}else if(isset($_POST['l_users_update'])){
		$data="";
		$data_convert="";
		$update="";
		foreach ($_POST as $key => $value) {
			if($key!="p_id_usr" && $key!="pv_id_usr" && $key!="l_users_update" && $key!="u_password" && $key!="u_id" && $key!="frm_l_users" && $value!="" && $key!="l_users_add" && $key!="confirm_u_password" && $key!="frm_mode"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		// echo $data_convert;
		$data=json_decode($db->update("l_users",$data_convert,"u_id='{$_POST['u_id']}'"));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit l_users",$log_data); 
		if($data->status){
			if(isset($_POST['u_password']) && $_POST['u_password']!=""){
				$update="u_password='{$_POST['u_password']}'";
				echo $db->update("l_users",$update,"u_id='{$_POST['u_id']}'");
				$db->log($_SESSION['name'],"edit l_users",$update); 
			}else{
				echo json_encode($data);
			}
		}else{
			echo $data;
		}
		
	}else if(isset($_POST['l_users_del'])){

		if($_SESSION['usr']==$_POST['u_id']){
			$res=[
				"msg"=>"ไม่สามารถลบข้อมูลที่ใช้เข้าระบบได้"
			];
			echo json_encode($res);
		}else{
			echo $db->delete("l_users","u_id='{$_POST['u_id']}'");
			$db->log($_SESSION['name'],"remove l_users","u_id='{$_POST['u_id']}'"); 

		}
		
	}else if(isset($_POST['set_pagination_l_users'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option=$sql_search;
		}else{
			$option=$sql_normal;
		}

		$total_page=ceil($db->count_rows("l_users,l_position,l_province,l_department","*",$option)/$perpage);
		$res=[
			"page"=>$total_page
		];
		echo json_encode($res);
	}
?>