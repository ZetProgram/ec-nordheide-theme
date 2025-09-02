<?php
/*Template Name: Headerbild schmal*/
?>
<?php get_header(); ?>


   <div id="main" style="">

<div class="headerbild_schmal" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
<div id="slogan" class="slogan"><?php echo the_title(); ?></div>

<!--<div class="headerbild_overlay_hexagone" style="height: 310px;"></div>-->

</div>
<div id="nav2">
	<div id="nav_dynamisch">

	</div>
</div>

	<div class="inhalts_container_100" style="">
	
				<!-- nur für die Terminliste -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <!--<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>-->
         <div class="entry">
            <?php the_content(); ?>
         </div>
      <?php endwhile; endif; ?>
	  		
			
			<div class="abstand_150"></div>
	</div><!-- inhalts_container_mittig_max_width -->
	
	
   </div><!-- main -->
 
 
<?php get_footer(); ?>