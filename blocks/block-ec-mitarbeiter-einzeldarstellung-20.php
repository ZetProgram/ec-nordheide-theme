<?php
// Mitarbeiter-ID aus Block-Field
$wp_mitarbeiter_id = (int) block_field('eme_mitarbeiter', false);

// Daten aus Plugin holen (vorsichtig prüfen)
$a_tmp_mitarbeiter = function_exists('hole_wp_mitarbeiter_blocklab_mitarbeiterplugin')
    ? (array) hole_wp_mitarbeiter_blocklab_mitarbeiterplugin($wp_mitarbeiter_id)
    : array();

$a_mitarbeiter = isset($a_tmp_mitarbeiter[$wp_mitarbeiter_id]) && is_array($a_tmp_mitarbeiter[$wp_mitarbeiter_id])
    ? $a_tmp_mitarbeiter[$wp_mitarbeiter_id]
    : array();

// Felder auslesen mit Fallbacks
$s_mitarbeiter_bildurl = !empty($a_mitarbeiter['wp_mitarbeiter_bildurl'])
    ? $a_mitarbeiter['wp_mitarbeiter_bildurl']
    : '/wp-content/themes/ecjugend20192/img/keinbild.PNG';

$vorname = isset($a_mitarbeiter['wp_mitarbeiter_vorname']) ? $a_mitarbeiter['wp_mitarbeiter_vorname'] : '';
$nachname = isset($a_mitarbeiter['wp_mitarbeiter_name']) ? $a_mitarbeiter['wp_mitarbeiter_name'] : '';
$s_mitarbeiter_name = trim($vorname . ' ' . $nachname);

$funktion = isset($a_mitarbeiter['wp_mitarbeiter_funktion']) ? $a_mitarbeiter['wp_mitarbeiter_funktion'] : '';

$telefon_raw = isset($a_mitarbeiter['wp_mitarbeiter_telefon']) ? $a_mitarbeiter['wp_mitarbeiter_telefon'] : '';
// Für tel:-Links nur Ziffern, Plus und Komma/Leerzeichen/-/() entfernen bzw. tolerieren
$s_mitarbeiter_telefon_link = preg_replace('/[^\d\+]/', '', $telefon_raw);

$email_raw = isset($a_mitarbeiter['wp_mitarbeiter_email']) ? $a_mitarbeiter['wp_mitarbeiter_email'] : '';
$email_safe = sanitize_email($email_raw);

// Nur für die Auswahlbox im Backend (Kommentarblock korrigiert):
/*
nur für die Auswahlbox im Backend
$a_alle_mitarbeiter = function_exists('hole_wp_mitarbeiter') ? hole_wp_mitarbeiter() : array();
foreach ($a_alle_mitarbeiter as $id => $mit) {
    echo esc_html($id . ' : ' . ($mit['wp_mitarbeiter_name'] ?? '') . ', ' . ($mit['wp_mitarbeiter_vorname'] ?? '') . ' - ' . ($mit['wp_mitarbeiter_kategorie'] ?? '') . ' (' . ($mit['wp_mitarbeiter_funktion'] ?? '') . ')<br />');
}
*/
?>
<div class="inhalt_begrenzte_breite_zentriert wp_mitarbeiter_einzelansicht">
  <div class="section group">
    <div class="xcol xspan_1_of_3" style="display:block;float:left;width:32.26%;margin:1% 0;">
      <img
        style="max-width:150px;width:100%;"
        src="<?php echo esc_url($s_mitarbeiter_bildurl); ?>"
        alt="<?php echo esc_attr($s_mitarbeiter_name ?: 'Mitarbeiterbild'); ?>"
        title="<?php echo esc_attr($s_mitarbeiter_name); ?>"
      />
    </div>
    <div class="xcol xspan_2_of_3" style="display:block;float:left;width:64.53%;margin:1% 0 1% 1.6%;">
      <h3 class="wp_mitarbeiter_name"><?php echo esc_html($s_mitarbeiter_name); ?></h3>
      <?php if (!empty($funktion)) : ?>
        <div class="wp_mitarbeiter_funktion"><?php echo esc_html($funktion); ?></div>
      <?php endif; ?>

      <div class="wp_mitarbeiter_beschreibung">
        <?php
          // block_field mit false gibt zurück → sicher ausgeben, HTML zulassen wenn gewünscht:
          $beschreibung = block_field('eme_beschreibung', false);
          echo wp_kses_post($beschreibung);
        ?>
      </div>

      <?php if (!empty($s_mitarbeiter_telefon_link)) : ?>
      <div class="wp_mitarbeiter_telefon" style="display:flex;align-items:center;gap:.5rem;margin-top:.5rem;">
        <div><a href="tel:<?php echo esc_attr($s_mitarbeiter_telefon_link); ?>"><i class="fas fa-phone-square fa-2x wp_mitarbeiter_telefon_icon" aria-hidden="true"></i></a></div>
        <div class="wp_mitarbeiter_telefon_nummer">
          <a href="tel:<?php echo esc_attr($s_mitarbeiter_telefon_link); ?>"><?php echo esc_html($telefon_raw); ?></a>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($email_safe)) : ?>
      <div class="wp_mitarbeiter_email" style="display:flex;align-items:center;gap:.5rem;margin-top:.25rem;">
        <div><a href="mailto:<?php echo esc_attr($email_safe); ?>"><i class="fas fa-envelope-square fa-2x wp_mitarbeiter_email_icon" aria-hidden="true"></i></a></div>
        <div class="wp_mitarbeiter_email_email">
          <a href="mailto:<?php echo esc_attr($email_safe); ?>">E-Mail</a>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php // pf($a_mitarbeiter); ?>
</div>
