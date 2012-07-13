	var province=['主类1','主类2','主类3'];

	var citys = new Array(
		new Array("子类1","子类2","子类3"),	
		new Array("子类A","子类B","子类C"),	
		new Array("子类AA","子类BB","子类CC")
	);

function scity(pname,cname){
	document.write('<select onChange="selectc(this);" id="pro" name="'+pname+'">');
	document.write('<option value="">--选择主类--</option>');
	for(var i=0; i<province.length; i++){
		document.write('<option value="'+province[i]+'">'+province[i]+'</option>');
	}
	document.write("</select>");

	document.write('<select id="citys" name="'+cname+'">');
	document.write('<option value="">--选择分类--</option>');
	document.write("</select>");
	
}


function selectc(pobj){
	var index=pobj.selectedIndex-1;
	var cobj=document.getElementById("citys");
	cobj.innerHTML="";
	if ( index >=0 ){
		var option=document.createElement("option");
		var text="--选择分类--";
		option.value=text;
		option.innerHTML=text;
		cobj.appendChild(option);
		for (var i=0; i< citys[index].length ; i++ ){
			var option=document.createElement("option");
			var text=citys[index][i];
			option.value=text;
			option.innerHTML=text;
			cobj.appendChild(option);
		}
	}
}