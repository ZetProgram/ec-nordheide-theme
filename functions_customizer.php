<?php 
/**
 * Adds Layout Options section and sidebar position setting.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function theme_slug_customize_register_MainMenuSpalten( $wp_customize ) {

	// Add layout options section.
	$wp_customize->add_section( 'theme_slug_mainmenu_spalten', array(
		'title'    => esc_html__( 'Menü Spalten', 'theme-slug' ),
		'priority' => 120,
		'description'     => 'Hier kannst du bis zu vier Spalten für die Darstellung der Navigation im Haupmenü definieren. Definiere jeweils die Überschrift und die Elternseite, dessen Unterelemente gelistet werden sollen.<br /> Es werden nur Elternseiten gelistet, die auch in der <a href="/wp-admin/edit.php?post_type=page">Seitenstruktur</a> Unterelemente aufweisen.'
	) );
	
	$a_options = cm_hole_options_alle_seiten();	
	
	for($i=1;$i<=4;$i++){
		// Überschrift definition Spalte 1
		$wp_customize->add_setting( 'main_meu_spalte_bezeichnung_'.$i, array(
			'default'           => 'Überschrift '.$i,
			'sanitize_callback' => 'theme_slug_sanitize_input',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( 'main_meu_spalte_bezeichnung_'.$i, array(
			'label'    => esc_html__( 'Spalte '.$i.': Überschrift / Elternseite', 'theme-slug' ),
			'section'  => 'theme_slug_mainmenu_spalten',
			'type'     => 'input',
			/*'description'     => 'add_control description',*/
			'priority' => 1
		) );
		
		
		// Parent id Spalte 1
		$wp_customize->add_setting( 'main_meu_spalte_'.$i, array(
			'default'           => '123',
			'sanitize_callback' => 'theme_slug_sanitize_select',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( 'main_meu_spalte_'.$i, array(
			/*'label'    => esc_html__( 'Spalte 1', 'theme-slug' ),*/
			'section'  => 'theme_slug_mainmenu_spalten',
			'type'     => 'select',
			'priority' => 1,
			'choices'  => $a_options,
		) );
	}


}
add_action( 'customize_register', 'theme_slug_customize_register_MainMenuSpalten' );

