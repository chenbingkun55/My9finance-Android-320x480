<div class="ContentPlane Content" id="Content" align="center">
<script>ChangFunTitle('FunTitle3')</script>



<FORM action="main.php" method="get" >
	
	<select id="scorde" name="scorde" onChange="DisableStype()">
		 <option  value="out_corde" <?PHP if ( $_GET['scorde'] == "out_corde")  echo "selected=\"selected\"" ;  ?>>支出</option>
		 <option  value="in_corde" <?PHP if ( $_GET['scorde'] == "in_corde")  echo "selected=\"selected\"" ;  ?>>收入</option>
		 <option  value="in_out" <?PHP if ( $_GET['scorde'] == "in_out")  echo "selected=\"selected\"" ;  ?>>收支</option>
	</select>

	<select id="stype" name="stype" <?PHP if ( $_GET['scorde'] == "in_out")  echo "disabled=\"true\"" ;  ?>>
		 <option  value="users" <?PHP if ( $_GET['stype'] == "users")  echo "selected=\"selected\"" ;  ?>>用户</option>
		 <option  value="address"  <?PHP if ( $_GET['stype'] == "address" )  echo "selected=\"selected\"" ;  ?>>地址</option>
		 <option  value="mantype"  <?PHP if ( $_GET['stype'] == "mantype" )  echo "selected=\"selected\"" ;  ?>>类别</option>
	</select>

	后<input type="text" name="d_num" value="0" size="1"> 
	<select name="sdate">
		 <option  value="week" <?PHP if ( $_GET['sdate'] == "week" )  echo "selected=\"selected\"" ;  ?>>周</option>
		 <option  value="month" <?PHP if ( $_GET['sdate'] == "month")  echo "selected=\"selected\"" ;  ?>>月</option>
		 <option  value="year" <?PHP if ( $_GET['sdate'] == "year")  echo "selected=\"selected\"" ;  ?>>年</option>
	</select>
	<input type="hidden" name="report" value="1">
	<input type="hidden" name="page" value="report.php">
	<input type="submit" value="报表">

</FORM>
<hr>

