<?php get_header(); ?>
 
	<div id="main" style="">

<div class="headerbild" style="height: 200px;background-image: url(/wp-content/uploads/2019/09/bg_verlauf_1920x1582.png);
">
<div id="slogan" class="slogan">EC-Suche</div>
<!--<div class="headerbild_overlay_hexagone" style=""></div>-->
</div>

	<div class="inhalts_container_mittig_max_width" style="">
	
		<?php if ( have_posts() ) : ?>
		<h2>Suchergebnis "<?php echo $s; ?>"</h2>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
			<div>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			
				<?php the_excerpt(); ?>
			</div>
		<?php endwhile; ?>
		
		
		   
		<?php else : ?>
		<h2>Leider nichts gefunden</h2>
		
		<?php endif; ?>
	  
		<div class="abstand_150"></div>
	  
</div><!-- inhalts_container_mittig_max_width -->
	
	
	</div><!-- main -->
	
  
 
<?php get_footer(); ?>
