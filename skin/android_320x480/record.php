<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle1')</script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=record.php&add_type=".$_GET['add_type'];?>" method="post">

<?PHP 	
	$recordtype = $_GET['add_type'];
	$add_submit = $_POST['add_submit'];

	/*
		添加表单:
	*/
	if  ( $recordtype == 'out_record' )
	{
		if ( $add_submit == 1 ){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->addCordeData("out",$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}


		echo "支出:&nbsp;";
		$Finance->select_type($login_user_id,"out");
		$today_corde = $Finance->getCordeData($login_group_id,"out",date("Y-m-d"));
		$table_title = array("序号","时间","用户","家庭","主类","子类","金额","地址","备注");
		
		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($today_corde);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";

			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"","users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['out_mantype_id'],"out_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['out_subtype_id'],"out_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}

	} else if ( $recordtype == 'in_record' ){
		if ( $add_submit == 1 ){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($Finance->addCordeData("in",$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}

		echo "收入:&nbsp;";
		
		$Finance->select_type($login_user_id,"in");
		$today_corde = $Finance->getCordeData($login_group_id,"in",date("Y-m-d"));
		$table_title = array("序号","时间","用户","家庭","主类","子类","金额","地址","备注");
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}

		echo "<table>";		
		echo "<tr bgcolor=\"#66CC00\">";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="#33FFFF";
		for ($i=0;$i<count($today_corde);$i++){
			echo "<tr bgcolor=\"".$c."\">";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"","users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['in_mantype_id'],"in_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['in_subtype_id'],"in_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "</tr>";
			$c=($c=="#33FFFF") ? "#00CC00":"#33FFFF";
		}

		echo "</table>";
	} else if ( $recordtype == 'out_record_type' ){

		echo "添加支出主类:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加支出主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加支出主类金额\"><br>";
		echo "添加支出主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加支出主类说明\"><br>";
	} else if ( $recordtype == 'in_record_type' ){
		echo "添加收入主类:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";

	} else if ( $recordtype == 'address' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";
	} else if ( $recordtype == 'user' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";
	} else if ( $recordtype == 'family' ){
		echo "添加地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "添加收入主类金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类金额\"><br>";
		echo "添加收入主类说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"添加收入主类说明\"><br>";

	}else{
		echo "<a href=\"main.php?page=record.php&add_type=out_record\">支出记录</a><br><br>";
		echo "<a href=\"main.php?page=record.php&add_type=in_record\">收入记录</a><br><br>";
		echo "<a href=\"main.php?page=fun_manager.php\"><span>功能管理</span></a><br><br>";
		echo "<a href=\"main.php?page=report.php\">报表</a><br><br>";
		echo "<a href=\"main.php?page=search.php\">搜索</a><br><br>";
		echo "<a href=\"main.php?page=about.php\">关于</a>";
	}
?>
</form>
</div>

