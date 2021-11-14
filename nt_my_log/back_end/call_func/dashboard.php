<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['title_of_use'])){ 
        $data_load;
        $l_department=json_decode($db->select("l_department"," l_department.d_name","WHERE 1 ORDER BY
        l_department.d_name asc")) ;
        foreach ($l_department as $key => $val) {

            $table="
            l_users
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
            
            ";
        $select="
            count(l_log.u_id) as num_title, 
            l_log.l_title,
            count(l_log_approve.u_id) as approved";
        $g_d_name=json_decode($db->select($table,$select,"WHERE l_users.u_id <> '1' && l_department.d_name='{$val->d_name}' GROUP BY l_log.l_title"), true);
        // $db->get_arr($g_d_name);
        $data_load[$key]=[
            "branch_name"=>$val->d_name,
            "data"=>$g_d_name
        ];
        }
        // $db->get_arr($data_load);
        echo json_encode($data_load);

	}
?>