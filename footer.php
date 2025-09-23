<?php
  // Schließe ggf. vorherige Container/Divs, falls nötig.
?>

<footer id="site-footer" class="bg-[#D9D9D9] text-white mt-16">
  <!-- Upper footer: 3 columns -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Spalte 1: Kontakt (Widget hat Vorrang; sonst Fallback aus Customizer) -->
      <div>
        <?php if ( is_active_sidebar('footer_col_1') ) : ?>
          <?php dynamic_sidebar('footer_col_1'); ?>
        <?php else :
          $org   = get_theme_mod('footer_contact_org',   '');
          $addr  = nl2br(esc_html(get_theme_mod('footer_contact_addr', '')));
          $phone = get_theme_mod('footer_contact_phone', '');
          $email = get_theme_mod('footer_contact_email', '');
        ?>
          <h3 class="font-semibold text-white text-lg mb-3"><?php esc_html_e('Kontakt','ec-nordheide-theme'); ?></h3>
          <div class="space-y-1 text-sm leading-6">
            <?php if ($org)   echo '<div>'.esc_html($org).'</div>'; ?>
            <?php if ($addr)  echo '<div>'.$addr.'</div>'; ?>
            <?php if ($phone) echo '<div>'.esc_html__('Telefon','ec-nordheide-theme').': '.esc_html($phone).'</div>'; ?>
            <?php if ($email) echo '<div>'.esc_html__('E-Mail','ec-nordheide-theme').': <a class="underline" href="'.esc_url('mailto:'.$email).'">'.esc_html($email).'</a></div>'; ?>
          </div>

          <!-- Social-Icons Platzhalter -->
          <div class="flex gap-3 mt-4">
            <!-- Beispiel: Ersetze # durch echte Links -->
            <a href="#" class="inline-flex items-center justify-center w-10 h-10 border border-white/40 rounded" aria-label="Instagram">
              <span class="sr-only">Instagram</span>⌁
            </a>
            <a href="#" class="inline-flex items-center justify-center w-10 h-10 border border-white/40 rounded" aria-label="YouTube">
              <span class="sr-only">YouTube</span>▶
            </a>
            <a href="#" class="inline-flex items-center justify-center w-10 h-10 border border-white/40 rounded" aria-label="Facebook">
              <span class="sr-only">Facebook</span>f
            </a>
            <a href="#" class="inline-flex items-center justify-center w-10 h-10 border border-white/40 rounded" aria-label="WhatsApp">
              <span class="sr-only">WhatsApp</span>◷
            </a>
          </div>
        <?php endif; ?>
      </div>

      <!-- Spalte 2: frei (Newsletter, Text, Liste, …) -->
      <div>
        <?php if ( is_active_sidebar('footer_col_2') ) : ?>
          <?php dynamic_sidebar('footer_col_2'); ?>
        <?php else : ?>
          <h3 class="font-semibold text-white text-lg mb-3"><?php esc_html_e('Newsletter','ec-nordheide-theme'); ?></h3>
          <p class="text-sm text-white/90 mb-2">
            <?php esc_html_e('Bleibe über Neuigkeiten informiert.','ec-nordheide-theme'); ?>
          </p>
          <a href="#" class="inline-flex items-center gap-2 underline">
            ✉ <?php esc_html_e('Jetzt abonnieren','ec-nordheide-theme'); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- Spalte 3: frei (Links-Liste etc.) -->
      <div>
        <?php if ( is_active_sidebar('footer_col_3') ) : ?>
          <?php dynamic_sidebar('footer_col_3'); ?>
        <?php else : ?>
          <h3 class="font-semibold text-white text-lg mb-3"><?php esc_html_e('Klingt interessant','ec-nordheide-theme'); ?></h3>
          <ul class="space-y-2 text-sm">
            <li><a class="hover:underline" href="#"><?php esc_html_e('Wer steckt hinter EC Nordheide?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline" href="#"><?php esc_html_e('Welche Arbeitsbereiche gibt es?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline" href="#"><?php esc_html_e('Wann sind die nächsten Veranstaltungen?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline" href="#"><?php esc_html_e('Was für Schulungen gibt es?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline" href="#"><?php esc_html_e('Hilfreiche Downloads','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline" href="#"><?php esc_html_e('Adressänderung','ec-nordheide-theme'); ?></a></li>
          </ul>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- Divider -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <hr class="border-white/15">
  </div>

  <!-- Bottom bar: Logo + Bottom menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) : ?>
          <div class="shrink-0"><?php the_custom_logo(); ?></div>
        <?php else: ?>
          <span class="font-semibold"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
        <span class="text-white/70 text-sm">© <?php echo esc_html( date('Y') ); ?></span>
      </div>

      <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu',
          'container'      => false,
          'fallback_cb'    => false,
          'depth'          => 1,
          'items_wrap'     => '<ul class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm">%3$s</ul>',
          'link_before'    => '',
          'link_after'     => '',
        ]);
      ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
