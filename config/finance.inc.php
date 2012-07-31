<?PHP
    require_once(INCLUDE_PATH.'db.inc.php');
    require_once(INCLUDE_PATH.'language_CN.php');

/*
	返回值说明：0 成功 ， 非0值 失败
		1		用户不存在。
	    2		登录用户有存在，密码验证失败。



	函数说明：
		login()		判断登录是否成功。
*/

    class Finance extends DBSQL
    {
        /* 定义表名称变量*/
        public $_in_corde = 'in_corde';
        public $_out_corde = 'out_corde';
        public $_in_mantype = 'in_mantype';
        public $_in_subtype = 'in_subtype';
        public $_out_mantype = 'out_mantype';
        public $_out_subtype = 'out_subtype';
        public $_users = 'users';
        public $_groups = 'groups';
        public $_user_group = 'user_group';
        public $_log_resolve = 'log_resolve';
        public $_address = 'address';
		public $_log = 'log';


        public $_pagesize = 10;
        public $_is_display = array("0"=>"禁用",
            "1"=>"启用");

        /*  连接数据库函数 */
        public function _construct()
        {
            parent::_construct();
        }
        

         /* 用户登录验证函数 */
        public function login($username,$password)
        {
             $sql = "SELECT * FROM ".$this->_users." WHERE username = '".$username."'";
			 $sql2 = "SELECT * FROM ".$this->_users." WHERE username = '".$username."' AND password = password( '".$password."')";

             if( $result =  $this->select($sql))
            {
				if ($this->select($sql2)){
					return $result;
				}else{
					return 2;
				}

             } else {                
				return 1;
			}
		}

         /*更新用户会话ID与最后登录时间函数 */
        public function refurbishUserSession($user_id)
        {
            $sql = "UPDATE users SET last_date = '".date("Y-m-d H:i:s")."' , session = '".session_id()."' WHERE id = '".$user_id."'";
            return $this->update($sql);
        }

        /* 转换LOG_ID为日志内容函数 */
        public function convertLogIdToContent($log_id)
        {
            $sql = "SELECT content FROM  ".$this->_log_resolve." WHERE log_id = '".$log_id."'";        
            if ($result = $this->select($sql)) {
				return $result;
			} else {
				return	false;
			}
        }




       /* 获取收入\支出数据函数 */
        public function getCordeData($group_id,$in_out,$date,$is_user=0,$Aid=0)
        {
            
			if ( $in_out == "out_record" ){
				$sql = $is_user ? "SELECT * FROM  ".$this->_out_corde." WHERE create_date like '".$date."%' AND user_id = '".$user_id."' ORDER BY  create_date desc": $Aid ? "SELECT * FROM  ".$this->_out_corde." WHERE id = '".$Aid."'":"SELECT * FROM  ".$this->_out_corde." WHERE create_date like '".$date."%' AND group_id = '".$group_id."' ORDER BY  create_date desc";
			} else if ( $in_out == "in_record" ) {
				$sql = $is_user ? "SELECT * FROM  ".$this->_in_corde." WHERE create_date like '".$date."%' AND user_id = '".$user_id."' ORDER BY  create_date desc": $Aid ? "SELECT * FROM  ".$this->_in_corde." WHERE id = '".$Aid."'":"SELECT * FROM  ".$this->_in_corde." WHERE create_date like '".$date."%' AND group_id = '".$group_id."' ORDER BY  create_date desc";
			}

			$result = $this->select($sql);

            return $result;
        }

       /* 添加收入\支出数据函数 "out",$user_id,$group_id,$mantype_id,$subtype_id,$address,$menoy,$notes */
        public function addCordeData($in_out,$user_id,$group_id,$mantype_id,$subtype_id,$address,$money,$notes)
        {
            
			switch($in_out){
				case "out_record":
					$sql = "INSERT INTO ".$this->_out_corde."  VALUES ('','".$money."','".$user_id."','".$group_id."','".$mantype_id."','".$subtype_id."','".$address."','".$notes."','".date("Y-m-d H:i:s")."')";
					break;
				case "in_record":
					$sql = "INSERT INTO ".$this->_in_corde."  VALUES ('','".$money."','".$user_id."','".$group_id."','".$mantype_id."','".$subtype_id."','".$address."','".$notes."','".date("Y-m-d H:i:s")."')";
					break;
			}

            return $this->insert($sql);
        }

		/*更新收入/支出记录函数 */
        public function updateCordeData($in_out,$Aid,$user_id,$group_id,$mantype_id,$subtype_id,$address,$money,$notes)
        {
			switch($in_out){
				case "out_record":
					$sql = "UPDATE ".$this->_out_corde." SET money = '".$money."',mantype_id = '".$mantype_id."',subtype_id = '".$subtype_id."',addr_id = '".$address."', notes = '".$notes."'  WHERE id = '".$Aid."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_out_corde."  WHERE id = '".$Aid."' AND user_id = '".$user_id."'";
					break;
				case "in_record":
					$sql = "UPDATE ".$this->_in_corde." SET money = '".$money."',mantype_id = '".$mantype_id."',subtype_id = '".$subtype_id."',addr_id = '".$address."', notes = '".$notes."'  WHERE id = '".$Aid."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_in_corde."  WHERE id = '".$Aid."' AND user_id = '".$user_id."'";
					break;
			}

			/* 记录修改前的资料 START */
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_out_corde." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }

		/* 添加收入\支出类别 */
		public function addTypeData($in_out,$user_id,$typename,$is_display=1,$man_id=0){
			switch($in_out){
				case "out_mantype"||"out_subtype":
					$man_store = $this->select("select max(store) from out_mantype");
					$sub_store = $this->select("select max(store) from out_subtype WHERE man_id = '".$man_id."'");

					$sql =($man_id) ? "INSERT INTO ".$this->_out_subtype ."  VALUES ('','".$user_id."','".$man_id."','".($sub_store['0']['0']+1)."','".$is_display."','".$typename."','".date("Y-m-d H:i:s")."')":"INSERT INTO ".$this->_out_mantype ."  VALUES ('','".$user_id."','".($man_store['0']['0']+1)."','".$is_display."','".$typename."','".date("Y-m-d H:i:s")."')" ;
					break;
				case "in_mantype"||"in_subtype":
					$man_store = $this->select("select max(store) from in_mantype");
					$sub_store = $this->select("select max(store) from in_subtype WHERE man_id = '".$man_id."'");

					$sql =($man_id) ? "INSERT INTO ".$this->_in_subtype ."  VALUES ('','".$user_id."','".$man_id."','".($sub_store['0']['0']+1)."','".$is_display."','".$typename."','".date("Y-m-d H:i:s")."')":"INSERT INTO ".$this->_in_mantype ."  VALUES ('','".$user_id."','".($man_store['0']['0']+1)."','".$is_display."','".$typename."','".date("Y-m-d H:i:s")."')" ;
					break;
			}
			return $this->insert($sql);
		}

		/* 更新收入\支出类别 */
		public function updateTypeData($in_out,$user_id,$Aid=0,$typename,$is_display=1,$man_id=0){
			switch($in_out){
				case "out_mantype":
					$sql ="UPDATE ".$this->_out_mantype." SET name = '".$typename."',is_display = '".$is_display."' WHERE id = '".$Aid."' AND user_id = '". $user_id."'";

					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_out_mantype."  WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_out_mantype." 原记录: ";
					break;
			case "out_subtype":
					$sql ="UPDATE ".$this->_out_subtype." SET name = '".$typename."',is_display = '".$is_display."',man_id = '".$man_id."' WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					
					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_out_subtype."  WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_out_mantype." 原记录: ";
					break;
			case "in_mantype":
					$sql ="UPDATE ".$this->_in_mantype." SET name = '".$typename."',is_display = '".$is_display."' WHERE id = '".$Aid."' AND user_id = '". $user_id."'";

					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_in_mantype."  WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_in_mantype." 原记录: ";
					break;
			case "in_subtype":
					$sql ="UPDATE ".$this->_in_subtype." SET name = '".$typename."',is_display = '".$is_display."',man_id = '".$man_id."' WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					
					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_in_subtype."  WHERE id = '".$Aid."' AND user_id = '". $user_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_in_mantype." 原记录: ";
					break;
			}
			return $this->update($sql);
		}


        /*  添加用户函数 */
        public function AddUser($user_name,$user_alias,$user_password,$notes,$group_id)
        {
            $sql = "INSERT INTO ".$this->_users." (id,username,user_alias,password,notes,create_date)   VALUES  ('','".$user_name."','".$user_alias."',password('".$user_password."'),'".$notes."','".date("Y-m-d H:i:s")."')";
			if ($this->insert($sql) != false){
				$user_id = $this->select("SELECT * from users where username = '".$user_name."'");
				$sql = "INSERT INTO ".$this->_user_group." (id,user_id,group_id,create_date,disable)   VALUES  ('','".$user_id['0']['id']."','".$group_id."','".date("Y-m-d H:i:s")."','0')";
				if ($this->insert($sql) != false){
					return true;
				}else{
					$this->select("DELETE from users where id = '".$user_id['0']['id']."'");
					return false;
				}
			} else {
				
				return false;
			}
            
        }

        /*  获取家庭用户函数 */
        public function getUserData($group_id=0)
        {
			$users = $this->select("SELECT user_id FROM user_group where group_id ='".$group_id."'");
            for ($i=0;$i<count($users);$i++){
				if ($i<count($users)-1){
					$user_list .= "'".$users[$i]['user_id']."',";
				}else{
					$user_list .= "'".$users[$i]['user_id']."'";
				}
			}
			$sql = "SELECT * FROM users where id in (".$user_list.")";
			return $this->select($sql);
        }

        /* 获取用户组数据 */
        public function getUserGroupData($user_id)
        {
            $sql = "SELECT group_id FROM ".$this->_user_group." WHERE user_id = '".$user_id."'";
            $temp =  $this->select($sql);

			$sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$temp[0][group_id]."'";
			return $this->select($sql);
        }


         /* 获取主类函数  */
        public function getManType($user_id,$cordtype,$isdisplay=0,$alter_id=0)
        {
			if ($cordtype == "out_mantype" || $cordtype == "out_record" ) {
				if($alter_id!="0"){
					$sql = "SELECT * FROM  ".$this->_out_mantype." where user_id = '".$user_id."' AND id = '".$alter_id."'";
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_out_mantype." where user_id = '".$user_id."' order by store":"SELECT * FROM  ".$this->_out_mantype." where user_id = '".$user_id."' AND is_display = '1' order by store";
				}
			}else if ($cordtype == "in_mantype" || $cordtype == "in_record"){
				if($alter_id!="0"){
					$sql = "SELECT * FROM  ".$this->_in_mantype." where user_id = '".$user_id."' AND id = '".$alter_id."'";
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_in_mantype." where user_id = '".$user_id."' order by store":"SELECT * FROM  ".$this->_in_mantype." where user_id = '".$user_id."' AND is_display = '1' order by store";
				}
			}
            return $this->select($sql);
        }

		 /* 获取子类函数  */
        public function getSubType($user_id,$cordtype,$isdisplay=0,$man_id=0,$sub_id=0)
        {
			if ($cordtype == "out_subtype"|| $cordtype == "out_record" ) {
				if($man_id!="0"){
					if($sub_id !="0"){
						$sql = "SELECT * FROM  ".$this->_out_subtype." where user_id = '".$user_id."' AND man_id = '".$man_id."' AND id = '".$sub_id."'";
					}else{
						$sql = "SELECT * FROM  ".$this->_out_subtype." where user_id = '".$user_id."' AND man_id = '".$man_id."'";
					}
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_out_subtype." where user_id = '".$user_id."' order by store":"SELECT * FROM  ".$this->_out_subtype." where user_id = '".$user_id."' AND is_display = '1'  order by store";
				}
			}else if ($cordtype == "in_subtype"|| $cordtype == "in_record" ){
				if($sub_id!="0"){
					$sql = "SELECT * FROM  ".$this->_in_subtype." where user_id = '".$user_id."' AND id = '".$sub_id;
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_in_subtype." where user_id = '".$user_id."' order by store":"SELECT * FROM  ".$this->_in_subtype." where user_id = '".$user_id."' AND is_display = '1' order by store";
				}
			}
            return $this->select($sql);
        }


       /* 获取地址函数 */
        public function getAddress($user_id,$isdisplay=0)
        {
            $sql = $isdisplay ? "SELECT * FROM ".$this->_address." WHERE user_id = '".$user_id."'  order by store":"SELECT * FROM ".$this->_address." WHERE user_id = '".$user_id."'  AND is_display = '1' order by store";        
            return $this->select($sql);
        }


		/*  收入、支出、地址下拉菜单函数  */
		public function select_type($user_id,$in_out,$Aid=0){
				$ManType = $this->getManType($user_id,$in_out);
				$SubType = $this->getSubType($user_id,$in_out);
				$Address = $this->getAddress($user_id);

				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "主类数量".count($ManType);
					echo "子类数量".count($SubType);
					echo "地址数量".count($Address);
					echo "<br>DEBUG END*********************************************<br>";	
				}

				$alert_corde = $this->getCordeData(0,$in_out,0,0,$Aid);
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "修改的Aid为：";
					print_r($alert_corde);
					echo "<br>DEBUG END*********************************************<br>";	
				}
				
				
				echo "<script>";

				for ($i=0;$i<count($SubType);$i++){
					echo "SubType['".$i."'] = new Array('".$SubType[$i]['id']."','".$SubType[$i]['man_id']."','".$SubType[$i]['name']."');";
				}

				echo "</script>";
				echo "<span><select id=\"mantype_id\" name=\"mantype_id\" onChange=\"sSubType();\">";
				echo "<option value=\"\">--选择主类--</option>";
				for ($i=0;$i<count($ManType);$i++){
					$str = $ManType[$i]['id'] == $alert_corde['0']['mantype_id'] ? "<option selected=\"selected\" value=\"".$ManType[$i]['id']."\">".$ManType[$i]['name']."</option>":"<option value=\"".$ManType[$i]['id']."\">".$ManType[$i]['name']."</option>";
					echo $str;
				}
				echo "</select>";
				echo "<select id=\"subtype_id\" name=\"subtype_id\"><option value=\"\">--选择子类--</option></select></span>";
				if ($Aid != 0){
					echo "<script>sSubType('".$alert_corde['0']['subtype_id']."')</script>";
				}
				echo "<br>";
				echo "<span>地址:&nbsp;";
				echo "<select name=\"address\">";
				echo "<option value=\"\">--选择地址--</option>";
				for ($i=0;$i<count($Address);$i++){
					$str = $Address[$i]['id'] == $alert_corde['0']['addr_id'] ? "<option selected=\"selected\" value=\"".$Address[$i]['id']."\">".$Address[$i]['name']."</option>":"<option value=\"".$Address[$i]['id']."\">".$Address[$i]['name']."</option>";
					echo $str;
				}
				echo "</select></span>";

				echo "<br>";
				echo "<span>金额:&nbsp;";
				$str =  $Aid ? "<input  type=\"text\" name=\"money\" size=\"8\" value=\"".$alert_corde['0']['money']."\"></span><br>":"<input  type=\"text\" name=\"money\" size=\"8\" value=\"0\"></span><br>";
				echo $str;
				echo "<span>说明:&nbsp;";
				$str =  $Aid ? "<input  type=\"text\" name=\"notes\" size=\"20\" value=\"".$alert_corde['0']['notes']."\"></span><br>":"<input  type=\"text\" name=\"notes\" size=\"20\" value=\"\"></span><br>";
				echo $str;
				$str =  $Aid ? "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\"><INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"修改\"></span>":"<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"添加\"></span>";
				echo $str;
			}

         /* 转换ID->名称函数*/
        public function convertID($user_id,$id,$table)
        {
            
			switch ($table){
				case "users":
					$sql = "SELECT user_alias FROM ".$this->_users." WHERE id = '".$user_id."'";
					break;
				case "out_mantype":
					$sql = "SELECT name FROM ".$this->_out_mantype." WHERE id = '".$id."'";
					break;
				case "out_subtype":
					$sql = "SELECT name FROM ".$this->_out_subtype." WHERE id = '".$id."'";
					break;
				case "in_mantype":
					$sql = "SELECT name FROM ".$this->_in_mantype." WHERE id = '".$id."'";
					break;
				case "in_subtype":
					$sql = "SELECT name FROM ".$this->_in_subtype." WHERE id = '".$id."'";
					break;
				case "address":
					$sql = "SELECT name FROM ".$this->_address." WHERE id = '".$id."'";
					break;
			}
            $result = $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }


        /*删除收入支出与各主类了类记录函数 */
        public function delCorde($in_out,$user_id,$corde_id)
        {
			switch($in_out){
				case "out_record":
					$sql = "DELETE FROM ".$this->_out_corde." where id = '".$corde_id."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_out_corde."  where id = '".$corde_id."' AND user_id = '".$user_id."'";
					break;
				case "in_record":
					$sql = "DELETE FROM ".$this->_in_corde." where id = '".$corde_id."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_in_corde."  where id = '".$corde_id."' AND user_id = '".$user_id."'";
					break;
				case "out_mantype":
					$sql = "DELETE out_mantype,out_subtype from out_mantype left join out_subtype on out_mantype.id=out_subtype.man_id where out_mantype.id='".$corde_id."' AND out_mantype.user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * from out_mantype left join out_subtype on out_mantype.id=out_subtype.man_id where out_mantype.id='".$corde_id."' AND out_mantype.user_id = '".$user_id."'";
					break;
				case "out_subtype":
					$sql = "DELETE from ".$this->_out_subtype." where id='".$corde_id."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * from ".$this->_out_subtype." where id='".$corde_id."' AND user_id = '".$user_id."'";
					break;
				case "in_mantype":
					$sql = "DELETE in_mantype,in_subtype from in_mantype left join in_subtype on in_mantype.id=in_subtype.man_id where in_mantype.id='".$corde_id."' AND in_mantype.user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * from in_mantype left join in_subtype on in_mantype.id=in_subtype.man_id where in_mantype.id='".$corde_id."' AND in_mantype.user_id = '".$user_id."'";
					break;
				case "in_subtype":
					$sql = "DELETE from ".$this->_in_subtype." where id='".$corde_id."' AND user_id = '".$user_id."'";
					$old_corde_sql = "SELECT * from ".$this->_in_subtype." where id='".$corde_id."' AND user_id = '".$user_id."'";
					break;
			}

            
			/* 记录修改前的资料 START */	
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_out_corde." 原记录: ";

			
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }

        /*  往前地址排序函数 */
        public function down_up($in_out,$user_id,$man_id=0,$id,$isup=0)
        {
			
			$num = 0;
			switch($in_out){
				case "out_mantype":
					$store_num = $this->select("SELECT store from out_mantype where id = '".$id."'");
					if ($store_num['0']['0'] != 1 )
					{
						if ($isup){
							$num=$store_num['0']['0']-1;
						}else{
							$num=$store_num['0']['0']+1;
						}
						$sql = "UPDATE out_mantype SET store = '0' where store = '".$num."' AND user_id ='".$user_id."'";
						$this->update($sql);

						$sql = "UPDATE out_mantype SET store = '".$num."' where store = '".$store_num['0']['0']."' AND user_id ='".$user_id."'";
						$this->update($sql);

						$sql = "UPDATE out_mantype SET store = '".$store_num['0']['0']."' where store = '0' AND user_id ='".$user_id."'";
						$this->update($sql);
					}
					break;
				case "out_subtype":
					$store_num = $this->select("SELECT store from out_subtype where id = '".$id."'");
					if ($store_num['0']['0'] != 1 )
					{
						if ($isup){
							$num=$store_num['0']['0']-1;
						}else{
							$num=$store_num['0']['0']+1;
						}
						$sql = "UPDATE out_subtype SET store = '0' where store = '".$num."' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);

						$sql = "UPDATE out_subtype SET store = '".$num."' where store = '".$store_num['0']['0']."' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);

						$sql = "UPDATE out_subtype SET store = '".$store_num['0']['0']."' where store = '0' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);
					}
					break;

				case "in_mantype":
					$store_num = $this->select("SELECT store from in_mantype where id = '".$id."'");
					if ($store_num['0']['0'] != 1 )
					{
						if ($isup){
							$num=$store_num['0']['0']-1;
						}else{
							$num=$store_num['0']['0']+1;
						}
						$sql = "UPDATE in_mantype SET store = '0' where store = '".$num."' AND user_id ='".$user_id."'";
						$this->update($sql);

						$sql = "UPDATE in_mantype SET store = '".$num."' where store = '".$store_num['0']['0']."' AND user_id ='".$user_id."'";
						$this->update($sql);

						$sql = "UPDATE in_mantype SET store = '".$store_num['0']['0']."' where store = '0' AND user_id ='".$user_id."'";
						$this->update($sql);
					}
					break;
				case "in_subtype":
					$store_num = $this->select("SELECT store from in_subtype where id = '".$id."'");
					if ($store_num['0']['0'] != 1 )
					{
						if ($isup){
							$num=$store_num['0']['0']-1;
						}else{
							$num=$store_num['0']['0']+1;
						}
						$sql = "UPDATE in_subtype SET store = '0' where store = '".$num."' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);

						$sql = "UPDATE in_subtype SET store = '".$num."' where store = '".$store_num['0']['0']."' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);

						$sql = "UPDATE in_subtype SET store = '".$store_num['0']['0']."' where store = '0' AND user_id ='".$user_id."'  AND man_id ='".$man_id."'";
						$this->update($sql);
					}
					break;
			}
        }


