function validate_email(field,alerttxt)
{
	with (field)
	{
		apos=value.indexOf("@")
		dotpos=value.lastIndexOf(".")
		if (apos<1||dotpos-apos<2) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_username(field,alerttxt)
{
	with (field)
	{
		if ( value.length >= 15 || ! value.match(/^\S+$/) || ! value.match(/^\S+$/)) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_password(field,alerttxt)
{
	with (field)
	{
		if ( value.length < 6 || ! value.match(/^\S+$/) ) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_yes_password(field,field2,alerttxt)
{
	with (field)
	{
		if ( value != field2.value ) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_qq(field,alerttxt)
{
	
	with (field)
	{
		if ( isNaN(value) || ! value.match(/^\S+$/) || value.length >= 20 ) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function validate_family_num(field,alerttxt)
{
	with (field)
	{
		if ( value.match(/^0/) ||  value.length != 3 ) 
			{alert(alerttxt);return false}
		else {return true}
	}
}

function check(thisform)
{
	with (thisform)
	{
		if (validate_username(username,"用户名不能为空或大于15个字符!")==false)
		  {username.focus();return false}

		if (validate_family_num(family_num,"家庭号是3位数字并以非0开头!")==false)
		  {family_num.focus();return false}

		if (validate_email(email,"邮箱地址格式错误!")==false)
			{email.focus();return false}

		if (validate_qq(qq,"QQ号输入有误!")==false)
			{qq.focus();return false}

		if (validate_password(password,"密码不能为空或小于6位!")==false)
		  {password.focus();return false}

		if (validate_yes_password(password,yes_password,"两次密码不匹配!")==false)
		  {yes_password.focus();return false}
	}
}