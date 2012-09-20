<tr><td class="RLpadding">
<table class="ContentTable">
	<tr>
	<td class="Ltd ALLpadding ">
<script>ChangFunTitle('FunTitle4')</script>
<FORM action="main.php?page=search.php"  name="add_form" method="POST">
	<select id="scorde" name="scorde" onChange="SelectType()">
		 <option  value="out_record" <?PHP if ( $_GET['scorde'] == "out_record" )  echo "selected=\"selected\"" ;  ?>>支出</option>
		 <option  value="in_record" <?PHP if ( $_GET['scorde'] == "in_record")  echo "selected=\"selected\"" ;  ?>>收入</option>
	</select>

	<?PHP 
		$Finance->select_type($login_user_id,isset($_GET['scorde']) ? $_GET['scorde'] : "out_record");
	?>

	后<input type="text" name="d_num" value="0" size="1"> 
	<select name="sdate">
		 <option  value="week">周</option>
		 <option  value="month">月</option>
		 <option  value="year">年</option>
	</select>

	<input type="hidden" name="page" value="search.php">
	<INPUT type="hidden" name="search_submit" value="1">
	<input type="reset" value="清空">
	<input type="submit" value="搜索">
</FORM>
<hr>
<?PHP
	if ( $_POST['search_submit'] == 1 ) {
			$scorde = $_POST['scorde'];
			$mantype_id = $_POST['mantype_id'];
			$subtype_id = $_POST['subtype_id'];
			$address = $_POST['address'];
			$money = $_POST['money'];
			$notes = $_POST['notes'];
			$d_num = $_POST['d_num'];
			$sdate = $_POST['sdate'];

			$search_data = $Finance->getSearchData( $scorde, $mantype_id, $subtype_id, $address, $money, $notes, $d_num, $sdate,  $login_group_id); 

			$table_title = array("序号","用户","家庭","主类","子类","地址","金钱","备注","时间");
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";

			if ( $scorde == "out_record" ) {
				$mantype = "out_mantype";
				$subtype = "out_subtype";
			} else if ($scorde == "in_record") {
				$mantype = "in_mantype";
				$subtype = "in_subtype";
			}

			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}
			
			$c="ContentTdColor1";
			$today_money = 0;
			for ($i=0;$i<count($search_data);$i++){
				$today_money = ($today_money + $search_data[$i]['money']);
				echo "<tr class='".$c."'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".$Finance->convertID($search_data[$i]['user_id'],"users")."</td>";
				echo "<td>".$Finance->convertID($search_data[$i]['group_id'],"groups")."</td>";
				echo "<td>".$Finance->convertID($search_data[$i]['mantype_id'],$mantype)."</td>";
				echo "<td>".$Finance->convertID($search_data[$i]['subtype_id'],$subtype)."</td>";
				echo "<td>".$Finance->convertID($search_data[$i]['addr_id'],"address")."</td>";
				echo "<td>".$search_data[$i]['money']."</td>";
				echo "<td>".$search_data[$i]['notes']."</td>";
				echo "<td>".$search_data[$i]['create_date']."</td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "<tr class='ContentTdColor'><td colspan=\"6\" align=\"right\">总计：</td><td colspan=\"3\">".$today_money."元</td></tr>"; 
			echo "</table>";
	}
?>
	</td>
	</tr>
</table>
</td></tr>
