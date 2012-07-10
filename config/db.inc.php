<?PHP
	
class DBSQL{
	private $CONN="";
	
/*------------------------------------------------------------------------------------------*/
	public function _construct()
	{	
		try{
			$conn = mysql_connect(ServerName,UserName,PassWord);
			mysql_query("SET CHARACTER utf8",$conn);
			mysql_query("SET NAMES utf8",$conn);
			//mysql_query("SET COLLATION_CONNECTION utf8_general_ci",$conn);
			//mysql_query("SET COLLATION_DATABASE utf8_general_ci",$conn);
		}catch(Exception $e)
		{
			$msg = $e;
			include(ERRORFILE);
		}
		try{
			mysql_select_db(DBName,$conn);
		}catch(Exception $e)
		{
			$msg = $e;
			include(ERRORFILE);
		}
		$this->CONN = $conn;
		}

/*------------------------------------------------------------------------------------------*/
		public function select($sql = "")
		{
			if(empty($sql)) return false;
			if(empty($this->CONN)) return false;
			try{
				$results = mysql_query($sql,$this->CONN);
			}catch (Exception $e){
				@mysql_free_result($results);
				return false;
			}

			$count = 0;
			$data = array();

			while ($row = @mysql_fetch_array($results))
			{
				$data[$count] = $row;
				$count++;
			}
			@mysql_free_result($results);

			return $data;
		}

/*------------------------------------------------------------------------------------------*/

	public function insert($sql = "" )
	{
		/* 添加日志记录*/
		$this->corde_sql_log($sql); 

		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$results = mysql_query($sql,$this->CONN);
		}catch(Exception $e){
			$msg = $e;
			include(ERRORFILE);
		}
		if (!$results)
		{
			return false;
		}else{
			return @mysql_insert_id($this->CONN);
		}
	}


/*------------------------------------------------------------------------------------------*/

	public function update($sql = "" )
	{
		/* 添加日志记录*/
		$this->corde_sql_log($sql); 

		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$results = mysql_query($sql,$this->CONN);
		}catch(Exception $e){
			$msg = $e;
			include(ERRORFILE);
		}
		if (!$results)
		{
			return false;
		} else {
			return @mysql_affected_rows($this->CONN);
		}
	}


/*------------------------------------------------------------------------------------------*/

	public function delete($sql = "" )
	{
		/* 添加数据库日志记录*/
		$this->corde_sql_log($sql); 

		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{
			$results = mysql_query($sql,$this->CONN);
		}catch(Exception $e){
			$msg = $e;
			include(ERRORFILE);
		}
		if (!$results)
		{
			return false;
		} else {
			return @mysql_affected_rows($this->CONN);
		}
	}

/*------------------------------------------------------------------------------------------*/
	public function corde_sql_log($sql = "" )
	{

		if(empty($sql)) return false;
		if(empty($this->CONN)) return false;
		try{		
			$corde_sql_log = "INSERT INTO  log_sql (id,user_id,group_id,log,create_date) VALUES ('','".$_SESSION['__useralive'][0]."','".$_SESSION['__group_id']."',\"".$sql."\",'".date("Y-m-d H:i:s")."')";
			$results = mysql_query($corde_sql_log,$this->CONN);
		}catch(Exception $e){
			$msg = $e;
			include(ERRORFILE);
		}
		if (!$results)
		{
			return false;
		} else {
			return @mysql_affected_rows($this->CONN);
		}
	}

/*------------------------------------------------------------------------------------------*/

	public function begintransaction()
	{
		mysql_query("SET AUTOCOMMIT=0");
		mysql_query("BEGIN");
	}

/*------------------------------------------------------------------------------------------*/

	public function rollback()
	{
		mysql_query("ROOLBACK");
	}

/*------------------------------------------------------------------------------------------*/

	public function commit()
	{
		mysql_query("COMMIT");
	}

}

?>