//hervorgehobener Button
function theme_slug_customize_register_HighlightButton( $wp_customize ) {

	// Add layout options section.
	$wp_customize->add_section( 'theme_slug_highlightbtn', array(
		'title'    => esc_html__( 'Button Highlight', 'theme-slug' ),
		'priority' => 120,
		'description'     => 'Definiere hier den hervorgehobenen Button im Menü zwischen Hauptmenü Icon und der Suchen Funktion.',
	) );
	
	
	// Beschriftung
	$wp_customize->add_setting( 'highlightbtn_titel', array(
		'default'           => 'Spenden',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'highlightbtn_titel', array(
		'label'    => esc_html__( 'Beschriftung', 'theme-slug' ),
		'section'  => 'theme_slug_highlightbtn',
		'type'     => 'input',
		'priority' => 1
	) );	
	
	// URL
	$wp_customize->add_setting( 'highlightbtn_url', array(
		'default'           => './index.php',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_url'
	) );
	
	$wp_customize->add_control( 'highlightbtn_url', array(
		'label'    => esc_html__( 'Link', 'theme-slug' ),
		'section'  => 'theme_slug_highlightbtn',
		'type' => 'url',
		'priority' => 1
	) );

	// Target
	$wp_customize->add_setting( 'highlightbtn_target', array(
		'default'           => '_blank',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_select'
	) );
	
	$wp_customize->add_control( 'highlightbtn_target', array(
		'label'    => esc_html__( 'Ziel', 'theme-slug' ),
		'description'     => 'Soll sich der Link in einem neuen oder im selben Tab öffnen?',
		'section'  => 'theme_slug_highlightbtn',
		'type' => 'select',
		'choices'  => array(
			'_blank' => esc_html__( 'Neuer Tab', 'theme-slug' ),
			'_self' => esc_html__( 'Im selben Tab', 'theme-slug' )
		),
		'priority' => 1
	) );		
	
	
}
add_action( 'customize_register', 'theme_slug_customize_register_HighlightButton' );


function theme_slug_customize_register_Instagram( $wp_customize ) {

	// Add layout options section.
	$wp_customize->add_section( 'theme_slug_instagram', array(
		'title'    => esc_html__( 'Instagram im Footer', 'theme-slug' ),
		'priority' => 120,
		'description'     => 'Um Instagram im Footer einblenden zu lassen, kannst Du hier entsprechend nötige Daten definieren.',
	) );
	
	// Insta Link
	$wp_customize->add_setting( 'instagram_link', array(
		'default'           => 'https://www.instagram.com/ecjugend/',
		'sanitize_callback' => 'theme_slug_sanitize_textarea_html',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'instagram_link', array(
		'label'    => esc_html__( 'Instagram Link', 'theme-slug' ),
		'section'  => 'theme_slug_instagram',
		'type'     => 'input',
		'description'     => 'Der Link zu Deiner Instagram Seite.',
		'priority' => 1
	) );
	
	
			// Insta Access Token
	$wp_customize->add_setting( 'instagram_button_beschriftung', array(
		'default'           => 'EC auf Instagram',
		'sanitize_callback' => 'theme_slug_sanitize_input',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'instagram_button_beschriftung', array(
		'label'    => esc_html__( 'Instagram Button Beschriftung', 'theme-slug' ),
		'section'  => 'theme_slug_instagram',
		'type'     => 'input',
		'description'     => 'Gib hier die Beschriftung des Buttons unter den Hexagonen ein.',
		'priority' => 1
	) );
	
	
	// Insta AN AUS
	$wp_customize->add_setting( 'instagram_an_aus', array(
		'default'           => 'an',
		'sanitize_callback' => 'theme_slug_sanitize_select',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'instagram_an_aus', array(
		'label'    => esc_html__( 'Instagram An/Aus', 'theme-slug' ),
		'section'  => 'theme_slug_instagram',
		'type'     => 'select',
		'priority' => 1,
		'description'     => 'Hier kannst Du das Instagram Element ausblenden.',
		'choices'  => array(
			'an' => esc_html__( 'An', 'theme-slug' ),
			'aus' => esc_html__( 'Aus', 'theme-slug' )
		),
	) );	
	
	// Insta Access Token
	$wp_customize->add_setting( 'instagram_access_token', array(
		'default'           => '',
		'sanitize_callback' => 'theme_slug_sanitize_input',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'instagram_access_token', array(
		'label'    => esc_html__( 'Instagram Access Token', 'theme-slug' ),
		'section'  => 'theme_slug_instagram',
		'type'     => 'input',
		'description'     => 'Um von deinem Instagram Account Daten zu erhalten, ist der "Instagram Access Token" hier einzutragen. Ist dort nichts eingetragen, wird das gesamte Element ausgeblendet.',
		'priority' => 1
	) );
	


}
add_action( 'customize_register', 'theme_slug_customize_register_Instagram' );

function theme_slug_customize_register_Footeradresse( $wp_customize ) {

	// Add layout options section.
	$wp_customize->add_section( 'theme_slug_footeradresse', array(
		'title'    => esc_html__( 'Adresse im Footer', 'theme-slug' ),
		'priority' => 120,
		'description'     => 'Hier kann Du die Adresse, die im Footer erscheinen soll, definieren. Es sind folgende HTML Tags erlaubt: <ul><li>a<ul><li>href</li><li>title</li><li>target</li></ul></li><li>br</li><li>strong</li></ul>',
	) );
	
	
	// Insta AN AUS
	$wp_customize->add_setting( 'footeradresse', array(
		'default'           => 'Deutscher Jugendverband<br /><strong>"Entschieden für Christus"</strong> e.V.<br />Leuschnerstr. 74<br />34134 Kassel<br /><a href="tel:0561 4095 0" target="_blank" title="" style="color: #fff;">Tel: 0561 4095 0</a>',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_textarea_html'
	) );
	
	$wp_customize->add_control( 'footeradresse', array(
		'label'    => esc_html__( 'Adresse im Footer', 'theme-slug' ),
		'section'  => 'theme_slug_footeradresse',
		'type'     => 'textarea',
		'priority' => 1
	) );	
	
	
}
add_action( 'customize_register', 'theme_slug_customize_register_Footeradresse' );

function theme_slug_customize_register_Hexagone( $wp_customize ) {

	// Add layout options section.
	$wp_customize->add_section( 'theme_slug_hexagone', array(
		'title'    => esc_html__( 'Hexagone', 'theme-slug' ),
		'priority' => 120,
	) );
	
	
	// Anzahl Hexagone
	$wp_customize->add_setting( 'anzahl_hexagone', array(
		'default'           => '10',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'anzahl_hexagone', array(
		'label'    => esc_html__( 'Anzahl', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,
		'max'	=> 100,
		),
		'description' => 'Wie viele Hexagone sollen auf der Seite angezeigt werden? Achtung: zu viele können die Seite lahm legen. Ein sinnvoller Wert liegt bis max. 20, auch je nachdem wie die anderen Parameter gesetzt sind.',
		'priority' => 1
	) );	
	
	// Geschwindigkeit Hexagone
	$wp_customize->add_setting( 'geschwindigkeit_hexagone_von', array(
		'default'           => '10',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'geschwindigkeit_hexagone_von', array(
		'label'    => esc_html__( 'Scrollgeschwindigkeit "von / bis"', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,
		),
		'description' => 'Die Geschwindigkeit der Hexagone wird zufällig in einem Bereich "von" und "bis" gesetzt. Sinnvolle Werte liegen zwischen 10 und 100. Gleiche Werte bedingen, dass alle Hexagone die gleiche Scrollgeschwindigkeit haben.',
		'priority' => 1
	) );


	$wp_customize->add_setting( 'geschwindigkeit_hexagone_bis', array(
		'default'           => '100',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'geschwindigkeit_hexagone_bis', array(
		/*'label'    => esc_html__( 'Größe "bis"', 'theme-slug' ),*/
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,),
		'priority' => 1
	) );
	
	// Rotationswinkel Hexagone
	$wp_customize->add_setting( 'rotation_hexagone_von', array(
		'default'           => '0',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'rotation_hexagone_von', array(
		'label'    => esc_html__( 'Rotationswinkel "von / bis"', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'input_attrs' => array(
		'min'   => 0,
		'max'   => 360,),
		'type'     => 'number',
		'description' => 'Der Rotationswinkel (in Grad) der Hexagone wird zufällig in einem Bereich "von" und "bis" gesetzt. Sinnvolle Werte liegen zwischen 0 und 360 Grad. Gleiche Werte bedingen, dass alle Hexagone den gleichen Rotationswinkel haben.',
		'priority' => 1
	) );


	$wp_customize->add_setting( 'rotation_hexagone_bis', array(
		'default'           => '360',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'rotation_hexagone_bis', array(
		/*'label'    => esc_html__( 'Größe "bis"', 'theme-slug' ),*/
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,
		'max'   => 360,),
		'priority' => 1
	) );
	
// Größe Hexagone
	$wp_customize->add_setting( 'groesse_hexagone_von', array(
		'default'           => '5',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'groesse_hexagone_von', array(
		'label'    => esc_html__( 'Größe "von / bis"', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'description' => 'Die Größe (vw) der Hexagone wird zufällig in einem Bereich "von" und "bis" gesetzt. Sinnvolle Werte liegen zwischen 5 und 20. Gleiche Werte bedingen, dass alle Hexagone die gleiche Größe haben.',
		'priority' => 1
	) );


	$wp_customize->add_setting( 'groesse_hexagone_bis', array(
		'default'           => '20',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'groesse_hexagone_bis', array(
		/*'label'    => esc_html__( 'Größe "bis"', 'theme-slug' ),*/
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'priority' => 1
	) );

// Abstand vom Rand Hexagone
	$wp_customize->add_setting( 'abstand_rand_hexagone_von', array(
		'default'           => '0',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'abstand_rand_hexagone_von', array(
		'label'    => esc_html__( 'Abstand vom linken/rechten Seitenrand', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'description' => 'Der Abstand der Hexagone vom rechten/linken Bildrand (in %) wird zufällig in einem Bereich von/bis gesetzt. Gleiche Werte bedingen bei allen Hexagonen den gleichen Abstand.',
		'priority' => 1
	) );


	$wp_customize->add_setting( 'abstand_rand_hexagone_bis', array(
		'default'           => '10',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'abstand_rand_hexagone_bis', array(
		/*'label'    => esc_html__( 'Größe "bis"', 'theme-slug' ),*/
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'priority' => 1
	) );	
	
// Opacity vom Rand Hexagone
	$wp_customize->add_setting( 'opacity_hexagone_von', array(
		'default'           => '0',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'opacity_hexagone_von', array(
		'label'    => esc_html__( 'Deckungskraft', 'theme-slug' ),
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,
		'max'   => 100,),
		'description' => 'Die Deckungskraft (in %, 0 = unsichtbar; 100 = volle Deckungskraft) der Hexagone wird zufällig in einem Bereich von/bis gesetzt. Gleiche Werte bedingen bei allen Hexagonen die gleiche Deckungskraft.',
		'priority' => 1
	) );


	$wp_customize->add_setting( 'opacity_hexagone_bis', array(
		'default'           => '100',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'opacity_hexagone_bis', array(
		
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'input_attrs' => array(
		'min'   => 0,
		'max'   => 100,),
		'priority' => 1
	) );

	//ausblenden ab css
	$wp_customize->add_setting( 'display_none_hexagone', array(
		'default'           => '1360',
		'transport'         => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_input'
	) );
	
	$wp_customize->add_control( 'display_none_hexagone', array(
		'label'    => esc_html__( 'Display Breite: Hexagone ausblenden', 'theme-slug' ),
		'description'    => 'Ab welcher Display Breite (px) sollen die Hexagone ganz ausgeblendet werden?', 'theme-slug',
		'section'  => 'theme_slug_hexagone',
		'type'     => 'number',
		'priority' => 1
	) );
	
	//bilder für die Hexagone, 8 uploads möglich
	//Bild 1
	for($i = 1;$i<=8;$i++){
		$wp_customize->add_setting( 'img_hexagone_link_'.$i, array(
		'type' => 'theme_mod',
		'transport'         => 'refresh',
		) );
		if($i == 1){
			$label = "Eigene Hexagone (Bilder)";
			$description = "Definiere hier bis zu 8 eigene Hexagone oder Bilder. Willst du ein Bild als Hexagon darstellen, muss das Bild bereits als Hexagon vorliegen. Diesen kannst du jeweils einen Link hinzufügen.<br /><br />Eigenes Hexagon $i";
		} else {
			$label = "";
			$description = "Eigenes Hexagon $i";
		}
		$wp_customize->add_control(
			new WP_Customize_Media_Control( $wp_customize, 'img_hexagone_link_'.$i, array(
				'label' => $label, 'theme-slug',
				'description' => $description,
				'section'  => 'theme_slug_hexagone',
				'mime_type' => 'image',
				'priority' => 1
			)
		) );
		
		$wp_customize->add_setting( 'img_hexagone_link_href_'.$i, array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'theme_slug_sanitize_url',
		) );
		
		$wp_customize->add_control( 'img_hexagone_link_href_'.$i, array(
		  'type' => 'url',
		  'section' => 'theme_slug_hexagone', // Add a default or your own section
		  'label' => '',
		  'description' => 'Link für Hexagon '.$i,
		  'input_attrs' => array(
			'placeholder' => 'https://www.ec.de',
			),
			'priority' => 1
		) );
		
		
	}
	
}
add_action( 'customize_register', 'theme_slug_customize_register_Hexagone' );

function theme_slug_sanitize_url( $url ) {
  return esc_url_raw( $url );
}

function theme_slug_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function theme_slug_sanitize_input( $input ) {

	$sani_input = sanitize_text_field( $input );
	return $sani_input;
}

function theme_slug_sanitize_textarea_html( $input ) {

	$sani_textarea_html = wp_kses( $input, array( 
    'a' => array(
        'href' => array(),
        'target' => array(),
        'title' => array()
    ),
    'br' => array(),
    'strong' => array(),
	) );

	return $sani_textarea_html;
}


function cm_hole_options_alle_seiten(){
	
	$args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order',
	'hierarchical' => 1,
	'exclude' => '',
	'include' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'child_of' => 0,
	'parent' => '',
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
);

$o_alle_seiten = get_pages($args);

$a_alle_seiten = object_to_array($o_alle_seiten);

$s_options = '';

$a_options[0] = esc_html__( 'Bitte auswählen', 'theme-slug' );

	foreach($a_alle_seiten as $z => $a_seite){
		$sel = '';
		if($a_seite['ID'] == $aktuelle_seite){
			$sel = 'selected';
		}
		
		if(cm_has_children($a_seite['ID'])){
			
			$a_options[$a_seite['ID']] = esc_html__( $a_seite['post_title'], 'theme-slug' );
			
			/*
			$a_option = array(
			'123'   => esc_html__( 'Parentseite1', 'theme-slug' ),
			'456'  => esc_html__( 'Parentseite2', 'theme-slug' ),
			);*/
		
			
		}
		
	}
	
	return $a_options;
}

function cm_has_children($post_id) {
    $children = get_pages( array( 'child_of' => $post_id ) );
    if( count( $children ) == 0 ) {
        return false;
    } else {
        return true;
    }
}
?>