<h2><?php block_field('epi_ueberschrift'); ?></h2>

<?php
// Posts aus den Block-Feldern einsammeln
$a_posts = array();
for ($i = 1; $i <= 10; $i++) {
    $postid = (int) block_field('epi_post_id_id_' . $i, false);
    if ($postid > 0) {
        $a_posts[] = $postid;
    }
}

// Nichts zu tun?
if (empty($a_posts)) {
    echo '<div class="ec_posts_hint">Keine Beiträge konfiguriert.</div>';
    return;
}

// Helper: ca. 400 Zeichen Auszug, an Wortgrenze
if (!function_exists('epi_make_excerpt')) {
    function epi_make_excerpt($html, $max_len = 400) {
        if (function_exists('strip_tags_content')) {
            $text = strip_tags_content($html, '<figcaption>', true);
            $text = strip_tags($text);
        } else {
            $text = wp_strip_all_tags($html, true);
        }
        $words = preg_split('/\s+/', trim($text));
        $out = '';
        foreach ($words as $w) {
            $try = ($out === '' ? $w : $out . ' ' . $w);
            if (mb_strlen($try) <= $max_len) {
                $out = $try;
            } else {
                break;
            }
        }
        return trim($out);
    }
}

// Builder: Desktop
$content = '<div class="ec_posts ec_posts_div" style="position: relative; width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 100px;">';

$i = 0;
foreach ($a_posts as $postid) {

    $post = get_post($postid);
    if (!$post) { continue; }

    $post_id    = (int) $post->ID;
    $post_link  = get_permalink($post_id);
    $thumb_url  = get_the_post_thumbnail_url($post_id, 'small');
    if (!$thumb_url) {
        // 1x1-Transparent-Fallback – gerne durch eigenes Placeholder-Bild ersetzen
        $thumb_url = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
    }

    $excerpt     = epi_make_excerpt($post->post_content, 400);
    $post_title  = $post->post_title;

    // "[ext]" → neuen Tab öffnen
    $target_attr = (strpos($post_title, '[ext]') !== false) ? ' target="_blank" rel="noopener"' : '';

    // Escaping
    $esc_link    = esc_url($post_link);
    $esc_title   = esc_html($post_title);
    $esc_excerpt = esc_html($excerpt);
    $esc_thumb   = esc_url($thumb_url);

    if ($i % 2 === 0) {
        // links Bild, rechts Text
        $content .= '
        <div class="ec_posts_wrapper">
          <a href="' . $esc_link . '"' . $target_attr . '>
            <div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="ec_post_' . $post_id . '">
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
          <a href="' . $esc_link . '"' . $target_attr . '>
            <div class="section group ec_post animate_von_rechts inhalt_begrenzte_breite_zentriert" id="ec_post_' . $post_id . '">
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

// Mobile-Variante nur im Frontend
if (!function_exists('block_lab_backend') || !block_lab_backend()) {

    $content .= '<div class="ec_posts ec_posts_mobil_div" style="position: relative; width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 100px;">';

    $i = 0;
    foreach ($a_posts as $postid) {

        $post = get_post($postid);
        if (!$post) { continue; }

        $post_id    = (int) $post->ID;
        $post_link  = get_permalink($post_id);
        $thumb_url  = get_the_post_thumbnail_url($post_id, 'small');
        if (!$thumb_url) {
            $thumb_url = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
        }

        $excerpt     = epi_make_excerpt($post->post_content, 400);
        $post_title  = $post->post_title;

        $target_attr = (strpos($post_title, '[ext]') !== false) ? ' target="_blank" rel="noopener"' : '';

        $esc_link    = esc_url($post_link);
        $esc_title   = esc_html($post_title);
        $esc_excerpt = esc_html($excerpt);
        $esc_thumb   = esc_url($thumb_url);

        $hintergrund = ($i % 2 === 0) ? '' : 'hintergrund_grau';

        $content .= '
        <div class="ec_posts_wrapper ' . $hintergrund . '">
          <a href="' . $esc_link . '"' . $target_attr . ' style="text-decoration:none;">
            <div class="section group ec_post animate_von_links inhalt_begrenzte_breite_zentriert" id="mobil_ec_post_' . $post_id . '">
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
