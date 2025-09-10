<?php
/**
 * Modern Header (Tailwind + Alpine, aria, no jQuery)
 * Voraussetzungen: siehe functions.php Ergänzungen unten.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  // Favicons (optional – anpassen/entfernen)
  ?>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#ffffff">

  <?php wp_head(); ?>
  <style>[x-cloak]{display:none}</style>
</head>
<?php
  // Customizer: CTA
  $cta_text   = get_theme_mod('highlightbtn_titel', __('Unterstütze uns!','ec-nordheide-theme'));
  $cta_url    = get_theme_mod('highlightbtn_page', home_url('/spenden'));
  $cta_target = get_theme_mod('highlightbtn_target', '_self');

  // Menüs vorbereiten: Primary & Arbeitsbereiche (für Mega)
  $menu_locs = get_nav_menu_locations();
  $primary_menu_id = isset($menu_locs['primary']) ? $menu_locs['primary'] : 0;
  $arbeits_menu_id = isset($menu_locs['arbeitsbereiche']) ? $menu_locs['arbeitsbereiche'] : 0;

  $arbeits_parent_id = 0;
  $arbeits_children = [];

  if ($primary_menu_id) {
    $primary_items = wp_get_nav_menu_items($primary_menu_id);
    if ($primary_items) {
      // Finde den Top-Level Punkt "Arbeitsbereiche"
      foreach ($primary_items as $it) {
        if ((int)$it->menu_item_parent === 0 && sanitize_title($it->title) === sanitize_title(__('Arbeitsbereiche','ec-nordheide-theme'))) {
          $arbeits_parent_id = (int)$it->ID;
          break;
        }
      }
      // Falls "Arbeitsbereiche" im Primary gefunden: sammle dessen Kinder
      if ($arbeits_parent_id) {
        foreach ($primary_items as $it) {
          if ((int)$it->menu_item_parent === $arbeits_parent_id) {
            $arbeits_children[] = $it;
          }
        }
      }
    }
  }

  // Alternative: eigenes Menü "arbeitsbereiche" benutzen, falls keine Kinder im Primary hinterlegt sind
  if (!$arbeits_children && $arbeits_menu_id) {
    $arbeits_children = wp_get_nav_menu_items($arbeits_menu_id) ?: [];
  }

  // Logo
  $custom_logo_id = get_theme_mod('custom_logo');
  $logo_src       = '';
  if ($custom_logo_id) {
    $img = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($img) { $logo_src = $img[0]; }
  }
?>
<body <?php body_class('bg-white text-gray-900 antialiased'); ?> x-data="{ open:false, mega:false }" x-on:keydown.escape.window="open=false; mega=false">
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur lg:h-[140px] h-full max-h-[140px] supports-[backdrop-filter]:bg-white/75 border-b border-gray-200" role="banner">
  <div class="container mx-auto max-w-7xl px-3 md:px-6">
    <div class="flex items-center justify-between gap-3 h-full">

      <!-- Logo -->
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="shrink-0 inline-flex items-center my-2" aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?>">
        <?php if ($logo_src): ?>
          <img src="<?php echo esc_url($logo_src); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-full max-h-[100px] w-auto">
        <?php else: ?>
          <span class="font-black text-xl tracking-tight"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </a>

      <!-- Desktop Nav -->
      <nav class="hidden lg:flex items-center gap-6" aria-label="<?php esc_attr_e('Hauptnavigation','ec-nordheide-theme'); ?>">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'fallback_cb'    => false,
            'menu_class'     => 'flex items-center gap-6 font-medium',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'link_before'    => '<span class="inline-block py-2 hover:color-[#6C9941] uppercase color-[#1A1A1A] text-5xl">',
            'link_after'     => '</span>',
            // optional: 'walker' => new Your_Accessible_Walker_Nav_Menu(),
          ]);
        ?>

        <!-- CTA -->
        <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>"
           class="inline-flex items-center rounded-sm px-4 py-2 text-white bg-[#5CA6D1] hover:bg-[#4c8aad] text-5xl no-underline focus:outline-none transition uppercase font-bold">
          <?php echo esc_html($cta_text); ?>
        </a>
      </nav>

      <!-- Mobile: Toggle -->
      <button type="button" class="lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-md border border-gray-300 bg-white hover:bg-gray-50"
              x-on:click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-nav" aria-label="<?php esc_attr_e('Menü öffnen','ec-nordheide-theme'); ?>">
        <svg viewBox="0 0 24 24" class="w-6 h-6" aria-hidden="true"><path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
      </button>
    </div>
  </div>

  <!-- Mega-Menü: Arbeitsbereiche (Desktop) -->
  <?php if (!empty($arbeits_children)): ?>
    <div
      x-cloak
      x-show="mega"
      x-transition
      class="hidden lg:block border-t border-gray-200 bg-white shadow-sm"
      role="region"
      aria-label="<?php esc_attr_e('Arbeitsbereiche','ec-nordheide-theme'); ?>"
    >
      <div class="container mx-auto max-w-7xl px-3 md:px-6">
        <div class="py-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($arbeits_children as $child): ?>
              <?php
                // Bild-URL aus Menü-Beschreibung (Screen Options: Description aktivieren)
                $img_url = trim((string)$child->description);
              ?>
              <a href="<?php echo esc_url($child->url); ?>" class="group relative block overflow-hidden rounded-xl ring-1 ring-gray-200 hover:ring-gray-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-gray-900"
                 style="height: 160px;">
                <?php if ($img_url): ?>
                  <img src="<?php echo esc_url($img_url); ?>" alt="" loading="lazy"
                       class="absolute inset-0 w-full h-full object-cover transition scale-100 group-hover:scale-[1.03]">
                <?php endif; ?>
                <span class="absolute inset-0 bg-black/35"></span>
                <span class="relative z-10 flex items-center justify-center h-full text-white font-extrabold text-xl text-center px-3 drop-shadow">
                  <?php echo esc_html($child->title); ?>
                </span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</header>

<!-- Abstand nach sticky header (optional) -->
<div class="h-16 lg:h-0"></div>

<!-- Mobile Off-Canvas -->
<div id="mobile-nav" x-cloak x-show="open" class="fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true">
  <div class="absolute inset-0 bg-black/40" x-on:click="open=false"></div>
  <div class="absolute right-0 top-0 h-full w-[88%] max-w-[380px] bg-white shadow-2xl p-4 flex flex-col">
    <div class="flex items-center justify-between">
      <span class="font-semibold text-lg"><?php bloginfo('name'); ?></span>
      <button class="w-10 h-10 rounded-md border border-gray-300" aria-label="<?php esc_attr_e('Schließen','ec-nordheide-theme'); ?>" x-on:click="open=false">✕</button>
    </div>

    <nav class="mt-4 overflow-auto" aria-label="<?php esc_attr_e('Mobile Navigation','ec-nordheide-theme'); ?>">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'fallback_cb'    => false,
          'menu_class'     => 'flex flex-col gap-1',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ]);
      ?>
    </nav>

    <div class="mt-auto pt-4">
      <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>"
         class="w-full inline-flex items-center justify-center rounded-full px-5 py-3 font-semibold text-white bg-[#ff9a42] hover:bg-[#f08b33] transition">
        <?php echo esc_html($cta_text); ?>
      </a>
    </div>
  </div>
</div>

<script>
  // Mega-Trigger: Wenn im Primary-Menü ein Top-Level-Link "Arbeitsbereiche" existiert,
  // wird beim Hovern/Fokussieren das Mega-Menü geöffnet.
  document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('header nav');
    if (!nav) return;
    const links = nav.querySelectorAll('a');
    links.forEach(a => {
      if (a.textContent.trim().toLowerCase() === '<?php echo esc_js( mb_strtolower(__('Arbeitsbereiche','ec-nordheide-theme')) ); ?>'.toLowerCase()) {
        a.parentElement.addEventListener('mouseenter', () => document.body.__x.$data.mega = true);
        a.parentElement.addEventListener('mouseleave', () => document.body.__x.$data.mega = false);
        a.addEventListener('focus', () => document.body.__x.$data.mega = true);
        a.addEventListener('blur',  () => document.body.__x.$data.mega = false);
      }
    });
  });
</script>
