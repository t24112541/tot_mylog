<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['load_cc_contract'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where con_name like '%{$_POST['filter']}%'";
		}else{
			$option="where c_id='{$_POST['c_id']}' limit {$start},{$perpage}";
		}
		echo $db->select("cc_contract","*",$option);
	}else if(isset($_POST['load_cc_contract_detail'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where con_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("cc_contract","*",$option);
	}else if(isset($_POST['cc_contract_add'])){

        $fields="";
		$data="";

		$fields_convert="";
		$data_convert="";
		foreach ($_POST as $key => $value) {
			if($key!="frm_mode" && $value!="" && $key!="hidden"  && $key!="frm_cc_contract" && $key!="cc_contract_add"){
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
		echo $db->insert("cc_contract",$fields_convert,$data_convert);
		$log_data=$data_convert;
		$db->log($_SESSION['name'],"add cc_contract",$log_data); 

	}else if(isset($_POST['cc_contract_update'])){
	    echo $db->update("cc_contract","con_name='{$_POST['con_name']}',con_des='{$_POST['con_des']}'con_date='{$_POST['con_date']}'","con_id='{$_POST['con_id']}'");
		$db->log($_SESSION['name'],"edit cc_contract","con_id='{$_POST['con_id']}' con_name='{$_POST['con_name']}',con_des='{$_POST['con_des']}'con_date='{$_POST['con_date']}'"); 

	}else if(isset($_POST['cc_contract_del'])){
		echo $db->delete("cc_contract","con_id='{$_POST['con_id']}'");
		$db->log($_SESSION['name'],"remove cc_contract","con_id='{$_POST['con_id']}' "); 

	}else if(isset($_POST['set_pagination_cc_contract'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where con_name like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		$total_page=ceil($db->count_rows("cc_contract","*",$where)/$perpage);
        $res=[
            "page"=>$total_page
        ];
		echo json_encode($res);
	}else if(isset($_POST['break_even'])){
		$data['total_price']=[];
        $data['total_base']=[];
        $data['benefit']=[];

        $con_id=$_POST['con_id'];
        $table="cc_equipment,cc_contract";
        $select="(eq_price-(eq_price*(eq_discount/100))) AS total_pay";
        $option="where cc_equipment.con_id=cc_contract.con_id && cc_contract.con_id = {$con_id}";
        $data_total_pay=json_decode($db->select($table,$select,$option));

		$table="cc_equipment,cc_contract";
        $select="eq_base";
        $option="where cc_equipment.con_id=cc_contract.con_id && cc_contract.con_id = {$con_id}";
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