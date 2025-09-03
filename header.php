<?php
define( 'THEME_PFAD', get_stylesheet_directory_uri() );
$php_offsetWidth = 0;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>

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

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

<!-- Tailwind via CDN (für sofortige Nutzung) -->
<script src="https://cdn.tailwindcss.com"></script>

<?php wp_head(); ?>

<!-- JS-Basics: jQuery zuerst (Plugins hängen daran), dann UI, dann Plugins, dann eigener Code -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- FAQ-Plugin (benötigt jQuery vorher) -->
<script type="text/javascript" src="/wp-content/plugins/sp-faq/js/jquery.accordion.js?ver=3.3.2"></script>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

<!-- Alpine.js für Menü/State -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Dein Theme-JS -->
<script src="<?php echo esc_url( get_bloginfo( 'template_url' ) . '/javaScript.js' ); ?>"></script>

<?php
// GET-Parameter 'infomaterial' sicher für JS bereitstellen
$infomaterial    = filter_input( INPUT_GET, 'infomaterial', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$infomaterial_js = $infomaterial ? esc_js( $infomaterial ) : '';
?>

<script type="text/javascript">
jQuery(document).on('nfFormReady', function (e, layoutView) {
  if (document.getElementById('nf-field-375')) {
    selectElement('nf-field-375', '<?php echo $infomaterial_js; ?>');
    var fld = document.getElementById('nf-field-348');
    if (fld) { fld.value = 1; }
  }
});

// DOM ready
jQuery(function($){
  $(".slogan").css("opacity", 0).animate({opacity: 1}, 3000);

  // Smooth Scroll nur für lokale Anker, die existieren
  $('a[href*="#"]').on('click', function(e) {
    var target = this.hash;
    if (!target) return;
    var $target = $(target);
    if (!$target.length) return;
    e.preventDefault();
    $('html, body').stop().animate({ 'scrollTop': ($target.offset().top - 200) }, 1500, 'swing');
  });

  headerbild_overlay_hexagone_anpassen();
  window.addEventListener('resize', headerbild_overlay_hexagone_anpassen);
});
</script>

<style>
/* Minimales Zusatz-CSS für Dinge, die Tailwind nicht direkt kapselt */
.hex-mask a{
  -webkit-mask-image: url('/wp-content/themes/ecjugend20192/img/hexagon_maske_quadrat.png');
  mask-image: url('/wp-content/themes/ecjugend20192/img/hexagon_maske_quadrat.png');
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
}
.hex-menu a{
  background-color:#b1ca34;
  color:#fff;
}
/* Dropdown: nur bei Hover sichtbar auf Desktop */
.nav-item:hover > .nav-dropdown{
  display:block;
}
</style>

</head>

<?php $anzahl_hexagone = (int) get_theme_mod( 'anzahl_hexagone', 0 );?>
<script>
var anzahl_hexagone = <?php echo (int) $anzahl_hexagone; ?>;
</script>

<?php
// Hexagon-Bilder vorbereiten (Floating-Decoration)
$s_hex = '';
for ( $i = 1; $i <= $anzahl_hexagone; $i++ ) {
  $hex = rand( 1, 8 );

  $a_img      = wp_get_attachment_image_src( get_theme_mod( 'img_hexagone_link_' . $hex ), 'small' );
  $a_img_href = get_theme_mod( 'img_hexagone_link_href_' . $hex );

  $link_start = '';
  $link_ende  = '';

  if ( ! empty( $a_img_href ) ) {
    $link_start = '<a href="' . esc_url( $a_img_href ) . '" target="_blank" rel="noopener">';
    $link_ende  = '</a>';
  }

  $img_src = empty( $a_img[0] )
    ? get_stylesheet_directory_uri() . '/img/hex_' . $hex . '.png'
    : $a_img[0];

  // Theme-Mods mit Defaults
  $geschw_von = (int) get_theme_mod( 'geschwindigkeit_hexagone_von', 10 );
  $geschw_bis = (int) get_theme_mod( 'geschwindigkeit_hexagone_bis', 30 );
  $rot_von    = (int) get_theme_mod( 'rotation_hexagone_von', 0 );
  $rot_bis    = (int) get_theme_mod( 'rotation_hexagone_bis', 360 );
  $rand_von   = (int) get_theme_mod( 'abstand_rand_hexagone_von', 5 );
  $rand_bis   = (int) get_theme_mod( 'abstand_rand_hexagone_bis', 30 );
  $gr_von     = (int) get_theme_mod( 'groesse_hexagone_von', 5 );
  $gr_bis     = (int) get_theme_mod( 'groesse_hexagone_bis', 20 );
  $op_von     = (int) get_theme_mod( 'opacity_hexagone_von', 30 );
  $op_bis     = (int) get_theme_mod( 'opacity_hexagone_bis', 100 );

  $speed           = rand( $geschw_von * 100, $geschw_bis * 100 );
  $rot             = rand( $rot_von, $rot_bis );
  $left_right_proz = rand( $rand_von, $rand_bis );
  $groesse         = rand( $gr_von, $gr_bis );
  $opacity         = rand( $op_von, $op_bis ) / 100;

  $s_left_right = ( $i % 2 === 0 ) ? 'left' : 'right';

  $s_hex .= $link_start .
    '<img src="' . esc_url( $img_src ) . '" id="hex' . (int) $i . '_ec" data-speed="' . esc_attr( $speed ) . '" ' .
    'style="position:absolute;' .
    $s_left_right . ':' . esc_attr( $left_right_proz ) . '%;' .
    'opacity:' . esc_attr( $opacity ) . ';' .
    'z-index:4;' .
    'top:-500px;' .
    'width:' . esc_attr( $groesse ) . 'vw;' .
    'transform:rotate(' . esc_attr( $rot ) . 'deg);">' .
    $link_ende;
}
?>

<body <?php body_class('overflow-hidden'); ?> x-data="{ mobileOpen:false }">
  <div class="hexagone_wrapper relative"><?php echo $s_hex; ?></div>

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full z-20 bg-[#F7F5EC]">
    <div class="max-w-[1140px] mx-auto">
      <div class="relative w-full h-[105px] md:h-[170px] flex items-center">
        <!-- Logo -->
        <div class="flex-1">
          <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image          = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id, 'full' ) : null;
            $logo_src       = $image ? $image[0] : '';
          ?>
          <a href="<?php echo esc_url( home_url('/') ); ?>" class="inline-block">
            <?php if ( $logo_src ) : ?>
              <img src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" class="block max-h-[60px] md:max-h-[100px] w-auto">
            <?php else : ?>
              <span class="text-xl font-semibold text-gray-800"><?php bloginfo('name'); ?></span>
            <?php endif; ?>
          </a>
        </div>

        <!-- Actions rechts -->
        <div class="flex items-center gap-4">
          <!-- Highlight-Button -->
          <a
            class="hidden md:inline-flex items-center justify-center rounded-2xl px-5 py-2 text-xl font-semibold text-[#8fb217] hover:text-white hover:bg-[#8fb217] transition"
            target="<?php echo esc_attr( get_theme_mod( 'highlightbtn_target', '_self' ) ); ?>"
            href="<?php echo esc_url( get_theme_mod( 'highlightbtn_url', '#' ) ); ?>">
            <?php echo esc_html( get_theme_mod( 'highlightbtn_titel', '' ) ); ?>
          </a>

          <!-- Mobile Menü Button -->
          <button
            class="inline-flex md:hidden items-center justify-center w-11 h-11 rounded-lg text-[#388134] shadow-sm bg-white hover:bg-gray-50"
            x-on:click="mobileOpen = !mobileOpen"
            aria-label="Menü öffnen/schließen"
            :aria-expanded="mobileOpen.toString()">
            <i class="fas fa-bars text-2xl"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden md:block border-y border-gray-300 bg-white">
      <div class="max-w-[1140px] mx-auto px-2">
        <?php
          // Hauptmenü mit eigener Walker-Struktur ist nicht zwingend nötig:
          // Wir geben UL/LI aus und stylen via Tailwind + minimalem CSS
          wp_nav_menu( array(
            'theme_location' => 'main-menu',
            'container'      => false,
            'menu_class'     => 'flex flex-row gap-2',
            'fallback_cb'    => false,
            'link_before'    => '',
            'link_after'     => '',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          ) );
        ?>
      </div>
    </nav>

    <!-- Mobile Offcanvas/Dropdown -->
    <div
      class="md:hidden fixed inset-x-0 top-[105px] md:top-[170px] z-30"
      x-cloak
      x-show="mobileOpen"
      x-transition.origin.top.left
      @keydown.escape.window="mobileOpen=false"
    >
      <div class="mx-auto max-w-[1140px] px-3">
        <div class="bg-white border border-gray-300 rounded-xl shadow-xl overflow-hidden">
          <div class="flex items-center justify-between p-3">
            <div class="w-full">
              <?php if ( function_exists('ec_search_form') ) { echo ec_search_form( 'sf_im_menu' ); } ?>
            </div>
            <button class="ml-3 text-gray-500 hover:text-gray-700" x-on:click="mobileOpen=false" aria-label="Schließen">
              <i class="far fa-times-circle text-2xl"></i>
            </button>
          </div>

          <!-- Vier Spalten aus Theme-Mods (Ebene 2/3 Listen) -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 px-4 pb-4">
            <?php
              $a_parent_id   = array();
              $a_bezeichnung = array();
              for ( $i = 1; $i <= 4; $i++ ) {
                $pid = (int) get_theme_mod( 'main_meu_spalte_' . $i, 0 );
                $bez = get_theme_mod( 'main_meu_spalte_bezeichnung_' . $i, 'Überschrift' );
                if ( $pid > 0 ) {
                  $a_parent_id[ $i ]   = $pid;
                  $a_bezeichnung[ $i ] = $bez;
                }
              }
              $anz = count( $a_parent_id );

              if ( $anz <= 0 ) {
                echo '<div class="col-span-full text-sm text-gray-600">Bitte im Customizer unter <b>Mainmenu Spalten</b> die entsprechenden Parameter definieren.</div>';
              } else {
                foreach ( $a_parent_id as $z => $a_parent ) {
                  echo '<div class="border border-gray-200 rounded-xl p-3">';
                  echo '  <div class="text-center font-display text-3xl md:text-4xl text-[#388134] mb-2">'. esc_html( $a_bezeichnung[ $z ] ) .'</div>';
                  echo '  <div class="space-y-1">';
                  // liste_menu($a_parent) gibt bereits <ul><li>… aus – wir wrappen via Tailwind
                  // Falls du volle Kontrolle willst, könnte man hier rekursiv WP_Term- oder Menüfunktionen nutzen.
                  echo '    <div class="text-base">'. liste_menu( $a_parent ) .'</div>';
                  echo '  </div>';
                  echo '</div>';
                }
              }
            ?>
          </div>

          <div class="bg-[#8fb217] text-white">
            <div class="max-w-[1140px] mx-auto p-3 text-center">
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => false, 'menu_class' => 'flex flex-wrap justify-center gap-4 text-sm', 'fallback_cb' => false ) );?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </header>

  <!-- Offset für fixed Header -->
  <div class="h-[105px] md:h-[170px]"></div>

  <!-- Optional globale Suchzeile unter dem Header (wie vorher) -->
  <div class="max-w-[1140px] mx-auto px-3 py-3">
    <div class="">
      <?php if ( function_exists('ec_search_form') ) { echo ec_search_form( 'sf_webseite' ); } ?>
    </div>
  </div>

  <!-- Desktop-Menu mit Hex-Mask (angepasst) -->
  <div class="hidden md:block">
    <div class="max-w-[1140px] mx-auto px-2">
      <div class="hex-mask">
        <?php
          // Fallback: Wenn kein spezieller Walker genutzt wird,
          // werden UL/LI generiert. Wir ergänzen ein kleines Filter-Snippet,
          // um die Link-Klassen zu erweitern (alternativ: einen eigenen Walker schreiben).
          // Für Einfachheit hier direkt die Ausgabe eines zusätzlichen Menüs mit CSS-Mask:
          $menu = wp_get_nav_menu_items( get_nav_menu_locations()['main-menu'] ?? 0 );
          if ( ! empty( $menu ) ) :
            echo '<ul class="flex flex-row flex-wrap items-stretch gap-2">';
            foreach ( $menu as $item ) {
              if ( (int)$item->menu_item_parent !== 0 ) continue; // nur erste Ebene hier
              $url   = esc_url( $item->url );
              $title = esc_html( $item->title );
              echo '<li class="relative group">';
              echo '  <a href="'.$url.'" class="block whitespace-nowrap px-8 py-6 text-white bg-[#8fb217] hover:bg-[#b1ca34] transition" style="-webkit-mask-image:url(\'/wp-content/themes/ecjugend20192/img/hexagon_maske_quadrat.png\');mask-image:url(\'/wp-content/themes/ecjugend20192/img/hexagon_maske_quadrat.png\');-webkit-mask-size:100% 100%;mask-size:100% 100%;-webkit-mask-repeat:no-repeat;mask-repeat:no-repeat;">'.$title.'</a>';

              // Untermenü (zweite Ebene)
              $children = array_filter( $menu, function($m) use ($item){ return (int)$m->menu_item_parent === (int)$item->ID; } );
              if ( ! empty( $children ) ) {
                echo '<ul class="nav-dropdown absolute hidden top-full left-0 mt-1 min-w-[220px] rounded-lg overflow-hidden shadow-xl">';
                foreach ( $children as $child ) {
                  $c_url   = esc_url( $child->url );
                  $c_title = esc_html( $child->title );
                  echo '<li class="hex-menu"><a class="block px-4 py-2 hover:bg-[#9ec850]" href="'.$c_url.'">'.$c_title.'</a>';

                  // Dritte Ebene
                  $grand = array_filter( $menu, function($m) use ($child){ return (int)$m->menu_item_parent === (int)$child->ID; } );
                  if ( ! empty( $grand ) ) {
                    echo '<ul class="absolute left-full top-0 ml-1 min-w-[220px] rounded-lg overflow-hidden shadow-xl">';
                    foreach ( $grand as $g ) {
                      $g_url   = esc_url( $g->url );
                      $g_title = esc_html( $g->title );
                      echo '<li class="hex-menu"><a class="block px-4 py-2 hover:bg-[#9ec850]" href="'.$g_url.'">'.$g_title.'</a></li>';
                    }
                    echo '</ul>';
                  }

                  echo '</li>';
                }
                echo '</ul>';
              }

              echo '</li>';
            }
            echo '</ul>';
          endif;
        ?>
      </div>
    </div>
  </div>

  <div class="hidden md:block">
    <div class="max-w-[1140px] mx-auto px-2">
      <div class="w-full bg-white border-x border-b border-gray-300 rounded-b-xl">
        <div class="text-center py-2">
          <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => false, 'menu_class' => 'flex flex-wrap justify-center gap-6 text-sm text-[#388134]', 'fallback_cb' => false ) );?>
        </div>
      </div>
    </div>
  </div>

  <!-- Dein Seiteninhalt beginnt danach … -->
</body>
</html>
