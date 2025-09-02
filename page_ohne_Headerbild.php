<?php
/*Template Name: ohne Headerbild*/
?>
<?php get_header(); ?>


<!-- max_width_500 -->
<div id="nav2">
	<div id="nav_dynamisch">

	</div>
</div>
	<div id="main" style="">

	<div class="inhalts_container_100" style="">
	
				<!-- nur für die Terminliste -->
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
		<!--<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>-->
		<div class="entry">
			<?php the_content(); ?>
		</div>
				<?php
		endwhile;
endif;
	?>
			
	</div><!-- inhalts_container_mittig_max_width -->
		
	</div><!-- main -->
 
 
<?php get_footer(); ?>
