<?php 

//alte Seiten auf neue Arbeitsbereiche
$array_page_id_zu_aktuellem_link = array(
82 => "https://www.ec.de/arbeitsbereiche/kinder-jungschar/",
6905 => "https://www.ec.de/ueber-uns/ja4d/",
12796 => "https://www.ec.de/grundkurs-mentoring/",
63 => "https://www.ec.de/arbeitsbereiche/teenager-jugend/",
149 => "https://www.ec.de/arbeitsbereiche/pfadfinder/",
1317 => "https://www.ec.de/arbeitsbereiche/kinder-jungschar/",
696 => "https://www.ec.de/arbeitsbereiche/evangelisation/",
2220 => "https://www.ec.de/arbeitsbereiche/studiec/",
698 => "https://www.ec.de/arbeitsbereiche/evangelisation/",
12796 => "https://www.ec.de/arbeitsbereiche/echt-junge-erwachsene/",
12645 => "https://www.ec.de/ueber-uns/ja4d/",
302 => "https://www.ec.de/arbeitsbereiche/seelsorge/",
5739 => "https://www.ec.de/arbeitsbereiche/seelsorge/",
11460 => "https://www.ec.de/arbeitsbereiche/teenager-jugend/",
2940 => "https://www.ec.de/arbeitsbereiche/evangelisation/",
727 => "https://www.ec.de/ueber-uns/merchandise-material/",
735 => "https://www.ec.de/ueber-uns/downloadpool/",
16 => "https://www.ec.de/ueber-uns/wer-wir-sind/",
23 => "https://www.ec.de/ueber-uns/grundtexte/",
25 => "https://www.ec.de/ueber-uns/grundtexte/",
27 => "https://www.ec.de/ueber-uns/grundtexte/",
18 => "https://www.ec.de/ueber-uns/spenden/",
250 => "https://www.ec.de/ueber-uns/wer-wir-sind/",
534 => "https://www.ec.de/verband/ec-in-der-region/",
536 => "https://www.ec.de/verband/ec-struktur/",
3011 => "https://www.ec.de/ueber-uns/kontakt/",
539 => "https://www.ec.de/ueber-uns/kontakt/",
20 => "https://www.ec.de/verband/mitgliedschaft/",
2603 => "https://www.ec.de/ueber-uns/stiftungen/",
455 => "https://www.ec.de/ueber-uns/kontakt/",
2800 => "https://www.ec.de/ueber-uns/jobs/",
5668 => "https://www.ec.de/ueber-uns/kontakt/",
2791 => "https://www.ec.de/verband/ec-freizeitheime/",
40 => "https://www.ec.de/ueber-uns/kontakt/",
42 => "https://www.ec.de/impressum/",
14946 => "http://www.nextplus-kongress.de/",
);

if($array_page_id_zu_aktuellem_link[$_GET['page_id']] != ""){
	header("HTTP/1.1 301 Moved Permanently");
	header('Location: '.$array_page_id_zu_aktuellem_link[$_GET['page_id']]);
	header("Connection: close");
	exit;
}

get_header(); 

?>

   <div id="main" style="">

<div class="headerbild" style="height: 600px;background-image: url(wp-content/themes/ecjugend20192/img/ec-logo-404.png);
">
<div id="slogan" class="slogan">
<div class="block_logo_subtitle"></div>
	
	<div class="block_logo_description" style="font-size: 3vw;color: black;">
	<div style="text-shadow: none !important;">
	Hilf uns dabei diese Seite zu verbessern. Schreib uns doch eine kurze Mail, welche URL du eingegeben hast und wo du eigentlich landen wolltest.
						
	</div>
	</div>
</div>
</div>

	
	<div class="inhalts_container_mittig_max_width" style="">
	
	  <div class="table-button button_mitte">
								<div class="table-row-button">
									<div class="table-cell-button button_zeichen"></div>
									<a href="mailto:info@ec-nordheide.de" target="_blank" style="text-decoration: none;">
										<div class="table-cell-button button_verlauf ">info@ec-nordheide.de</div>
									</a>
								</div>
						</div>	
		
		

	</div><!-- inhalts_container_mittig_max_width -->
	
	
	
   </div><!-- main -->
 
 
<?php get_footer(); ?>