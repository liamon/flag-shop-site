window.addEventListener("load", animateBanner);

var curImage = 0;

function animateBanner() {
	document.getElementById("banner").src = "images/flags" + curImage + ".jpg";
	curImage = curImage == 3 ? 0 : curImage + 1;
	window.setTimeout("animateBanner()", 1800);
}
