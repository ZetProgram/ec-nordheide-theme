<?php 
if(block_lab_backend()){
	?>
	<div style="padding: 10px;"><strong>EC zweites Seitenmenü</strong><br />
	Bitte diesen Block am Seitenende einfügen<div>
	<?php 
}
?>

<script>

	h2_ankern();

	function h2_ankern(){
		var liste_elemente = document.getElementsByTagName('<?php block_field('tag'); ?>');
		//var liste_elemente = document.getElementsByClassName('h2_anker');
		var s_menu = '';
		var s_id = '';
		var html = '';
		var a_menu = new Array();
		
		for (var i = 0; i < liste_elemente.length; i++) {
			
			s_id = 'anker_id_'+i;
			
			liste_elemente[i].id = s_id;
			/*
			liste_elemente[i].classList.add("pointer");
			liste_elemente[i].onclick = function(evt) {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
			}
			*/
			html = liste_elemente[i].innerHTML;
			var s_html = html.replace("<p></p>","");
			s_html = s_html.replace(" ","&nbsp;");
			if(s_menu.indexOf(s_html)<0){
				s_menu += '<span style="margin-right:10px;"><a href="#'+s_id+'">'+s_html+'</a></span> ';
			}
			
		}

		if(document.getElementById('nav2')){
			document.getElementById('nav_dynamisch').innerHTML = '<div class="inhalts_container_mittig_max_width center">'+s_menu+'</div><div id="backtotopbutton" class="" style="display: none;"><i class="fas fa-angle-double-up fa-2x"></i></div>';
		}
	}
	

	
	$(document).ready(function(){
	
	// Der Button wird ausgeblendet
	$("#backtotopbutton").hide();
	
	// Funktion für das Scroll-Verhalten
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) { // Wenn 100 Pixel gescrolled wurde
				$('#backtotopbutton').fadeIn();
			} else {
				$('#backtotopbutton').fadeOut();
			}
		});

		$('#backtotopbutton').click(function () { // Klick auf den Button
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>