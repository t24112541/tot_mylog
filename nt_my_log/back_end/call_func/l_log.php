<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_l_log'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;

		$option="
			INNER JOIN
				l_log
			ON 
				l_users.u_id = l_log.u_id
			INNER JOIN
				l_log_approve
			ON 
				l_log.l_id = l_log_approve.l_id
			INNER JOIN
				l_log_files
			ON 
				l_log.l_id = l_log_files.l_id
			INNER JOIN
				l_position
			ON 
				l_users.p_id = l_position.p_id
			INNER JOIN
				l_province
			ON 
				l_users.pv_id = l_province.pv_id
			INNER JOIN
				l_department
			ON 
				l_users.d_id = l_department.d_id
			where l_users.u_id={$_SESSION['usr']}";
		if(isset($_POST['filter']) && $_POST['filter']!=""){	
			$option.=" && (l_date like '{$_POST['filter']}%' || d_name like '%{$_POST['filter']}%' || l_title like '%{$_POST['filter']}%' || u_fullname like '%{$_POST['filter']}%') ";
		}else if(isset($_POST['mode_data']) && $_POST['mode_data']!=""){
			if($_POST['mode_data']==1){
				$option.=" && l_log_approve.u_id IS NULL ";
			}else{
				$option.=" && l_log_approve.u_id!='' ";
			}
		}
		$option.=" ORDER BY l_log.l_id DESC  limit {$start},{$perpage}";
		
		echo $db->select("l_users","
							l_department.d_name, 
							l_province.pv_name, 
							l_log_files.lf_file, 
							l_log_files.lf_id, 
							l_position.p_name, 
							l_position.p_priority, 
							l_position.p_des, 
							l_log_approve.la_date, 
							l_log_approve.u_id as a_u_id, 
							l_log_approve.la_comment, 
							l_log.l_date,
							l_log.l_id, 
							l_log.l_detail, 
							l_log.l_title, 
							l_users.u_fullname, 
							l_users.u_tel",$option);
    }else if(isset($_POST['load_l_log_employee'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		$option="
			INNER JOIN
				l_log
			ON 
				l_users.u_id = l_log.u_id
			INNER JOIN
				l_log_approve
			ON 
				l_log.l_id = l_log_approve.l_id
			INNER JOIN
				l_log_files
			ON 
				l_log.l_id = l_log_files.l_id
			INNER JOIN
				l_position
			ON 
				l_users.p_id = l_position.p_id
			INNER JOIN
				l_province
			ON 
				l_users.pv_id = l_province.pv_id
			INNER JOIN
				l_department
			ON 
				l_users.d_id = l_department.d_id
			where p_priority>'{$_SESSION['p_priority']}'";
		if(isset($_POST['filter']) && $_POST['filter']!=""){	
			$option.=" && (l_date like '{$_POST['filter']}%' || d_name like '%{$_POST['filter']}%' || l_title like '%{$_POST['filter']}%' || u_fullname like '%{$_POST['filter']}%') ";
		}else if(isset($_POST['mode_data']) && $_POST['mode_data']!=""){
			if($_POST['mode_data']==1){
				$option.=" && l_log_approve.u_id IS NULL ";
			}else{
				$option.=" && l_log_approve.u_id!='' ";
			}
		}
		$option.=" ORDER BY l_log.l_id DESC  limit {$start},{$perpage}";
		
		echo $db->select("l_users","
							l_department.d_name, 
							l_province.pv_name, 
							l_log_files.lf_file, 
							l_position.p_name, 
							l_position.p_priority, 
							l_position.p_des, 
							l_log_approve.la_date, 
							l_log_approve.u_id, 
							l_log_approve.la_comment, 
							l_log.l_date,
							l_log.l_id, 
							l_log.l_detail, 
							l_log.l_title, 
							l_users.u_fullname, 
							l_users.u_tel",$option);
	}
	else if(isset($_POST['set_pagination_l_log_employee'])){
		$option="
			INNER JOIN
				l_log
			ON 
				l_users.u_id = l_log.u_id
			INNER JOIN
				l_log_approve
			ON 
				l_log.l_id = l_log_approve.l_id
			INNER JOIN
				l_log_files
			ON 
				l_log.l_id = l_log_files.l_id
			INNER JOIN
				l_position
			ON 
				l_users.p_id = l_position.p_id
			INNER JOIN
				l_province
			ON 
				l_users.pv_id = l_province.pv_id
			INNER JOIN
				l_department
			ON 
				l_users.d_id = l_department.d_id
			where p_priority>'{$_SESSION['p_priority']}'";
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option.=" && (l_title like '%{$_POST['filter']}%' || u_fullname like '%{$_POST['filter']}%') ";
		}else{
			$option.=" ";
		}
		$total_page=ceil($db->count_rows("l_users","l_log.l_id",$option)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($res);
    }else if(isset($_POST['load_l_log_title'])){
        $select="l_log.l_title";
		$option="
			INNER JOIN
				l_users
			ON 
				l_log.u_id = l_users.u_id
			INNER JOIN
				l_department
			ON 
				l_department.d_id = l_users.d_id
			where l_department.d_id='{$_SESSION['d_id']}'
			GROUP BY l_log.l_title";
		echo $db->select("l_log",$select,$option);
	}else if(isset($_POST['l_log_add'])){
        $fields="";
		$data="";
		$fields_convert="";
        $data_convert="";
		foreach ($_POST as $key => $value) {
            if($key!="frm_mode" && $value!="" && $key!="hidden"  && $key!="frm_l_log" && $key!="l_log_add" && $key!="lf_file"){
				$fields.="$key,";
                $data.="\"{$value}\",";
			}
        }
		// for($i=0;$i<strlen($fields)-1;$i++){
			$fields_convert= $fields;
		// }
		// for($i=0;$i<strlen($data)-1;$i++){
			$data_convert= $data;
		// }
		$fields_convert.="u_id";
		$data_convert.=$_SESSION['usr'];
        $res=json_decode($db->insert("l_log",$fields_convert,$data_convert));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add l_log",$log_data); 
		if($res->status){

            $lf_files="";
            if(isset($_FILES) && $_FILES['lf_file']['name']!=''){

				$filename = "../../img/".date("Y-m-d_His").".jpg";
				// $db->get_arr($_FILES['lf_file']);
                if(move_uploaded_file($_FILES['lf_file']["tmp_name"], $filename)){
					$lf_files=$filename;
                }
            }
    
			$fields_l_log_files="l_id,lf_file";
			$data_l_log_files="{$res->last_id},'{$lf_files}'";
            $db->insert("l_log_files",$fields_l_log_files,$data_l_log_files);
            
            $fields_l_log_approve="l_id";
			$data_l_log_approve="{$res->last_id}";
			echo $db->insert("l_log_approve",$fields_l_log_approve,$data_l_log_approve);
			
		}else{
			echo json_encode($res);
        }
        
		
	}else if(isset($_POST['l_log_approve_update'])){
	    $data="";
		$data_convert="u_id='{$_SESSION['usr']}',";
		$update="";
		foreach ($_POST as $key => $value) {
            if($key!="frm_mode" && $value!="" && $key!="hidden"  && $key!="frm_l_log" && $key!="l_log_approve_update" && $key!="lf_files" && $key!="hidd_lf_file" && $key!="lf_id"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		// echo $data_convert;
		$data=json_decode($db->update("l_log_approve",$data_convert,"l_id='{$_POST['l_id']}'"));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit l_log",$log_data); 
		if($data->status){
			
			$lf_files=$_POST['hidd_lf_file'];
			if(isset($_FILES) && $_FILES['lf_file']['name']!=''){
				// $filename = resize_image("../../img/".date("Y-m-d_His").".jpg", 200, 200);
				$filename = "../../img/".date("Y-m-d_His").".jpg";
				// $db->get_arr($_FILES['lf_file']);
                if(move_uploaded_file($_FILES['lf_file']["tmp_name"], $filename)){
					$lf_files=$filename;
                }
            }
			$fields_l_log_files="lf_file='{$lf_files}'";
			echo $db->update("l_log_files",$fields_l_log_files,"lf_id='{$_POST['lf_id']}'");
		}else{
			echo json_encode($data);
		}
	}else if(isset($_POST['l_log_update'])){
	    $data="";
		$data_convert="";
		$update="";
		foreach ($_POST as $key => $value) {
            if($key!="frm_mode" && $value!="" && $key!="hidden"  && $key!="frm_l_log" && $key!="l_log_update" && $key!="lf_files" && $key!="hidd_lf_file" && $key!="lf_id"){
				$data.="$key=\"{$value}\",";
			}
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
		// echo $data_convert;
		$data=json_decode($db->update("l_log",$data_convert,"l_id='{$_POST['l_id']}'"));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"edit l_log",$log_data); 
		if($data->status){
			
			$lf_files=$_POST['hidd_lf_file'];
			if(isset($_FILES) && $_FILES['lf_file']['name']!=''){
				// $filename = resize_image("../../img/".date("Y-m-d_His").".jpg", 200, 200);
				$filename = "../../img/".date("Y-m-d_His").".jpg";
				// $db->get_arr($_FILES['lf_file']);
                if(move_uploaded_file($_FILES['lf_file']["tmp_name"], $filename)){
					$lf_files=$filename;
                }
            }
			$fields_l_log_files="lf_file='{$lf_files}'";
			echo $db->update("l_log_files",$fields_l_log_files,"lf_id='{$_POST['lf_id']}'");
		}else{
			echo json_encode($data);
		}
	}else if(isset($_POST['l_log_del'])){
		echo $db->delete("l_log","l_id='{$_POST['l_id']}'");
		$db->log($_SESSION['name'],"remove l_log","l_id='{$_POST['l_id']}' "); 

	}else if(isset($_POST['set_pagination_l_log'])){

		$option="
			INNER JOIN
				l_log
			ON 
				l_users.u_id = l_log.u_id
			INNER JOIN
				l_log_approve
			ON 
				l_log.l_id = l_log_approve.l_id
			INNER JOIN
				l_log_files
			ON 
				l_log.l_id = l_log_files.l_id
			INNER JOIN
				l_position
			ON 
				l_users.p_id = l_position.p_id
			INNER JOIN
				l_province
			ON 
				l_users.pv_id = l_province.pv_id
			INNER JOIN
				l_department
			ON 
				l_users.d_id = l_department.d_id
			where l_users.u_id={$_SESSION['usr']}";
		if(isset($_POST['filter']) && $_POST['filter']!=""){	
			$option.=" && (l_date like '{$_POST['filter']}%' || d_name like '%{$_POST['filter']}%' || l_title like '%{$_POST['filter']}%' || u_fullname like '%{$_POST['filter']}%') ";
		}else if(isset($_POST['mode_data']) && $_POST['mode_data']!=""){
			if($_POST['mode_data']==1){
				$option.=" && l_log_approve.u_id IS NULL ";
			}else{
				$option.=" && l_log_approve.u_id!='' ";
			}
		}
		
		$total_page=ceil($db->count_rows("l_users","*",$option)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($res);
	}else if(isset($_POST['break_even'])){
		$data['total_price']=[];
        $data['total_base']=[];
        $data['benefit']=[];

        $l_id=$_POST['l_id'];
        $table="cc_equipment,l_log";
        $select="(eq_price-(eq_price*(eq_discount/100))) AS total_pay";
        $option="where cc_equipment.l_id=l_log.l_id && l_log.l_id = {$l_id}";
        $data_total_pay=json_decode($db->select($table,$select,$option));

		$table="cc_equipment,l_log";
        $select="eq_base";
        $option="where cc_equipment.l_id=l_log.l_id && l_log.l_id = {$l_id}";
        $data_eq_base=json_decode($db->select($table,$select,$option));

		$sum_money=0;
		$sum_base=0;
		if($data_total_pay->msg!=" null" ){
			foreach ($data_total_pay as $key => $val ){ 
				$sum_money+=$val->total_pay;
			}
			foreach ($data_eq_base as $key => $val ){ 
				$sum_base+=$val->eq_base;
			}
		}
		$row=0;
		$break_even=[];
		for($i=0;$i<12;$i++){$break_even[$i]=0;}
		if($sum_base!=0){
			for($base=$sum_base;$base>=0;$base-=$sum_money){
				$break_even[$row]=$base;
				$row++;
			}
		}
		$res=[
            "sum_base"=>$sum_base,
			"sum_money"=>$sum_money,
			"break_even"=>$break_even
        ];
        echo json_encode($res);
	}
?>