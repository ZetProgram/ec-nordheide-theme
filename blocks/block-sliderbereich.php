<h2><?php block_field( 'slider-bereich-ueberschrift' ); ?></h2>
<div class="section group">
	<div class="col span_2_of_2">
			<?php
				echo do_shortcode( '[slide-anything id="' . block_field( 'sa-id', false ) . '"]' );
			?>
		
	</div>
</div>
