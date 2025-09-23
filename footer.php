<?php
  // Schließe ggf. vorherige Container/Divs, falls nötig.
?>
<?php
$logo_id  = get_theme_mod('custom_logo'); 
$logo_src = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : '';
?>
<footer id="site-footer" class="bg-[#D9D9D9] text-[#1A1A1A] mt-16">
  <!-- Upper footer: 3 columns -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Spalte 1: Kontakt (Widget hat Vorrang; sonst Fallback aus Customizer) -->
      <div class="mx-auto">
        <?php if ( is_active_sidebar('footer_col_1') ) : ?>
          <?php dynamic_sidebar('footer_col_1'); ?>
        <?php else :
          $org   = get_theme_mod('footer_contact_org',   '');
          $addr  = nl2br(esc_html(get_theme_mod('footer_contact_addr', '')));
          $phone = get_theme_mod('footer_contact_phone', '');
          $email = get_theme_mod('footer_contact_email', '');
        ?>
          <h3 class="font-semibold text-[#1A1A1A] text-lg mb-3 text-center md:text-left"><?php esc_html_e('Kontakt','ec-nordheide-theme'); ?></h3>
          <div class="space-y-1 text-sm leading-6">
            <?php if ($org)   echo '<div>'.esc_html($org).'</div>'; ?>
            <?php if ($addr)  echo '<div>'.$addr.'</div>'; ?>
            <?php if ($phone) echo '<div>'.esc_html__('Telefon','ec-nordheide-theme').': '.esc_html($phone).'</div>'; ?>
            <?php if ($email) echo '<div>'.esc_html__('E-Mail','ec-nordheide-theme').': <a class="underline" href="'.esc_url('mailto:'.$email).'">'.esc_html($email).'</a></div>'; ?>
          </div>

          <!-- Social-Icons Platzhalter -->
          <div class="flex gap-3 mt-4">
            <a href="https://www.instagram.com/ecnordheide" class="inline-flex items-center justify-center w-10 h-10 border border-[#1A1A1A] rounded" aria-label="Instagram" title="Instagram">
            <svg class="w-[60%] h-[60%]" aria-hidden="true" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
			</a>
            <a href="https://www.youtube.com/@ecKreisverbandNordheide" class="inline-flex items-center justify-center w-10 h-10 border border-[#1A1A1A] rounded" aria-label="YouTube" title="YouTube">
              <svg class="w-[60%] h-[60%]" aria-hidden="true" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
            </a>
			<!--
            <a href="#" class="inline-flex items-center justify-center w-10 h-10 border border-[#1A1A1A] rounded" aria-label="WhatsApp" title="WhatsApp">
				<svg class="w-[60%] h-[60%]" aria-hidden="true" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
            </a>
			-->
          </div>
        <?php endif; ?>
      </div>

      <!-- Spalte 2: frei (Newsletter, Text, Liste, …) -->
      <div class="mx-auto">
        <?php if ( is_active_sidebar('footer_col_2') ) : ?>
          <?php dynamic_sidebar('footer_col_2'); ?>
        <?php else : ?>
          <h3 class="font-semibold text-[#1A1A1A] text-lg mb-3  text-center md:text-left"><?php esc_html_e('Newsletter','ec-nordheide-theme'); ?></h3>
          <p class="text-sm text-[#1A1A1A] mb-2">
            <?php esc_html_e('Bleibe über Neuigkeiten informiert.','ec-nordheide-theme'); ?>
          </p>
          <a href="#" class="inline-flex items-center gap-2 underline">
            ✉ <?php esc_html_e('Jetzt abonnieren','ec-nordheide-theme'); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- Spalte 3: frei (Links-Liste etc.) -->
      <div class="mx-auto ">
        <?php if ( is_active_sidebar('footer_col_3') ) : ?>
          <?php dynamic_sidebar('footer_col_3'); ?>
        <?php else : ?>
          <h3 class="font-semibold text-[#1A1A1A] text-lg mb-3  text-center md:text-left"><?php esc_html_e('Klingt interessant','ec-nordheide-theme'); ?></h3>
          <ul class="space-y-2 text-sm">
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Wer steckt hinter EC Nordheide?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Welche Arbeitsbereiche gibt es?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Wann sind die nächsten Veranstaltungen?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Was für Schulungen gibt es?','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Hilfreiche Downloads','ec-nordheide-theme'); ?></a></li>
            <li><a class="hover:underline no-underline" href="#"><?php esc_html_e('Adressänderung','ec-nordheide-theme'); ?></a></li>
          </ul>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- Divider -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <hr class="border-[#1A1A1A]">
  </div>

  <!-- Bottom bar: Logo + Bottom menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) : ?>
			
          <div class="shrink-0">
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="shrink-0 inline-flex items-center my-2" aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				<?php if ($logo_src): ?>
					<img src="<?php echo esc_url($logo_src); ?>" 
						alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
						class="h-full max-h-[60px] md:max-h-[75px] lg:max-h-[85px] w-auto">
				<?php else: ?>
					<span class="font-black text-xl tracking-tight"><?php bloginfo('name'); ?></span>
				<?php endif; ?>
			</a>
		  </div>
        <?php else: ?>
          <span class="font-semibold"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
        <span class="text-[#1A1A1A] text-sm">© <?php echo esc_html( date('Y') ); ?></span>
      </div>

      <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu',
          'container'      => false,
          'fallback_cb'    => false,
          'depth'          => 1,
          'items_wrap'     => '<ul class="flex flex-wrap items-center gap-x-5 gap-y-2 text-md no-underline">%3$s</ul>',
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
