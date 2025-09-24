<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
  <style>[x-cloak]{display:none}</style>
</head>
<?php
  $cta_text    = get_theme_mod('highlightbtn_titel', __('Unterstütze uns!','ec-nordheide-theme'));
  $cta_page_id = (int) get_theme_mod('highlightbtn_page', 0);
  $cta_target  = get_theme_mod('highlightbtn_target', '_self');
  $cta_url     = $cta_page_id > 0 ? get_permalink($cta_page_id) : home_url('/spenden');

  $custom_logo_id = get_theme_mod('custom_logo');
  $logo_src = '';
  if ($custom_logo_id) {
    $img = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($img) { $logo_src = $img[0]; }
  }
?>
<body <?php body_class('bg-white text-gray-900 antialiased'); ?> 
      x-data="{ openMobile:false, openMega:false }" 
      x-on:keydown.escape.window="openMobile=false; openMega=false">
<?php wp_body_open(); ?>

<header class="sticky top-0 isolate z-50" role="banner">
  <div class="relative bg-[#F7F5EC]">
    <div class="container mx-auto max-w-7xl px-3 md:px-6">
      <div class="flex items-center justify-between gap-3 h-full">
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url('/') ); ?>" 
           class="shrink-0 inline-flex items-center my-2" 
           aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?>">
          <?php if ($logo_src): ?>
            <img src="<?php echo esc_url($logo_src); ?>" 
                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                 class="h-full max-h-[60px] md:max-h-[75px] lg:max-h-[85px] w-auto">
          <?php else: ?>
            <span class="font-black text-xl tracking-tight"><?php bloginfo('name'); ?></span>
          <?php endif; ?>
        </a>

        <!-- Hauptbereich rechts -->
        <nav class="flex items-center gap-3 md:gap-6" aria-label="<?php esc_attr_e('Hauptnavigation','ec-nordheide-theme'); ?>">
          <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'fallback_cb'    => false,
            'menu_class'     => 'primary-nav hidden lg:flex items-center gap-6 font-medium',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'link_before'    => '<span class="inline-flex flex-row flex-nowrap items-center py-2 uppercase text-[#333] hover:text-[#6C9941] lg:text-[16px] text-[18px]">',
            'link_after'     => '</span>',
          ]);
          ?>

          <!-- Instagram -->
          <a href="https://www.instagram.com/ecnordheide" class="inline-flex items-center justify-center w-10 h-10 cursor-pointer hover:text-[#6C9941]" aria-label="Instagram" title="Instagram">
            <svg class="w-[80%] h-[80%]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
          </a>

          <button type="button"
                  class="hidden lg:inline-flex items-center justify-center w-12 h-12 "
                  x-on:click="openMega = !openMega"
                  :aria-expanded="openMega.toString()"
                  aria-controls="mega-panel"
                  aria-label="<?php esc_attr_e('Menü öffnen (Desktop)','ec-nordheide-theme'); ?>">
            <svg class="w-10 h-10 text-[#333] hover:text-[#6C9941]" role="img" aria-label="Menü" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
              <title>Menü</title>
              <!-- Hex-Umriss -->
              <polygon points="64,4 116,32 116,96 64,124 12,96 12,32" fill="none" stroke="currentColor" stroke-width="6" stroke-linejoin="round"></polygon>
              <!-- Hamburger -->
              <g transform="translate(64,66)" fill="currentColor">
                <rect x="-20" y="-18" width="40" height="6" rx="3"></rect>
                <rect x="-20" y="-6" width="40" height="6" rx="3"></rect>
                <rect x="-20" y="6" width="40" height="6" rx="3"></rect>
              </g>
            </svg>
          </button>

          <!-- CTA: nur auf xl+ sichtbar -->
          <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>" class="hidden xl:inline-flex items-center rounded-sm px-4 py-2 text-white bg-[#92C355] hover:bg-[#64863a] text-[20px] no-underline focus:outline-none transition uppercase">
            <?php echo esc_html($cta_text); ?>
          </a>

          <!-- MENU BUTTONS -->
          <!-- Mobile Button (öffnet Off-Canvas) -->
          <button type="button"
                  class="inline-flex items-center justify-center w-12 h-12 lg:hidden"
                  x-on:click="openMobile = !openMobile"
                  :aria-expanded="openMobile.toString()"
                  aria-controls="mobile-nav"
                  aria-label="<?php esc_attr_e('Menü öffnen (mobil)','ec-nordheide-theme'); ?>">
            <svg class="w-10 h-10 text-[#333] hover:text-[#6C9941]" role="img" aria-label="Menü" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg">
              <title>Menü</title>
              <!-- Hex-Umriss -->
              <polygon points="64,4 116,32 116,96 64,124 12,96 12,32" fill="none" stroke="currentColor" stroke-width="6" stroke-linejoin="round"></polygon>
              <!-- Hamburger -->
              <g transform="translate(64,66)" fill="currentColor">
                <rect x="-20" y="-18" width="40" height="6" rx="3"></rect>
                <rect x="-20" y="-6" width="40" height="6" rx="3"></rect>
                <rect x="-20" y="6" width="40" height="6" rx="3"></rect>
              </g>
            </svg>

          <!-- Desktop/Tablet Button (öffnet Mega-Panel) -->

        </nav>
      </div>
    </div>
  </div>

  <!-- Divider bleibt wie gehabt -->
  <div class="">
    <!-- MOBILE Divider -->
    <svg viewBox="0 0 1200 10" preserveAspectRatio="none" class="pointer-events-none absolute inset-x-0 h-[10px] w-full z-10 md:hidden">
      <path d="M0,0 L1200,0 L1200,8 L900,3 L600,7 L300,4 L0,8 Z" fill="#F7F5EC"/>
      <polyline points="0,8 300,4 600,7 900,3 1200,8" fill="none" stroke="#92C355" stroke-width="4" vector-effect="non-scaling-stroke" stroke-linejoin="round" stroke-linecap="round" />
    </svg>
    <!-- DESKTOP Divider -->
    <svg viewBox="0 0 1200 10" preserveAspectRatio="none" class="pointer-events-none absolute inset-x-0 h-[14px] w-full z-10 hidden md:block">
      <path d="M0,0 L1200,0 L1200,8 L1090,3 L980,7 L860,4 L760,6 L655,3 L560,7 L455,2 L370,6 L280,3 L180,7 L90,4 L0,8 Z" fill="#F7F5EC"/>
      <polyline points="0,8 90,4 180,7 280,3 370,6 455,2 560,7 655,3 760,6 860,4 980,7 1090,3 1200,8" fill="none" stroke="#92C355" stroke-width="5" vector-effect="non-scaling-stroke" stroke-linejoin="round" stroke-linecap="round" />
    </svg>
  </div>

  <!-- MEGA PANEL (Desktop/Tablet) -->
<div id="mega-panel" class="hidden lg:block relative">
  <div
    x-cloak
    x-show="openMega"
    x-transition.opacity
    class="absolute inset-x-0 top-0"
    aria-label="<?php esc_attr_e('Großes Menü','ec-nordheide-theme'); ?>"
    @click.away="openMega=false"
  >
    <div
      class="mx-auto max-w-7xl px-3 md:px-6 flex justify-items-center"
    >
      <div
        class="origin-top transform-gpu w-full"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
      >
        <div class="overflow-hidden rounded-2xl shadow-2xl border-4 w-full border-[#92C355] rounded-tl-none rounded-tr-none bg-[#f7f5ec]/95 backdrop-blur supports-[backdrop-filter]:bg-[#f7f5ec]/80">
          <div class="p-6 md:p-8">
            <?php
              wp_nav_menu([
                'theme_location' => 'mega',
                'container'      => false,
                'fallback_cb'    => false,
                'menu_class'     => 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4',
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 3,
              ]);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</header>

<!-- MOBILE Off-Canvas -->
<div id="mobile-nav"
     x-cloak
     x-show="openMobile"
     x-transition.opacity
     class="fixed inset-0 z-50 lg:hidden"  <!-- nur auf Mobile sichtbar -->
     role="dialog"
     aria-modal="true">
  <div class="absolute inset-0 bg-black/40" x-on:click="openMobile=false"></div>

  <div class="absolute right-0 top-0 h-full w-[88%] max-w-[380px] bg-white shadow-2xl p-4 flex flex-col"
       x-trap.noscroll.inert="openMobile">
    <div class="flex items-center justify-between">
      <span class="font-semibold text-lg"><?php bloginfo('name'); ?></span>
      <button class="w-10 h-10 rounded-md border border-gray-300" aria-label="<?php esc_attr_e('Schließen','ec-nordheide-theme'); ?>" x-on:click="openMobile=false">✕</button>
    </div>

    <nav class="mt-4 overflow-auto" aria-label="<?php esc_attr_e('Mobile Navigation','ec-nordheide-theme'); ?>">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary', // gleiches Menü wie im Header (klein)
          'container'      => false,
          'fallback_cb'    => false,
          'menu_class'     => 'mobile-menu flex flex-col gap-1',
          'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth'          => 3,
        ]);
      ?>
    </nav>

    <div class="mt-auto pt-4">
      <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>"
         class="w-full inline-flex items-center justify-center rounded-full px-5 py-3 font-semibold no-underline text-white bg-[#ff9a42] hover:bg-[#f08b33] transition">
        <?php echo esc_html($cta_text); ?>
      </a>
    </div>
  </div>