/*  以上内容为优化内容  ####################################################################################################*/


        /*  以用户名来获取用户ID函数 */
        public function getUserID($username)
        {
            $sql = "SELECT id FROM ".$this->_users." Where username = '".$username."'";
            return $this->select($sql);
        }

          /*取得当前用户会话函数*/
        public function getUserSession($user_id)
        {
            $sql = "SELECT session FROM ".$this->_users." WHERE id = '".$user_id."'";
            $result = $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }



        /* 转换用户ID为用户别名函数*/
        public function convertUserAliasID($user_id)
        {
            $sql = "SELECT user_alias FROM ".$this->_users." WHERE id = '".$user_id."'";
            $result =  $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }


        /* 提取用户ID数据函数*/
        public function drawUserID($user_id)
        {
            $sql = "SELECT * FROM ".$this->_users." WHERE id = '".$user_id."'";
            return  $this->select($sql);
        }



        /*  添加用户默认收支主类 */
        public function insertManTypeDefault($user_id)
        {
            $sql = "INSERT INTO ".$this->_out_mantype." (id,user_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','1','1','衣','".date("Y-m-d H:i:s")."'),('','".$user_id."','2','1','食','".date("Y-m-d H:i:s")."'),('','".$user_id."','3','1','住','".date("Y-m-d H:i:s")."'),('','".$user_id."','4','1','行','".date("Y-m-d H:i:s")."'),('','".$user_id."','5','1','我','".date("Y-m-d H:i:s")."'),('','".$user_id."','6','1','信息费','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);
            $sql = "INSERT INTO ".$this->_in_mantype." (id,user_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','1','1','固定收入','".date("Y-m-d H:i:s")."'),('','".$user_id."','2','1','其它收入','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);
        }

        /*  添加用户默认收支子类 */
        public function insertSubTypeDefault($user_id)
        {
            /* 衣----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '衣' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','服装','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','鞋帽','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);
            /* 食----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '食' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','早餐','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','午餐','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','3','1','晚餐','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','4','1','夜宵','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);

            /* 住----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '住' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','日常用品','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','家用电器','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','3','1','房租','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);

            /* 行----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '行' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','公交车','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','的士','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','3','1','地铁','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','4','1','火车','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','5','1','摩的','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','6','1','飞机','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','7','1','轮船','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);

            /* 我----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '我' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','零食','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','饮料','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','3','1','理发','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);


            /* 信息费----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from out_mantype where name = '信息费' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_out_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','网络费','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','2','1','手机费','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','3','1','电话费','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','4','1','通信硬件','".date("Y-m-d H:i:s")."'),('','".$user_id."','".$mantype_id['0']['0']."','5','1','通信软件','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);

            /* 固定收入----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from in_mantype where name = '固定收入' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_in_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','工资','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);

            /* 其它收入----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from in_mantype where name = '其它收入' and user_id = '".$user_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_in_subtype." (id,user_id,man_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','".$mantype_id['0']['0']."','1','1','未知','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);
        }


        /*  添加用户默认地址 */
        public function insertAddressDefault($user_id)
        {
            $sql = "INSERT INTO ".$this->_address." (id,user_id,store,is_display,name,create_date)   VALUES  ('','".$user_id."','1','1','公司','".date("Y-m-d H:i:s")."'),('','".$user_id."','2','1','公司附近','".date("Y-m-d H:i:s")."'),('','".$user_id."','3','1','家里','".date("Y-m-d H:i:s")."'),('','".$user_id."','4','1','综合大卖场','".date("Y-m-d H:i:s")."'),('','".$user_id."','5','1','超市菜市场','".date("Y-m-d H:i:s")."'),('','".$user_id."','6','1','电脑城','".date("Y-m-d H:i:s")."')";
            $this->insert($sql);
        }


        /*更新用户函数 */
        public function updateUser($user_name,$user_alias,$user_password,$notes)
        {
            if  ( $_SESSION['__useralive'][0] == 1 )
            {
                    $sql = "UPDATE ".$this->_users." SET username = '".$user_name."',user_alias = '".$user_alias."', password = '".$user_password."' ,notes = '".$notes."'  WHERE id = '".$_SESSION['__gettype_id']."'";
					$old_corde_sql = "SELECT * FROM ".$this->_users." WHERE id = '".$_SESSION['__gettype_id']."'";
            } else {
                    $sql = "UPDATE ".$this->_users." SET username = '".$user_name."',user_alias = '".$user_alias."', password = '".$user_password."' ,notes = '".$notes."'  WHERE id = '".$_SESSION['__useralive'][0]."'";
					$old_corde_sql = "SELECT * FROM ".$this->_users." WHERE id = '".$_SESSION['__useralive'][0]."'";
            }
			/* 记录修改前的资料 START */
			
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_users." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }

        /*删除用户函数 */
        public function deleteUser($user_id)
        {
            if ($_SESSION['__useralive'][0] == 1 )
            {
                    $sql = "DELETE FROM ".$this->_users." WHERE id = '".$user_id."'";
					/* 记录修改前的资料 START */
					$old_corde_sql = "SELECT * FROM ".$this->_users." WHERE id = '".$user_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_users." 原记录: ";
					for($j=0;$j<count($old_corde1);$j++) {
						for($i=0;$i<count($old_corde1[$j]);$i++) {
							$old_corde .= "'".$old_corde1[$j][$i]."',";
						}
						$old_corde .= " | ";
					}

					$this->corde_sql_log($old_corde);
					/*  记录修改前的资料 END */

                    return $this->delete($sql);
            } else {
                    return false;
            }
        }






    
        /* 获取组列表 */
        public function getGroupList()
        {
            $sql = "SELECT * FROM ".$this->_groups;
            return $this->select($sql);
        }

        /* 获取组成员列表函数 */
        public function getGroupMemberList()
        {
            $sql = "SELECT user_id FROM ".$this->_user_group." WHERE group_id = '".$_SESSION['__group_id']."' AND disable = '0'";
            return $this->select($sql);
        }

        /* 获取组中用户的数量 */
        public function getGroupMemberNum()
        {
            $sql = "SELECT count(*) FROM ".$this->_user_group." WHERE group_id = '".$_SESSION['__group_id']."'";
            return $this->select($sql);
        }

        /* 删除组中用户函数 */
        public function deleteGroupMember($member)
        {
            $sql = "DELETE FROM ".$this->_user_group." WHERE user_id = '".$member."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_user_group." WHERE user_id = '".$member."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_user_group." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }


        /*更新组函数 */
        public function updateGroup($group_name,$group_alias,$group_password,$notes)
        {
            $sql = "UPDATE ".$this->_groups." SET groupname = '".$group_name."',group_alias = '".$group_alias."', password = '".$group_password."' ,notes = '".$notes."'  WHERE id = '".$_SESSION['__gettype_id']."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$_SESSION['__gettype_id']."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_groups." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }


        /* 提取组ID数据函数*/
        public function getGroupAdmin()
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$_SESSION['__group_id']."' AND groupadmin_id = '".$_SESSION['__useralive'][0]."'";
            return  $this->select($sql);
        }

        /* 提取管理员的组ID数据函数*/
        public function getGroupAdminID()
        {
            $sql = "SELECT id FROM ".$this->_groups." WHERE  groupadmin_id = '".$_SESSION['__useralive'][0]."'";
            $admin_id =  $this->select($sql);
            return $admin_id['0']['0'];
        }



        /*  添加组函数 */
        public function insertGroup($group_name,$group_alias,$group_password,$notes)
        {
            $sql = "INSERT INTO ".$this->_groups." (id,groupname,group_alias,groupadmin_id,password,notes,create_date)   VALUES  ('','".$group_name."','".$group_alias."','".$_SESSION['__useralive'][0]."','".$group_password."','".$notes."','".date("Y-m-d H:i:s")."')";
            return $this->insert($sql);
        }


        /*删除组函数 */
        public function deleteGroup($group_id)
        {
            if ($_SESSION['__useralive'][0] == 1 || $this->getGroupAdmin())
            {
                    $sql = "DELETE FROM ".$this->_groups." WHERE id = '".$group_id."'";
					/* 记录修改前的资料 START */
					$old_corde_sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$group_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_groups." 原记录: ";
					for($j=0;$j<count($old_corde1);$j++) {
						for($i=0;$i<count($old_corde1[$j]);$i++) {
							$old_corde .= "'".$old_corde1[$j][$i]."',";
						}
						$old_corde .= " | ";
					}

					$this->corde_sql_log($old_corde);
					/*  记录修改前的资料 END */
                    return $this->delete($sql);
            } else {
                    return false;
            }
        }

        /*　获取用户所属于的组ID　*/
        public function getUserResideGroup($user_id)
        {
            if(empty($user_id))
            {
                $sql = "SELECT group_id FROM ".$this->_user_group." WHERE user_id = '".$_SESSION['__useralive'][0]."' AND disable != '1'";
            } else {
                $sql = "SELECT group_id FROM ".$this->_user_group." WHERE user_id = '".$user_id."' AND disable != '1'";
            }
            
            
            $result = $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }


        /*　判断用户是否属于的组　*/
        public function yesUserInGroup()
        {

            $sql = "SELECT group_id FROM ".$this->_user_group." WHERE user_id = '".$_SESSION['__useralive'][0]."'";
            
            
            $result = $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }

        /* 转换组ID为组别名函数*/
        public function convertGroupAliasID($group_id)
        {
            $sql = "SELECT groupname,group_alias FROM ".$this->_groups." WHERE id = '".$group_id."'";
            $result =  $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value;
            }
        }


        /* 判断用户是否有权限更改组函数*/
        public function drawGroupID($group_id)
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$group_id."'";
            return  $this->select($sql);
        }


        /* 判断用户是否是组管理员,并且返回是否有新成员加入函数*/
        public function getIsGroupAdmin($group_id)
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$group_id."' AND groupadmin_id = '".$_SESSION['__useralive'][0]."'";
            $is_yes = $this->select($sql);
            if ($is_yes)
            {
                $sql = "SELECT user_id FROM ".$this->_user_group." WHERE group_id = '".$group_id."' AND disable = '1'";
                return $this->select($sql);
            }

        }


        /* 添加用户到组函数 */
        public function insertUserGroup($user_id,$group_id)
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$group_id."' AND groupadmin_id = '".$_SESSION['__useralive'][0]."'";
            $is_yes = $this->select($sql);

            if ( $_SESSION['__useralive'][0] == 1 || $is_yes )
            {
                $sql = "INSERT INTO ".$this->_user_group." (id,user_id,group_id,create_date,disable)   VALUES  ('','".$user_id."','".$group_id."','".date("Y-m-d H:i:s")."','0')";
            } else {
                $sql = "INSERT INTO ".$this->_user_group." (id,user_id,group_id,create_date)   VALUES  ('','".$user_id."','".$group_id."','".date("Y-m-d H:i:s")."')";
            }
            return $this->insert($sql);
        }

        /* 判断密码是否正确函数 */
        public function checkGroupPassword($group_id,$group_password)
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$group_id."' AND password = '".$group_password."'";
            return $this->select($sql);
        }



        /* 修改用户到组函数 */
        public function updateUserGroup($user_id,$group_id)
        {
            $sql = "UPDATE user_group set group_id = '".$group_id."',disable = '1' where user_id = '".$user_id."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM user_group where user_id = '".$user_id."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:user_group 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }

        /* 允许用户添加到组函数 */
        public function addAccpetUserGroup($user_id)
        {
                $sql = "UPDATE user_group set disable = '0' WHERE user_id = '".$user_id."'";
                return $this->update($sql);        
        }



        /* 删除用户与组的关系函数 */
        public function deleteUserGroup($user_id)
        {
            $sql = "SELECT * FROM ".$this->_groups." WHERE id = '".$_SESSION['__group_id']."' AND groupadmin_id = '".$_SESSION['__useralive'][0]."'";
            $is_yes = $this->select($sql);

            if ($is_yes && $user_id == $_SESSION['__useralive'][0] )
            {
                return false;
            } else {
                $sql = "DELETE FROM user_group where user_id = '".$user_id."'";
				/* 记录修改前的资料 START */
				$old_corde_sql = "SELECT * FROM user_group where user_id = '".$user_id."'";
				$old_corde1 = $this->select($old_corde_sql);
				$old_corde = "表名:user_group 原记录: ";
				for($j=0;$j<count($old_corde1);$j++) {
					for($i=0;$i<count($old_corde1[$j]);$i++) {
						$old_corde .= "'".$old_corde1[$j][$i]."',";
					}
					$old_corde .= " | ";
				}

				$this->corde_sql_log($old_corde);
				/*  记录修改前的资料 END */

                return $this->delete($sql);
            }
        }

        
        /* 删除用户与组的关系从组管理员函数 */
        public function deleteUserGroupForAdmin()
        {
				$sql = "DELETE FROM user_group where user_id = '".$_SESSION['__useralive'][0]."'";
				/* 记录修改前的资料 START */
				$old_corde_sql = "SELECT * FROM user_group where user_id = '".$_SESSION['__useralive'][0]."'";
				$old_corde1 = $this->select($old_corde_sql);
				$old_corde = "表名:user_group 原记录: ";
				for($j=0;$j<count($old_corde1);$j++) {
					for($i=0;$i<count($old_corde1[$j]);$i++) {
						$old_corde .= "'".$old_corde1[$j][$i]."',";
					}
					$old_corde .= " | ";
				}

				$this->corde_sql_log($old_corde);
				/*  记录修改前的资料 END */
                return $this->delete($sql);
        }


        /*  列出收入与支出的分类函数*/
        public function getInOutType($in_out_type)
        {
            $sql = "SELECT * FROM  ".$this->$in_out_type."  WHERE  user_id = '".$_SESSION['__useralive'][0]."' order by store";
            return $this->select($sql);
        }


        /*写入收入主类函数 */
        public function insertInManType($user_id,$store,$is_display,$addmantypename)
        {
            $sql = "INSERT INTO   ".$this->_in_mantype . "  VALUES ('','".$user_id."','".$store."','".$is_display."','".$addmantypename."','".date("Y-m-d H:i:s")."')";
            return $this->insert($sql);
        }


        /*更新主类函数 */
        public function updateManType($in_out_type,$is_display,$altermantypename,$mantype_id)
        {
            $sql = "UPDATE ".$this->$in_out_type." SET name = '".$altermantypename."',is_display = '".$is_display."' WHERE id = '".$mantype_id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_out_type."  WHERE id = '".$mantype_id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_out_type." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}
			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }






        public  function  getManTypeList($typelist)
        {
            $sql = "SELECT id,name FROM  ".$this->$typelist." WHERE user_id = '".$_SESSION['__useralive'][0]."' AND is_display = '1' order by store";
            return $this->select($sql);
        }

        public  function  getSubTypeList($typelist)
        {
            $sql = "SELECT id,man_id,name FROM  ".$this->$typelist." WHERE user_id = '".$_SESSION['__useralive'][0]."' AND is_display = '1' order by man_id,store";
            return $this->select($sql);
        }

          /*写入支出主类函数 */
        public function insertOutManType($user_id,$store,$is_display,$addmantypename)
        {
            $sql = "INSERT INTO   ".$this->_out_mantype . "  VALUES ('','".$user_id."','".$store."','".$is_display."','".$addmantypename."','".date("Y-m-d H:i:s")."')";
            return $this->insert($sql);
        }


        /*  把数据写入收入支出表函数 */
        public function insertInOutRecord($in_out_corde,$money,$mantype_id,$subtype_id,$address_id,$notes)
        {
            $sql = "INSERT INTO ".$this->$in_out_corde ."  VALUES ('','".$money."','".$_SESSION['__useralive'][0]."','".$_SESSION['__group_id']."','".$mantype_id."','".$subtype_id."','".$address_id."','".$notes."','".date("Y-m-d H:i:s")."')";
            return $this->insert($sql);
        }




        /*更新收入记录函数 */
        public function     updateInCorde($id,$money,$mantype_id,$subtype_id,$address_id,$notes)
        {
            $sql = "UPDATE ".$this->_in_corde." SET money = '".$money."',mantype_id = '".$mantype_id."',subtype_id = '".$subtype_id."',addr_id = '".$address_id."', notes = '".$notes."'  WHERE id = '".$id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_in_corde."  WHERE id = '".$id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_in_corde." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }



        /*删除用户收入支出记录函数 */
        public function deleteUserData($in_out_corde,$user_id)
        {
            $sql = "DELETE FROM ".$this->$in_out_corde." where user_id = '".$user_id."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_out_corde."  where user_id = '".$user_id."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_out_corde." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }


        /*删除用户收入支出记录从组管理员函数 */
        public function deleteUserDataForGroupAdmin($in_out_corde)
        {
            $sql = "DELETE FROM ".$this->$in_out_corde." where group_id = '".$_SESSION['__group_id']."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_out_corde."  where group_id = '".$_SESSION['__group_id']."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_out_corde." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }




          /* 把传过来的类ID转换为名称函数  */
        public function convertIdToNmae($in_out_type,$type_id)
        {
            $sql = "SELECT name FROM  ".$this->$in_out_type."  WHERE  id = ".$type_id;
            $result = $this->select($sql);
            foreach($result as $key => $value )
            {
                $value_done = $value[0] ;
            }
	    if (empty($value_done))
	    {
	    	return "";
	    } else {
                return $value_done;
	    }
        } 

        /*  把数据写入主类表函数*/
        public function insertManType($typetable,$store,$is_display,$name)
        {
            $sql = "INSERT INTO ".$this->$typetable."  VALUES ('','".$store."','".$is_display."','".$name."')";
            
            return $this->insert($sql);
        }


        /* 把数据写入子类表函数 */
        public function insertSubType($typetable,$man_id,$store,$is_display,$name)
        {
            $sql = "INSERT INTO ".$this->$typetable." values ('','".$_SESSION['__useralive'][0]."','".$man_id."','".$store."','".$is_display."','".$name."','".date("Y-m-d H:i:s")."')";
            
            return $this->insert($sql);
        }


        /*更新子类函数 */
        public function updateSubType($in_out_type,$subtype_id,$is_display,$altersubtypename)
        {
            $sql = "UPDATE ".$this->$in_out_type." SET name = '".$altersubtypename."',is_display = '".$is_display."' WHERE id = '".$subtype_id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_out_type."  WHERE id = '".$subtype_id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_out_type." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->update($sql);
        }


        /*删除子类函数 */
        public function deleteSubType($in_out_type,$subtype_id)
        {
            $sql = "DELETE FROM ".$this->$in_out_type." where id = '".$subtype_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_out_type."  where id = '".$subtype_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_out_type." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }












        /*  添加新日志解释函数 */
        public function insertLogResolve($log_id,$content)
        {
            $sql = "INSERT INTO ".$this->_log_resolve." values ('','".$log_id."','".$content."')";        
            return $this->insert($sql);
        }



        /*更新日志函数 */
        public function updateLog($id,$log_id,$content)
        {
            $sql = "UPDATE ".$this->_log_resolve." SET log_id = '".$log_id."',content = '".$content."' WHERE id = '".$id."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_log_resolve."  WHERE id = '".$id."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_log_resolve." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->update($sql);
        }


        /*删除日志函数 */
        public function deleteLog($id)
        {
            $sql = "DELETE FROM ".$this->_log_resolve." where id = '".$id."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_log_resolve." where id = '".$id."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_log_resolve." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->delete($sql);
        }




       /* 列出日志内容函数 */
        public function getLogContentList()
        {
            $sql = "SELECT * FROM ".$this->_log_resolve." ORDER BY  log_id asc";        
            return $this->select($sql);
        }




        /*  列出要显示的地址函数*/
        public function getAddressDisplay()
        {
            $sql = "SELECT * FROM  ".$this->_address."  WHERE  user_id = '".$_SESSION['__useralive'][0]."' AND is_display = '1' order by store";
            return $this->select($sql);
        }

        /*  添加地址函数 */
        public function insertAddress($store,$is_display,$addr_name)
        {
            $sql = "INSERT INTO ".$this->_address."  VALUES ('','".$_SESSION['__useralive'][0]."','".$store."','".$is_display."','".$addr_name."','".date("Y-m-d H:i:s")."')";
            
            return $this->insert($sql);
        }

        /*更新地址函数 */
        public function updateAddress($address_id,$addr_name,$is_display)
        {
            $sql = "UPDATE ".$this->_address." SET name = '".$addr_name."',is_display = '".$is_display."' WHERE id = '".$address_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_address." WHERE id = '".$address_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_address." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

            return $this->update($sql);
        }


        
        /*删除地址函数 */
        public function deleteAddress($address_id)
        {
            $sql = "DELETE FROM ".$this->_address." where id = '".$address_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_address." where id = '".$address_id."' AND user_id = '".$_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_address." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */
            return $this->delete($sql);
        }

        /*获取传过来的ID对应Store值函数 */
        public function getIsDisplay($table,$id)
        {
            $sql = "SELECT is_display FROM ".$this->$table." where id = '".$id."'";
            return $this->select($sql);
        }

         /* 转换地址ID为地址名函数*/
        public function convertAddrID($addr_id)
        {
            $sql = "SELECT name FROM ".$this->_address." WHERE id = '".$addr_id."'";
            $result =  $this->select($sql);
            foreach( $result as $key => $value)
            {
                return $value[0];
            }
        }

        /*获得每月支出数据函数 */
        public function getReportOutMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月支出数据*/
        public function getReportOutMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得指定用户每月支出数据函数 */
        public function getReportPersonOutMonth($user_id,$month1)
        {
            $sql = "SELECT * FROM ".$this->_out_corde." WHERE user_id = '".$user_id."' AND create_date like '".$month1."%'";        
            return $this->select($sql);
        }


        /*获得每月支出地址数据*/
        public function getReportOutAddrMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  group by addr_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by addr_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by addr_id";
            }
            return $this->select($sql);
        }

        /*获得每月支出主类数据*/
        public function getReportOutManTypeMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  group by mantype_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by mantype_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by mantype_id";
            }
            return $this->select($sql);
        }

        /*获得每月支出主类数据函数 */
        public function getReportOutManTypeMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月支出地址数据函数 */
        public function getReportOutAddrMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月收入数据*/
        public function getReportInMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$month."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }

        /*获得每月收入数据函数 */
        public function getReportInMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$month."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得指定用户每月收入数据函数 */
        public function getReportPersonInMonth($user_id,$month1)
        {
            $sql = "SELECT * FROM ".$this->_in_corde." WHERE user_id = '".$user_id."' AND create_date like '".$month1."%'";        
            return $this->select($sql);
        }

        /*获得每年支出数据*/
        public function getReportOutYearTotal($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$year."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$year."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_out_corde." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得每年支出数据函数 */
        public function getReportOutYear($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$year."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$year."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_out_corde." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }


        /*获得指定用户每年支出数据函数 */
        public function getReportPersonOutYear($user_id,$year1)
        {
            $sql = "SELECT * FROM ".$this->_out_corde." WHERE user_id = '".$user_id."' AND create_date like '".$year1."%'";        
            return $this->select($sql);
        }


        /*获得每年收入数据*/
        public function getReportInYearTotal($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$year."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$year."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_in_corde." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得每年支收入数据函数 */
        public function getReportInYear($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$year."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$year."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_in_corde." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }


        /*获得指定用户每年收入数据函数 */
        public function getReportPersonInYear($user_id,$year1)
        {
            $sql = "SELECT * FROM ".$this->_in_corde." WHERE user_id = '".$user_id."' AND create_date like '".$year1."%'";        
            return $this->select($sql);
        }

        /*搜索函数 */
        public function search($sql)
        {        
            return $this->select($sql);
        }




         /* SELECT数字选择函数*/
        public function NumList($money ="" )
        {

			$old_money = explode(".",$money);
			$numlist_1000 = $old_money[0]/1000%10;
			$numlist_100 = $old_money[0]/100%10;
			$numlist_10 = $old_money[0]/10%10;
			$numlist_1 = $old_money[0]/1%10;

			$numlist_01 = $old_money[1]/10%10;
			$numlist_001 = $old_money[1]/1%10;

            $i = 0;
            echo "<select  name = \"numlist_1000\" >";
            while($i<10)
            {
				if ( $i == $numlist_1000 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";

            //===========================================================
            $i = 0;
            echo "<select  name = \"numlist_100\" >";
            while($i<10)
            {
				if ( $i == $numlist_100 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";

            //===========================================================
            $i = 0;
            echo "<select  name = \"numlist_10\" >";
            while($i<10)
            {
				if ( $i == $numlist_10 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";
            
            //===========================================================
            $i = 0;
            echo "<select  name = \"numlist_1\" >";
            while($i<10)
            {
				if ( $i == $numlist_1 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";

            echo " . ";

               //===========================================================
            $i = 0;
            echo "<select  name = \"numlist_01\">";
            while($i<10)
            {
				if ( $i == $numlist_01 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";

               //===========================================================
            $i = 0;            
            echo "<select  name = \"numlist_001\" >";
            while($i<10)
            {
				if ( $i == $numlist_001 ) {
					echo "<option selected=\"selected\" value =".$i.">" . $i . "</option>";
				} else {
					echo "<option value =".$i.">" . $i . "</option>";
				}
                $i++;
            }
                echo "</select >";
           }

        /*  往前主类排序函数 */
        public function TaxisManFront($table,$id)
        {
            $num = 0;
            
            if ($id != 1 )
            {
                $num = $id-1;
                $sql = "UPDATE ".$this->$table." SET store = '0' where store = '".$num."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$num."' where store = '".$id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$id."' where store = '0'";
                $this->update($sql);
            } else {
                return false;
            }
        }

        /*  往后主类排序函数 */
        public function TaxisManAfter($table,$id)
        {
            $num = 0;
            $sql = "select max(store) from ".$this->$table;
            $max = $this->select($sql);

            if ($id <= $max['0']['0'] )
            {
                $num = $id+1;
                $sql = "UPDATE ".$this->$table." SET store = '0' where store = '".$num."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$num."' where store = '".$id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$id."' where store = '0'";
                $this->update($sql);
            } else {
                return false;
            }
        }

        /*  往前子类排序函数 */
        public function TaxisSubFront($table,$man_id,$id)
        {
            $num = 0;
            
            if ($id != 1 )
            {
                $num = $id-1;
                $sql = "UPDATE ".$this->$table." SET store = '0' where store = '".$num."' AND man_id = '".$man_id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$num."' where store = '".$id."' AND man_id = '".$man_id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$id."' where store = '0' AND man_id = '".$man_id."'";
                $this->update($sql);
            } else {
                return false;
            }
        }

        /*  往后子类排序函数 */
        public function TaxisSubAfter($table,$man_id,$id)
        {
            $num = 0;
            $sql = "select max(store) from ".$this->$table;
            $max = $this->select($sql);

            if ($id <= $max['0']['0'] )
            {
                $num = $id+1;
                $sql = "UPDATE ".$this->$table." SET store = '0' where store = '".$num."' AND man_id = '".$man_id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$num."' where store = '".$id."' AND man_id = '".$man_id."'";
                $this->update($sql);

                $sql = "UPDATE ".$this->$table." SET store = '".$id."' where store = '0' AND man_id = '".$man_id."'";
                $this->update($sql);
            } else {
                return false;
            }
        }



        /*  获取主类最大排序号函数 */
        public function getMaxManStore($table)
        {
            $sql = "select max(store) from ".$this->$table." where user_id = ".$_SESSION['__useralive'][0];
            return $this->select($sql);
        }

        /*  获取子类最大排序号函数 */
        public function getMaxSubStore($table,$man_id)
        {
            $sql = "select max(store) from ".$this->$table." WHERE man_id = '".$man_id."'";
            return $this->select($sql);
        }

        /*  获取地址最大排序号函数 */
        public function getMaxAddrStore()
        {
            $sql = "select max(store) from address WHERE user_id = '".$_SESSION['__useralive'][0]."'";
            return $this->select($sql);
        }
		
		/*  记录事件日志 */
        public function CrodeLog($text_log = "")
        {
			$info_log = "文件:".$_SERVER['PHP_SELF']." 上一页面:".$_SERVER['HTTP_REFERER']." 协议:".$_SERVER['SERVER_PROTOCOL']." 当前主机:".$_SERVER['SERVER_NAME']." 当标识:".$_SERVER['SERVER_SOFTWARE']." 方法:".$_SERVER['REQUEST_METHOD']." HTTP主机:".$_SERVER['HTTP_HOST']." 客户端主机名:".$_SERVER['REMOTE_HOST']." 客户端浏览器:".$_SERVER['HTTP_USER_AGENT']." 客户端IP:".$_SERVER['REMOTE_ADDR']." 请求头信息:".$_SERVER['HTTP_ACCEPT']." 代理头信息:".$_SERVER['HTTP_USER_AGENT'];
            $sql = "INSERT INTO ".$this->_log."  VALUES ('','".$_SESSION['__useralive'][0]."','".$_SESSION['__group_id']."',\"".$text_log."\",\"".$info_log."\",'".$_SESSION['__global_logid']."','".date("Y-m-d H:i:s")."')";
            return $this->insert($sql);
        }


    }

	/*------------------------------------------------------------------------------------------*/


    /* 创建一个类变量 */
    $Finance = new Finance();

    /* 连接到数据库 */
    $Finance->_construct();



?>