<?PHP
	if ( $_GET['report'] == 1 ) {
		$report_data = $Finance->getReportData($_GET['scorde'],$_GET['stype'],$_GET['sdate'],$login_family_id,$jump);

		switch( $_GET['stype'] ) {
			case  "address":
				$table_title = array("序号","地址","家庭号","金钱","占百分比");
				$stype = "address";
				break;
			case  "mantype":
				$table_title = array("序号","类别","家庭号","金钱","占百分比");
				if ( $_GET['scorde'] == "in_corde" ) {
					$stype = "in_mantype";
				}
				if ( $_GET['scorde'] == "out_corde" ) {
					$stype = "out_mantype";
				}
				break;
			default:
				$table_title = array("序号","用户","家庭号","金钱","占百分比");
				$stype = "users";
		}	

		if(DEBUG_YES){ 
			echo "<br>DEBUG START*********************************************<br>";
			print_r($report_data);
			echo "<br>$stype = ".$stype."<br>";
			echo  "\$_SESSION['date_num'] = ". $_SESSION['date_num']."<br>";
			echo  "\$_GET['d_num'] = ".$_GET['d_num'] ."<br>";
			echo "<br>DEBUG END*********************************************<br>";	
		}

		if ( $_GET['scorde'] == "in_out" ) {
			echo "<table><tr class='ContentTdColor'>";
			echo "<th>总收入</th>";
			echo "<th>平均/每天</th>";
			echo "</tr><tr class='ContentTdColor1'>";
			echo "<td>".$report_data['0']['0']."</td>";
			echo "<td>".$report_data['0']['1']."</td>";
			echo "</tr></table>";

			echo "<table><tr class='ContentTdColor'>";
			echo "<th>总支出</th>";
			echo "<th>平均/每天</th>";
			echo "</tr><tr class='ContentTdColor1'>";
			echo "<td>".$report_data['0']['2']."</td>";
			echo "<td>".$report_data['0']['3']."</td>";
			echo "</tr></table>";

			echo "<table><tr class='ContentTdColor'>";
			echo "<th>总收支差</th>";
			echo "<th>总平均/每天差</th>";
			echo "</tr><tr class='ContentTdColor1'>";
			echo "<td>".$report_data['0']['4']."</td>";
			echo "<td>".$report_data['0']['5']."</td>";
			echo "</tr></table>";
		} else {
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$today_money = 0;
			for ($i=0;$i<count($report_data);$i++){
				$today_money = ($today_money + $report_data[$i]['sum(money)']);
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($report_data);$i++){
				echo "<tr class='".$c."'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($report_data[$i]['1'],$stype )."</td>";
				echo "<td>".$report_data[$i]['2']."</td>";
				echo "<td>".$report_data[$i]['sum(money)']."</td>";
				echo "<td>".(number_format($report_data[$i]['sum(money)']/$today_money,2)*100)."%</td>";
				echo "</tr>";
			
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "<tr class='ContentTdColor'><td colspan=\"3\" align=\"right\">总计：</td><td colspan=\"2\">".$today_money."元</td></tr>";
		}
		echo "</table>";

	} else {		
		$jump =  isset($_GET['jump']) ? $_GET['jump'] : 0 ;
		$scorde = isset($_GET['scorde']) ? $_GET['scorde'] : "out_corde";
		$stype =  isset($_GET['stype']) ? $_GET['stype'] : "users";
		$sdate = isset($_GET['sdate']) ?  $_GET['sdate'] :   "week";

		$report_data = $Finance->getReportData($scorde,$stype,$sdate,$login_family_id,$jump);
		
		if ( $_GET['scorde'] == "in_out" ) {
			echo "<table><tr class='ContentTdColor'>";
			echo "<th>收入总数</th>";
			echo "<th>收入平均</th>";
			echo "</tr><tr>";
			echo "<td>".$report_data['0']['0']."</td>";
			echo "<td>".$report_data['0']['1']."</td>";
			echo "</tr></table>";

			echo "<table><tr class='ContentTdColor'>";
			echo "<th>支出总数</th>";
			echo "<th>支出平均</th>";
			echo "</tr><tr>";
			echo "<td>".$report_data['0']['2']."</td>";
			echo "<td>".$report_data['0']['3']."</td>";
			echo "</tr></table>";

			echo "<table><tr class='ContentTdColor'>";
			echo "<th>总收支差</th>";
			echo "<th>总收支平均差</th>";
			echo "</tr><tr>";
			echo "<td>".$report_data['0']['4']."</td>";
			echo "<td>".$report_data['0']['5']."</td>";
			echo "</tr></table>";
		} else {
			switch( $_GET['stype'] ) {
				case  "address":
					$table_title = array("序号","地址","家庭号","金钱","占百分比");
					$stype = "address";
					break;
				case  "mantype":
					$table_title = array("序号","类别","家庭号","金钱","占百分比");
					if ( $_GET['scorde'] == "in_corde" ) {
						$stype = "in_mantype";
					}
					if ( $_GET['scorde'] == "out_corde" ) {
						$stype = "out_mantype";
					}
					break;
				default:
					$table_title = array("序号","用户","家庭号","金钱","占百分比");
					$stype = "users";
			}	


			if(DEBUG_YES){ 
				echo "<br>DEBUG START*********************************************<br>";
				print_r($report_data);
				echo "<br>".$stype."<br>";
				echo "<br>".$jump."<br>";
				echo "<br>DEBUG END*********************************************<br>";	
			}
			
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";
			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}

			$today_money = 0;
			for ($i=0;$i<count($report_data);$i++){
				$today_money = ($today_money + $report_data[$i]['sum(money)']);
			}

			$c="ContentTdColor1";
			for ($i=0;$i<count($report_data);$i++){
				echo "<tr class='".$c."'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($report_data[$i]['1'],$stype )."</td>";
				echo "<td>".$report_data[$i]['2']."</td>";
				echo "<td>".$report_data[$i]['sum(money)']."</td>";
				echo "<td>".(number_format($report_data[$i]['sum(money)']/$today_money,2)*100)."%</td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "<tr class='ContentTdColor'><td colspan=\"3\" align=\"right\">总计：</td><td colspan=\"2\">".$today_money."元</td></tr>";
			echo "</table>";
		}
	}
?>
</div>

