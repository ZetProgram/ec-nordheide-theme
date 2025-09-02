<?php 

?>
<h2><?php block_field('ec-posts-ueberschrift'); ?></h2>

<?php

    $args = array(
        'category_name' => block_field('ec-posts-kategorie',false),
        'numberposts' => block_field('ec-posts-anzahl',false)
    );
   
    //Posts holen
   $posts = get_posts($args);

    //Inhalte sammeln
    $content = '<div class="ec_posts ec_posts_div" style="position: relative; width: 100%; margin-left: auto;margin-right: auto;margin-bottom: 100px;">';
	$i = 0;
    foreach ($posts as $post) {
		
		//pf($post);
		//$post->post_content
		$s_text = strip_tags_content($post->post_content,"<figcaption>",TRUE);
		$s_text = strip_tags($s_text);
		
		$a_woerter = explode(" ",$s_text);
		$s_post_content_auszug = "";
		for/*TODO:refactor each()*/ each($a_woerter as $s_schnipsel)[
			//Zeichen zählen
			if(strlen($s_post_content_auszug)<=400){
				$s_post_content_auszug .= $s_schnipsel." ";
			}
		]
		
		$post_title = $post->post_title;
		$target_ext = '';
					
		if(strpos($post_title,"[ext]") > 0){
			$target_ext = 'target="_blank"';
		}
					
		if ($i % 2 == 0)
		{
		//links bild, rechts text
		$content .= '<div class="ec_posts_wrapper ">
		<a '.$target_ext.' href="'.get_permalink($post->ID).'">
		<div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="ec_post_'.$post->ID.'" style="">
						<div class="col span_1_of_2 ec_posts_img" 
						style="background-image: url('.get_the_post_thumbnail_url($post->ID, 'small').');">
							
						</div>
						<div class="col span_1_of_2">
							<div class="ec_posts_post_title"><h2 style="margin-top: 0;margin-bottom:0;text-align: left;">'.$post_title.'</h2></div>
							<div class="ec_posts_post_excerpt">'.$s_post_content_auszug.' ... <u>weiterlesen</u></div>
						</div>
					</div>
					</a></div>';
		}
		else
		{
		//rechts bild, links text
		$content .= '<div class="ec_posts_wrapper hintergrund_grau">
		<a '.$target_ext.' href="'.get_permalink($post->ID).'">
		<div class="section group ec_post animate_von_rechts inhalt_begrenzte_breite_zentriert" id="ec_post_'.$post->ID.'" style="">
						<div class="col span_1_of_2">
							<div class="ec_posts_post_title"><h2 style="margin-top: 0;margin-bottom:0;text-align: left;">'.$post_title.'</h2></div>
							<div class="ec_posts_post_excerpt">'.$s_post_content_auszug.'  ... <u>weiterlesen</u></div>
						</div>
						<div class="col span_1_of_2 ec_posts_img" 
						style="background-image: url('.get_the_post_thumbnail_url($post->ID, 'small').');">
							
						</div>
					</div></a></div>';
		}
  
        $i++;
		
    }
    $content .= '</div>';
	
	//Nur anzeigen, falls man nicht im Backend ist, sonst verwirrend
	
	if(!block_lab_backend()){
		
	//für mobil
	    //Inhalte sammeln
    $content .= '<div class="ec_posts ec_posts_mobil_div" style="position: relative; width: 100%; margin-left: auto;margin-right: auto;margin-bottom: 100px;">';
	$i = 0;
    foreach ($posts as $post) {
		//pf($post);
		$s_text = strip_tags_content($post->post_content,"<figcaption>",TRUE);
		$s_text = strip_tags($s_text);
		$a_woerter = explode(" ",$s_text);
		$s_post_content_auszug = "";
		for/*TODO:refactor each()*/ each($a_woerter as $s_schnipsel)[
			//Zeichen zählen
			if(strlen($s_post_content_auszug)<=400){
				$s_post_content_auszug .= $s_schnipsel." ";
			}
		]
		
		
		$post_title = $post->post_title;
		$target_ext = '';
					
		if(strpos($post_title,"[ext]") > 0){
			$target_ext = 'target="_blank"';
		}
		
		
		if ($i % 2 == 0)
		{
			$hintergrund = "";
			}
			else
		{
			$hintergrund = "hintergrund_grau";
		}
		//links bild, rechts text
		$content .= '<div class="ec_posts_wrapper '.$hintergrund.'">
		<a '.$target_ext.' style="text-decoration: none;" href="'.get_permalink($post->ID).'">
		<div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="mobil_ec_post_'.$post->ID.'" style="">
		<div class="ec_posts_post_title"><h2 style="margin-top: 0;margin-bottom:0;text-align: left;">'.$post_title.'</h2></div>
						<div class="col span_1_of_2 ec_posts_img" 
						style="background-image: url('.get_the_post_thumbnail_url($post->ID, 'small').');">
							
						</div>
						<div class="col span_1_of_2">
							
							<div class="ec_posts_post_excerpt">'.$s_post_content_auszug.' ... <u>weiterlesen</u></div>
						</div>
					</div>
					</a></div>';
        $i++;
		
    }
    $content .= '</div>';
	
	}
	echo $content;
?>
