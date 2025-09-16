var THEME_PFAD = './wp-content/themes/ecjugend20192';
const sleep = (milliseconds) => {
	return new Promise(resolve => setTimeout(resolve, milliseconds))
}



function wp_mitarbeiter_kategorie_mitarbeiter_einblenden(id) {
	// alert(alle_ids.length);
	// alle elemente schliessen
	for (var i = 0; i <= alle_ids.length; i++) {
		$('#' + alle_ids[i]).hide('slow');
	}
	if (document.getElementById(id).style.display == "block") {
		$('#' + id).hide('slow');
	} else {
		$('#' + id).show('slow');
	}

}

function suchfeld_einblenden() {
	add_class("#sf_webseite", "sf_webseite_sichtbar");
}

function suchfeld_ausblenden() {
	remove_class("#sf_webseite", "sf_webseite_sichtbar");
}

/*ist es ein Smartphone, Tablet oder ein Desktop pc?*/
function check_device() {
	function handleMotion(event) {

		if (event.acceleration.x) {
			document.getElementById('menu_triangle').style.display = "none";
			// alert("device mit sensor");
		} else {
			// alert("kein sensor");
		}

		window.removeEventListener("devicemotion", handleMotion);

	}

	window.addEventListener("devicemotion", handleMotion);

}

function check_offsetWidth() {
	$.ajax(
		{
			method: "POST",
			url: "/wp-content/themes/ecjugend20192/func.php",
			data: "aktion=set_offsetWidth&offsetWidth=" + document.body.offsetWidth,
			success: function (result) {
				// hier passiert nichts, unten, falls die Werte abweichen
			},
			fail: function () {
				alert('fail');
			}
		}
	);
}

function headerbild_overlay_hexagone_anpassen() {
	/*slider höhe ermitteln*/
	if (document.querySelector(".wp-block-nextend-smartslider3")) {
		var element = document.querySelector(".wp-block-nextend-smartslider3");
		// alert(element.offsetHeight);
		if (document.getElementById('headerbild_overlay_hexagone')) {
			var headerbild_overlay_hexagone = document.getElementById('headerbild_overlay_hexagone');
			headerbild_overlay_hexagone.style.height = element.offsetHeight + 'px';
		}

	}
}

function beziehungskompass_notiz_einblenden(id) {

	$('#bzkp_in_notiz').css("opacity", "0");
	$('#bzkp_out_notiz').css("opacity", "0");
	$('#bzkp_up_notiz').css("opacity", "0");
	$('#bzkp_with_notiz').css("opacity", "0");

	$('#' + id).animate(
		{
			opacity: 1,
		}
	);
}


function menu_items_oeffnen() {
	suchfeld_ausblenden();

	$('#div_main_menu').animate(
		{
			top: '0px'
		},
		{
			complete: function () {

				$("#body_wrapper").click(
					function () {
						menu_items_schliessen();
					}
				);
			}
		}
	);
}

function menu_items_schliessen() {

	$('#div_main_menu').animate(
		{
			top: '-2500px'
		},
		{
			complete: function () {
				$("#body_wrapper").prop("onclick", null).off("click");

			}
		}
	);

}

function terminbeschreibung_fadeIn(id) {

	document.getElementById('terminbeschreibung_inhalt').innerHTML = document.getElementById(id).innerHTML;
	// add_class('#terminbeschreibung_inhalt','class_terminbeschreibung_inhalt_visible');
}

function terminbeschreibung_fadeOut(id) {
	remove_class('#terminbeschreibung_inhalt', 'class_terminbeschreibung_inhalt_visible');
}

function add_class(selector, addclass) {
	document.querySelector(selector).classList.add(addclass);
}

function remove_class(selector, removeclass) {
	document.querySelector(selector).classList.remove(removeclass);

}

function link_klick(url) {
	window.location = url;
}

function go_to_link(url) {
	// window.location = url;
	alert("demnächst gehts zu 'Arbeitsbereiche Seite', ist die Frage, ob wir die Übersichtsseite benötigen, wir können auch jedes Element aus dem Slider einzeln verlinken.");
}

