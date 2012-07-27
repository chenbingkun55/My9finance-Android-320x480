<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle2')</script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=fun_manager.php&add_type=".$_GET['add_type'];?>" method="post">

<?PHP 	
	$recordtype = $_GET['add_type'];
	$UP = $_GET['UP'];
	$DOWN = $_GET['DOWN'];
	$ViewS = $_GET['ViewS'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];


	/*
		添加表单:
	*/
	if  ( $recordtype == 'out_mantype' )
	{
		if ( $add_submit == 1 ){
			$mantype = $_POST['mantype'];
			$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype值为：".$_POST['mantype']."<br>";
				echo "is_display值为：".$_POST['is_display']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->addTypeData($recordtype,$login_user_id,$mantype,$is_display,0)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}

		if (!(is_null($Did)) && !(is_null($login_user_id))){
			if ($Finance->delType($recordtype,$login_user_id,$Did)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}


		echo "添加主支出类别 名称:&nbsp;<br>";
		echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"\"></span>";
		echo "是否显示";
		echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
		echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
		echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";

		$man_type = $Finance->getManType($login_user_id,"out",1);

		$table_title = array("序号","状态","名称","排序","主类操作","子类操作");
		
		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($man_type);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$YesNo=$man_type[$i]['is_display']? "启用":"禁用"."</td>";
			echo "<td>".$man_type[$i]['name']."</td>";
			echo "<td><span class=\"click\" onClick=\"MoveUp('".$man_type[$i]['id']."')\">上移</span>|<span class=\"click\" onClick=\"MoveDown('".$man_type[$i]['id']."')\">下移</span></td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$man_type[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$man_type[$i]['id']."')\">删除</span></td>";
			echo "<td><span class=\"click\" onClick=\"ListSubtype('".$man_type[$i]['id']."')\">查看子类</span></td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($man_type);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}
	} else if ( $recordtype == 'in_mantype' ){
		if ( $add_submit == 1 ){
			$mantype = $_POST['mantype'];
			$_POST['is_display'] == "on" ? $is_display = "1" : $is_display = "0" ;

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype值为：".$_POST['mantype']."<br>";
				echo "is_display值为：".$_POST['is_display']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->addTypeData("in",$login_user_id,$mantype,$is_display,0)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}


		echo "添加主收入类别 名称:&nbsp;<br>";
		echo "<input  type=\"text\" name=\"mantype\" size=\"10\" value=\"\"></span>";
		echo "是否显示";
		echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
		echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
		echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";

		$man_type = $Finance->getManType($login_user_id,"in",1);

		$table_title = array("序号","状态","名称","排序","主类操作","子类操作");
		
		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($man_type);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$YesNo=$man_type[$i]['is_display']? "启用":"禁用"."</td>";
			echo "<td>".$man_type[$i]['name']."</td>";
			echo "<td>上移\下移</td>";
			echo "<td>修改\删除</td>";
			echo "<td>列出子类</td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($man_type);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}	
		} else if ( $recordtype == 'address' ){
			if ( $add_submit == 1 ){
			$mantype = $_POST['mantype'];
			$is_display = $_POST['is_display'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype值为：".$_POST['mantype']."<br>";
				echo "is_display值为：".$_POST['is_display']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->addTypeData("in",$login_user_id,$mantype,1,0)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}


		echo "地址名称:&nbsp;<br>";
		echo "<input  type=\"text\" name=\"address\" size=\"10\" value=\"\"></span>";
		echo "是否显示";
		echo "<INPUT TYPE=\"checkbox\" checked=\"checked\" name=\"is_display\" ></span>";
		echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
		echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";

		$address = $Finance->getAddress($login_user_id,1);

		$table_title = array("序号","状态","名称","排序","操作");
		
		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($address);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$YesNo=$address[$i]['is_display'] ? "启用":"禁用"."</td>";
			echo "<td>".$address[$i]['name']."</td>";
			echo "<td>上\下</td>";
			echo "<td>修改\删除</td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($address);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}	
	} else if ( $recordtype == 'family' ){
			if ( $add_submit == 1 ){
			$user_name = $_POST['user_name'];
			$user_alias = $_POST['user_alias'];
			$user_password = $_POST['user_password'];
			$notes = $_POST['notes'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "user_name值为：".$_POST['user_name']."<br>";
				echo "user_alias值为：".$_POST['user_alias']."<br>";
				echo "user_password值为：".$_POST['user_password']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->AddUser($user_name,$user_alias,$user_password,$notes,$login_group_id)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}


		echo "用户名:&nbsp;";
		echo "<input type=\"text\" name=\"user_name\" size=\"12\" maxlength=\"20\" value = \"\">";
		echo "<br>别名:";
		echo "<input type=\"text\" name=\"user_alias\" size=\"12\" maxlength=\"20\" value =\"\">";
		echo "<br>密码:";
		echo "<input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"20\">";
		echo "<br>备注:";
		echo "<input type=\"text\" name=\"notes\" size=\"12\" maxlength=\"20\" value =\"\">";
		echo "<br>";
		echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
		echo "<INPUT  TYPE=\"submit\" value=\"".$_ADD."\">";

		$users = $Finance->getUserData($login_group_id);
		
		$table_title = array("序号","状态","用户名","别名","家庭","备注","最后登录","操作");
		
		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($users);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$YesNo=$users[$i]['disable']? "禁用":"启用"."</td>";
			echo "<td>".$users[$i]['username']."</td>";
			echo "<td>".$users[$i]['user_alias']."</td>";
			echo "<td>".$login_groupname."</td>";
			echo "<td>".$users[$i]['notes']."</td>";
			echo "<td>".$users[$i]['last_date']."</td>";

			echo "<td>修改\删除</td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($users);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}	
	}else{
		echo "<a href=\"main.php?page=fun_manager.php&add_type=in_mantype\"><span>收入类别管理</span></a>";
		echo "<br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=out_mantype\"><span>支出类别管理</span></a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=address\"><span>地址管理</span></a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php&add_type=family\"><span>家庭管理</span></a>";
	}
?>
</form>
</div>

