<?php
	include_once("./header.php");

	$perpage=10;

	if(isset($_POST['title_of_use'])){
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
            l_log_approve.u_id as approved";
        echo $db->select($table,$select,"WHERE l_users.u_id <> '1' GROUP BY l_log.l_title");

	}
?>