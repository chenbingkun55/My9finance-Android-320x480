<form class="add_form" name="add_form" action="add_record.php" method="post">

<?PHP 	
	require_once("../../config/config.inc.php");
	require_once(INCLUDE_PATH.'finance.inc.php');	
	header("Content-Type:text/html;charset=UTF-8"); 	
	date_default_timezone_set('PRC');

	/* 初始化用户环境变量 */
	$login_username = $_SESSION['__userdata']['0']["username"];
	$login_user_alias = $_SESSION['__userdata']['0']["user_alias"];
	$login_user_id = $_SESSION['__userdata']['0']["id"];
	$login_user_session = $_SESSION['__userdata']['0']["session"];
	$login_last_date = $_SESSION['__userdata']['0']["last_date"];
	$login_groupname = $_SESSION['__groupdata']['0']['groupname'];
	$login_group_alias = $_SESSION['__groupdata']['0']['group_alias'];
	$login_groupadmin_id = $_SESSION['__groupdata']['0']['groupadmin_id'];
	$login_id = $_SESSION['__groupdata']['0']['id'];

	$recordtype = $_GET['add_type'];
/*
	添加表单:
*/

	if  ( $recordtype == 'out_record' )
	{
		echo "支出:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "支出金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"支出金额\"><br>";
		echo "支出说明:&nbsp;";
		echo "<input  type=\"text\" name=\"notes\" size=\"8\" value=\"支出金额\"><br>";
		echo "<INPUT type=\"submit\" value=".$_ADD_OUT.">";

	} else if ( $recordtype == 'in_record' ){
		echo "收入:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择主类\">";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择子类\"><br>";
		echo "地址:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"选择地址\"><br>";
		echo "收入金额:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入金额\"><br>";
		echo "收入说明:&nbsp;";
		echo "<input  type=\"text\" name=\"maintype\" size=\"8\" value=\"收入说明\"><br>";
		echo "<INPUT type=\"submit\" value=".$_ADD_IN.">";

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

	}
?>
</form>

<?PHP
	/*  获取今天的数据 */
	if  ( $recordtype == 'out_record' )
	{
		echo "===========================<br>";
		$today_out_corde = $Finance->getCordeData($login_user_id,$Finance->_out_corde,date("Y-m-d"));
		print_r($today_out_corde);
		echo "<Br>".date("Y-m-d");
	} else if ( $recordtype == 'in_record' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";

	} else if ( $recordtype == 'out_record_type' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";
	} else if ( $recordtype == 'in_record_type' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";

	} else if ( $recordtype == 'address' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";
	} else if ( $recordtype == 'user' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";
	} else if ( $recordtype == 'family' ){
		echo "<br>";
		echo "+++++++++++++++++++++++<br>";
		echo "获取今天的数据";

	}
?>


