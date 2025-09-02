<?php get_header(); ?>
 
	<div id="main" style="">
   
<div class="headerbild_beitrag" style="background-image: url(/wp-content/uploads/2019/09/bg_verlauf_1920x1582.png);">
<div id="slogan" class="slogan"><?php echo the_title(); ?></div>
<!--<div class="headerbild_overlay_hexagone" style=""></div>-->
</div>
<div id="nav2">
	<div id="nav_dynamisch">

	</div>
</div>

	<!--<div class="inhalts_container_mittig_max_width">-->
	
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
		
 
		<div class="entry">
				<?php the_content(); ?>
		</div>
		 
					<!--<div id="meta">
			<p>erstellt am: <?php the_date( 'd.m.Y' ); ?> | 
			von: <?php the_author(); ?> | 
			Kategorie(n): <?php the_category( ', ' ); ?></p>
		</div>-->
		 
					<?php
		endwhile;
endif;
		?>
		   
	<!-- </div>inhalts_container_mittig_max_width -->
	   
		<?php
		/*
		 * Kommentare sind auf Seiten deaktiviert.
		 * Möchtest du die Kommentarfunktion auf Seiten aktivieren, entferne einfach die beiden "//"-Zeichen vor "comments_template();"
		 */

		// comments_template();
		?>
			<div class="abstand_150"></div>
	</div><!-- main -->
 
 
<?php get_footer(); ?>
