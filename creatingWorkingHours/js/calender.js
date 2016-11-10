function show(num){
	for (var i = min; i <= max; i++) {
		document.getElementById("lineID_"+i).style.display="none";
	}
	document.getElementById("lineID_"+num).style.display="block";
}