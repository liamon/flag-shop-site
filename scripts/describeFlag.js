function describe(flag) {
	var mouseOverExplain = '<br><br><span id="smaller">(Mouse over the images and a brief description will appear here!)</span>'
	switch (flag) {
		case "brazil":
			document.getElementById("describe").innerHTML = "To celebrate our expansion into South America and the upcoming 2016 Olympic Games in Brazil, we are cutting the prices on our Brazilian flags!" + mouseOverExplain;
			break;
		case "munster":
			document.getElementById("describe").innerHTML = "Whether you're showing rugby pride or simply provincial pride, fly this Munster flag high!" + mouseOverExplain;
			break;
		case "scotland":
			document.getElementById("describe").innerHTML = "Och aye, represent the Scots with this St. Andrew's Saltire, now on sale!" + mouseOverExplain;
			break;
	}
}
