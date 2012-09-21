	function check(){
		var loginform = document.getElementById('login-form');
		var info="";
		var stats=true;

		/* match  以非空字符开始,中间不允许有空格,至少有个字符. */
		if(!loginform.username.value.match(/^\S+$/)){
			info+="用户名不能使用空格或为空!\n";
			stats = false;
		} else if ( loginform.username.value.length >= 15){
			info+="用户名不能超过15个字符!\n";
			stats = false;
		}

		if (loginform.password.value == ""){
			info+="用户密码不能为空!\n";
			stats = false;
		}
		if(!stats){
			alert(info);
		}
		return stats;
	}
