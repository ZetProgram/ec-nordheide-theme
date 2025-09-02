function selectElement(id, valueToSelect) {    
    let element = document.getElementById(id);
    element.value = valueToSelect;
}

function isElementInViewport(element) {
 var rect = element.getBoundingClientRect();
 
var tolleranz = -200;
 
 return (
	(rect.top+tolleranz) >= 0 
	/*&&
	(rect.left-tolleranz) >= 0*/ &&
	(rect.bottom+tolleranz) <= (window.innerHeight || document.documentElement.clientHeight) 
	
	/*&&
	(rect.right-tolleranz) <= (window.innerWidth || document.documentElement.clientWidth)*/
 );
}

var elements_einfaden = document.querySelectorAll(".einfaden");
var elements_animate_von_links = document.querySelectorAll(".animate_von_links");
var elements_animate_von_rechts = document.querySelectorAll(".animate_von_rechts");
var elements_von_rechts_einfahren = document.querySelectorAll(".von_rechts_einfahren");
var elements_von_links_einfahren = document.querySelectorAll(".von_links_einfahren");
var elements_oeffnen = document.querySelectorAll(".oeffnen");
var elements_resize_anim_links_rechts = document.querySelectorAll(".resize_anim_links_rechts");



// Timeline define variables
var items = document.querySelectorAll(".timeline li");
var fixierer = document.querySelectorAll(".fixierer");

$window = $(window);
var beziehungskompass_ausgefuehrt = 0;
var beziehungskompass_duration = 1000;





function callbackFunc_load(){
		/*werte setzen ohne scroll callbackFunc*/
	var element_body = document.body;
	var left = element_body.offsetLeft;
	var right = element_body.offsetWidth - left;
	var top = element_body.offsetTop;
	var bottom = element_body.offsetHeight - top;

	for(var i=1;i<=anzahl_hexagone;i++){
		if(document.getElementById('hex'+i+'_ec')){
			var ein_element = document.getElementById('hex'+i+'_ec');
			
			//var offset = ein_element.getAttribute("data-y-offset");
			var offset = random(800,bottom);
			//alert(bottom);
			//alert(parseInt(offset)+'/'+bottom);
			if(parseInt(offset) > bottom){
				offset = bottom;
			}
			window['data-y-offset-'+i] = offset;
			window['speed-'+i] = ein_element.getAttribute("data-speed");
		}
		
	}
	callbackFunc_scroll();
}

