<?php 
ob_start();
class controller{
	private $conn;
	function __construct($host,$user,$pass,$db){
		// error_reporting(0);
		$con=new mysqli($host,$user,$pass,$db);
		if(!$con){echo "connect error: ".$con->connect_error;}
		else{$con->set_charset("utf8");$this->conn=$con;date_default_timezone_set("Asia/Bangkok");}
	}
	function chk_session(){
		if(isset($_SESSION['u_id'])){
			$res=[
				"status"=>1,
			];
		}else{
			$res=[
				"status"=>0,
				"msg"=>"not login",
			];
		}
		return json_encode($res);
	}
	function chk_connect(){
		if($this->conn->connect_error){
			$res=[
				"status"=>0,
				"msg"=>"connect error: ".$this->conn->connect_error,
			];
		}else{
			$res=[
				"status"=>1
			];
		}
		return json_encode($res);
	}
	function login($user,$pass){
			$que=$this->conn->query("SELECT
				*,l_department.d_id as d_id
			FROM
				l_position
			INNER JOIN
				l_users
			ON 
				l_position.p_id = l_users.p_id
			INNER JOIN
				l_department
			ON 
				l_department.d_id = l_users.d_id
			INNER JOIN
				l_province
			ON 
				l_users.pv_id = l_province.pv_id
			where u_code='{$user}' && u_password='{$pass}' ");

			if($que->num_rows==1){
				$sh=$que->fetch_assoc();

				$res=[
					"status"=>1,
					"auth"=>1,
					"usr"=>$sh['u_id'],
					"name"=>$sh['u_fullname'],
					"pv_id"=>$sh['pv_id'],
					"p_priority"=>$sh['p_priority'],
					"d_id"=>$sh['d_id'],
				];
				
			}else{
				$res=[
					"status"=>0,
					"msg"=>"ไม่พบ username password ดังกล่าว"
				];
			}		
			// echo var_dump($res);
		return json_encode($res);
	}
	function regist($data){
		$field="";$i=0;$val="";

		foreach ($data as $key => $value) {
			$field.=$key;
			if($key=="u_password"){
				$val.="'".$this->re_encode($value)."'";
			}else{
				$val.="'".$value."'";
			}
			if($i!=count($data)-1){$field.=",";$val.=",";}
			$i++;
		}

		return $this->insert("l_users",$field,$val);
	}
	function insert($table,$field,$val){
		// echo "insert into $table ({$field}) values ({$val})";
		$que=$this->conn->query("insert into $table ({$field}) values ({$val})");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			];
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1,
				"last_id"=>$this->conn->insert_id
			];
		}return json_encode($res);

	}
	function update($table,$val,$where){
		// echo "update $table set $val where $where";

		$que=$this->conn->query("update $table set $val where $where");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			];
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1
			];
		}return json_encode($res);

	}
	function delete($table,$where){
		$que=$this->conn->query("delete from $table where $where");
		if(!$que){
			$res=[
				"msg"=>"error : ".$this->conn->error,
				"status"=>0
			]; 
		}else{
			$res=[
				"msg"=>"success",
				"status"=>1
			];
		}return json_encode($res);

	}
	function select($table,$select,$where){
		$data=[];
		// echo "select $select from $table $where"."end \n";
		$this->conn->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
		$que=$this->conn->query("select $select from $table $where");
		if($que->num_rows!=0){
			foreach ($que as $key => $value) {
				$data[$key]=$value;
			}
		}else{
			$data['msg']="null";
		}
		
		return json_encode($data);
	}
	function count_rows($table,$select,$where){
		// echo "select $select from $table $where";
		$que=$this->conn->query("select $select from $table $where");
		return $que->num_rows;
	}
	
	function get_arr($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	function log($who,$action,$what){
		$log=[];
		$data=json_decode(file_get_contents('../../log/log.json'));
		if(sizeof($data)>0){
			for($i=0;$i<sizeof($data);$i++){
				$log[$i]=[
					"date"=>$data[$i]->date,
					"who"=>$data[$i]->who,
					"action"=>$data[$i]->action,
					"what"=>$data[$i]->what
				];
			}
		}
		$log[sizeof($data)]=[
			"date"=>date("Y/m/d h:i:s"),
			"who"=>$who,
			"action"=>$action,
			"what"=>$what
		];
		$res=json_encode($log);
		file_put_contents('../../log/log.json',$res);
	}
	function get_log(){
		$data=json_decode(file_get_contents('../../log/log.json'));
		$arr=[];
		$len=0;
		for($i=sizeof($data)-1;$i>=0;$i--){
			$arr[$len]=[
				"date"=>$data[$i]->date,
				"who"=>$data[$i]->who,
				"action"=>$data[$i]->action,
				"what"=>$data[$i]->what
			];
			$len++;
		}
		return json_encode($arr);
	}
	function resize_image($file, $w, $h, $crop=FALSE) {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
		return $dst;
	}
	
}

?>