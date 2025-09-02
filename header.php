<?php 
session_start();

$php_offsetWidth = 0;

if($_GET['superadmin'] == 1){
	$_SESSION['superadmin'] = "superadmin";
}
if($_GET['superadmin'] == 0){
	unset($_SESSION['superadmin']);
}
?>
<?php define('THEME_PFAD',get_stylesheet_directory_uri()); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//DE" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
 
<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php 
$style_version = '003';
$js_version = '002';
 ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo THEME_PFAD.'/style_V'.$style_version.'.css' ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

<?php wp_head(); ?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="<?php echo bloginfo('template_url'); ?>/javaScript.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<!-- hier muss es eingefügt werden, sonst funktioniert das FAQ nicht ?? Konflikt mit Zeile darüber?! -->
<script type='text/javascript' src='/wp-content/plugins/sp-faq/js/jquery.accordion.js?ver=3.3.2'></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>



<script type="text/javascript"> 

jQuery(document).on( 'nfFormReady', function( e, layoutView ) {
    if(document.getElementById('nf-field-375')){
		selectElement('nf-field-375', '<?php echo $_GET['infomaterial']; ?>');
		document.getElementById('nf-field-348').value = 1;
		}
});


check_device();
$(document).ready(function(){

  	
 //$(".slogan").fadeOut();
	$(".slogan").css("opacity", 0);
	$(".slogan").animate({opacity: 1}, 3000);
	
	
	
	
	$( "#testbutton" ).click(function() {
  $( "#menu_header_unten_ebene2" ).animate({
    opacity: "1",
  }, 1000, function() {
    // Animation complete.
  });
});
});


</script>

<script>
// Seichtes Scrollen zum Anker
$(document).ready(function(){

	// Klick auf einen Link, der eine Raute (# = Anker) enthält
	$('a[href*="#"]').on('click',function(e) {
		e.preventDefault();

		var target = this.hash;
		var $target = $(target);

		$('html, body').stop().animate({
			'scrollTop': ($target.offset().top-200)
		}, 1500, 'swing', function () {
			//window.location.hash = target;
		});
	});
	
	headerbild_overlay_hexagone_anpassen();
	window.addEventListener('resize', function() {
		headerbild_overlay_hexagone_anpassen();
	});
	
});
 </script>


<style>
@media (max-width:<?php echo get_theme_mod( 'display_none_hexagone' ); ?>px) {
	.hexagone_wrapper{
		display: none;
	}
}
</style>

</head>

<!-- linke seite -->
<?php

$anzahl_hexagone = get_theme_mod( 'anzahl_hexagone' );
if($anzahl_hexagone > 20){
	//$anzahl_hexagone = 20;
}
?>
<script>
var anzahl_hexagone = <?php echo $anzahl_hexagone;?>;
</script>
<?php


/*
 	$a_img = wp_get_attachment_image_src(get_theme_mod( 'img_hexagone_link_'.$hex ), 'small');
	pf($a_img);
 */
for($i = 1;$i<=$anzahl_hexagone;$i++){
	
	$hex = rand(1,8);
	
	$a_img = wp_get_attachment_image_src(get_theme_mod( 'img_hexagone_link_'.$hex ), 'small');
	$a_img_href = get_theme_mod( 'img_hexagone_link_href_'.$hex );
	
	$link_start = '';
	$link_ende = '';
	
	if($a_img_href != ""){
		$link_start = '<a href="'.$a_img_href.'" target="_blank">';
		$link_ende = '</a>';	
	}
	
	if($a_img[0] == ""){
		$img_src = '/wp-content/themes/ecjugend20192/img/hex_'.$hex.'.png" id="hex'.$i.'_ec';
	} else {
		$img_src = ''.$a_img[0].'" id="hex'.$i.'_ec';
	}
	
	$speed = rand(get_theme_mod( 'geschwindigkeit_hexagone_von' )*100,get_theme_mod( 'geschwindigkeit_hexagone_bis' )*100);
	//$offset = rand(800,4000);/*wird in JS geregelt, da die länge der Seite nicht bekannt ist*/
	$rot = rand(get_theme_mod( 'rotation_hexagone_von' ),get_theme_mod( 'rotation_hexagone_bis' ));
	$left_right_proz = rand(get_theme_mod( 'abstand_rand_hexagone_von' ),get_theme_mod( 'abstand_rand_hexagone_bis' ));
	$groesse = rand(get_theme_mod( 'groesse_hexagone_von' ),get_theme_mod( 'groesse_hexagone_bis' ));
	
	$opacity = rand(get_theme_mod( 'opacity_hexagone_von' ),get_theme_mod( 'opacity_hexagone_bis' ))/100;
	//$opacity = 1;/*immer voll sichtbar*/
	
	
	if ($i % 2 == 0){
		$s_left_right = 'left';
	} else {
		$s_left_right = 'right';
	}
		
	$s_hex .= $link_start.'<img src="'.$img_src.'" id="hex'.$i.'_ec" data-speed="'.$speed.'" 
		style="position: absolute; 
		'.$s_left_right.': '.$left_right_proz.'%;
		opacity: '.$opacity.';
		z-index: 4;
		top: -500px;
		width: '.$groesse.'vw;
		 transform: rotate('.$rot.'deg);">'.$link_ende;
}

