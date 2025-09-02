<?php
// Überschrift (block_field echo't direkt)
?>
<h2><?php block_field('ec-posts-ueberschrift'); ?></h2>
<?php

// Kleine Helper-Funktion für einen Textauszug (ca. 400 Zeichen, Wortgrenze)
if (!function_exists('ec_make_excerpt')) {
    function ec_make_excerpt($html, $max_len = 400) {
        // Falls strip_tags_content nicht existiert, fallback
        if (function_exists('strip_tags_content')) {
            $text = strip_tags_content($html, '<figcaption>', true);
            $text = strip_tags($text);
        } else {
            $text = wp_strip_all_tags($html, true);
        }

        $words  = preg_split('/\s+/', trim($text));
        $out    = '';
        foreach ($words as $snippet) {
            if (mb_strlen($out) + mb_strlen($snippet) + 1 <= $max_len) {
                $out .= ($out === '' ? '' : ' ') . $snippet;
            } else {
                break;
            }
        }
        return trim($out);
    }
}

// Posts laden
$args = array(
    'category_name' => block_field('ec-posts-kategorie', false),
    'numberposts'   => (int) block_field('ec-posts-anzahl', false),
);
$posts = get_posts($args);

// Inhalte sammeln (Desktop)
$content = '<div class="ec_posts ec_posts_div" style="position: relative; width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 100px;">';

$i = 0;
foreach ((array) $posts as $post) {

    $post_id     = $post->ID;
    $post_link   = get_permalink($post_id);
    $thumb_url   = get_the_post_thumbnail_url($post_id, 'small');
    if (!$thumb_url) {
        // 1x1-Transparent-Fallback – gerne ersetzen durch eigenes Placeholder-Bild
        $thumb_url = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
    }

    $excerpt     = ec_make_excerpt($post->post_content, 400);
    $post_title  = $post->post_title;

    // Wenn "[ext]" im Titel vorkommt, neuen Tab öffnen
    $target_ext  = (strpos($post_title, '[ext]') !== false) ? ' target="_blank" rel="noopener"' : '';

    // Sauber escapen
    $esc_link    = esc_url($post_link);
    $esc_title   = esc_html($post_title);
    $esc_excerpt = esc_html($excerpt);
    $esc_thumb   = esc_url($thumb_url);

    if ($i % 2 === 0) {
        // links Bild, rechts Text
        $content .= '
        <div class="ec_posts_wrapper">
          <a href="' . $esc_link . '"' . $target_ext . '>
            <div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="ec_post_' . (int)$post_id . '">
              <div class="col span_1_of_2 ec_posts_img" style="background-image: url(\'' . $esc_thumb . '\');"></div>
              <div class="col span_1_of_2">
                <div class="ec_posts_post_title"><h2 style="margin-top:0;margin-bottom:0;text-align:left;">' . $esc_title . '</h2></div>
                <div class="ec_posts_post_excerpt">' . $esc_excerpt . ' ... <u>weiterlesen</u></div>
              </div>
            </div>
          </a>
        </div>';
    } else {
        // rechts Bild, links Text
        $content .= '
        <div class="ec_posts_wrapper hintergrund_grau">
          <a href="' . $esc_link . '"' . $target_ext . '>
            <div class="section group ec_post animate_von_rechts inhalt_begrenzte_breite_zentriert" id="ec_post_' . (int)$post_id . '">
              <div class="col span_1_of_2">
                <div class="ec_posts_post_title"><h2 style="margin-top:0;margin-bottom:0;text-align:left;">' . $esc_title . '</h2></div>
                <div class="ec_posts_post_excerpt">' . $esc_excerpt . ' ... <u>weiterlesen</u></div>
              </div>
              <div class="col span_1_of_2 ec_posts_img" style="background-image: url(\'' . $esc_thumb . '\');"></div>
            </div>
          </a>
        </div>';
    }

    $i++;
}

$content .= '</div>';

// Nur Frontend: mobile Variante anhängen
if (!function_exists('block_lab_backend') || !block_lab_backend()) {

    $content .= '<div class="ec_posts ec_posts_mobil_div" style="position: relative; width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 100px;">';

    $i = 0;
    foreach ((array) $posts as $post) {

        $post_id     = $post->ID;
        $post_link   = get_permalink($post_id);
        $thumb_url   = get_the_post_thumbnail_url($post_id, 'small');
        if (!$thumb_url) {
            $thumb_url = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
        }

        $excerpt     = ec_make_excerpt($post->post_content, 400);
        $post_title  = $post->post_title;

        $target_ext  = (strpos($post_title, '[ext]') !== false) ? ' target="_blank" rel="noopener"' : '';

        $esc_link    = esc_url($post_link);
        $esc_title   = esc_html($post_title);
        $esc_excerpt = esc_html($excerpt);
        $esc_thumb   = esc_url($thumb_url);

        $hintergrund = ($i % 2 === 0) ? '' : 'hintergrund_grau';

        $content .= '
        <div class="ec_posts_wrapper ' . $hintergrund . '">
          <a href="' . $esc_link . '"' . $target_ext . ' style="text-decoration:none;">
            <div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="mobil_ec_post_' . (int)$post_id . '">
              <div class="ec_posts_post_title"><h2 style="margin-top:0;margin-bottom:0;text-align:left;">' . $esc_title . '</h2></div>
              <div class="col span_1_of_2 ec_posts_img" style="background-image: url(\'' . $esc_thumb . '\');"></div>
              <div class="col span_1_of_2">
                <div class="ec_posts_post_excerpt">' . $esc_excerpt . ' ... <u>weiterlesen</u></div>
              </div>
            </div>
          </a>
        </div>';

        $i++;
    }

    $content .= '</div>';
}

// Ausgabe
echo $content;