function spenden_button_freigeben() {

	if (document.getElementById('Datenschutzrichtlinie_gelesen_verstanden_akzeptiert').checked == true) {
		document.getElementById('datenschutzbestimmungen_link').click(); /*Datenschutzbestimmung öffnen*/
		document.getElementById('spenden_button').disabled = false;
	} else {
		document.getElementById('spenden_button').disabled = true;
	}

}

function regelmaessig_form_aufrufen() {
	// alert(document.getElementById('einmalig_regelmaessig').value);

	if (document.getElementById('einmalig_regelmaessig').value == "regelmaessig") {

		document.getElementById('zahlart_div').style.display = 'none';

		document.getElementById('sepa_form').style.display = "block";
		// felder auf required setzen
		document.getElementById('Turnus').lang = "de";
		document.getElementById('regelmaessig_am').lang = "de";
		document.getElementById('regelmaessig_ab').lang = "de";
		document.getElementById('Kreditinstitut').lang = "de";
		document.getElementById('BIC').lang = "de";
		document.getElementById('IBAN').lang = "de";
		document.getElementById('spenden_button').value = "Jetzt regelmäßig spenden!";
		// document.getElementById('spendenformular').action = "http://www.ec-jugend.de/public/sepa_spende.php";

		var today = new Date();
		var tomorrow = new Date(today);
		tomorrow.setDate(today.getDate() + 6);
		var monat = tomorrow.getMonth() + 1;
		var tag = tomorrow.getDate();
		var jahr = tomorrow.getFullYear();
		document.getElementById('regelmaessig_ab_fruehstens').innerHTML = tag + "." + monat + "." + jahr;
		document.getElementById('regelmaessig_ab').value = tag + "." + monat + "." + jahr;

	} else {
		document.getElementById('zahlart_div').style.display = 'block';
		document.getElementById('sepa_form').style.display = "none";
		// felder auf required setzen
		document.getElementById('Turnus').lang = "";
		document.getElementById('regelmaessig_am').lang = "";
		document.getElementById('regelmaessig_ab').lang = "";
		document.getElementById('Kreditinstitut').lang = "";
		document.getElementById('BIC').lang = "";
		document.getElementById('IBAN').lang = "";
		document.getElementById('spenden_button').value = "Jetzt spenden!";
	}

}


function pruefe_formular(formular_id) {
	var a_ad_felder = document.getElementById(formular_id).elements;
	var meldung = '';
	for (i = 0; i < a_ad_felder.length; i++) {
		switch (a_ad_felder[i].type) {
			case "text":
			case "select-one":
				if (a_ad_felder[i].lang == 'de' && a_ad_felder[i].value == "") {
					meldung += a_ad_felder[i].title + "\n";
					a_ad_felder[i].style.border = "solid red 1px";
				}
				break;
			case "checkbox":
				if (a_ad_felder[i].lang == 'de' && a_ad_felder[i].checked == false) {
					meldung += a_ad_felder[i].title + "\n";
					a_ad_felder[i].style.border = "solid red 1px";
				}
				break;
			case "textarea":
				if (a_ad_felder[i].lang == 'de' && a_ad_felder[i].value == "") {
					meldung += a_ad_felder[i].title + "\n";
					a_ad_felder[i].style.border = "solid red 1px";
				}
				break;
		}

	}

	if (meldung == "") {

		if (document.getElementById('ffeld').value == "") {
			return true;
		} else {
			return false;
		}
	} else {
		alert(meldung);
		return false;
	}
}

function oeffne_steckbrief(id) {
	var alle_div_steckbrief = document.getElementsByClassName('div_steckbrief');

	if (document.getElementById(id).style.display == 'none') {
		for (var i = 0; i < alle_div_steckbrief.length; i++) {
			document.getElementById(alle_div_steckbrief[i].id).style.display = 'none';
		}
		document.getElementById(id).style.display = 'block';
		document.getElementById(id).className = 'div_steckbrief rahmen';
	} else {
		document.getElementById(id).style.display = 'none';
		document.getElementById(id).className = 'div_steckbrief';
	}
}