function callbackFunc_scroll() {
	
	for (var i = 0; i < items.length; i++) {
      if (isElementInViewport(items[i])) {
        items[i].classList.add("in-view");
      } else {
		  items[i].classList.remove("in-view");
	  }
    }
	
	for (var i = 0; i < elements_einfaden.length; i++) {
		if (isElementInViewport(elements_einfaden[i])) {
			//alert(elements_einfaden[i].id + " isElementInViewport");
			elements_einfaden[i].classList.add("einfaden_visible");
		} else{
			//elements_einfaden[i].classList.remove("einfaden_visible");
		}
	}	
	
	for (var i = 0; i < elements_resize_anim_links_rechts.length; i++) {
		if (isElementInViewport(elements_resize_anim_links_rechts[i])) {
			//alert(elements_einfaden[i].id + " isElementInViewport");
			elements_resize_anim_links_rechts[i].classList.add("resize_anim_links_rechts_visible");
		} else{
			elements_resize_anim_links_rechts[i].classList.remove("resize_anim_links_rechts_visible");
		}
	}
	
	for (var i = 0; i < elements_von_rechts_einfahren.length; i++) {
		if (isElementInViewport(elements_von_rechts_einfahren[i])) {
			//alert(elements_von_rechts_einfahren[i].id + " isElementInViewport");
			elements_von_rechts_einfahren[i].classList.add("von_rechts_einfahren_visible");
		} else{
			elements_von_rechts_einfahren[i].classList.remove("von_rechts_einfahren_visible");
		}
	}	
	
	for (var i = 0; i < elements_von_links_einfahren.length; i++) {
		if (isElementInViewport(elements_von_links_einfahren[i])) {
			//alert(elements_von_links_einfahren[i].id + " isElementInViewport");
			elements_von_links_einfahren[i].classList.add("von_links_einfahren_visible");
		} else{
			elements_von_links_einfahren[i].classList.remove("von_links_einfahren_visible");
		}
	}
	
	for (var i = 0; i < elements_oeffnen.length; i++) {
		if (isElementInViewport(elements_oeffnen[i])) {
			//alert(elements_oeffnen[i].id + " isElementInViewport");
			elements_oeffnen[i].classList.add("oeffnen_visible");
		} else{
			//elements_oeffnen[i].classList.remove("oeffnen_visible");
		}
	}
	
	for (var i = 0; i < elements_animate_von_links.length; i++) {
		if (isElementInViewport(elements_animate_von_links[i])) {
			//alert(elements_animate_von_links[i].id + " isElementInViewport");
			$('#'+elements_animate_von_links[i].id).animate({
				left: '0',
				opacity: 1,
				
			});
/*
			$('#'+elements_animate_von_links[i].id).css ({
			  "transform": "skew(0deg)",
			  "-webkit-transform" : "skew(0deg)", 
			  "-ms-transform":"skew(0deg)"
			 });*/
			//elements_animate_von_links[i].classList.add("von_rechts_einfahren_visible");
		} else{
			//elements_animate_von_links[i].classList.remove("von_rechts_einfahren_visible");
		}
	}
	
	for (var i = 0; i < elements_animate_von_rechts.length; i++) {
		if (isElementInViewport(elements_animate_von_rechts[i])) {
			//alert(elements_animate_von_rechts[i].id + " isElementInViewport");
			$('#'+elements_animate_von_rechts[i].id).animate({
				left: '0',
				opacity: 1,
				
				});
			/*	
			$('#'+elements_animate_von_rechts[i].id).css ({
			  "transform": "skew(0deg)",
			  "-webkit-transform" : "skew(0deg)", 
			  "-ms-transform":"skew(0deg)"
			 });*/
			//elements_animate_von_rechts[i].classList.add("von_rechts_einfahren_visible");
		} else{
			//elements_animate_von_rechts[i].classList.remove("von_rechts_einfahren_visible");
		}
	}
	
	
	var element_body = document.body;
	
	var left = element_body.offsetLeft;
		var right = element_body.offsetWidth - left;
		var top = element_body.offsetTop;
		var bottom = element_body.offsetHeight - top;
		var breite = element_body.offsetWidth;
	  
		document.getElementById('dev_out').innerHTML = breite;
	/*if (isElementInViewport(document.getElementById('viewport_footer'))) {
		//alert("viewport_footer");
		
		} else{
			//elements_animate_von_rechts[i].classList.remove("von_rechts_einfahren_visible");
		}
	scrollendes div (erstmal eins)*/
	//hex3
	/*
		var element_body = document.body;
		
		var left = element_body.offsetLeft;
		var right = element_body.offsetWidth - left;
		var top = element_body.offsetTop;
		var bottom = element_body.offsetHeight - top;
*/
	for(var i=1;i<=anzahl_hexagone;i++){
		if(document.getElementById('hex'+i+'_ec')){
			var ein_element = document.getElementById('hex'+i+'_ec');

			var windowScrollTop = $window.scrollTop();
			var yPos = -(windowScrollTop * (window['speed-'+i]/10000))+parseInt(window['data-y-offset-'+i]); 
			
			// Put together our final background position
			var coords = yPos + 'px';
			ein_element.style.top = coords;
			
		}
	}
	/*
	for(var i=1;i<=8;i++){
		if(document.getElementById('hex'+i+'_ec_lichtsttrahlen')){
			var ein_element = document.getElementById('hex'+i+'_ec_lichtsttrahlen');
			var speed = ein_element.getAttribute("data-speed");
			var datayoffset = ein_element.getAttribute("data-y-offset");
			
			var winscrolltop = $window.scrollTop();
			var ec_lichtstrahlen_div_offsetTop = document.getElementById('ec_lichtstrahlen_div').offsetTop-datayoffset;
			var diff_winscrolltop_ec_lichtstrahlen_div_offsetTop = winscrolltop-ec_lichtstrahlen_div_offsetTop;
			
			var yPosHex4 = (diff_winscrolltop_ec_lichtstrahlen_div_offsetTop * speed);
			// Put together our final background position
			var coords = yPosHex4 + 'px';
			//neue Position
			ein_element.style.top = coords;
		}
	}
	*/
	/*
	if(document.getElementById('hex2_ec_lichtsttrahlen')){
		var ein_element = document.getElementById('hex2_ec_lichtsttrahlen');
		var speed = ein_element.getAttribute("data-speed");
		var datayoffset = ein_element.getAttribute("data-y-offset");
		
		var winscrolltop = $window.scrollTop();
		var ec_lichtstrahlen_div_offsetTop = document.getElementById('ec_lichtstrahlen_div').offsetTop-datayoffset;
		var diff_winscrolltop_ec_lichtstrahlen_div_offsetTop = winscrolltop-ec_lichtstrahlen_div_offsetTop;
		
		
		
		
		var yPosHex4 = (diff_winscrolltop_ec_lichtstrahlen_div_offsetTop * speed);
		// Put together our final background position
		var coords = yPosHex4 + 'px';
		//neue Position
		ein_element.style.top = coords;
	}
	*/
	/*
	//hex4 soll sich von oben nach unten bewergen
	if(document.getElementById('hex4')){
		var ein_element_hex4 = document.getElementById('hex4');
		var speed_hex4 = ein_element_hex4.getAttribute("data-speed");
		var xmax = ein_element_hex4.getAttribute("data-xmax");
		var yPos_hex4 = ($window.scrollTop() * speed_hex4); 
		// Put together our final background position
		var coords_hex4 = yPos_hex4 + 'px';
		//neue Position
		//alert(speed_hex4);
		if(yPos_hex4 <= xmax){
			//alert("pos hex4: " + yPos_hex4);
			ein_element_hex4.style.top = coords_hex4;
		}
	}*/
	//document.getElementById('dev_out').innerHTML = yPos_hex4+' / '+coords_hex4; 
	

	
}
jQuery(document).ready(function() {

window.addEventListener("load", callbackFunc_load);
window.addEventListener("scroll", callbackFunc_scroll);

});

function random(min, max) {
  return min + Math.random() * (max - min);
}

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}