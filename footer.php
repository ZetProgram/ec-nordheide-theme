<script src="<?php echo bloginfo('template_url'); ?>/javaScript_footer_V002.js"></script>

<?php 

get_theme_mod( 'instagram_button_beschriftung' );
$insta_am_aus = get_theme_mod( 'instagram_an_aus', 'an' );
$insta_access_token = get_theme_mod( 'instagram_access_token', '' );
$insta_an = false;
if($insta_am_aus == 'an' && $insta_access_token != ""){
	$insta_an = true;
}
if($insta_an === true){
	//http://erz.ec-jugend.de/#access_token=3132420392.1038ae9.bbf3c0aa6acf4761baa59fe87f358233
	$access_token   =   $insta_access_token;//3132420392.1038ae9.bbf3c0aa6acf4761baa59fe87f358233
	$photo_count    =   2;
                  
	$json_link      =   'https://api.instagram.com/v1/users/self/media/recent/?';
	$json_link      .=  'access_token=' . $access_token . '&count=' . $photo_count . '';

	$obj            =   @file_get_contents($json_link);
	$obj            =   json_decode($obj, true, 512, JSON_BIGINT_AS_STRING);

	//pf($obj['data']);
	if(is_array($obj['data'])){
		for/*TODO:refactor each()*/ each($obj['data'] as $z => $data){
			$a_insta_img_urls[] = $data['images']['standard_resolution']['url'];
			$a_insta_link[] = $data['link'];
			$a_insta_text[] =  $data['caption']['text'];
		}
	}
}

?>

	
	
<div class="inhalts_container_mittig_max_width instagramm" style="position: relative;top: -20px;">
	
	<div class="insta_bild_wrapper" style="position: absolute;z-index: 3;width: 100%;top: 150px;">
		<img style="max-width: 200px;" src="/wp-content/uploads/2020/06/Logo_Hexagon_250x250.png" alt="?" title="?" />
	</div>
	
	<div class="inhalts_container_mittig_max_width insta_bild_wrapper" style="position: absolute;z-index: 3;width: 100%;top: 150px;">
	
		<div style="width: 350px;margin-left: auto;margin-right: 10%;">
			<div id="" class="insta_bild insta_bild_1 img_hexagon_q_insta img_hexagon_q_insta_1">
			<a href="<?php echo $a_insta_link[0]; ?>" target="_blank"  alt="<?php echo $a_insta_text[0]; ?>" title="<?php echo $a_insta_text[0]; ?>">
				<img class="insta_img_1" src="<?php echo $a_insta_img_urls[0]; ?>" />
			</a></div>		
		
			<div class="insta_bild insta_bild_2 img_hexagon_q_insta img_hexagon_q_insta_2"><a href="<?php echo $a_insta_link[1]; ?>" target="_blank"  alt="<?php echo $a_insta_text[1]; ?>" title="<?php echo $a_insta_text[1]; ?>">
			<img class="insta_img_2" src="<?php echo $a_insta_img_urls[1]; ?>" /></a></div>			
		</div>	
			
	</div>
</div><!-- inhalts_container_mittig_max_width -->	
			
<div id="footer" class="maske_footer" style="">


	
	<div class="inhalts_container_mittig_max_width" style="color: white;">
		<div class="section group">
			<div class="col span_1_of_3" style="width: 18%;">
     
			</div>
			<div class="col span_1_of_3" style="width: 46.52%;">
			<?php 
	
			$footeradresse = get_theme_mod( 'footeradresse',  'Footer Adresse');
			echo $footeradresse;
			?>
				
			</div>
			
			<div class="col span_1_of_3">
			
			
			<?php 
			if($insta_an === true){
			?>
						
							<div class="button_runde_ecken_hell instagram_button_footer">
								<a href="<?php echo get_theme_mod( 'instagram_link',  ''); ?>" class="" target="_blank" title="">
								<div class=""><?php echo get_theme_mod( 'instagram_button_beschriftung' ); ?></div>
							</a>
							</div>
							
						</div>
			<?php 
			}
			?>
			
		</div>
		<div class="section group">
			<div class="col span_3_of_3 center">
			<div id="im_main_menu">
						<?php 
						wp_nav_menu(
		  array(
		   'theme_location' => 'footer-menu'
		  )
		);
						?>
			</div>
			</div>
		</div>
		
	</div><!-- inhalts_container_mittig_max_width -->
	
</div><!-- footer -->
    
</div><!-- wrapper -->

<?php wp_footer(); ?>

</body>
</html>