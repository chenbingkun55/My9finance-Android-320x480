<?PHP
    require(INCLUDE_PATH.'db.inc.php');
    require(INCLUDE_PATH.'language_CN.php');

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
        public $_record_lib = 'record_lib';
        public $_mantype = 'mantype';
        public $_subtype = 'subtype';
		public $_family = 'family';
		public $_bug = "bug";
		public $_bank_card = "bank_card";
		public $_family_member = 'family_member';
        public $_log_resolve = 'log_resolve';
        public $_address = 'address';
		public $_log = "log_";

        public $_pagesize = 10;
        public $_is_disable = array("0"=>"启用",
            "1"=>"禁用");

        /*  连接数据库函数 */
        public function _construct()
        {
            parent::_construct();
        }
        

         /* 用户登录验证函数 */
        public function login($familyname,$password)
        {
             $sql = "SELECT * FROM ".$this->_family." WHERE Name = '".$familyname."'";
			 $sql2 = "SELECT * FROM ".$this->_family." WHERE Name = '".$familyname."' AND L_pass = password('".$password."')";

             if( $result =  $this->select($sql))
            {
				if ($this->select($sql2)){
					if ( $result['0']["Is_d"] == 0 ) {
						return $result;
					} else {
						return 4;
					}
				}else{
					return 2;
				}
             } else {                
				return 1;
			}
		}

		/* 判断成员是否可用 */
		public function AvailableMember($member_id){
			$sql = "SELECT * from ".$this->_family_member." WHERE ID = '".$member_id."'";

			if( $this->select($sql) ) {
				return true;
			} else {
				return false;
			}
		}

         /*更新家庭会话ID与最后登录时间函数 */
        public function refurbishFamilySession($family_id)
        {
            $sql = "UPDATE ".$this->_family." SET L_date = '".time()."' , Session = '".session_id()."', Sum = Sum + 1  WHERE ID = '".$family_id."'";
            $this->update($sql);

			$sql = "SELECT Session FROM  ".$this->_family." WHERE id = '".$family_id."'";
			return $this->select($sql);
        }

         /*更新用户计数与最后登录时间函数 */
        public function refurbishMemberSession($member_id)
        {
            $sql = "UPDATE ".$this->_family_member." SET L_date = '".time()."', Sum = Sum + 1  WHERE ID = '".$member_id."'";
            
			return $this->update($sql);
        }

		/*取得当前用户会话函数*/
        public function getFamilySession($family_id)
        {
            $sql = "SELECT Session FROM ".$this->_family." WHERE ID = '".$family_id."'";
            $result = $this->select($sql);
			return  $result;
        }

		/*取得家庭成员函数*/
        public function getFamilyMember($family_id)
        {
            $sql = "SELECT * FROM ".$this->_family_member." WHERE F_id = '".$family_id."' AND Is_d = '0'";
            $result = $this->select($sql);
			return  $result;
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
        public function getCordeData($family_id,$flow,$date,$is_member=0,$Aid=0)
        {
			$member_id = $family_id;

			switch ($flow){
				case "0":
					$sql = $is_member ? "SELECT * FROM  ".$this->_record_lib." WHERE  from_unixtime(C_date)>='".date('Y-m-d',$date)."'  AND U_id = '".$member_id."' AND Flow = '0'": ($Aid ? "SELECT * FROM  ".$this->_record_lib." WHERE ID = '".$Aid."'":"SELECT * FROM  ".$this->_record_lib." WHERE from_unixtime(C_date)>='".date('Y-m-d',$date)."'  AND F_id = '".$family_id."' AND Flow = '0'");
					break;
				case "1":
					$sql = $is_member ? "SELECT * FROM  ".$this->_record_lib." WHERE from_unixtime(C_date)>='".date('Y-m-d',$date)."'  AND U_id = '".$member_id."' AND Flow = '1'": ($Aid ? "SELECT * FROM  ".$this->_record_lib." WHERE ID = '".$Aid."'":"SELECT * FROM  ".$this->_record_lib." WHERE from_unixtime(C_date)>='".date('Y-m-d',$date)."'  AND F_id = '".$family_id."'  AND Flow = '1'");
					break;
				case "bug":
					$sql = $is_member ? "SELECT ID,U_id,F_id,B_type,case B_level when 1 then '一般' when 2 then '重要' when 3 then '特重要' when 4 then '无法使用' end as B_level,B_title,B_centent,C_date,case Status when 0 then '新增' when 1 then '处理中' when 2 then '己解决' when 3 then '己关闭' end as Status  FROM ".$this->_bug." WHERE U_id = '".$member_id."' AND Status = '".$date."'" :  ($Aid ?  "SELECT ID,U_id,F_id,B_type,case B_level when 1 then '一般' when 2 then '重要' when 3 then '特重要' when 4 then '无法使用' end as B_level,B_title,B_centent,C_date,case Status when 0 then '新增' when 1 then '处理中' when 2 then '己解决' when 3 then '己关闭' end as Status FROM  ".$this->_bug." WHERE ID = '".$Aid."'" : "SELECT ID,U_id,F_id,case B_type when 'bug' then '缺陷' when 'suggestion' then '建议' end as B_type,case B_level when 1 then '一般' when 2 then '重要' when 3 then '特重要' when 4 then '无法使用' end as B_level,B_title,B_centent,C_date,case Status when 0 then '新增' when 1 then '处理中' when 2 then '己解决' when 3 then '己关闭' end as Status  FROM  ".$this->_bug." WHERE F_id = '".$family_id."'");
					break;
				case "bank_card":
					$sql = $is_member ? "SELECT * FROM  ".$this->_bank_card." WHERE U_id = '".$member_id."'"   : ($Aid ? "SELECT * FROM  ".$this->_bank_card." WHERE ID = '".$Aid."'" : "SELECT * FROM  ".$this->_bank_card." WHERE F_id = '".$family_id."'");
					break;
			}

			$result = $this->select($sql);

            return $result;
        }

       /* 添加收入\支出数据函数 $flow,$user_id,$family_id,$mantype_id,$subtype_id,$address,$menoy,$notes */
        public function addCordeData($flow,$member_id,$family_id,$bank_id,$mantype_id,$subtype_id,$address_id,$money,$notes)
        {
            
			switch($flow){
				case "0":
					$sql = "INSERT INTO ".$this->_record_lib." (ID,U_id,F_id,B_id,M_id,S_id,A_id,Flow,Money,Notes,C_date) VALUES ('','".$member_id."','".$family_id."','".$bank_id."','".$mantype_id."','".$subtype_id."','".$address_id."','0','".$money."','".$notes."','".time()."')";
					$cmoney = $money-$money*2;
					break;
				case "1":
					$sql = "INSERT INTO ".$this->_record_lib."  (ID,U_id,F_id,B_id,M_id,S_id,A_id,Flow,Money,Notes,C_date) VALUES ('','".$member_id."','".$family_id."','".$bank_id."','".$mantype_id."','".$subtype_id."','".$address_id."','1','".$money."','".$notes."','".time()."')";
					$cmoney = $money;
					break;
			}
			
			$this->updateMoney($member_id,$family_id,$bank_id,$cmoney ,"");

            return $this->insert($sql);
        }

		/*更新收入/支出记录函数 */
        public function updateCordeData($flow,$Aid,$member_id,$family_id,$mantype_id,$subtype_id,$address,$money,$notes)
        {
			switch($flow){
				case "0":
					$sql = "UPDATE ".$this->_record_lib." SET Money = '".$money."',M_id = '".$mantype_id."',S_id = '".$subtype_id."',A_id = '".$address."', Notes = '".$notes."'  WHERE ID = '".$Aid."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_record_lib."  WHERE ID = '".$Aid."' AND U_id = '".$member_id."'";
					break;
				case "1":
					$sql = "UPDATE ".$this->_record_lib." SET Money = '".$money."',M_id = '".$mantype_id."',S_id = '".$subtype_id."',A_id = '".$address."', Notes = '".$notes."'  WHERE ID = '".$Aid."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_record_lib."  WHERE ID = '".$Aid."' AND U_id = '".$member_id."'";
					break;
			}

			/* 记录修改前的资料 START */
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_record_lib." 原记录: ";
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
		public function addTypeData($in_out,$family_id,$flow,$typename,$is_display=1,$man_id=0){
			switch($in_out){
				case 'mantype':
				case 'subtype':
					$man_store = $this->select("select max(Store) from mantype Where F_id = '".$family_id."' AND Flow = '".$flow."'");
					$sub_store = $this->select("select max(Store) from subtype WHERE M_id = '".$man_id."' AND F_id ='".$family_id."'");
					if ( $man_id == 0 ){
						$sql = "INSERT INTO ".$this->_mantype ." (ID,F_id,Is_d,Store,Flow,Name,C_date) VALUES ('','".$family_id."','".$is_display."','".($man_store['0']['0']+1)."','".$flow."','".$typename."','".time()."')" ;
					} else {
						$sql = "INSERT INTO ".$this->_subtype ." (ID,F_id,M_id,Is_d,Store,Name,C_date) VALUES ('','".$family_id."','".$man_id."','".$is_display."','".($sub_store['0']['0']+1)."','".$typename."','".time()."')";
					}
					break;
				case 'address':
					$addr_store = $this->select("select max(Store) from ".$this->_address." Where F_id = '".$family_id."'");

					$sql = "INSERT INTO ".$this->_address ." (ID,F_id,Is_d,Store,Name,C_date) VALUES ('','".$family_id."','".$is_display."','".($addr_store['0']['0']+1)."','".$typename."','".time()."')";
					break;
			}
			return $this->insert($sql);
		}

		/* 更新收入\支出类别 */
		public function updateTypeData($in_out,$family_id,$Aid=0,$typename,$is_display=0,$man_id=0){
			switch($in_out){
				case "mantype":
					$sql ="UPDATE ".$this->_mantype." SET Name = '".$typename."',Is_d = '".$is_display."' WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";

					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_mantype."  WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_mantype." 原记录: ";
					break;
			case "subtype":
					$sql ="UPDATE ".$this->_subtype." SET Name = '".$typename."',Is_d = '".$is_display."',M_id = '".$man_id."' WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					
					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_subtype."  WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_mantype." 原记录: ";
					break;
			case "mantype":
					$sql ="UPDATE ".$this->_mantype." SET Name = '".$typename."',Is_d = '".$is_display."' WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";

					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_mantype."  WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_mantype." 原记录: ";
					break;
			case "subtype":
					$sql ="UPDATE ".$this->_subtype." SET Name = '".$typename."',Is_d = '".$is_display."',M_id = '".$man_id."' WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					
					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_subtype."  WHERE id = '".$Aid."' AND family_id = '". $family_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_mantype." 原记录: ";
					break;
			case "address":
					$sql ="UPDATE ".$this->_address." SET Name = '".$typename."',Is_d = '".$is_display."' WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";

					/* 记录修改前的资料 START */
					$old_corde_sql ="SELECT * FROM ".$this->_address."  WHERE ID = '".$Aid."' AND F_id = '". $family_id."'";
					$old_corde1 = $this->select($old_corde_sql);
					$old_corde = "表名:".$this->_mantype." 原记录: ";
					break;
			}
			return $this->update($sql);
		}


        /*  添加用户函数 */
        public function AddMember($is_disable=0,$user_name,$email,$qq,$money,$notes,$family_id)
        {
			$this->begintransaction();

            $sql = "INSERT INTO ".$this->_family_member." (ID,F_id,Is_d,Name,Notes,Skin,Email,Sum,QQ,Money,C_date,L_date)   VALUES  ('','".$family_id."','".$is_disable."','".$user_name."','".$notes."','0','".$email."','0','".$qq."','".$money."','".time()."','')";

			$sql2 = "UPDATE ".$this->_family." set Member=Member+'1'";
			
			$sql3 = "SELECT Member from ".$this->_family."  WHERE ID = '".$family_id."'";
			
			if ( $this->insert($sql) != false && $this->update($sql2) != false ){
				$Member_num = $this->select($sql3);
				$_SESSION['__familydata']['0']['Member'] = $Member_num['0']['Member'];

				$this->commit();
				return true;
			}else{
				$this->rollback();
				return false;
			}       
        }


        /*  注册家庭函数 */
        public function RegistrFamily($familyname,$familyalias,$password,$adm_email)
        {
			$this->begintransaction();
			$sql = "INSERT INTO ".$this->_family." (ID,Is_d,Name,Alias,L_pass,C_pass,A_pass,Notes,Email,C_date,L_date,Sum,Session)  VALUES  ('','0','".$familyname."','".$familyalias."',password('".$password."'),'".$password."','','','".$adm_email."','".time()."','','0','')";

            $sql_family_id = "SELECT ID from ".$this->_family." where  Name = '".$familyname."'";

			if ($this->insert($sql) != false){
				$family_id = $this->select($sql_family_id);
				$this->insertDefault($family_id['0']['0']);
				$this->commit();
				return true;
			}else{
				$this->rollback();
				return false;
			}
        }

      /* 更新用户数据函数 */
        public function updateMember($is_disable,$user_name,$email,$qq,$money,$notes,$alter_id=0)
        {
			$sql = "UPDATE ".$this->_family_member." SET Is_d = '".$is_disable."',Name = '".$user_name."',Email='".$email."',QQ='".$qq."',Money = '".$money."',Notes = '".$notes."'  WHERE ID = '".$alter_id."'";
			
			$old_corde_sql = "SELECT * FROM ".$this->_family_member."  WHERE ID = '".$alter_id."'";


			/* 记录修改前的资料 START */
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_family_member." 原记录: ";
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);

			$current_member = $_SESSION['current_member'] ;
			$_SESSION['__memberdata'][$current_member]['Money'] = $money ;
			 
			/*  记录修改前的资料 END */
            return $this->update($sql);


        }



      /* 获取用户数据函数 */
        public function getMember($member_id,$isdisplay=0,$alter_id=0)
        {
            if ($alter_id!="0"){
				$sql = "SELECT * FROM ".$this->_family_member." WHERE ID = '".$alter_id."'";  
			} else {
				$sql = $isdisplay ? "SELECT * FROM ".$this->_family_member." WHERE U_id = '".$user_id:"SELECT * FROM ".$this->_family_member." WHERE Is_d = '0'";  
			}
            return $this->select($sql);
        }


        /*  获取家庭用户函数 */
        public function getUserData($family_id=0)
        {
			$sql = "SELECT * FROM ".$this->_family_member." where F_id =  '".$family_id."'";
			return $this->select($sql);
        }


         /* 获取主类函数  */
        public function getManType($family_id,$flow,$isdisplay=0,$alter_id=0)
        {
			if ( $flow == "0" ) {
				if($alter_id != "0"){
					$sql = "SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."' AND ID = '".$alter_id."'";
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."'  AND Flow = '0' order by Store":"SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."' AND Is_d = '0' AND Flow = '0' order by Store";
				}
			}else if ( $flow == "1"){
				if($alter_id!="0"){
					$sql = "SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."' AND ID = '".$alter_id."'";
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."'  AND Flow = '1' order by Store":"SELECT * FROM  ".$this->_mantype." where F_id = '".$family_id."' AND Is_d = '0' AND Flow = '1' order by Store";
				}
			}
            return $this->select($sql);
        }

		 /* 获取子类函数  */
        public function getSubType($family_id,$flow,$isdisplay=0,$man_id=0,$sub_id=0)
        {
			if ($flow = "0" ) {
				if($man_id != "0"){
					if($sub_id != "0"){
						$sql = "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND M_id = '".$man_id."' AND ID = '".$sub_id."' order by Store";
					}else{
						$sql = "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND M_id = '".$man_id."' order by Store";
					}
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."'  order by Store":"SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND Is_d = '0' order by Store";
				}
			}else if ( $flow = "1" ){
				if($man_id!="0"){
					if($sub_id !="0"){
						$sql = "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND M_id = '".$man_id."' AND ID = '".$sub_id."' order by Store";
					}else{
						$sql = "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND M_id = '".$man_id."' order by Store";
					}
				}else{
					$sql = $isdisplay ? "SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."'    order by Store":"SELECT * FROM  ".$this->_subtype." where F_id = '".$family_id."' AND Is_d = '0' order by Store";
				}			
			}
            return $this->select($sql);
        }


       /* 获取地址函数 */
        public function getAddress($family_id,$isdisplay=0,$addr_id=0)
        {
            if ($addr_id!="0"){
				$sql = "SELECT * FROM ".$this->_address." WHERE F_id = '".$family_id."' AND ID = '".$addr_id."'";  
			} else {
				$sql = $isdisplay ? "SELECT * FROM ".$this->_address." WHERE F_id = '".$family_id."'  order by store":"SELECT * FROM ".$this->_address." WHERE F_id = '".$family_id."'  AND Is_d = '0' order by store";  
			}
            return $this->select($sql);
        }


		/*  收入、支出、地址下拉菜单函数  */
		public function select_type($family_id,$flow,$Aid=0){
				$ManType = $this->getManType($family_id,$flow);
				$SubType = $this->getSubType($family_id,$flow);
				$Address = $this->getAddress($family_id);

				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "主类数量".count($ManType);
					echo "子类数量".count($SubType);
					echo "地址数量".count($Address);
					echo "<br>DEBUG END*********************************************<br>";	
				}

				$alert_corde = $this->getCordeData(0,$flow,0,0,$Aid);
				if(DEBUG_YES){ 
					echo "<br>DEBUG START*********************************************<br>";
					echo "修改的Aid为：";
					print_r($alert_corde);
					echo "<br>DEBUG END*********************************************<br>";	
				}
				
				
				echo "<script>";

				for ($i=0;$i<count($SubType);$i++){
					echo "SubType['".$i."'] = new Array('".$SubType[$i]['ID']."','".$SubType[$i]['M_id']."','".$SubType[$i]['Name']."');";
				}

				echo "</script>";
				echo "<span><select id=\"mantype_id\" name=\"mantype_id\" onChange=\"sSubType();\">";
				echo "<option value=\"\">--选择主类--</option>";
				if ( $ManType != 0 ) {
					for ($i=0;$i<count($ManType);$i++){
						$str = $ManType[$i]['ID'] == $alert_corde['0']['M_id'] ? "<option selected=\"selected\" value=\"".$ManType[$i]['ID']."\">".$ManType[$i]['Name']."</option>":"<option value=\"".$ManType[$i]['ID']."\">".$ManType[$i]['Name']."</option>";
						echo $str;
					}
				}
				echo "</select>";
				echo "<select id=\"subtype_id\" name=\"subtype_id\"><option value=\"\">--选择子类--</option></select></span>";
				if ($Aid != 0){
					echo "<script>sSubType('".$alert_corde['0']['S_id']."')</script>";
				}
				echo "<br>";
				echo "<span>地址:&nbsp;";
				echo "<select name=\"address\">";
				echo "<option value=\"\">--选择地址--</option>";
				for ($i=0;$i<count($Address);$i++){
					$str = $Address[$i]['ID'] == $alert_corde['0']['A_id'] ? "<option selected=\"selected\" value=\"".$Address[$i]['ID']."\">".$Address[$i]['Name']."</option>":"<option value=\"".$Address[$i]['ID']."\">".$Address[$i]['Name']."</option>";
					echo $str;
				}
				echo "</select></span>";

				echo "<br>";
				echo "<span>金额:&nbsp;";
				$str =  $Aid ? "<input  type=\"text\" name=\"money\" size=\"8\" value=\"".$alert_corde['0']['Money']."\"></span><br>":"<input  type=\"text\" name=\"money\" size=\"8\" value=\"0\"></span><br>";
				echo $str;
				echo "<span>说明:&nbsp;";
				$str =  $Aid ? "<input  type=\"text\" name=\"notes\" size=\"20\" value=\"".$alert_corde['0']['Notes']."\"></span><br>":"<input  type=\"text\" name=\"notes\" size=\"20\" value=\"\"></span><br>";
				echo $str;
			}

         /* 转换ID->名称函数*/
        public function convertID($id,$table)
        {		
			switch($table){
				case "bank_card" :
					if ( $id == "0" ){ 
						return "钱包"; 
						break;
					}
				default:
					$sql = "SELECT Name FROM ".$table." WHERE ID = '".$id."'";
			}
				
			
			$result = $this->select($sql);
			foreach( $result as $key => $value)
			{
				return $value[0];
			}
        }


        /*删除收入支出与各主类了类记录函数 */
        public function delCorde($flow,$family_id,$corde_id,$member_id)
        {
			switch($flow){
				case "0":
					$sql = "DELETE FROM ".$this->_record_lib." where ID = '".$corde_id."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_record_lib."  where ID = '".$corde_id."' AND U_id = '".$member_id."'";
					break;
				case "1":
					$sql = "DELETE FROM ".$this->_record_lib." where ID = '".$corde_id."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * FROM ".$this->_record_lib."  where ID = '".$corde_id."' AND U_id = '".$member_id."'";
					break;
				case "mantype":
					$sql = "DELETE mantype,subtype from mantype left join subtype on mantype.ID=subtype.M_id where mantype.ID='".$corde_id."' AND mantype.F_id = '".$family_id."'";
					$old_corde_sql = "SELECT * from mantype left join subtype on mantype.ID=subtype.M_id where mantype.ID='".$corde_id."' AND mantype.F_id = '".$family_id."'";
					break;
				case "subtype":
					$sql = "DELETE from ".$this->_subtype." where ID='".$corde_id."' AND F_id = '".$family_id."'";
					$old_corde_sql = "SELECT * from ".$this->_subtype." where ID='".$corde_id."' AND F_id = '".$family_id."'";
					break;
				case "address":
					$sql = "DELETE from ".$this->_address." where ID='".$corde_id."' AND F_id = '".$family_id."'";
					$old_corde_sql = "SELECT * from ".$this->_address." where ID='".$corde_id."' AND F_id = '".$family_id."'";
					break;
				case "family":
					$sql = "DELETE from ".$this->_family_member." where ID='".$corde_id."'";
					$old_corde_sql = "SELECT * from ".$this->_family_member." where ID='".$corde_id."'";

					$sql2 = "UPDATE ".$this->_family." SET Member = Member - 1  WHERE ID = '".$family_id."'";

					$sql3 = "SELECT Member from ".$this->_family."  WHERE ID = '".$family_id."'";
					break;
				case "bug":
					$sql = "DELETE from ".$this->_bug." where ID='".$corde_id."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * from ".$this->_bug." where ID='".$corde_id."' AND U_id = '".$member_id."'";
					break;
				case "bank_card":
					$sql = "DELETE from ".$this->_bank_card." where ID='".$corde_id."' AND U_id = '".$member_id."'";
					$old_corde_sql = "SELECT * from ".$this->_bank_card." where ID='".$corde_id."' AND U_id = '".$member_id."'";
					break;
			}

            
			/* 记录修改前的资料 START */	
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_record_lib." 原记录: ";

			
			for($j=0;$j<count($old_corde1);$j++) {
				for($i=0;$i<count($old_corde1[$j]);$i++) {
					$old_corde .= "'".$old_corde1[$j][$i]."',";
				}
				$old_corde .= " | ";
			}

			$this->corde_sql_log($old_corde);
			/*  记录修改前的资料 END */

			if ( $this->delete($sql) ) {
				if ( $in_out == "family" ){
					$this->update($sql2);
					$Member_num = $this->select($sql3);
					$_SESSION['__familydata']['0']['Member'] = $Member_num['0']['Member'];
				}
				return true;
			} else {
				return false;
			}
            
        }

        /*  往前地址排序函数 */
        public function down_up($in_out,$family_id,$man_id=0,$id,$isup=0)
        {
			
			$num = 0;
			switch($in_out){
				case "mantype":
					$store_num = $this->select("SELECT Store,Flow from ".$this->_mantype." where ID = '".$id."'");
					$flow = $store_num['0']['Flow'] == "0" ? 0 : 1;

					$store_max = $this->select("SELECT max(Store) from ".$this->_mantype." where F_id = '".$family_id."' AND Flow = '".$flow."'");
					if ($isup && $store_num['0']['0'] > 0){
						$num=$store_num['0']['0']-1==0 ? $store_max['0']['0']:$store_num['0']['0']-1;
					}else if($store_num['0']['0'] <= $store_max['0']['0']){
						$num=$store_num['0']['0']+1 > $store_max['0']['0'] ? 1:$store_num['0']['0']+1;
					} else{
						break;
					}
					$sql = "UPDATE ".$this->_mantype." SET Store = '0' where Store = '".$num."' AND F_id ='".$family_id."' AND Flow = '".$flow."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_mantype." SET Store = '".$num."' where Store = '".$store_num['0']['0']."' AND F_id ='".$family_id."' AND Flow = '".$flow."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_mantype." SET Store = '".$store_num['0']['0']."' where Store = '0' AND F_id ='".$family_id."' AND Flow = '".$flow."'";
					$this->update($sql);
					break;
				case "subtype":
					$store_num = $this->select("SELECT Store from ".$this->_subtype." where ID = '".$id."' AND M_id='".$man_id."'");
					$store_max = $this->select("SELECT max(Store) from ".$this->_subtype." where M_id = '".$man_id."'");
					if ($isup && $store_num['0']['0'] > 0){
						$num=$store_num['0']['0']-1==0 ? $store_max['0']['0']:$store_num['0']['0']-1;
					}else if($store_num['0']['0'] <= $store_max['0']['0']){
						$num=$store_num['0']['0']+1 > $store_max['0']['0'] ? 1:$store_num['0']['0']+1;
					} else{
						break;
					}
					$sql = "UPDATE ".$this->_subtype." SET Store = '0' where Store = '".$num."' AND F_id ='".$family_id."' AND M_id ='".$man_id."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_subtype." SET Store = '".$num."' where Store = '".$store_num['0']['0']."' AND F_id ='".$family_id."'  AND M_id ='".$man_id."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_subtype." SET Store = '".$store_num['0']['0']."' where Store = '0' AND F_id ='".$family_id."'  AND M_id ='".$man_id."'";
					$this->update($sql);
					break;

				case "address":
					$store_num = $this->select("SELECT Store from ".$this->_address." where ID = '".$id."'");
					$store_max = $this->select("SELECT max(Store) from ".$this->_address." where F_id = '".$family_id."'");
					if ($isup && $store_num['0']['0'] > 0){
						$num=$store_num['0']['0']-1==0 ? $store_max['0']['0']:$store_num['0']['0']-1;
					}else if($store_num['0']['0'] <= $store_max['0']['0']){
						$num=$store_num['0']['0']+1 > $store_max['0']['0'] ? 1:$store_num['0']['0']+1;
					} else{
						break;
					}
					$sql = "UPDATE ".$this->_address." SET Store = '0' where Store = '".$num."' AND F_id ='".$family_id."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_address." SET Store = '".$num."' where Store = '".$store_num['0']['0']."' AND F_id ='".$family_id."'";
					$this->update($sql);

					$sql = "UPDATE ".$this->_address." SET Store = '".$store_num['0']['0']."' where Store = '0' AND F_id ='".$family_id."'";
					$this->update($sql);
					break;
			}
        }

		/*  记录事件日志 */
        public function CrodeLog($text_log = "")
        {
			$info_log = "文件:".$_SERVER['PHP_SELF']." 上一页面:".$_SERVER['HTTP_REFERER']." 协议:".$_SERVER['SERVER_PROTOCOL']." 当前主机:".$_SERVER['SERVER_NAME']." 当标识:".$_SERVER['SERVER_SOFTWARE']." 方法:".$_SERVER['REQUEST_METHOD']." HTTP主机:".$_SERVER['HTTP_HOST']." 客户端主机名:".$_SERVER['REMOTE_HOST']." 客户端浏览器:".$_SERVER['HTTP_USER_AGENT']." 客户端IP:".$_SERVER['REMOTE_ADDR']." 请求头信息:".$_SERVER['HTTP_ACCEPT']." 代理头信息:".$_SERVER['HTTP_USER_AGENT'];
            $sql = "INSERT INTO ".$this->_log.date('Ym')."  VALUES ('','".$_SESSION['__memberdata']['0']["ID"]."','".$_SESSION['__familydata']['0']['ID']."',\"".$text_log."\",\"".$info_log."\",'".$_SESSION['__global_logid']."','".time()."')";
            return $this->insert_log($sql);
        }


	 public function PostMessage(){
		if ( !is_null($_SESSION['__global_logid'])) {
			$error_info	= $this->convertLogIdToContent($_SESSION['__global_logid']);
			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($error_info); 
				echo "<br>DEBUG END*********************************************<br>";	
			} else {
				echo "<script>PostMessage(\"".$error_info['0']['content']."\");</script>";
				$_SESSION['__global_logid']=NULL;
			}
		} else {
			echo "<script>PostMessage();</script>";
		}
	 }

	 /* 更新用户Skin ID */
	 public function UpdateSkin($login_member_id,$skin){
		$skin_num = $this->update("update ".$this->_family_member." set Skin = '".$skin."' where ID = '".$login_member_id."'");
		
		if ($skin_num){
			return true;
		} else {
			return false;
		}
	 }


        /*  添加用户默认主类数据 */
        public function insertDefault($family_id)
        {
            $sql = "INSERT INTO ".$this->_mantype." (ID,F_id,Is_d,Store,Flow,Name,C_date)   VALUES  ('','".$family_id."','0','1','0','衣服类','".time()."'),('','".$family_id."','0','2','0','饮食类','".time()."'),('','".$family_id."','0','3','0','住房类','".time()."'),('','".$family_id."','0','4','0','交通类','".time()."'),('','".$family_id."','0','5','0','个人消费类','".time()."'),('','".$family_id."','0','6','0','网络类','".time()."')";
            $this->insert($sql);

            $sql = "INSERT INTO ".$this->_mantype." (ID,F_id,Is_d,Store,Flow,Name,C_date)   VALUES  ('','".$family_id."','0','1','1','固定收入','".time()."'),('','".$family_id."','0','2','1','第三方收入','".time()."')";
            $this->insert($sql);

			/*  添加用户默认地址 */
            $sql = "INSERT INTO ".$this->_address." (ID,F_id,Is_d,Store,name,C_date)   VALUES  ('','".$family_id."','0','1','住房处','".time()."'),('','".$family_id."','0','2','公司','".time()."'),('','".$family_id."','0','3','超市菜市场','".time()."'),('','".$family_id."','0','4','商场','".time()."'),('','".$family_id."','0','5','其他','".time()."')";
            $this->insert($sql);

			/* 添加收入子类与支出子类 */
            /* 衣服类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '衣服类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','服装','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','其他','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','鞋帽','".time()."')";
            $this->insert($sql);

            /* 饮食类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '饮食类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','早餐','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','午餐','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','晚餐','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','4','夜宵','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','5','其他','".time()."')";
            $this->insert($sql);

            /* 住房类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '住房类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','日常用品','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','家用电器','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','房租','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','4','其他','".time()."')";
            $this->insert($sql);

            /* 交通类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '交通类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','公交车','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','的士','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','地铁','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','4','火车','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','5','摩的','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','6','飞机','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','7','轮船','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','8','其他','".time()."')";
            $this->insert($sql);

            /* 个人消费类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '个人消费类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','零食','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','饮料','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','理发','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','4','其他','".time()."')";
            $this->insert($sql);

            /* 网络类----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '网络类' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','网络费','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','手机费','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','电话费','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','4','通信软硬件','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','5','其他','".time()."')";
            $this->insert($sql);

            /* 固定收入----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '固定收入' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','工资','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','奖金','".time()."')";
            $this->insert($sql);

            /* 第三方收入----------------------------------------------------------------------------- */
            $sql_mantype = "SELECT id from mantype where name = '第三方收入' and F_id = '".$family_id."'";
            $mantype_id = $this->select($sql_mantype);
            
            $sql = "INSERT INTO ".$this->_subtype." (ID,F_id,M_id,Is_d,Store,Name,C_date)   VALUES  ('','".$family_id."','".$mantype_id['0']['0']."','0','1','中奖','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','2','兼职','".time()."'),('','".$family_id."','".$mantype_id['0']['0']."','0','3','其他','".time()."')";
            $this->insert($sql);
        }

		 public function getReportData($scorde="0", $stype="member", $sdate="week",$family_id,$jump=0) {
				if ( $_SESSION['date_num'] < 100 ) {
					switch ( $sdate ) {
						case "week":
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=1\"><span>上一周</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=0\"><span>这周</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=2\"><span>下一周</span></a>&nbsp;&nbsp;";
							/* 上一周  1,这周 0 ,下一周 2 */
							$sdate_num = 7 ;
							echo "<br>";
							if ( $jump == 1 ) {
									$_SESSION['date_num']++;
									$time = time() - 87000 *7*$_SESSION['date_num'];
									$date_min =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 1 ,date( 'Y',$time));
									$date_max =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 7 , date('Y',$time));
							} else if ( $jump == 2) {
									if ( $_SESSION['date_num'] > 1 ) {
										$_SESSION['date_num']--;
										$time = time() - 87000 *7*$_SESSION['date_num'];
										$date_min =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 1 ,date( 'Y',$time));
										$date_max =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 7 , date('Y',$time));
									} else {
										$_SESSION['date_num'] = 0;
										$date_min =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 1 ,date( 'Y',time()));
										$date_max =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 7 , date('Y',time()));
									}
							} else {
								if ( is_numeric($_GET['d_num']) && $_GET['d_num'] != 0 ) { 
									$_SESSION['date_num'] = $_GET['d_num'] ;
									$time = time() - 87000 *7*$_SESSION['date_num'];
									$date_min =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 1 ,date( 'Y',$time));
									$date_max =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 7 , date('Y',$time));
								} else {
									$_SESSION['date_num'] = 0;
									$date_min =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 1 ,date( 'Y',time()));
									$date_max =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 7 , date('Y',time()));
								}
							}

							$date_filter = "C_date > '".$date_min."' AND C_date < '".$date_max."'"; 
							echo "时间: ".date('Y-m-d',$date_min)." 至 ".date('Y-m-d',$date_max)."<br>";
							break;
						case "month":
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=1\"><span>上个月</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=0\"><span>当月</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=2\"><span>下个月</span></a>&nbsp;&nbsp;";
							/* 上个月  1,当月 0 ,下个月 2 */
							echo "<br>";
							if ( $jump == 1 ) {
								$_SESSION['date_num']++;
								$sdate_num = date('t',mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time())));
								$date_month =  mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time()));
							} else if ( $jump == 2) {
								if ( $_SESSION['date_num'] > 1 ) {
									$_SESSION['date_num']--;
									$sdate_num = date('t',mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time())));
									$date_month =  mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time()));
								} else {
									$_SESSION['date_num'] = 0;
									$sdate_num = date('d',time());
									$date_month =  mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time()));
								}
							} else {
								if ( is_numeric($_GET['d_num']) && $_GET['d_num'] != 0 ) { 
									$_SESSION['date_num'] = $_GET['d_num'] ;
									$sdate_num = date('t',mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,0));
									$date_month =  mktime( 0,0, 0, date('m',time()) - $_SESSION['date_num'] ,1 ,date( 'Y',time()));
								} else {
									$_SESSION['date_num'] = 0;
									$sdate_num = date('d',time());
									$date_month = mktime( 0,0, 0, date('m',time()) ,1 ,date( 'Y',time()));
								}	
							}
							$date_filter = "from_unixtime(C_date) like '".date('Y-m',$date_month)."%'";
							echo "月份: ".date('Y-m',$date_month)." [共:".$sdate_num."天]<br>";

							break;
						case "year":
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=1\"><span>上一年</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=0\"><span>当年</span></a>&nbsp;&nbsp;";
							echo "<a href=\"main.php?page=report.php&scorde=".$scorde."&stype=".$stype."&sdate=".$sdate."&jump=2\"><span>下一年</span></a>&nbsp;&nbsp;";
							/* 上一年  1,当年 0 ,下一年 2 */
							echo "<br>";
							if ( $jump == 1 ) {
									$_SESSION['date_num']++;
									$date_year =  mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()) - $_SESSION['date_num']);
									$sdate_num = date('z',mktime( 0,0, 0, 12 ,31,date( 'Y',time()) - $_SESSION['date_num']));
							} else if ( $jump == 2) {
								if( $_SESSION['date_num'] > 0 ) {
									$_SESSION['date_num']-- ;
									$date_year =  mktime( 0,0, 0, 12,1 ,date( 'Y',time()) - $_SESSION['date_num'] );
									$sdate_num = date('z',mktime( 0,0, 0, 12,31 ,date( 'Y',time()) - $_SESSION['date_num'] ));
								} else {
									$_SESSION['date_num'] = 0;
									$date_year = mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()));
									$sdate_num = date('z',mktime( 0,0, 0, 12 ,31 ,date( 'Y',time())));
								}
							} else {
								if ( is_numeric($_GET['d_num']) && $_GET['d_num'] != 0 ) { 
									$_SESSION['date_num'] = $_GET['d_num'] ;
									$date_year =  mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()) - $_SESSION['date_num']);
									$sdate_num = date('z',mktime( 0,0, 0, date("m"),date("d") ,date( 'Y',time())));
								} else {
									$_SESSION['date_num'] = 0;
									$date_year = mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()));
									$sdate_num = date('z',mktime( 0,0, 0, date("m"),date("d") ,date( 'Y',time())));
								}
							}

							$date_filter = "from_unixtime(C_date) like '".date('Y',$date_year)."%'";
							echo "年份: ".date('Y',$date_year)." [共: ".$sdate_num."天]<br>";

							break;
						default:
							$date_filter = "C_date like '%' ";
					} 
				} else {
					$_SESSION['date_num'] = 0;
					$date_min =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 1 ,date( 'Y',time()));
					$date_max =  mktime( 0,0, 0, date('m',time()) ,date('d',time()) - date('N',time()) + 7 , date('Y',time()));
					$date_filter = "C_date > '".date('Y-m-d',$date_min)."%' AND C_date < '".date('Y-m-d',$date_max)."%'"; 
				}
				
				if ( $scorde == "in_out" ) {
					$sql = "SELECT sum(Money) FROM ".$this->_record_lib." WHERE ".$date_filter." AND F_id = '".$family_id."' AND Flow = '0'";
					$out_data = $this->select($sql);

					$sql = "SELECT sum(Money) FROM ".$this->_record_lib." WHERE ".$date_filter." AND F_id = '".$family_id."'  AND Flow = '1'";
					$in_data = $this->select($sql);


					$report_in_out['0']['0'] = $in_data['0']['0'] ;
					$report_in_out['0']['1'] = number_format( $in_data['0']['0'] / $sdate_num,2);
					$report_in_out['0']['2'] = $out_data['0']['0'] ;
					$report_in_out['0']['3'] = number_format( $out_data['0']['0'] / $sdate_num,2) ;
					$report_in_out['0']['4'] = number_format( $in_data['0']['0'] - $out_data['0']['0'],2) ;
					$report_in_out['0']['5'] = number_format( ($in_data['0']['0']-$out_data['0']['0']) / $sdate_num,2);


					return $report_in_out; 
				} else {
					switch ($stype) {
						case "mantype":
							$sql = "SELECT sum(Money),M_id,F_id FROM ".$this->_record_lib." WHERE  ".$date_filter."  AND F_id = '".$family_id."' AND Flow = '".$scorde."' group by M_id order by sum(Money) desc";
							break;
						case "member":
							$sql = "SELECT sum(Money),U_id,F_id FROM ".$this->_record_lib." WHERE ".$date_filter."   AND F_id = '".$family_id."' AND Flow = '".$scorde."' group by U_id order by sum(Money) desc";
							break;
						case "address":
							$sql = "SELECT sum(Money),A_id,F_id FROM ".$this->_record_lib." WHERE  ".$date_filter."  AND F_id = '".$family_id."' AND Flow = '".$scorde."' group by A_id order by sum(Money) desc";
							break;
					}
				return $this->select($sql);
			}
		 }

		  public function getSearchData($scorde, $mantype_id, $subtype_id, $address, $money, $notes, $d_num, $sdate,  $family_id) {
				$where_sql = is_numeric($mantype_id)  ?  " AND M_id = '".$mantype_id."' " : "" ;
				$where_sql .= is_numeric($subtype_id)  ?  " AND S_id = '".$subtype_id."' " : "" ;
				$where_sql .=  is_numeric($address)  ?  " AND A_id = '".$address."' " : "" ;
				$where_sql .= (is_numeric($money) && $money != 0)  ?  " AND Money = '".$money."' " : "" ;
				$where_sql .= $notes != ""  ?  " AND Notes like '%".$notes."%' " : "" ;

				switch ( $sdate ) {
					case "week":
						$time = time() - 87000 *7*$d_num;
						$date_min =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 1 ,date( 'Y',$time));
						$date_max =  mktime( 0,0, 0, date('m',$time) ,date('d',$time) - date('N',$time) + 7 , date('Y',$time));

						$date_filter = "C_date > '".$date_min."%' AND C_date < '".$date_max."%'"; 
						break;
					case "month":
						$date_month =  mktime( 0,0, 0, date('m',time()) - $d_num ,1 ,date( 'Y',time()));
						$date_filter = "from_unixtime(C_date) like '".date('Y-m',$date_month)."%'";
						break;
					case "year":	
						$date_year =  mktime( 0,0, 0, 12 ,1 ,date( 'Y',time()) - $d_num);
						$date_filter = "from_unixtime(C_date) like '".date('Y',$date_year)."%'";
						break;
					default:
						$date_filter = "C_date like '%' ";
					} 


			$sql = "SELECT * FROM ".$this->_record_lib." WHERE  ".$date_filter." ".$where_sql."  AND F_id = '".$family_id."' AND Flow = '".$scorde."'";
			/* echo $sql; */
			 return $this->select($sql);
			/*return $subtype_id;*/
		  }

		  /*  添加BUG	{ bug_level  	1:一般 2:重要 3:特重要 4:无法使用} { status  0: 新增  1:处理中  2: 己解决   3: 己关闭  4:  } */
		  public function addBUG($member_id,$family_id,$bug_type,$bug_level,$bug_title,$bug_centent) {
				$sql = "INSERT INTO ".$this->_bug."  (ID,U_id,F_id,B_type,B_level,Status,B_title,B_centent,C_date) values ('','".$member_id."','".$family_id."','".$bug_type."','".$bug_level."','0','".$bug_title."','".$bug_centent."','".time()."')";

				 return $this->insert($sql);
		  }

		public function updateBUG($bug_type,$bug_level,$bug_title,$bug_centent,$status,$alter_id){
			$set_sql = is_null($bug_type) ? "  " :  "B_type = '".$bug_type."' "   ;
			$set_sql .= is_null($bug_level) ?   " " : " ,B_level = '".$bug_level."' " ;
			$set_sql .= is_null($bug_title) ? " "  :  " ,B_title = '".$bug_title."' ";
			$set_sql .= is_null($bug_centent) ? " "  :  " ,B_centent = '".$bug_centent."' ";
			$set_sql .= is_null($status) ? " "  :  " ,Status = '".$status."' ";
			$sql = "update ".$this->_bug."  set  ".$set_sql."  WHERE ID = '".$alter_id."'";
	
			return $this->update($sql);
		}

	/* 添加银行卡 */
	public function addBankCard( $member_id,$family_id,$cardname,$cardnum,$cardtype,$cardaddr,$cardmoney,$notes,$alter_id,$is_disable ) {
			$card_store = $this->select("select max(Store) from bank_card Where F_id = '".$family_id."'");

			$sql = "INSERT INTO ".$this->_bank_card." (ID,U_id,F_id,Is_d,Name,C_num,C_type,C_addr,Money,Store,Notes,C_date) values ('','".$member_id."','".$family_id."','".$is_disable."','".$cardname."','".$cardnum."','".$cardtype."','".$cardaddr."','".$cardmoney."','".$card_store."','".$notes."','".time()."')";

			return $this->insert($sql);
		}
	/* 参数Type类型ID ，返回卡中文名称 */
	public function bankCardType($C_type_id){
		switch($C_type_id){
			case "1" :
				return "储蓄卡";
				break;
			case "2" :
				return "信用卡";
				break;
			case "3" :
				return "支付宝卡";
				break;
			case "4" :
				return "存折";
				break;
			default:
				return "未知卡";
		}
	}


	/* 更新银行卡 */
	public function updateBankCard($member_id,$cardname,$cardnum,$cardtype,$cardaddr,$cardmoney,$notes,$alter_id,$is_disable) {
			$set_sql = is_null($cardname) ? "  " :  "Name = '".$cardname."' "   ;
			$set_sql .= is_null($cardnum) ?   " " : " ,C_num = '".$cardnum."' " ;
			$set_sql .= is_null($cardtype) ?   " " : " ,C_type = '".$cardtype."' " ;
			$set_sql .= is_null($cardaddr) ?   " " : " ,C_addr = '".$cardaddr."' " ;
			$set_sql .= is_null($cardmoney) ?   " " : " ,Money = '".$cardmoney."' " ;
			$set_sql .= is_null($notes) ?   " " : " ,Notes = '".$notes."' " ;
			$set_sql .= is_null($is_disable) ?   " " : " ,Is_d = '".$is_disable."' " ;

			$sql = "UPDATE ".$this->_bank_card." SET  ".$set_sql." WHERE ID = '".$alter_id."' AND U_id = '".$member_id."'";

			return $this->update($sql);
	}

	/* 修改用户现金 */
	public function updateMoney($member_id,$family_id,$mtype_id,$cmoney,$alter_id){
		if ( $mtype_id == "0" ){
			if ( $alter_id == "") {
				$sql = "UPDATE ".$this->_family_member." set Money = Money + '".$cmoney."' WHERE ID = '".$member_id."' AND F_id = '".$family_id."'" ;
				
				$current_member = $_SESSION['current_member'] ;
				$_SESSION['__memberdata'][$current_member]['Money'] = $_SESSION['__memberdata'][$current_member]['Money'] + $cmoney;
			} else {
				$sql = "UPDATE ".$this->_family_member." set Money = '".$cmoney."' WHERE ID = '".$alter_id."' AND F_id = '".$family_id."'" ;
				$current_member = $_SESSION['current_member'] ;
				$_SESSION['__memberdata'][$current_member]['Money'] = $cmoney;
			}
		} else {
			$sql = "UPDATE ".$this->_bank_card." set Money = Money + '".$cmoney."' WHERE U_id = '".$member_id."' AND F_id = '".$family_id."' AND ID = '".$mtype_id."'" ;
		}

		return $this->update($sql);			
	}

	/* 添加表格一个字段"create_date2", 将旧数据库 create_date的日期 转为 create_date2的时间截  */
	public function Tab_Date($table)
	{
		$sql = "select * from ".$table;
		$start_date = $this->select($sql);
		echo "共转换条数: ".count($start_date);

		for ( $i= "0"; $i < count($start_date) ;$i++) {
			$sql2 = "update ".$table." set create_date2 = ".strtotime($start_date[$i]['create_date'])."  WHERE id = '".$start_date[$i]['id']."'" ;
			$this->select($sql2);
		}
	}



