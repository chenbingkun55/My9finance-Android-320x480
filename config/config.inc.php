<?PHP
session_start();
define("UserName","recod");
define("PassWord","chenbk55");
define("ServerName","localhost");
define("DBName","my9finance");
define("ERRORFILE","error.php");
// define("ROOT_PATH",dirname(_FILE_).'/');
define("INCLUDE_PATH",'../../config/');
define("IMG_PATH",'../../images/');
define("JS_PATH",'../../JavaScript/');
define("CSS_PATH",'../../CssScript/');
define("LIB_PATH",'../../Lib/');
define("DEBUG_YES","0");
date_default_timezone_set('PRC') or die('设置时区错误,请联系管理员.');
?>