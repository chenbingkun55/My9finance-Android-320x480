<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle1')</script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=record.php&add_type=".$_GET['add_type'];?>" method="post">

<?PHP 	
	$recordtype = $_GET['add_type'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];

	/*
		添加表单:
	*/
	if  ( $recordtype == 'out_record' )
	{
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "alter_id值为：".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$str = ($Finance->addCordeData($recordtype,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? "成功<br>":"失败<br>";
				echo $str;
			}
			if($alter_submit == 1){
				$str =($Finance->updateCordeData($recordtype,$alter_id,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? "成功<br>":"失败<br>";
				echo $str;
			}
		}

		if (!(is_null($Did)) && !(is_null($login_user_id))){
			if ($Finance->delCorde($recordtype,$login_user_id,$Did)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}

		echo "支出:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_user_id))){
			$Finance->select_type($login_user_id,$recordtype,$Aid);
		}else{
			$Finance->select_type($login_user_id,$recordtype);
		}
		
		$today_corde = $Finance->getCordeData($login_group_id,$recordtype,date("Y-m-d"));
		$table_title = array("序号","时间","用户","家庭","主类","子类","金额","地址","备注","操作");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";

			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"","users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['mantype_id'],"out_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['subtype_id'],"out_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$today_corde[$i]['id']."')\">删除</span></td>";
			echo "</tr>";
			$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
		}
		echo "<tr class='ContentTdColor'><td colspan=\"6\" align=\"right\">当天总计：</td><td colspan=\"4\">".$today_money."元</td></tr>";
		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}

	} else if ( $recordtype == 'in_record' ){
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "alter_id值为：".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$str = ($Finance->addCordeData($recordtype,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? "成功<br>":"失败<br>";
				echo $str;
			}
			if($alter_submit == 1){
				$str =($Finance->updateCordeData($recordtype,$alter_id,$login_user_id,$login_group_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? "成功<br>":"失败<br>";
				echo $str;
			}
		}

		if (!(is_null($Did)) && !(is_null($login_user_id))){
			if ($Finance->delCorde($recordtype,$login_user_id,$Did)){
				echo "成功<br>";
			}else{
				echo "失败<br>";
			}
		}

		echo "收入:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_user_id))){
			$Finance->select_type($login_user_id,$recordtype,$Aid);
		}else{
			$Finance->select_type($login_user_id,$recordtype);
		}
		
		$today_corde = $Finance->getCordeData($login_group_id,$recordtype,date("Y-m-d"));
		$table_title = array("序号","时间","用户","家庭","主类","子类","金额","地址","备注","操作");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td><script>PrintCreateDateShort('".$today_corde[$i]['create_date']."')</script></td>";

			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],"","users")."</td>";
			echo "<td>".$login_group_alias."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['mantype_id'],"out_mantype")."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['subtype_id'],"out_subtype")."</td>";
			echo "<td>".$today_corde[$i]['money']."</td>";
			echo "<td>".$Finance->convertID($today_corde[$i]['user_id'],$today_corde[$i]['addr_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['id']."')\">修改</span>|<span class=\"click\" onClick=\"Del('".$today_corde[$i]['id']."')\">删除</span></td>";
			echo "</tr>";
			$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
		}
		echo "<tr class='ContentTdColor'><td colspan=\"6\" align=\"right\">当天总计：</td><td colspan=\"4\">".$today_money."元</td></tr>";
		echo "</table>";
		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($today_corde);
			echo "<Br>".date("Y-m-d");
			echo "<br>DEBUG END*********************************************<br>";	
		}
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