/*  以上内容为优化内容  ####################################################################################################*/


        /*  以用户名来获取用户ID函数 */
        public function getUserID($username)
        {
            $sql = "SELECT id FROM ".$this->_users." Where username = '".$username."'";
            return $this->select($sql);
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
            $sql = "INSERT INTO ".$this->_groups." (id,groupname,group_alias,groupadmin_id,password,notes,create_date)   VALUES  ('','".$group_name."','".$group_alias."','".$_SESSION['__useralive'][0]."','".$group_password."','".$notes."','".time()."')";
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
                $sql = "INSERT INTO ".$this->_user_group." (id,user_id,group_id,create_date,disable)   VALUES  ('','".$user_id."','".$group_id."','".time()."','0')";
            } else {
                $sql = "INSERT INTO ".$this->_user_group." (id,user_id,group_id,create_date)   VALUES  ('','".$user_id."','".$group_id."','".time()."')";
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
            $sql = "INSERT INTO   ".$this->_mantype . "  VALUES ('','".$user_id."','".$store."','".$is_display."','".$addmantypename."','".time()."')";
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
            $sql = "SELECT Id,Name FROM  ".$this->$typelist." WHERE U_id = '".$_SESSION['__memberdata']['0']['Id']."' AND Is_d = '0' order by Store";
            return $this->select($sql);
        }

        public  function  getSubTypeList($typelist)
        {
            $sql = "SELECT Id,M_id,Name FROM  ".$this->$typelist." WHERE U_id = '".$_SESSION['__memberdata']['0']['Id']."' AND Is_d = '0' order by M_id,Store";
            return $this->select($sql);
        }

          /*写入支出主类函数 */
        public function insertOutManType($user_id,$store,$is_display,$addmantypename)
        {
            $sql = "INSERT INTO   ".$this->_mantype . "  VALUES ('','".$user_id."','".$store."','".$is_display."','".$addmantypename."','".time()."')";
            return $this->insert($sql);
        }


        /*  把数据写入收入支出表函数 */
        public function insertInOutRecord($in_record_lib,$money,$mantype_id,$subtype_id,$address_id,$notes)
        {
            $sql = "INSERT INTO ".$this->$in_record_lib ."  VALUES ('','".$money."','".$_SESSION['__useralive'][0]."','".$_SESSION['__group_id']."','".$mantype_id."','".$subtype_id."','".$address_id."','".$notes."','".time()."')";
            return $this->insert($sql);
        }




        /*更新收入记录函数 */
        public function     updateInCorde($id,$money,$mantype_id,$subtype_id,$address_id,$notes)
        {
            $sql = "UPDATE ".$this->_record_lib." SET money = '".$money."',mantype_id = '".$mantype_id."',subtype_id = '".$subtype_id."',addr_id = '".$address_id."', notes = '".$notes."'  WHERE id = '".$id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->_record_lib."  WHERE id = '".$id."' AND user_id = '". $_SESSION['__useralive'][0]."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->_record_lib." 原记录: ";
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
        public function deleteUserData($in_record_lib,$user_id)
        {
            $sql = "DELETE FROM ".$this->$in_record_lib." where user_id = '".$user_id."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_record_lib."  where user_id = '".$user_id."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_record_lib." 原记录: ";
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
        public function deleteUserDataForGroupAdmin($in_record_lib)
        {
            $sql = "DELETE FROM ".$this->$in_record_lib." where group_id = '".$_SESSION['__group_id']."'";
			/* 记录修改前的资料 START */
			$old_corde_sql = "SELECT * FROM ".$this->$in_record_lib."  where group_id = '".$_SESSION['__group_id']."'";
			$old_corde1 = $this->select($old_corde_sql);
			$old_corde = "表名:".$this->$in_record_lib." 原记录: ";
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
            $sql = "INSERT INTO ".$this->$typetable." values ('','".$_SESSION['__useralive'][0]."','".$man_id."','".$store."','".$is_display."','".$name."','".time()."')";
            
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
            $sql = "INSERT INTO ".$this->_address."  VALUES ('','".$_SESSION['__useralive'][0]."','".$store."','".$is_display."','".$addr_name."','".time()."')";
            
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
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月支出数据*/
        public function getReportOutMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得指定用户每月支出数据函数 */
        public function getReportPersonOutMonth($user_id,$month1)
        {
            $sql = "SELECT * FROM ".$this->_record_lib." WHERE user_id = '".$user_id."' AND create_date like '".$month1."%'";        
            return $this->select($sql);
        }


        /*获得每月支出地址数据*/
        public function getReportOutAddrMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  group by addr_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by addr_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,addr_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by addr_id";
            }
            return $this->select($sql);
        }

        /*获得每月支出主类数据*/
        public function getReportOutManTypeMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  group by mantype_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by mantype_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,mantype_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by mantype_id";
            }
            return $this->select($sql);
        }

        /*获得每月支出主类数据函数 */
        public function getReportOutManTypeMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月支出地址数据函数 */
        public function getReportOutAddrMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得每月收入数据*/
        public function getReportInMonthTotal($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }

        /*获得每月收入数据函数 */
        public function getReportInMonth($month)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$month."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }

        /*获得指定用户每月收入数据函数 */
        public function getReportPersonInMonth($user_id,$month1)
        {
            $sql = "SELECT * FROM ".$this->_record_lib." WHERE user_id = '".$user_id."' AND create_date like '".$month1."%'";        
            return $this->select($sql);
        }

        /*获得每年支出数据*/
        public function getReportOutYearTotal($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得每年支出数据函数 */
        public function getReportOutYear($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }


        /*获得指定用户每年支出数据函数 */
        public function getReportPersonOutYear($user_id,$year1)
        {
            $sql = "SELECT * FROM ".$this->_record_lib." WHERE user_id = '".$user_id."' AND create_date like '".$year1."%'";        
            return $this->select($sql);
        }


        /*获得每年收入数据*/
        public function getReportInYearTotal($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%'  group by user_id";
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%'  AND user_id = '".$_SESSION['__useralive'][0]."'  group by user_id";
            } else {
                $sql = "SELECT count(*),sum(money),user_id,group_id FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."' group by user_id";
            }
            return $this->select($sql);
        }


        /*获得每年支收入数据函数 */
        public function getReportInYear($year)
        {
            if($_SESSION['__useralive'][0] == 1 )
            {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_POST["group_id"]."'";    
            } else if ( $_SESSION['__groupname'] == "公共组" ) {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND user_id = '".$_SESSION['__useralive'][0]."'";
            } else {
                $sql = "SELECT * FROM ".$this->_record_lib." WHERE create_date like '".$year."%' AND group_id = '".$_SESSION['__group_id']."'";    
            }
            return $this->select($sql);
        }


        /*获得指定用户每年收入数据函数 */
        public function getReportPersonInYear($user_id,$year1)
        {
            $sql = "SELECT * FROM ".$this->_record_lib." WHERE user_id = '".$user_id."' AND create_date like '".$year1."%'";        
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
		
    }



	/*------------------------------------------------------------------------------------------*/


    /* 创建一个类变量 */
    $Finance = new Finance();


	
	/* 连接到日志数据库 */
	$Finance->_construct_log();

    /* 连接到主数据库 */
    $Finance->_construct();

	/* 创建日志表 */
	$Finance->create_log_table();
?>
