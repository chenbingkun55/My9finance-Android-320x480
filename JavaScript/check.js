	function check(){
		var loginform = document.getElementById('login-form');
		var info="";
		var stats=true;

		/* match  �Էǿ��ַ���ʼ,�м䲻�����пո�,�����и��ַ�. */
		if(!loginform.username.value.match(/^\S+$/)){
			info+="�û�������ʹ�ÿո��Ϊ��!\n";
			stats = false;
		} else if ( loginform.username.value.length >= 15){
			info+="�û������ܳ���15���ַ�!\n";
			stats = false;
		}

		if (loginform.password.value == ""){
			info+="�û����벻��Ϊ��!\n";
			stats = false;
		}
		if(!stats){
			alert(info);
		}
		return stats;
	}
