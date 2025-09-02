<?php
/**
 * Customizer: Einstellungen für Menü-Spalten, Highlight-Button, Instagram, Footer-Adresse, Hexagone
 * - Fix: Undefined variable $aktuelle_seite entfernt (Optionen-Funktion braucht das nicht)
 * - Fix: object_to_array entfernt – wir arbeiten direkt mit den Page-Objekten
 * - Fix: Falsche Array-Einträge entfernt (z. B. 'theme-slug' ohne Key)
 * - Fix: Control-Typen konsistent (text/number/url/select)
 */

/**
 * Adds Layout Options section and sidebar position setting.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function theme_slug_customize_register_MainMenuSpalten( $wp_customize ) {

	$wp_customize->add_section(
		'theme_slug_mainmenu_spalten',
		array(
			'title'       => esc_html__( 'Menü Spalten', 'theme-slug' ),
			'priority'    => 120,
			/* Hinweis: Im Customizer sollten Links besser relativ vermieden werden, hier aber beibehalten */
			'description' => wp_kses_post(
				'Hier kannst du bis zu vier Spalten für die Darstellung der Navigation im Hauptmenü definieren. 
             Definiere jeweils die Überschrift und die Elternseite, dessen Unterelemente gelistet werden sollen.<br />
             Es werden nur Elternseiten gelistet, die auch in der <a href="/wp-admin/edit.php?post_type=page">Seitenstruktur</a> Unterelemente aufweisen.'
			),
		)
	);

	$a_options = cm_hole_options_alle_seiten();

	for ( $i = 1; $i <= 4; $i++ ) {

		// Überschrift Spalte
		$wp_customize->add_setting(
			'main_meu_spalte_bezeichnung_' . $i,
			array(
				'default'           => 'Überschrift ' . $i,
				'sanitize_callback' => 'theme_slug_sanitize_input',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'main_meu_spalte_bezeichnung_' . $i,
			array(
				/* Für Freitext passt 'text' besser als 'input' */
				'type'     => 'text',
				'label'    => sprintf( esc_html__( 'Spalte %d: Überschrift / Elternseite', 'theme-slug' ), $i ),
				'section'  => 'theme_slug_mainmenu_spalten',
				'priority' => 1,
			)
		);

		// Parent-ID Spalte
		$wp_customize->add_setting(
			'main_meu_spalte_' . $i,
			array(
				'default'           => '123',
				'sanitize_callback' => 'theme_slug_sanitize_select',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'main_meu_spalte_' . $i,
			array(
				'type'     => 'select',
				'section'  => 'theme_slug_mainmenu_spalten',
				'priority' => 1,
				'choices'  => $a_options,
			)
		);
	}
}
add_action( 'customize_register', 'theme_slug_customize_register_MainMenuSpalten' );


// Hervorgehobener Button
function theme_slug_customize_register_HighlightButton( $wp_customize ) {

	$wp_customize->add_section(
		'theme_slug_highlightbtn',
		array(
			'title'       => esc_html__( 'Button Highlight', 'theme-slug' ),
			'priority'    => 120,
			'description' => esc_html__( 'Definiere hier den hervorgehobenen Button im Menü zwischen Hauptmenü-Icon und der Suche.', 'theme-slug' ),
		)
	);

	// Beschriftung
	$wp_customize->add_setting(
		'highlightbtn_titel',
		array(
			'default'           => 'Spenden',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'highlightbtn_titel',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Beschriftung', 'theme-slug' ),
			'section'  => 'theme_slug_highlightbtn',
			'priority' => 1,
		)
	);

	// URL
	$wp_customize->add_setting(
		'highlightbtn_url',
		array(
			'default'           => './index.php',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_url',
		)
	);

	$wp_customize->add_control(
		'highlightbtn_url',
		array(
			'type'     => 'url',
			'label'    => esc_html__( 'Link', 'theme-slug' ),
			'section'  => 'theme_slug_highlightbtn',
			'priority' => 1,
		)
	);

	// Target
	$wp_customize->add_setting(
		'highlightbtn_target',
		array(
			'default'           => '_blank',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'highlightbtn_target',
		array(
			'type'        => 'select',
			'label'       => esc_html__( 'Ziel', 'theme-slug' ),
			'description' => esc_html__( 'Soll sich der Link in einem neuen oder im selben Tab öffnen?', 'theme-slug' ),
			'section'     => 'theme_slug_highlightbtn',
			'choices'     => array(
				'_blank' => esc_html__( 'Neuer Tab', 'theme-slug' ),
				'_self'  => esc_html__( 'Im selben Tab', 'theme-slug' ),
			),
			'priority'    => 1,
		)
	);
}
add_action( 'customize_register', 'theme_slug_customize_register_HighlightButton' );


// Instagram im Footer
function theme_slug_customize_register_Instagram( $wp_customize ) {

	$wp_customize->add_section(
		'theme_slug_instagram',
		array(
			'title'       => esc_html__( 'Instagram im Footer', 'theme-slug' ),
			'priority'    => 120,
			'description' => esc_html__( 'Um Instagram im Footer einzublenden, definiere hier die nötigen Daten.', 'theme-slug' ),
		)
	);

	// Insta Link
	$wp_customize->add_setting(
		'instagram_link',
		array(
			'default'           => 'https://www.instagram.com/ecjugend/',
			'sanitize_callback' => 'theme_slug_sanitize_textarea_html',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'instagram_link',
		array(
			'type'        => 'text',
			'label'       => esc_html__( 'Instagram Link', 'theme-slug' ),
			'description' => esc_html__( 'Der Link zu deiner Instagram-Seite.', 'theme-slug' ),
			'section'     => 'theme_slug_instagram',
			'priority'    => 1,
		)
	);

	// Button-Beschriftung
	$wp_customize->add_setting(
		'instagram_button_beschriftung',
		array(
			'default'           => 'EC auf Instagram',
			'sanitize_callback' => 'theme_slug_sanitize_input',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'instagram_button_beschriftung',
		array(
			'type'        => 'text',
			'label'       => esc_html__( 'Instagram Button Beschriftung', 'theme-slug' ),
			'description' => esc_html__( 'Beschriftung des Buttons unter den Hexagonen.', 'theme-slug' ),
			'section'     => 'theme_slug_instagram',
			'priority'    => 1,
		)
	);

	// Instagram An/Aus
	$wp_customize->add_setting(
		'instagram_an_aus',
		array(
			'default'           => 'an',
			'sanitize_callback' => 'theme_slug_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'instagram_an_aus',
		array(
			'type'        => 'select',
			'label'       => esc_html__( 'Instagram An/Aus', 'theme-slug' ),
			'description' => esc_html__( 'Hiermit kannst du das Instagram-Element ausblenden.', 'theme-slug' ),
			'section'     => 'theme_slug_instagram',
			'choices'     => array(
				'an'  => esc_html__( 'An', 'theme-slug' ),
				'aus' => esc_html__( 'Aus', 'theme-slug' ),
			),
			'priority'    => 1,
		)
	);

	// Access Token
	$wp_customize->add_setting(
		'instagram_access_token',
		array(
			'default'           => '',
			'sanitize_callback' => 'theme_slug_sanitize_input',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'instagram_access_token',
		array(
			'type'        => 'text',
			'label'       => esc_html__( 'Instagram Access Token', 'theme-slug' ),
			'description' => esc_html__( 'Trage hier deinen Instagram Access Token ein. Ist er leer, wird das Element ausgeblendet.', 'theme-slug' ),
			'section'     => 'theme_slug_instagram',
			'priority'    => 1,
		)
	);
}
add_action( 'customize_register', 'theme_slug_customize_register_Instagram' );


// Adresse im Footer
function theme_slug_customize_register_Footeradresse( $wp_customize ) {

	$wp_customize->add_section(
		'theme_slug_footeradresse',
		array(
			'title'       => esc_html__( 'Adresse im Footer', 'theme-slug' ),
			'priority'    => 120,
			'description' => wp_kses_post(
				'Hier kannst du die Adresse definieren, die im Footer erscheinen soll. 
             Erlaubte HTML-Tags: <ul><li>a<ul><li>href</li><li>title</li><li>target</li></ul></li><li>br</li><li>strong</li></ul>'
			),
		)
	);

	$wp_customize->add_setting(
		'footeradresse',
		array(
			'default'           => 'Deutscher Jugendverband<br /><strong>"Entschieden für Christus"</strong> e.V.<br />Leuschnerstr. 74<br />34134 Kassel<br /><a href="tel:0561 4095 0" target="_blank" title="" style="color: #fff;">Tel: 0561 4095 0</a>',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_textarea_html',
		)
	);

	$wp_customize->add_control(
		'footeradresse',
		array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Adresse im Footer', 'theme-slug' ),
			'section'  => 'theme_slug_footeradresse',
			'priority' => 1,
		)
	);
}
add_action( 'customize_register', 'theme_slug_customize_register_Footeradresse' );


// Hexagone
function theme_slug_customize_register_Hexagone( $wp_customize ) {

	$wp_customize->add_section(
		'theme_slug_hexagone',
		array(
			'title'    => esc_html__( 'Hexagone', 'theme-slug' ),
			'priority' => 120,
		)
	);

	// Anzahl
	$wp_customize->add_setting(
		'anzahl_hexagone',
		array(
			'default'           => '10',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'anzahl_hexagone',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Anzahl', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
			),
			'description' => esc_html__( 'Wie viele Hexagone sollen angezeigt werden? Werte bis ~20 sind meist sinnvoll.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	// Geschwindigkeit
	$wp_customize->add_setting(
		'geschwindigkeit_hexagone_von',
		array(
			'default'           => '10',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'geschwindigkeit_hexagone_von',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Scrollgeschwindigkeit "von / bis"', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array( 'min' => 0 ),
			'description' => esc_html__( 'Sinnvolle Werte zwischen 10 und 100. Gleiche Werte = gleiche Geschwindigkeit.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'geschwindigkeit_hexagone_bis',
		array(
			'default'           => '100',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'geschwindigkeit_hexagone_bis',
		array(
			'type'        => 'number',
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array( 'min' => 0 ),
			'priority'    => 1,
		)
	);

	// Rotationswinkel
	$wp_customize->add_setting(
		'rotation_hexagone_von',
		array(
			'default'           => '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'rotation_hexagone_von',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Rotationswinkel "von / bis"', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array(
				'min' => 0,
				'max' => 360,
			),
			'description' => esc_html__( 'Werte zwischen 0 und 360 Grad. Gleiche Werte = gleiche Rotation.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'rotation_hexagone_bis',
		array(
			'default'           => '360',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'rotation_hexagone_bis',
		array(
			'type'        => 'number',
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array(
				'min' => 0,
				'max' => 360,
			),
			'priority'    => 1,
		)
	);

	// Größe
	$wp_customize->add_setting(
		'groesse_hexagone_von',
		array(
			'default'           => '5',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'groesse_hexagone_von',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Größe "von / bis"', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'description' => esc_html__( 'Größe in vw. Sinnvoll zwischen 5 und 20.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'groesse_hexagone_bis',
		array(
			'default'           => '20',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'groesse_hexagone_bis',
		array(
			'type'     => 'number',
			'section'  => 'theme_slug_hexagone',
			'priority' => 1,
		)
	);

	// Abstand vom Rand
	$wp_customize->add_setting(
		'abstand_rand_hexagone_von',
		array(
			'default'           => '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'abstand_rand_hexagone_von',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Abstand vom linken/rechten Seitenrand', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'description' => esc_html__( 'Abstand in %. Gleiche Werte = gleicher Abstand für alle.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'abstand_rand_hexagone_bis',
		array(
			'default'           => '10',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'abstand_rand_hexagone_bis',
		array(
			'type'     => 'number',
			'section'  => 'theme_slug_hexagone',
			'priority' => 1,
		)
	);

	// Deckkraft
	$wp_customize->add_setting(
		'opacity_hexagone_von',
		array(
			'default'           => '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'opacity_hexagone_von',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Deckungskraft', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
			),
			'description' => esc_html__( '0 = unsichtbar, 100 = volle Deckungskraft.', 'theme-slug' ),
			'priority'    => 1,
		)
	);

	$wp_customize->add_setting(
		'opacity_hexagone_bis',
		array(
			'default'           => '100',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'opacity_hexagone_bis',
		array(
			'type'        => 'number',
			'section'     => 'theme_slug_hexagone',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
			),
			'priority'    => 1,
		)
	);

	// Ausblenden ab Breite
	$wp_customize->add_setting(
		'display_none_hexagone',
		array(
			'default'           => '1360',
			'transport'         => 'refresh',
			'sanitize_callback' => 'theme_slug_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'display_none_hexagone',
		array(
			'type'        => 'number',
			'label'       => esc_html__( 'Display Breite: Hexagone ausblenden', 'theme-slug' ),
			'description' => esc_html__( 'Ab welcher Display-Breite (px) sollen die Hexagone ganz ausgeblendet werden?', 'theme-slug' ),
			'section'     => 'theme_slug_hexagone',
			'priority'    => 1,
		)
	);

	// Eigene Hexagon-Bilder (bis zu 8)
	for ( $i = 1; $i <= 8; $i++ ) {

		// Bild-Auswahl
		$wp_customize->add_setting(
			'img_hexagone_link_' . $i,
			array(
				'type'              => 'theme_mod',
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);

		$label       = ( $i === 1 ) ? esc_html__( 'Eigene Hexagone (Bilder)', 'theme-slug' ) : '';
		$description = ( $i === 1 )
			? esc_html__( 'Definiere bis zu 8 eigene Hexagone/Bilder. Wenn ein Bild als Hexagon erscheinen soll, muss es bereits entsprechend zugeschnitten sein. Du kannst jedem Bild einen Link zuweisen.', 'theme-slug' )
			: '';

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'img_hexagone_link_' . $i,
				array(
					'label'       => $label,
					'description' => ( $label ? $description : sprintf( esc_html__( 'Eigenes Hexagon %d', 'theme-slug' ), $i ) ),
					'section'     => 'theme_slug_hexagone',
					'mime_type'   => 'image',
					'priority'    => 1,
				)
			)
		);

		// Link zum Bild
		$wp_customize->add_setting(
			'img_hexagone_link_href_' . $i,
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'theme_slug_sanitize_url',
			)
		);

		$wp_customize->add_control(
			'img_hexagone_link_href_' . $i,
			array(
				'type'        => 'url',
				'section'     => 'theme_slug_hexagone',
				'label'       => '',
				'description' => sprintf( esc_html__( 'Link für Hexagon %d', 'theme-slug' ), $i ),
				'input_attrs' => array(
					'placeholder' => 'https://www.ec.de',
				),
				'priority'    => 1,
			)
		);
	}
}
add_action( 'customize_register', 'theme_slug_customize_register_Hexagone' );


/** Sanitisierungsfunktionen */
function theme_slug_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

function theme_slug_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$control = $setting->manager->get_control( $setting->id );
	$choices = is_object( $control ) ? $control->choices : array();

	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}

function theme_slug_sanitize_input( $input ) {
	return sanitize_text_field( $input );
}

function theme_slug_sanitize_textarea_html( $input ) {
	$allowed = array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
			'title'  => array(),
			'style'  => array(),
		),
		'br'     => array(),
		'strong' => array(),
	);
	return wp_kses( $input, $allowed );
}


/**
 * Liefert ein Choices-Array mit Seiten, die Kinder haben:
 * [0 => 'Bitte auswählen', <page_id> => <page_title>, ...]
 */
function cm_hole_options_alle_seiten(): array {

	$args = array(
		'sort_order'   => 'ASC',
		'sort_column'  => 'menu_order',
		'hierarchical' => 1,
		'post_type'    => 'page',
		'post_status'  => 'publish',
	);

	$pages     = get_pages( $args ); // liefert Objekte
	$a_options = array(
		0 => esc_html__( 'Bitte auswählen', 'theme-slug' ),
	);

	if ( empty( $pages ) || ! is_array( $pages ) ) {
		return $a_options;
	}

	foreach ( $pages as $page ) {
		// Nur Elternseiten, die Kinder haben
		if ( cm_has_children( $page->ID ) ) {
			$a_options[ $page->ID ] = esc_html( $page->post_title );
		}
	}

	return $a_options;
}

/** Prüft, ob eine Seite Kinder hat */
function cm_has_children( $post_id ): bool {
	$children = get_pages(
		array(
			'child_of' => (int) $post_id,
			'number'   => 1,
		)
	);
	return ! empty( $children );
}
