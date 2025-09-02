<?php
$wp_mitarbeiter_id = block_field( 'eme_mitarbeiter', false );
$a_tmp_mitarbeiter = hole_wp_mitarbeiter_blocklab_mitarbeiterplugin( $wp_mitarbeiter_id );
$a_mitarbeiter     = $a_tmp_mitarbeiter[ $wp_mitarbeiter_id ];

$s_mitarbeiter_bildurl = $a_mitarbeiter['wp_mitarbeiter_bildurl'];
if ( $s_mitarbeiter_bildurl == '' ) {
	$s_mitarbeiter_bildurl = '/wp-content/themes/ecjugend20192/img/keinbild.PNG';
}
$s_mitarbeiter_name         = $a_mitarbeiter['wp_mitarbeiter_vorname'] . ' ' . $a_mitarbeiter['wp_mitarbeiter_name'];
$s_mitarbeiter_telefon_link = str_replace( ' ', '', $a_mitarbeiter['wp_mitarbeiter_telefon'] );
/*
nur für die Auswahlbox im Backend
$a_alle_mitarbeiter = hole_wp_mitarbeiter();


for/*TODO:refactor each()*/ each( $a_alle_mitarbeiter as $id => $a_mitarbeiter )[ echo $id . ' : ' . $a_mitarbeiter['wp_mitarbeiter_name'] . ', ' . $a_mitarbeiter['wp_mitarbeiter_vorname'] . ' - ' . $a_mitarbeiter['wp_mitarbeiter_kategorie'] . ' (' . $a_mitarbeiter['wp_mitarbeiter_funktion'] . ')<br />'; ]
* /
?>
<div class="inhalt_begrenzte_breite_zentriert wp_mitarbeiter_einzelansicht">
<div class="section group">
	<div class="xcol xspan_1_of_3" style="display: block;float: left;width: 32.26%;margin: 1% 0 1% 0%;">
	

		<img style="max-width: 150px; width: 100%;" src="<?php echo $s_mitarbeiter_bildurl; ?>" alt="" title="" />

	</div>
	<div class="xcol xspan_2_of_3 " style="display: block;float: left;width: 64.53%;margin: 1% 0 1% 1.6%;">
	<h3 class="wp_mitarbeiter_name"><?php echo $s_mitarbeiter_name; ?></h3>
	<div class="wp_mitarbeiter_funktion"><?php echo $a_mitarbeiter['wp_mitarbeiter_funktion']; ?></div>
	<div class="wp_mitarbeiter_beschreibung"><?php echo block_field( 'eme_beschreibung', false ); ?></div>
	<div class="wp_mitarbeiter_telefon"><div style="float: left;"><a href="tel:<?php echo $s_mitarbeiter_telefon_link; ?>"><i class="fas fa-phone-square fa-2x wp_mitarbeiter_telefon_icon"></i></a></div><div class="wp_mitarbeiter_telefon_nummer"><a href="tel:<?php echo $s_mitarbeiter_telefon_link; ?>"><?php echo $a_mitarbeiter['wp_mitarbeiter_telefon']; ?></a></div></div>
	<div class="wp_mitarbeiter_email"><div style="float: left;"><a href="mailto:<?php echo $a_mitarbeiter['wp_mitarbeiter_email']; ?>"><i class="fas fa-envelope-square fa-2x wp_mitarbeiter_email_icon"></i></a></div><div class="wp_mitarbeiter_email_email"><a href="mailto:<?php echo $a_mitarbeiter['wp_mitarbeiter_email']; ?>">E-Mail</a></div></div>

	</div>
</div>

<?php
// pf($a_mitarbeiter);
?>
</div>
