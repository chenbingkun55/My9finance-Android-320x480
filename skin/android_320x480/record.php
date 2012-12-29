<div class="ContentPlane Content" id="Content">
<script> ChangFunTitle('FunTitle1'); </script>
<form class="add_form" name="add_form" action="main.php<?PHP echo "?page=record.php&add_type=".$_GET['add_type'];?>" method="post">

<?PHP 	
	$flow = $_GET['add_type'];
	$stype = $_GET['stype'];
	$add_submit = $_POST['add_submit'];
	$alter_submit = $_POST['alter_submit'];
	$Aid = $_GET['Aid'];
	$Did = $_GET['Did'];

	/*
		添加表单:
	*/
	if  ( $flow == '0' )
	{
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$bank_id = $_POST['bank_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "bank_id值为：".$_POST['bank_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "flow值为：".$flow."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "alter_id值为：".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$YesNo = ($Finance->addCordeData($flow,$login_member_id,$login_family_id,$bank_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  记录日志   */
				$text_log = $YesNo ? "添加支出-成功,金额:".$money." 支出主类: ".@$Finance->convertID($mantype_id,"mantype")." 支出子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes : "添加支出-失败,金额:".$money." 支出主类: ".@$Finance->convertID($mantype_id,"mantype")." 支出子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ?  5010 : 1010;  
			}
			if($alter_submit == 1){
				$YesNo =($Finance->updateCordeData($flow,$alter_id,$login_member_id,$login_family_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  记录日志   */
				$text_log = $YesNo ?  "修改支出-成功,金额:".$money." 支出主类: ".@$Finance->convertID($mantype_id,"mantype")." 支出子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes : "添加支出-失败,金额:".$money." 支出主类: ".@$Finance->convertID($mantype_id,"mantype")." 支出子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes;
				/*  消息提醒  */
				$_SESSION['__global_logid']= $YesNo ?  5012:1012;  
			}
		}

		if (!(is_null($Did)) && !(is_null($login_family_id))){
			$Did_data = $Finance->getCordeData($login_family_id,"0",0,0,$Did);
			$YesNo = ($Finance->delCorde($flow,$login_family_id,$Did,$login_member_id))==true ? true:false;
				
			/*  记录日志   */
			$text_log = $YesNo ? "删除支出-成功,金额:".$Did_data['0']['Money']." 支出主类: ".@$Finance->convertID($Did_data['0']['M_id'],"mantype")." 支出子类: ".@$Finance->convertID($Did_data['0']['S_id'],"subtype")." 地址:".@$Finance->convertID($Did_data['0']['A_id'],"address")." 备注:".$Did_data['0']['Notes'] : "删除支出-失败,金额:".$Did_data['0']['Money']." 支出主类: ".@$Finance->convertID($Did_data['0']['M_id'],"mantype")." 支出子类: ".@$Finance->convertID($Did_data['0']['S_id'],"subtype")." 地址:".@$Finance->convertID($Did_data['0']['A_id'],"address")." 备注:".$Did_data['0']['Notes'];
			/*  消息提醒  */
			$_SESSION['__global_logid'] = $YesNo ?  5014 : 1014; 
		}

		$bank_card = $Finance->getCordeData($login_member_id,"bank_card",0,1,0);
		echo "<script>";
		echo "MemberMoney['0'] = new Array('0','".$login_member_id."','我的钱包','".$login_member_money."');";
		for ($i=0;$i<count($bank_card);$i++){
			$j = $i + 1; 
			echo "MemberMoney['".$j."'] = new Array('".$bank_card[$i]['ID']."','".$bank_card[$i]['U_id']."','".$bank_card[$i]['Name']."','".$bank_card[$i]['Money']."');";
		} 
		echo "</script>";

		echo "从:&nbsp;<select name=\"bank_id\" onChange=\"PrintMoney(this);\">";
		echo "<option value=\"0\">我的钱包</option>";
		for ($i=0;$i<count($bank_card);$i++){
			echo "<option value=\"".$bank_card[$i]['ID']."\">".$bank_card[$i]['Name']."</option> ";
		} 
		echo "</select>";

		echo "<div class=\"MoneyPlane\" align=\"right\" id=\"MoneyPlane\">".$_SESSION['__memberdata'][$current_member]['Money']."</div>";


		echo "<BR>支出:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_family_id))){
			$Finance->select_type($login_family_id,$flow,$Aid);
		}else{
			$Finance->select_type($login_family_id,$flow);
		}
		$str =  $Aid ? "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\"><INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"修改\"></span>":"<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"添加\"></span>";
		echo $str;

		$today_corde = $Finance->getCordeData($login_family_id,$flow,time());
		$table_title = array("序号","时间","用户","主类","子类","账号","金额","地址","备注","操作");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['Money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>".date('H:i:s',$today_corde[$i]['C_date'])."</td>";

			echo "<td>".@$Finance->convertID($today_corde[$i]['U_id'],"family_member")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['M_id'],"mantype")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['S_id'],"subtype")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['B_id'],"bank_card")."</td>";
			echo "<td>".$today_corde[$i]['Money']."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['A_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['Notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['ID']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$today_corde[$i]['ID']."')\">删除</span></td>";
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

	} else if ( $flow == '1' ){
		if ( $add_submit == 1 || $alter_submit == 1){
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$bank_id = $_POST['bank_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$alter_id = $_POST['alter_id'];

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "mantype_id值为：".$_POST['mantype_id']."<br>";
				echo "subtype_id值为：".$_POST['subtype_id']."<br>";
				echo "bank_id值为：".$_POST['bank_id']."<br>";
				echo "address值为：".$_POST['address']."<br>";
				echo "money值为：".$_POST['money']."<br>";
				echo "notes值为：".$_POST['notes']."<br>";
				echo "alter_id值为：".$alter_id."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			if ($add_submit == 1){
				$YesNo = ($Finance->addCordeData($flow,$login_member_id,$login_family_id,$bank_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;
				
				/*  记录日志   */
				$text_log = $YesNo ?  "添加收入-成功,金额:".$money." 收入主类: ".@$Finance->convertID($mantype_id,"mantype")." 收入子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes : "添加收入-失败,金额:".$money." 收入主类: ".@$Finance->convertID($mantype_id,"mantype")." 收入子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes;
				/*  消息提醒  */
				$_SESSION['__global_logid'] = $YesNo ? 5011 : 1011;  
			}
			if($alter_submit == 1){
				$YesNo =($Finance->updateCordeData($flow,$alter_id,$login_member_id,$login_family_id,$mantype_id,$subtype_id,$address,$money,$notes))==true ? true:false;

				/*  记录日志   */
				$text_log = $YesNo ?  "修改收入-成功,金额:".$money." 收入主类: ".@$Finance->convertID($mantype_id,"mantype")." 收入子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes : "添加收入-失败,金额:".$money." 收入主类: ".@$Finance->convertID($mantype_id,"mantype")." 收入子类: ".@$Finance->convertID($subtype_id,"subtype")." 地址:".@$Finance->convertID($address,"address")." 备注:".$notes;
				/*  消息提醒  */
				$_SESSION['__global_logid']= $YesNo ?  5013:1013;  

			}
		}

		if (!(is_null($Did)) && !(is_null($login_family_id))){
			$Did_data = $Finance->getCordeData($login_family_id,"in_record",0,0,$Did);
			$YesNo = ($Finance->delCorde($flow,$login_family_id,$Did,$login_member_id))==true ? true:false;

			/*  记录日志   */
			$text_log = $YesNo ? "删除收入-成功,金额:".$Did_data['0']['Money']." 收入主类: ".@$Finance->convertID($Did_data['0']['M_id'],"mantype")." 收入子类: ".@$Finance->convertID($Did_data['0']['S_id'],"subtype")." 地址:".@$Finance->convertID($Did_data['0']['A_id'],"address")." 备注:".$Did_data['0']['Notes'] : "删除收入-失败,金额:".$Did_data['0']['Money']." 收入主类: ".@$Finance->convertID($Did_data['0']['M_id'],"mantype")." 收入子类: ".@$Finance->convertID($Did_data['0']['S_id'],"subtype")." 地址:".@$Finance->convertID($Did_data['0']['A_id'],"address")." 备注:".$Did_data['0']['Notes'];
			/*  消息提醒  */
			$_SESSION['__global_logid'] = $YesNo ?  5015 : 1015;
		}

		$bank_card = $Finance->getCordeData($login_member_id,"bank_card",0,1,0);
		echo "<script>";
		echo "MemberMoney['0'] = new Array('0','".$login_member_id."','我的钱包','".$login_member_money."');";
		for ($i=0;$i<count($bank_card);$i++){
			$j = $i + 1; 
			echo "MemberMoney['".$j."'] = new Array('".$bank_card[$i]['ID']."','".$bank_card[$i]['U_id']."','".$bank_card[$i]['Name']."','".$bank_card[$i]['Money']."');";
		} 
		echo "</script>";

		echo "入:&nbsp;<select name=\"bank_id\" onChange=\"PrintMoney(this);\">";
		echo "<option value=\"0\">我的钱包</option>";
		for ($i=0;$i<count($bank_card);$i++){
			echo "<option value=\"".$bank_card[$i]['ID']."\">".$bank_card[$i]['Name']."</option> ";
		} 
		echo "</select>";

		echo "<div class=\"MoneyPlane\" align=\"right\" id=\"MoneyPlane\">".$_SESSION['__memberdata'][$current_member]['Money']."</div>";


		echo "<BR>收入:&nbsp;";
		if (!(is_null($Aid)) && !(is_null($login_family_id))){
			$Finance->select_type($login_family_id,$flow,$Aid);
		}else{
			$Finance->select_type($login_family_id,$flow);
		}
		$str =  $Aid ? "<INPUT type=\"hidden\" name=\"alter_id\" value=\"".$Aid."\"><INPUT type=\"hidden\" name=\"alter_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"修改\"></span>":"<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\"><span align=\"right\"><INPUT class=\"LoginButton\" type=\"submit\" value=\"添加\"></span>";
		echo $str;

		$today_corde = $Finance->getCordeData($login_family_id,$flow,time());
		$table_title = array("序号","时间","用户","主类","子类","账号","金额","地址","备注","操作");
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($today_corde);$i++){
			$today_money = ($today_money + $today_corde[$i]['Money']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>".date('H:i:s',$today_corde[$i]['C_date'])."</td>";

			echo "<td>".@$Finance->convertID($today_corde[$i]['U_id'],"family_member")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['M_id'],"mantype")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['S_id'],"subtype")."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['B_id'],"bank_card")."</td>";
			echo "<td>".$today_corde[$i]['Money']."</td>";
			echo "<td>".@$Finance->convertID($today_corde[$i]['A_id'],"address")."</td>";
			echo "<td>".$today_corde[$i]['Notes']."</td>";
			echo "<td><span class=\"click\" onClick=\"Alter('".$today_corde[$i]['ID']."')\">修改</span>&nbsp;|&nbsp;<span class=\"click\" onClick=\"Del('".$today_corde[$i]['ID']."')\">删除</span></td>";
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

	} else if ( $flow == '3' ){
		$bank_card = $Finance->getCordeData($login_family_id,"bank_card",0,0,0);
		$members = $Finance->getFamilyMember($login_family_id);

		$stype = isset($_POST['stype']) ? $_POST['stype'] : $stype;
		switch($stype){
			case "1":
				echo "银行卡->现金:<BR>";
				echo "从<select name=\"bank_id\">";
				for ($i=0;$i<count($bank_card);$i++){
					echo "<option value=\"".$bank_card[$i]['ID']."\">".@$Finance->convertID($bank_card[$i]['U_id'],"family_member")."-".$bank_card[$i]['Name']."</option> ";
				} 
				echo "</select>";
				echo "手续费<input  type=\"text\" name=\"tip\" size=\"4\" value=\"0\"><BR>";
				echo "转出<input  type=\"text\" name=\"money2\" size=\"8\" value=\"0\">";
				echo "->";

				echo "<select name=\"member_id\">";
				for ($i=0;$i<count($members);$i++){
					echo "<option value=\"".$members[$i]['ID']."\">".$members[$i]['Name']."</option> ";
				}
				echo "</select><BR>";
				echo "<INPUT type=\"hidden\" name=\"stype\" value=\"1\">";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<BR><span><a class=\"content\" href=\"main.php?page=record.php&add_type=3\">返回</a></span>";
				echo "&nbsp;&nbsp;&nbsp;<INPUT class=\"LoginButton\" type=\"submit\" value=\"".$_COMMIT."\">";
				echo "<HR>";

				break;
			case "2":
				echo "现金->银行卡:<BR>";
				echo "从<select name=\"member_id\">";
				for ($i=0;$i<count($members);$i++){
					echo "<option value=\"".$members[$i]['ID']."\">".$members[$i]['Name']."</option> ";
				}

				echo "</select>";
				echo "手续费<input  type=\"text\" name=\"tip\" size=\"2\" value=\"0\">";
				echo "存入<input  type=\"text\" name=\"money2\" size=\"8\" value=\"0\">";
				echo "<BR>->";

				echo "<select name=\"bank_id\">";
				for ($i=0;$i<count($bank_card);$i++){
					echo "<option value=\"".$bank_card[$i]['ID']."\">".@$Finance->convertID($bank_card[$i]['U_id'],"family_member")."-".$bank_card[$i]['Name']."</option> ";
				} 
				echo "</select><BR>";
				echo "<INPUT type=\"hidden\" name=\"stype\" value=\"2\">";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<BR><span><a class=\"content\" href=\"main.php?page=record.php&add_type=3\">返回</a></span>";
				echo "&nbsp;&nbsp;&nbsp;<INPUT class=\"LoginButton\" type=\"submit\" value=\"".$_COMMIT."\">";
				
				echo "</form>";
				echo "<HR>";

				
				break;
			case "3":
				echo "银行卡 -> 其它卡:<BR>";
				echo "从<select name=\"bank_id\">";
				for ($i=0;$i<count($bank_card);$i++){
					echo "<option value=\"".$bank_card[$i]['ID']."\">".@$Finance->convertID($bank_card[$i]['U_id'],"family_member")."-".$bank_card[$i]['Name']."</option> ";
				} 
				echo "</select><BR>";
				echo "手续费<input  type=\"text\" name=\"tip\" size=\"2\" value=\"0\">";
				echo "&nbsp;&nbsp;&nbsp;<input  type=\"text\" name=\"money2\" size=\"8\" value=\"0\">";
				echo "<BR>->";
				echo "<input  type=\"text\" name=\"card\" size=\"20\" value=\"0\"><BR>";
				echo "<INPUT type=\"hidden\" name=\"stype\" value=\"3\">";
				echo "<INPUT type=\"hidden\" name=\"add_submit\" value=\"1\">";
				echo "<span><a class=\"content\" href=\"main.php?page=record.php&add_type=3\">返回</a></span>";
				echo "&nbsp;&nbsp;&nbsp;<INPUT class=\"LoginButton\" type=\"submit\" value=\"".$_COMMIT."\">";
				echo "</form>";
				echo "<HR>";
				break;
			default:
			echo "<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行转账</B>";
			echo "<BR><BR>";
			echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=3&stype=1\">银行卡->现金</a><br><br>";
			echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=3&stype=2\">现金->银行卡</a><br><br>";
			echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=3&stype=3\">银行卡 -> 其它卡</a><br><br>";
		}
		if ( $add_submit == 1){
			$stype = $_POST['stype'];
			$member_id = $_POST['member_id'];
			$bank_id = $_POST['bank_id'];
			$card = $_POST['card'];
			$tip = $_POST['tip'];
			$money2 = $_POST['money2'];
			$bank_data = $Finance->getCordeData($bank_id,"bank_card",0,$member_id,1);

			$notes = "从".@$Finance->convertID($bank_data['0']['U_id'],"family_member")."-".@$Finance->convertID($bank_data['0']['ID'],"bank_card")."转出:".$money2."元,给".@$Finance->convertID($member_id,"family_member").",手续费:".$tip."元" ;

			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				echo "add_submit值为：".$_POST['add_submit']."<br>";
				echo "stype值为：".$_POST['stype']."<br>";
				echo "member_id值为：".$_POST['member_id']."<br>";
				echo "bank_id值为：".$_POST['bank_id']."<br>";
				echo "card值为：".$_POST['card']."<br>";
				echo "tip值为：".$_POST['tip']."<br>";
				echo "money2值为：".$_POST['money2']."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			
			switch($stype){
				case "1":
					$YesNo = ($Finance->addCordeData(0,$login_member_id,$login_family_id,$bank_id,0,0,0,$money2,$notes))==true ? true:false;
					
					$Finance->updateMoney($member_id,$login_family_id,0,$money2 ,"");

					$cmoney = $money2-$money2*2;
					$Finance->updateMoney($member_id,$login_family_id,$bank_id,$cmoney ,"");

					/*  记录日志   */
					
					$text_log = $YesNo ? "银行卡->现金-成功,从".@$Finance->convertID($bank_data['0']['U_id'],"family_member")."-".@$Finance->convertID($bank_data['0']['ID'],"bank_card")."转出:".$money2."元,给".@$Finance->convertID($member_id,"family_member").",手续费:".$tip."元" : "银行卡->现金-失败,从".@$Finance->convertID($bank_data['0']['U_id'],"family_member")."-".@$Finance->convertID($bank_data['0']['ID'],"bank_card")."转出:".$money2."元,给".@$Finance->convertID($member_id,"family_member").",手续费:".$tip."元";
					
					/*  消息提醒  */
					$_SESSION['__global_logid'] = $YesNo ?  5010 : 1010;  
					
					echo "1 ".$cmoney;
					break;
				case "2":
					echo "2";
					break;
				case "3":
					echo "3";
					break;
			}
		}
	}else{
		echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=0\">支出记录</a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=1\">收入记录</a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=record.php&add_type=3\">银行转账</a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=fun_manager.php\"><span>功能管理</span></a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=report.php\">报表</a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=search.php\">搜索</a><br><br>";
		echo "<a class=\"content\" href=\"main.php?page=about.php\">关于</a>";
	}

	/*  记录Log  */
	if (! empty($text_log)) {
		$Finance->CrodeLog($text_log);
	}
?>
</form>
</div>

