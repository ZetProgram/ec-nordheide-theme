<?php
if(strpos($_SERVER['REDIRECT_URL'],'block-lab') !== false){
	echo "Logo, Titel, Text";
}
?>
<?php
$image_id  = block_value( 'logo-url' ); // This will return the image's ID.
$a_logo = wp_get_attachment_image_src( $image_id, 'large' );

$header_bg_image_css = '';
if(block_value( 'logo-individuelle-header-hintergrundgrafik' ) != ""){
	$header_bg_image_id  = block_value( 'logo-individuelle-header-hintergrundgrafik' ); // This will return the image's ID.
	$header_bg_image = wp_get_attachment_image_src( $header_bg_image_id, 'large' );
	$header_bg_image_css = "background-image: url($header_bg_image[0]) !important;";
}

$header_height_css = '';
$headerbild_overlay_hexagone_css = '';
if(block_value( 'logo-individuelle-header-hoehe' ) != ""){
	$header_height_css = "height: ".block_value( 'logo-individuelle-header-hoehe' )."px;";
	$headerbild_overlay_hexagone_css = "height: ".block_value( 'logo-individuelle-header-hoehe' )."px !important;";
}


$logo_subtitle = block_field('logo-subtitle',false);
$logo_description = block_field('logo-description',false);

$s_block_logo_slogan_subtitle_description = '';

if($a_logo['0'] != ""){
	$s_block_logo_slogan_subtitle_description = '<img class="block_logo_img weisses_png_mit_schatten" src="'.$a_logo['0'].'" alt="" title="" />';
}
if($logo_subtitle != ""){
	$s_block_logo_slogan_subtitle_description .= '<div class="block_logo_subtitle">'.$logo_subtitle.'</div>';
}
if($logo_description != ""){
	$s_block_logo_slogan_subtitle_description .= '<div class="block_logo_description"><div>'.$logo_description.'</div></div>';
}
//logo-individuelle-header-hoehe
//logo-individuelle-header-hintergrundgrafik
?>

<script>
document.getElementById('slogan').innerHTML = '<?php echo $s_block_logo_slogan_subtitle_description; ?>';
</script>

<style>
	.headerbild {
    <?php echo $header_height_css; ?>
	<?php echo $header_bg_image_css; ?>
	} 
	.headerbild_beitrag {
    <?php echo $header_height_css; ?>
	<?php echo $header_bg_image_css; ?>
	} 
	.headerbild_schmal {
    <?php echo $header_height_css; ?>
	<?php echo $header_bg_image_css; ?>
	}
	.headerbild_overlay_hexagone{
		<?php echo $headerbild_overlay_hexagone_css; ?>
	}
</style>