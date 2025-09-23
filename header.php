<!DOCTYPE html>
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
  // CTA / Spenden
  $cta_text    = get_theme_mod('highlightbtn_titel', __('Unterstütze uns!','ec-nordheide-theme'));
  $cta_page_id = (int) get_theme_mod('highlightbtn_page', 0);
  $cta_target  = get_theme_mod('highlightbtn_target', '_self');
  if ($cta_page_id > 0) {
    $cta_url = get_permalink($cta_page_id);
  } else {
    $cta_url = home_url('/spenden');
  }

  // Logo
  $custom_logo_id = get_theme_mod('custom_logo');
  $logo_src       = '';
  if ($custom_logo_id) {
    $img = wp_get_attachment_image_src($custom_logo_id, 'full');
    if ($img) { $logo_src = $img[0]; }
  }
?>
<body <?php body_class('bg-white text-gray-900 antialiased'); ?> x-data="{ open:false }" x-on:keydown.escape.window="open=false">
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 isolate" role="banner">
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

        <!-- Desktop Nav -->
        <nav class="flex items-center gap-6" aria-label="<?php esc_attr_e('Hauptnavigation','ec-nordheide-theme'); ?>">
          <?php
            wp_nav_menu([
              'theme_location' => 'primary',
              'container'      => false,
              'fallback_cb'    => false,
              'menu_class'     => 'hidden lg:flex items-center gap-6 font-medium',
              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'link_before'    => '<span class="inline-block py-2 hover:color-[#6C9941] uppercase color-[#1A1A1A] lg:text-[20px] text-[18px]">',
              'link_after'     => '</span>',
            ]);
          ?>

          <button type="button" class="inline-flex mr-4 xl:mr-0 items-center justify-center w-14 h-14"
                  x-on:click="open = !open" 
                  :aria-expanded="open.toString()" 
                  aria-controls="mobile-nav" 
                  aria-label="<?php esc_attr_e('Menü öffnen','ec-nordheide-theme'); ?>">
              <img src="<?php echo esc_url( get_template_directory_uri() . '/img/menu_symbol.svg' ); ?>" alt="<?php esc_attr_e('Menü Icon','ec-nordheide-theme'); ?>" class="max-h-[60px] w-14 h-14"> 
          </button>

          <!-- Spenden Button -->
          <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>" class="hidden xl:inline-flex items-center rounded-sm px-4 py-2 text-white bg-[#92C355] hover:bg-[#64863a] text-[20px] no-underline focus:outline-none transition uppercase">
            <?php echo esc_html($cta_text); ?>
          </a>
        </nav>
      </div>
    </div>
  </div>

  <div>
    <!-- Divider: Polygonfüllung + grüne Linie -->
    <!-- MOBILE -->
    <svg viewBox="0 0 1200 10" preserveAspectRatio="none"
         class="pointer-events-none absolute inset-x-0 h-[10px] w-full z-10 md:hidden">
      <path d="M0,0 L1200,0 L1200,8 L900,3 L600,7 L300,4 L0,8 Z"
            fill="#F7F5EC"/>
      <polyline
        points="0,8 300,4 600,7 900,3 1200,8"
        fill="none"
        stroke="#92C355"
        stroke-width="4"
        vector-effect="non-scaling-stroke"
        stroke-linejoin="round"
        stroke-linecap="round" />
    </svg>

    <!-- DESKTOP -->
    <svg viewBox="0 0 1200 10" preserveAspectRatio="none"
         class="pointer-events-none absolute inset-x-0 h-[14px] w-full z-10 hidden md:block">
      <path d="M0,0 L1200,0 L1200,8 L1090,3 L980,7 L860,4 L760,6 L655,3 L560,7 L455,2 L370,6 L280,3 L180,7 L90,4 L0,8 Z"
            fill="#F7F5EC"/>
      <polyline
        points="0,8 90,4 180,7 280,3 370,6 455,2 560,7 655,3 760,6 860,4 980,7 1090,3 1200,8"
        fill="none"
        stroke="#92C355"
        stroke-width="5"
        vector-effect="non-scaling-stroke"
        stroke-linejoin="round"
        stroke-linecap="round" />
    </svg>
  </div>
</header>

<!-- Mobile Off-Canvas -->
 <div id="mobile-nav" x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50 " role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/40" x-on:click="open=false"></div>

    <div class="absolute right-0 top-0 h-full w-[88%] max-w-[380px] bg-white shadow-2xl p-4 flex flex-col"
         x-trap.noscroll.inert="open">
      <div class="flex items-center justify-between">
        <span class="font-semibold text-lg"><?php bloginfo('name'); ?></span>
        <button class="w-10 h-10 rounded-md border border-gray-300" aria-label="<?php esc_attr_e('Schließen','ec-nordheide-theme'); ?>" x-on:click="open=false">✕</button>
      </div>

      <nav class="mt-4 overflow-auto" aria-label="<?php esc_attr_e('Mobile Navigation','ec-nordheide-theme'); ?>">
        <?php
          // Wichtig: gleiche theme_location wie oben → eine Stelle pflegen!
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'fallback_cb'    => false,
            'menu_class'     => 'mobile-menu flex flex-col gap-1',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            // Tiefe ruhig lassen; WP rendert <ul class="sub-menu"> automatisch
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
document.addEventListener('DOMContentLoaded', function () {
  const container = document.querySelector('#mobile-nav .mobile-menu');
  if (!container) return;

  const parents = container.querySelectorAll('li.menu-item-has-children');
  parents.forEach((li, idx) => {
    const sub = li.querySelector(':scope > ul.sub-menu');
    const link = li.querySelector(':scope > a');

    if (!sub || !link) return;

    // Wrap den Link und den Toggle nebeneinander
    const row = document.createElement('div');
    row.className = 'flex items-center justify-between gap-2';

    // Button
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'shrink-0 w-10 h-10 grid place-items-center rounded-md border border-gray-300';
    btn.setAttribute('aria-expanded', 'false');
    btn.setAttribute('aria-controls', `submenu-${idx}`);
    btn.innerHTML = '<span aria-hidden="true">▾</span><span class="sr-only">Untermenü umschalten</span>';

    // IDs/ARIA
    sub.id = `submenu-${idx}`;
    sub.hidden = true;

    // DOM umbauen
    const linkParent = link.parentNode;
    linkParent.insertBefore(row, link);
    row.appendChild(link);
    row.appendChild(btn);

    // Toggle Logik
    btn.addEventListener('click', () => {
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      sub.hidden = expanded;
    });

    // Optional: Link öffnet NICHT das Sub auf mobile – nur Button.
    // Wenn du willst, dass der erste Tap den Dropdown öffnet:
    // link.addEventListener('click', (e) => {
    //   if (sub.hidden) { e.preventDefault(); btn.click(); }
    // });
  });
});
</script>
</body>
</html>