?>
		 
<div id="dev_out" style="display: none;position: fixed;top:100px;left: 0;z-index:3000;background-color: #000;color: #fff;"></div>		 
<body style="overflow: hidden;">
<div class="hexagone_wrapper"><?php echo ''.$s_hex.''; ?></div>


<div id="body_wrapper" class="">





   <div id="header_wrapper">
   <div id="header" style="">

   
   
   <div id="header_logo_menu_wrapper">

		<div id="menu_header_unten" class="">
		
			<div class="section group">
				<div class="col_header col_header_logo">
					
					
					<div id="" class="">
						<div id="" class="">
						<?php 
								$custom_logo_id = get_theme_mod( 'custom_logo' );
								$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );	
						   ?>
						   <a href="/index.php">
							<img src="<?php echo $image[0]; ?>" class="logo_img" style="" alt="">
						   </a>
						   
						 </div>
						
					</div>
					
					
				</div>

				<div class="col_header align-right menu_col_header" style="">
					<div class="menu_button_wrapper " style="margin-right: 0;margin-left:auto;">

						<div class="section group " style="position: relative;">
							<div class="col span_1_of_3 " id="menubutton_div" style="">
								<div id="mobile_top_menu" class="pointer" style="margin-top: 5px;" onclick="menu_items_oeffnen();"><i class="fas fa-bars fa-2x"></i></div>
							</div>
							
							<div class="col span_1_of_3 " id="spendenbutton_div">
								<div id="" class="pointer center" style="margin-top: 3px;font-size: 28px;">
								<a style="text-decoration: none;" target="<?php echo get_theme_mod( 'highlightbtn_target' ); ?>" href="<?php echo get_theme_mod( 'highlightbtn_url' ); ?>"><?php echo get_theme_mod( 'highlightbtn_titel' ); ?></a>
								</div>
							</div>
							
							<div class="col span_1_of_3 " id="suchebutton_div" style="">
								<div id="" class="pointer center" style="margin-top: 5px;"><i onclick="suchfeld_einblenden('sf_webseite');" class="fas fa-search fa-2x"></i>
								
								
								</div>
							</div>
						</div>
					</div>	 
				
				</div>					
				
	
		   
			</div>
			
		</div><!-- menu_header_unten -->
		
	</div><!-- header_logo_menu_wrapper -->
   </div><!-- header -->
   </div><!-- header wraooer -->


  <div id="div_main_menu" class="main_menu">
	 <div class="main_menu_inner_wrapper">
		<div class="align-right">
		<i class="far fa-2x fa-times-circle grau" style="margin: 10px;" onclick="menu_items_schliessen();"></i>			
			 <?php 
				echo ec_search_form('sf_im_menu');
			   ?>
			   
		</div>
		<div class="section group" style="position: relative;">
	<?php 
		$i_anz = 0;
		
		for($i = 1;$i <= 4;$i++){
			$a_parent_id[$i] = get_theme_mod( 'main_meu_spalte_'.$i, '0' );
			$a_bezeichnung[$i] = get_theme_mod( 'main_meu_spalte_bezeichnung_'.$i, 'Überschrift' );
			if($a_parent_id[$i] == 0){
				unset($a_parent_id[$i]);
			}
		}
		
		$anz = @count($a_parent_id);
		
		if($anz <= 0){
			echo "Bitte im Customizer unter Mainmenu Spalten die entsprechenden Parameter definieren.";
		}
		
		foreach($a_parent_id as $z => $a_parent){
			echo '
			<div class="col span_1_of_'.$anz.' center">
				<div class="menu_ueberschriften">'.$a_bezeichnung[$z].'</div>

				<div class="main_menu_ab_ebene_2">';
					echo liste_menu($a_parent);
			echo '</div>
			</div>
			';
		}
		
	?>
		</div>
		<div id="im_main_menu" class="center hintergrund_gruen_main_menu_bottom" style="padding-top: 10px;padding-bottom: 10px;"><?php 
		wp_nav_menu(
		  array(
		   'theme_location' => 'footer-menu'
		  )
		);
?></div>			
	</div>
	</div>
	
	<div id="div_search_form" class="inhalt_begrenzte_breite_zentriert">
			
			   <?php 
				echo ec_search_form('sf_webseite');
			   ?>
			
			
	</div>