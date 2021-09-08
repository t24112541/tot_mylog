<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['market_share'])){
		
		// $option="where t_id like '%{$_POST['filter']}%' || t_name like '%{$_POST['filter']}%' || t_des like '%{$_POST['filter']}%'";
		
		$table="cc_equipment INNER JOIN cc_product ON      cc_equipment.p_id = cc_product.p_id INNER JOIN cc_customer ON      cc_customer.c_id = cc_equipment.c_id GROUP BY cc_product.p_id";
        $select="cc_product.p_id, cc_product.p_name, count(cc_product.p_id) as use_num ,sum(eq_price-(eq_price*(eq_discount/100))) as total";
        echo $db->select($table,$select,"");

	}else if(isset($_POST['income_per_m'])){
        $table="cc_equipment";
        $select="sum(eq_price-(eq_price*(eq_discount/100))) as total";
        echo $db->select($table,$select,"");
    }else if(isset($_POST['total_as_base'])){
        $table="cc_equipment";
        $select="sum(eq_base) as total";
        echo $db->select($table,$select,"");
    }else if(isset($_POST['income_of_year']) || isset($_GET['income_of_year'])){
        $data['total_price']=[];
        $data['total_base']=[];
        $data['benefit']=[];

        $y_now=date("Y");
        $table="cc_equipment";
        $select="eq_date_m";
        $option="cc_equipment where   eq_date_y = {$y_now} GROUP BY cc_equipment.eq_date_m ";
        $data_1=json_decode($db->select($table,$select,$option));
        foreach ($data_1 as $key => $val ){ 
            $if[$key]=$val->eq_date_m;
        }
        for($i=0;$i<=12;$i++){$total_price[$i]=0;$base[$i]=0;$benefit[$i]=0;}
        
        for($i=0;$i<sizeof($if);$i++){
            $table="cc_equipment";
            $select="(eq_price-(eq_price*(eq_discount/100))) as total,eq_base";
            $option="where eq_date_m={$if[$i]}";
            $data_2=json_decode($db->select($table,$select,$option));
            foreach ($data_2 as $key => $val ){ 
                $total_price[(int)$if[$i]-1]+=$val->total;
                $base[(int)$if[$i]-1]+=$val->eq_base;
            }
        }
        $total=0;
        $base_tt=0;
        $benefit_tt=0;
        $dt[]=0;
        foreach ($total_price as $key => $val ){ 
            $total_price[$key]+=$total;
            $total+=$val;
        } 
        foreach ($base as $key => $val ){ 
            $base[$key]+=$base_tt;
            $base_tt+=$val;
            $benefit_tt+=($val-$total_price[$key]);
            if($benefit_tt>=0){
                $benefit[$key]+=$benefit_tt;

            }
            
        } 
        // $db->get_arr($benefit);

        $data['total_base']=$base;
        $data['total_price']=$total_price;
        $data['benefit']=$benefit;
        echo json_encode($data);
        
    }else if(isset($_POST['income_donut']) || isset($_GET['income_donut'])){
        $data['lbl_name']=[];
        $data['val']=[];
        $l=0;
        $n=0;
        $table="cc_equipment INNER JOIN cc_product ON      cc_equipment.p_id = cc_product.p_id INNER JOIN cc_customer ON      cc_customer.c_id = cc_equipment.c_id GROUP BY cc_product.p_id";
        $select="cc_product.p_id,p_name";
        $option="";
        $data_1=json_decode($db->select($table,$select,$option));
        foreach ($data_1 as $key => $val ){ 
            array_push($data['lbl_name'],$val->p_name);
            // $data['lbl_name']=array($val->p_name);
            $table="cc_equipment";
            $select="sum(eq_price-(eq_price*(eq_discount/100))) as total";
            $option="where    p_id={$val->p_id}";
            $data_2=json_decode($db->select($table,$select,$option));

            foreach ($data_2 as $key => $val ){ 
                $total_as_list[$l]=$val->total;
                array_push($data['val'],$total_as_list[$l]);

                $l++;
            }
        }
        echo json_encode($data);
    }else if(isset($_POST['income_5_y']) || isset($_GET['income_5_y'])){
        $data['lbl_name']=[];
        $data['val']=[];
        $y_now=date("Y");
        for($i=0;$i<5;$i++){
            $total_price_5y[$i]=0;
        }
        $round=0;
        for($i=$y_now-4;$i<=$y_now;$i++){
            if($y_now-$i==4){$ind=0;}
            else if($y_now-$i==3){$ind=1;}
            else if($y_now-$i==2){$ind=2;}
            else if($y_now-$i==1){$ind=3;}
            else if($y_now-$i==0){$ind=4;}
            // echo $y_now."-".$i."=".($ind)."<br>";
            // $years[$round]=$i;
            array_push($data['lbl_name'],$years[$round]=$i);
            $table="cc_equipment";
            $select="(eq_price-(eq_price*(eq_discount/100))) as total";
            $option="where eq_date_y={$i}";
            $data_1=json_decode($db->select($table,$select,$option));
            // echo "<pre>";
            // var_dump($data_1);
            // echo "</pre>";
            
            foreach ($data_1 as $key => $val ){ 
                $total_price_5y[$ind]+=$val->total; 
            }
            array_push($data['val'], $total_price_5y[$ind]);
            $round++;
        }
        echo json_encode($data);
        
    }
?>