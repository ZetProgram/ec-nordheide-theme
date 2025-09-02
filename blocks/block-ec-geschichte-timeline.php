<?php 
$args = array(
        'category_name' => block_field('ec-geschichte-timeline-kategorie',false),
		'numberposts' => 1000,
		'orderby'     => 'date',
		'order'       => 'ASC'
    );
  
    //Posts holen
   $posts = get_posts($args);
  // pf($posts);
?>
<link rel="stylesheet" href="/wp-content/themes/ecjugend20192/timeline/css/style.css">
<section class="timeline">
  <ol>
  
  <?php 
  foreach ($posts as $post) {
	  $thumbnail = '';
	  if(has_post_thumbnail()){
		  $thumbnail = '<img src="'.get_the_post_thumbnail_url($post->ID, 'small').'" class="thumb">';
	  }
	  echo'
	  <li>
      <div>
        <time>'.$post->post_title.'</time>'.$thumbnail.''.$post->post_excerpt.'
      </div>
    </li>';
  }
   ?> 
   
    <li></li>
  </ol>
  
  <div class="arrows">
    <button class="arrow arrow__prev disabled" disabled>
      <i class="fas fa-4x fa-chevron-circle-left"></i>
    </button>
    <button class="arrow arrow__next">
      <i class="fas fa-4x fa-chevron-circle-right"></i>
    </button>
  </div>
</section>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js'></script>

    <script src="/wp-content/themes/ecjugend20192/timeline/js/index.js"></script>