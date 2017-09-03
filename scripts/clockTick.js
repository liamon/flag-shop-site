window.addEventListener("load", clockTick);

function clockTick() {
	var curTime = new Date();
	var hour = curTime.getHours();
	var mins = curTime.getMinutes();
	var secs = curTime.getSeconds();
	
	hour = (hour < 10) ? "0" + hour : hour; //
	mins = (mins < 10) ? "0" + mins : mins; // Leading zeroes
	secs = (secs < 10) ? "0" + secs : secs; //
	
	document.getElementById("clock").innerHTML = "Current Time:<br>" + hour + ":" + mins + ":" + secs;
	window.setTimeout("clockTick()", 1000);
}
