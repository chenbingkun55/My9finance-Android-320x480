function OverFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);
	
	//alert(FunTitleColor.style.backgroundColor);
	if (FunTitleColor.style.backgroundColor != "#c7edcc")
	{
		FunTitleColor.style.backgroundColor = "#c7edcd";
	}
}

function OutFunTitleColor(obj) { 
	var FunTitleColor = document.getElementById(obj);
	
	if (FunTitleColor.style.backgroundColor == "#c7edcd")
	{
		FunTitleColor.style.backgroundColor = "";
	}
}

function ChangFunTitle(obj){
	var FunTitleColor = document.getElementById(obj);
	
	document.getElementById('FunTitle1').style.backgroundColor = "";
	document.getElementById('FunTitle2').style.backgroundColor = "";
	document.getElementById('FunTitle3').style.backgroundColor = "";
	document.getElementById('FunTitle4').style.backgroundColor = "";
	document.getElementById('FunTitle5').style.backgroundColor = "";

	FunTitleColor.style.backgroundColor = "#c7edcc";
}
