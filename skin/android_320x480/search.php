<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle4')</script>
<?PHP
	$scorde = isset( $_GET['scorde'] ) ? $_GET['scorde'] : $_POST['scorde'];
?>

<FORM action="main.php?page=search.php"  name="add_form" method="POST">
	<select id="scorde" name="scorde" onChange="SelectType()">
		 <option  value="0" <?PHP if ( $scorde == "0" )  echo "selected=\"selected\"" ;  ?>>支出</option>
		 <option  value="1" <?PHP if ( $scorde == "1")  echo "selected=\"selected\"" ;  ?>>收入</option>
	</select>

	<?PHP 
		$Finance->select_type($login_family_id,$scorde);
	?>

	后<input type="text" name="d_num" value="0" size="1"> 
	<select name="sdate">
		 <option  value="week" <?PHP if ( $_POST['sdate'] == "week" )  echo "selected=\"selected\"" ;  ?>>周</option>
		 <option  value="month" <?PHP if ( $_POST['sdate'] == "month" )  echo "selected=\"selected\"" ;  ?>>月</option>
		 <option  value="year" <?PHP if ( $_POST['sdate'] == "year" )  echo "selected=\"selected\"" ;  ?>>年</option>
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

			$search_data = $Finance->getSearchData( $scorde, $mantype_id, $subtype_id, $address, $money, $notes, $d_num, $sdate,  $login_family_id); 

			$table_title = array("序号","用户","主类","子类","地址","金钱","备注","时间");
			echo "<table>";		
			echo "<tr class='ContentTdColor'>";


			for ($i=0;$i<count($table_title);$i++){
				echo "<th>".$table_title[$i]."</th>";
			}
			
			$c="ContentTdColor1";
			$today_money = 0;
			for ($i=0;$i<count($search_data);$i++){
				$today_money = ($today_money + $search_data[$i]['Money']);
				echo "<tr class='".$c."'>";
				echo "<td>".($i+1)."</td>";
				echo "<td>".@$Finance->convertID($search_data[$i]['U_id'],"family_member")."</td>";
				echo "<td>".@$Finance->convertID($search_data[$i]['M_id'],"mantype")."</td>";
				echo "<td>".@$Finance->convertID($search_data[$i]['S_id'],"subtype")."</td>";
				echo "<td>".@$Finance->convertID($search_data[$i]['A_id'],"address")."</td>";
				echo "<td>".$search_data[$i]['Money']."</td>";
				echo "<td>".$search_data[$i]['Notes']."</td>";
				echo "<td>".date('Y-m-d H:i:s',$search_data[$i]['C_date'])."</td>";
				echo "</tr>";
				$c=($c=="ContentTdColor1") ? "ContentTdColor2":"ContentTdColor1";
			}
			echo "<tr class='ContentTdColor'><td colspan=\"5\" align=\"right\">总计：</td><td colspan=\"3\">".$today_money."元</td></tr>"; 
			echo "</table>";
	}
?>
</div>