</div>

<?php wp_footer(); ?>

<script>
// Mobile Submenu Toggle (unverändert, nur auf Mobile relevant)
document.addEventListener('DOMContentLoaded', function () {
  const container = document.querySelector('#mobile-nav .mobile-menu');
  if (!container) return;

  const parents = container.querySelectorAll('li.menu-item-has-children');
  parents.forEach((li, idx) => {
    const sub = li.querySelector(':scope > ul.sub-menu');
    const link = li.querySelector(':scope > a');
    if (!sub || !link) return;

    const row = document.createElement('div');
    row.className = 'flex items-center justify-between gap-2';

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'shrink-0 w-10 h-10 grid place-items-center rounded-md border border-gray-300';
    btn.setAttribute('aria-expanded', 'false');
    btn.setAttribute('aria-controls', `submenu-${idx}`);
    btn.innerHTML = '<span aria-hidden="true">▾</span><span class="sr-only">Untermenü umschalten</span>';

    sub.id = `submenu-${idx}`;
    sub.hidden = true;

    const linkParent = link.parentNode;
    linkParent.insertBefore(row, link);
    row.appendChild(link);
    row.appendChild(btn);

    btn.addEventListener('click', () => {
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      sub.hidden = expanded;
    });
  });
});
</script>

</body>
</html>
