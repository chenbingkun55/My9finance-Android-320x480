<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle3')</script>
<FORM action="main.php?page=report.php" method="post">
	
	<select name="scorde">
		 <option  value="in_corde" <?PHP if ( $_POST['scorde'] == "in_corde" )  echo "selected=\"selected\"" ;  ?>>收入</option>
		 <option  value="out_corde"<?PHP if ( $_POST['scorde'] == "out_corde" )  echo "selected=\"selected\"" ;  ?>>支出</option>
	</select>

	<select name="stype">
		 <option  value="users" <?PHP if ( $_POST['stype'] == "users" )  echo "selected=\"selected\"" ;  ?>>用户</option>
		 <option  value="address"  <?PHP if ( $_POST['stype'] == "address" )  echo "selected=\"selected\"" ;  ?>>地址</option>
		 <option  value="mantype"  <?PHP if ( $_POST['stype'] == "mantype" )  echo "selected=\"selected\"" ;  ?>>类别</option>
	</select>

	<select name="sdate">
		 <option  value="week" <?PHP if ( $_POST['sdate'] == "week" )  echo "selected=\"selected\"" ;  ?>>周</option>
		 <option  value="month" <?PHP if ( $_POST['sdate'] == "month" )  echo "selected=\"selected\"" ;  ?>>月</option>
		 <option  value="year" <?PHP if ( $_POST['sdate'] == "year" )  echo "selected=\"selected\"" ;  ?>>年</option>
	</select>
	<input type="hidden" name="report" value="1">
	<input type="submit" value="报表">

</FORM>
<hr>

<?PHP
	if ( $_POST['report'] == 1 ) {
		$report_data = $Finance->getReportData($_POST['scorde'],$_POST['stype'],$_POST['sdate'],$login_groupname);

		print_r($report_data);
		switch( $_POST['stype'] ) {
			case  "users":
				$table_title = array("序号","用户","家庭","金钱");
				$stype = "users";
				break;
			case  "address":
				$table_title = array("序号","地址","家庭","金钱");
				$stype = "address";
				break;
			case  "mantype":
				$table_title = array("序号","类别","家庭","金钱");
				if ( $_POST['scorde'] == "in_corde" ) {
					$stype = "in_mantype";
				}
				if ( $_POST['scorde'] == "out_corde" ) {
					$stype = "out_mantype";
				}
				break;
		}

		echo "<br>".$stype."<br>";
		
		
		echo "<table>";		
		echo "<tr class='ContentTdColor'>";
		for ($i=0;$i<count($table_title);$i++){
			echo "<th>".$table_title[$i]."</th>";
		}

		$c="ContentTdColor1";
		$today_money = 0;
		for ($i=0;$i<count($report_data);$i++){
			$today_money = ($today_money + $report_data[$i]['sum(money)']);
			echo "<tr class='".$c."'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$Finance->convertID($report_data[$i]['1'],$stype)."</td>";
			echo "<td>".$Finance->convertID($report_data[$i]['2'],groups)."</td>";
			echo "<td>".$report_data[$i]['sum(money)']."</td>";
			echo "</tr>";
			$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
		}
		echo "<tr class='ContentTdColor'><td colspan=\"3\" align=\"right\">总计：</td><td colspan=\"1\">".$today_money."元</td></tr>";
		echo "</table>";

	} else {
		echo "<center>";
		echo "上一年&nbsp;当年&nbsp;下一年";
		echo "<br>";
		echo "<img  SRC=\"../../Other/TEST.png\"  width=\"220\" height=\"200\">";
		echo "</center>";
		echo "<br>";
		echo "chenBK    50%  <br>";
		echo "caiyun      50%  <br>";
		echo "baobao     10%   <br>";
	}
?>
</div>

