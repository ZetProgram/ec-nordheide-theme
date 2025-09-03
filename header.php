<?php
define( 'THEME_PFAD', get_stylesheet_directory_uri() );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#ffffff">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" crossorigin="anonymous">

<?php wp_head(); ?>

<!-- jQuery nur falls deine Plugins es brauchen -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<!-- Alpine.js für Mobile-Menu Toggle -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
[x-cloak]{ display:none; }
</style>
</head>

<?php
// Logo
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image          = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id, 'full' ) : null;
$logo_src       = $image ? $image[0] : '';

// Header-Links (wir lesen maximal die ersten 2 Items)
$header_links = [];
$locs = get_nav_menu_locations();
if ( isset($locs['header-links']) && $locs['header-links'] ) {
  $menu_items = wp_get_nav_menu_items( $locs['header-links'] );
  if ( $menu_items ) {
    // Nur Ebene 1 und max. 2 Items
    foreach ($menu_items as $mi) {
      if ((int)$mi->menu_item_parent === 0) { $header_links[] = $mi; }
      if (count($header_links) >= 2) break;
    }
  }
}

// Spendenbutton aus Customizer
$cta_text   = get_theme_mod('highlightbtn_titel', __('UNTERSTÜTZE UNS','your-theme'));
$cta_url    = get_theme_mod('highlightbtn_page', 0);
$cta_target = get_theme_mod('highlightbtn_target', '_self');
?>

<body <?php body_class(); ?> x-data="{open:false}">
  <header class="fixed top-0 left-0 w-full z-40">
    <div class="mx-auto w-full px-3">
      <div class="bg-[#F7F5EC] clip-custom-shape">
        <div class="h-[120px] flex items-center justify-center gap-6 md:gap-10 px-3">

          <!-- Logo -->
          <a href="<?php echo esc_url( home_url('/') ); ?>" class="flex items-center justify-center">
            <?php if ($logo_src): ?>
              <img src="<?php echo esc_url($logo_src); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-24 w-auto">
            <?php else: ?>
              <span class="font-bold text-gray-900"><?php bloginfo('name'); ?></span>
            <?php endif; ?>
          </a>

          <!-- Zwei konfigurierbare Header-Links -->
          <nav class="hidden sm:flex items-center justify-center gap-6 font-semibold italic">
            <?php if (!empty($header_links)): ?>
              <?php foreach ($header_links as $li): ?>
                <a href="<?php echo esc_url($li->url); ?>" class="text-gray-900 hover:underline">
                  <?php echo esc_html($li->title); ?>
                </a>
              <?php endforeach; ?>
            <?php else: ?>
              <!-- Fallback-Hinweis für Admin -->
              <?php if ( current_user_can('edit_theme_options') ): ?>
                <a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>" class="text-gray-400 hover:text-gray-600">
                  (Header-Links anlegen)
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </nav>

          <!-- Menü-Icon (öffnet Off-Canvas / Mobile-Menü) -->
          <button
            type="button"
            class="inline-flex items-center justify-center w-10 h-10 rounded-md border border-black/30 bg-white hover:bg-gray-50"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-label="Menü öffnen">
            <span class="sr-only">Menü</span>
            <span class="text-xl">≡</span>
          </button>

          <!-- Spenden-Button -->
          <a
            href="<?php echo esc_url($cta_url); ?>"
            target="<?php echo esc_attr($cta_target); ?>"
            class="inline-flex items-center justify-center rounded-full px-4 md:px-5 py-2 font-semibold text-white bg-[#8fb217] hover:bg-[#7aa311] transition"
          >
            <?php echo esc_html($cta_text); ?>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Platzhalter für fixed Header -->
  <div class="h-[86px] md:h-[110px]"></div>
  <div class="hidden md:block h-[56px]"></div>

  <!-- OFF-CANVAS / MOBILE MENU -->
  <div
    x-cloak
    x-show="open"
    @keydown.escape.window="open=false"
    class="fixed inset-0 z-50"
    aria-modal="true"
    role="dialog"
  >
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40" @click="open=false"></div>

    <!-- Panel -->
    <div class="absolute right-0 top-0 h-full w-[88%] max-w-[380px] bg-white shadow-2xl p-4 flex flex-col">
      <div class="flex items-center justify-between mb-2">
        <span class="font-semibold text-lg">Menü</span>
        <button class="w-10 h-10 rounded-md border border-gray-300" @click="open=false" aria-label="Schließen">✕</button>
      </div>

      <!-- Optional: die zwei Header-Links wiederholen -->
      <?php if (!empty($header_links)): ?>
        <div class="mb-4">
          <ul class="space-y-2">
            <?php foreach ($header_links as $li): ?>
              <li><a href="<?php echo esc_url($li->url); ?>" class="block px-3 py-2 rounded-md hover:bg-gray-100"><?php echo esc_html($li->title); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Hauptmenü (mobile) -->
      <div class="overflow-auto">
        <?php
          wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'menu_class'     => 'flex flex-col gap-1',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          ));
        ?>
      </div>

      <!-- Spenden-Button unten hervorheben -->
      <div class="mt-auto pt-4">
        <a
          href="<?php echo esc_url($cta_url); ?>"
          target="<?php echo esc_attr($cta_target); ?>"
          class="w-full inline-flex items-center justify-center rounded-full px-5 py-3 font-semibold text-white bg-[#8fb217] hover:bg-[#7aa311] transition"
        >
          <?php echo esc_html($cta_text); ?>
        </a>
      </div>
    </div>
  </div>