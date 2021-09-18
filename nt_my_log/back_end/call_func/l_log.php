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
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where l_log.l_id=l_log_approve.l_id && l_log.l_id=l_log_files.l_id && l_title like '%{$_POST['filter']}%' ";
		}else{
			$option="where l_log.l_id=l_log_approve.l_id && l_log.l_id=l_log_files.l_id ORDER BY
            l_log.l_id DESC  limit {$start},{$perpage}";
		}
		echo $db->select("l_log,l_log_files,l_log_approve","*",$option);
    }else if(isset($_POST['load_l_log_title'])){
        $select="l_log.l_title";
		$option="GROUP BY l_log.l_title";
		echo $db->select("l_log",$select,$option);
	}
    else if(isset($_POST['l_log_add'])){

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
		for($i=0;$i<strlen($fields)-1;$i++){
			$fields_convert.= $fields[$i];
		}
		for($i=0;$i<strlen($data)-1;$i++){
			$data_convert.= $data[$i];
		}
        $res=json_decode($db->insert("l_log",$fields_convert,$data_convert));
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add l_log",$log_data); 
		if($res->status){

            $lf_files="";
            if(isset($_FILES) && $_FILES['lf_files']['name']!=''){
                $filename = "../../img/".date("yy-m-d_His").".jpg";
                if(move_uploaded_file($_FILES['lf_files']["tmp_name"], $filename)){
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
        

	}else if(isset($_POST['l_log_update'])){
	    echo $db->update("l_log","l_title='{$_POST['l_title']}',con_des='{$_POST['con_des']}'con_date='{$_POST['con_date']}'","con_id='{$_POST['con_id']}'");
		$db->log($_SESSION['name'],"edit l_log","con_id='{$_POST['con_id']}' l_title='{$_POST['l_title']}',con_des='{$_POST['con_des']}'con_date='{$_POST['con_date']}'"); 

	}else if(isset($_POST['l_log_del'])){
		echo $db->delete("l_log","con_id='{$_POST['con_id']}'");
		$db->log($_SESSION['name'],"remove l_log","con_id='{$_POST['con_id']}' "); 

	}else if(isset($_POST['set_pagination_l_log'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where l_title like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("l_log","*",$where)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($res);
	}else if(isset($_POST['break_even'])){
		$data['total_price']=[];
        $data['total_base']=[];
        $data['benefit']=[];

        $con_id=$_POST['con_id'];
        $table="cc_equipment,l_log";
        $select="(eq_price-(eq_price*(eq_discount/100))) AS total_pay";
        $option="where cc_equipment.con_id=l_log.con_id && l_log.con_id = {$con_id}";
        $data_total_pay=json_decode($db->select($table,$select,$option));

		$table="cc_equipment,l_log";
        $select="eq_base";
        $option="where cc_equipment.con_id=l_log.con_id && l_log.con_id = {$con_id}";
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