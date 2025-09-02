<?php
define('THEME_PFAD', get_stylesheet_directory_uri());
$php_offsetWidth = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de">
<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>

<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php
$style_version = '003';
$js_version    = '002';
?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo esc_url(THEME_PFAD . '/style_V' . $style_version . '.css'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

<?php wp_head(); ?>

<!-- JS-Basics: Erst jQuery, dann jQuery UI, dann Plugins, dann eigener Code -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- FAQ-Plugin (benötigt jQuery vorher) -->
<script type="text/javascript" src="/wp-content/plugins/sp-faq/js/jquery.accordion.js?ver=3.3.2"></script>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

<!-- Dein Theme-JS; get_bloginfo statt echo bloginfo -->
<script src="<?php echo esc_url(get_bloginfo('template_url') . '/javaScript.js'); ?>"></script>

<?php
// GET-Parameter 'infomaterial' sicher für JS bereitstellen
$infomaterial = filter_input(INPUT_GET, 'infomaterial', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$infomaterial_js = $infomaterial ? esc_js($infomaterial) : '';
?>

<script type="text/javascript">
jQuery(document).on('nfFormReady', function (e, layoutView) {
  if (document.getElementById('nf-field-375')) {
    selectElement('nf-field-375', '<?php echo $infomaterial_js; ?>');
    var fld = document.getElementById('nf-field-348');
    if (fld) { fld.value = 1; }
  }
});

function check_device(){/* falls vorhanden – Platzhalter */}

// DOM ready
jQuery(function($){
  $(".slogan").css("opacity", 0).animate({opacity: 1}, 3000);

  $("#testbutton").on("click", function(){
    $("#menu_header_unten_ebene2").animate({opacity: "1"}, 1000);
  });

  // Seichtes Scrollen zum Anker
  $('a[href*="#"]').on('click', function(e) {
    // Nur seicht scrollen, wenn Ziel auf der gleichen Seite existiert
    var target = this.hash;
    if (!target) return;
    var $target = $(target);
    if (!$target.length) return;
    e.preventDefault();
    $('html, body').stop().animate({
      'scrollTop': ($target.offset().top - 200)
    }, 1500, 'swing');
  });

  headerbild_overlay_hexagone_anpassen();
  window.addEventListener('resize', headerbild_overlay_hexagone_anpassen);
});
</script>

<style>
@media (max-width: <?php echo esc_attr((int) get_theme_mod('display_none_hexagone', 0)); ?>px) {
  .hexagone_wrapper { display: none; }
}
</style>

</head>

<?php
// linke seite
$anzahl_hexagone = (int) get_theme_mod('anzahl_hexagone', 0);
if ($anzahl_hexagone > 20) {
  // $anzahl_hexagone = 20; // optionales Limit
}
?>
<script>
var anzahl_hexagone = <?php echo (int) $anzahl_hexagone; ?>;
</script>
<?php
/**
 * Hexagon-Bilder vorbereiten
 * WICHTIG: $s_hex initialisieren (Fix für "Undefined variable")
 */
$s_hex = '';

for ($i = 1; $i <= $anzahl_hexagone; $i++) {
    $hex = rand(1, 8);

    $a_img      = wp_get_attachment_image_src(get_theme_mod('img_hexagone_link_' . $hex), 'small');
    $a_img_href = get_theme_mod('img_hexagone_link_href_' . $hex);

    $link_start = '';
    $link_ende  = '';

    if (!empty($a_img_href)) {
        $link_start = '<a href="' . esc_url($a_img_href) . '" target="_blank">';
        $link_ende  = '</a>';
    }

    // BUGFIX: kein id-Attribut im src zusammenbauen!
    if (empty($a_img[0])) {
        $img_src = get_stylesheet_directory_uri() . '/img/hex_' . $hex . '.png';
    } else {
        $img_src = $a_img[0];
    }

    // Theme-Mods mit Defaults
    $geschw_von = (int) get_theme_mod('geschwindigkeit_hexagone_von', 10);
    $geschw_bis = (int) get_theme_mod('geschwindigkeit_hexagone_bis', 30);
    $rot_von    = (int) get_theme_mod('rotation_hexagone_von', 0);
    $rot_bis    = (int) get_theme_mod('rotation_hexagone_bis', 360);
    $rand_von   = (int) get_theme_mod('abstand_rand_hexagone_von', 5);
    $rand_bis   = (int) get_theme_mod('abstand_rand_hexagone_bis', 30);
    $gr_von     = (int) get_theme_mod('groesse_hexagone_von', 5);
    $gr_bis     = (int) get_theme_mod('groesse_hexagone_bis', 20);
    $op_von     = (int) get_theme_mod('opacity_hexagone_von', 30);
    $op_bis     = (int) get_theme_mod('opacity_hexagone_bis', 100);

    $speed            = rand($geschw_von * 100, $geschw_bis * 100);
    $rot              = rand($rot_von, $rot_bis);
    $left_right_proz  = rand($rand_von, $rand_bis);
    $groesse          = rand($gr_von, $gr_bis);
    $opacity          = rand($op_von, $op_bis) / 100;

    $s_left_right = ($i % 2 === 0) ? 'left' : 'right';

    $s_hex .= $link_start .
      '<img src="' . esc_url($img_src) . '" id="hex' . (int)$i . '_ec" data-speed="' . esc_attr($speed) . '" ' .
      'style="position:absolute;' .
      $s_left_right . ':' . esc_attr($left_right_proz) . '%;' .
      'opacity:' . esc_attr($opacity) . ';' .
      'z-index:4;' .
      'top:-500px;' .
      'width:' . esc_attr($groesse) . 'vw;' .
      'transform:rotate(' . esc_attr($rot) . 'deg);">' .
      $link_ende;
}
?>

<div id="dev_out" style="display:none;position:fixed;top:100px;left:0;z-index:3000;background-color:#000;color:#fff;"></div>
<body style="overflow:hidden;">
  <div class="hexagone_wrapper"><?php echo $s_hex; ?></div>

  <div id="body_wrapper" class="">
    <div id="header_wrapper">
      <div id="header" style="">
        <div id="header_logo_menu_wrapper">
          <div id="menu_header_unten" class="">
            <div class="section group">
              <div class="col_header col_header_logo">
                <div>
                  <div>
                    <?php
                      $custom_logo_id = get_theme_mod('custom_logo');
                      $image = $custom_logo_id ? wp_get_attachment_image_src($custom_logo_id, 'full') : null;
                      $logo_src = $image ? $image[0] : '';
                    ?>
                    <a href="/index.php">
                      <?php if ($logo_src): ?>
                        <img src="<?php echo esc_url($logo_src); ?>" class="logo_img" alt="">
                      <?php endif; ?>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col_header align-right menu_col_header">
                <div class="menu_button_wrapper" style="margin-right:0;margin-left:auto;">
                  <div class="section group" style="position:relative;">
                    <div class="col span_1_of_3" id="menubutton_div">
                      <div id="mobile_top_menu" class="pointer" style="margin-top:5px;" onclick="menu_items_oeffnen();">
                        <i class="fas fa-bars fa-2x"></i>
                      </div>
                    </div>

                    <div class="col span_1_of_3" id="spendenbutton_div">
                      <div class="pointer center" style="margin-top:3px;font-size:28px;">
                        <a style="text-decoration:none;" target="<?php echo esc_attr(get_theme_mod('highlightbtn_target', '_self')); ?>" href="<?php echo esc_url(get_theme_mod('highlightbtn_url', '#')); ?>">
                          <?php echo esc_html(get_theme_mod('highlightbtn_titel', '')); ?>
                        </a>
                      </div>
                    </div>

                    <div class="col span_1_of_3" id="suchebutton_div">
                      <div class="pointer center" style="margin-top:5px;">
                        <i onclick="suchfeld_einblenden('sf_webseite');" class="fas fa-search fa-2x"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- .section group -->
          </div><!-- #menu_header_unten -->
        </div><!-- #header_logo_menu_wrapper -->
      </div><!-- #header -->
    </div><!-- #header_wrapper -->

    <div id="div_main_menu" class="main_menu">
      <div class="main_menu_inner_wrapper">
        <div class="align-right">
          <i class="far fa-2x fa-times-circle grau" style="margin:10px;" onclick="menu_items_schliessen();"></i>
          <?php echo ec_search_form('sf_im_menu'); ?>
        </div>

        <div class="section group" style="position:relative;">
          <?php
          $a_parent_id = [];
          $a_bezeichnung = [];
          for ($i = 1; $i <= 4; $i++) {
              $pid = (int) get_theme_mod('main_meu_spalte_' . $i, 0);
              $bez = get_theme_mod('main_meu_spalte_bezeichnung_' . $i, 'Überschrift');
              if ($pid > 0) {
                  $a_parent_id[$i] = $pid;
                  $a_bezeichnung[$i] = $bez;
              }
          }
          $anz = count($a_parent_id);

          if ($anz <= 0) {
              echo 'Bitte im Customizer unter Mainmenu Spalten die entsprechenden Parameter definieren.';
          } else {
              foreach ($a_parent_id as $z => $a_parent) {
                  echo '<div class="col span_1_of_' . (int)$anz . ' center">';
                  echo '  <div class="menu_ueberschriften">' . esc_html($a_bezeichnung[$z]) . '</div>';
                  echo '  <div class="main_menu_ab_ebene_2">';
                  echo        liste_menu($a_parent); // erwartet bereits saubere Ausgabe
                  echo '  </div>';
                  echo '</div>';
              }
          }
          ?>
        </div>

        <div id="im_main_menu" class="center hintergrund_gruen_main_menu_bottom" style="padding-top:10px;padding-bottom:10px;">
          <?php
          wp_nav_menu(['theme_location' => 'footer-menu']);
          ?>
        </div>
      </div>
    </div>

    <div id="div_search_form" class="inhalt_begrenzte_breite_zentriert">
      <?php echo ec_search_form('sf_webseite'); ?>
    </div>
  </div><!-- #body_wrapper -->
</body>
</html>
