<div class="ContentPlane Content" id="Content">
<script>ChangFunTitle('FunTitle4')</script>
<FORM action="main.php?page=search.php"  name="add_form" method="POST">
	<select id="scorde" name="scorde" onChange="SelectType()">
		 <option  value="NULL" >----</option>
		 <option  value="out_record" <?PHP if ( $_GET['scorde'] == "out_record" )  echo "selected=\"selected\"" ;  ?>>支出</option>
		 <option  value="in_record" <?PHP if ( $_GET['scorde'] == "in_record")  echo "selected=\"selected\"" ;  ?>>收入</option>
	</select>

	<?PHP 
		$Finance->select_type($login_user_id,$_GET['scorde']);
	?>

	后<input type="text" name="d_num" value="1" size="1"> 
	<select name="sdate">
		 <option  value="week">周</option>
		 <option  value="month">月</option>
		 <option  value="year">年</option>
	</select>

	<input type="hidden" name="page" value="search.php">
	<INPUT type="hidden" name="search_submit" value="1">
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
			echo $search_data;
			
	
	}

?>


</div>
