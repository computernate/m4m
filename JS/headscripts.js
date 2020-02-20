

//When the user scrolls down, hide the top

var scrolledDown=false;
var lastPagey=0;
window.onscroll=function(){
	var topdis=document.body.scrollTop;
	if(!scrolledDown){
		if(lastPagey<topdis){
			document.getElementById("header").classList.add("scrolledUp");
			scrolledDown=!scrolledDown;
			if(nav){
				document.getElementById("fullNav").classList.remove("active");
			}
		}
	}
	else{
		if(lastPagey>topdis){
			document.getElementById("header").classList.remove("scrolledUp");
			scrolledDown=!scrolledDown;
		}
	}
	lastPagey=topdis;
}



//When the user clicks the nav, toggle nav

var nav=false;

function toggleNav(){
	if(nav){
		document.getElementById("fullNav").classList.remove("active");
	}
	else{
		document.getElementById("fullNav").classList.add("active");
	}
	nav=!nav;
}

document.getElementById("userImageFile").onchange = function() {
	console.log("Change");
    document.getElementById("submitUserImage").submit();
};
