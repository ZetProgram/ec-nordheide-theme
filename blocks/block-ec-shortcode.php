<?php
$linkstart                       = '';
$linkende                        = '';
$ec_shortcode_element_link       = block_field( 'ec-shortcode-element-link', false );
$ec_shortcode_element_link_title = block_field( 'ec-shortcode-element-link-title', false );
if ( $ec_shortcode_element_link != '' ) {
		$ec_shortcode_element_onclick = "link_klick('$ec_shortcode_element_link');";

}

?>

<div class="<?php block_field( 'ec-shortcode-block-css' ); ?>" title="<?php block_field( 'ec-shortcode-element-link-title' ); ?>" onclick="<?php echo $ec_shortcode_element_onclick; ?>">
<?php
$heading = block_field( 'ec-shortcode-ueberschrift', false );
if ( $heading != '' ) {
	$heading = '<div class="' . block_field( 'ec-shortcode-ueberschrift-class', false ) . '">' . $heading . '</div>';
	echo $heading;
}
?>
<div class="section group <?php block_field( 'ec-shortcode-shortcode-css' ); ?>">
	<div class="col span_2_of_2">
			<?php
				do_shortcode( block_field( 'ec-shortcode-shortcode' ) );
			?>
		
	</div>
</div>

</div>
