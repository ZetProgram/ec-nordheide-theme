<?php
function hole_wp_mitarbeiter_blocklab( $wp_mitarbeiter_id = '', $order_by = '' ) {

	$a_mitarbeiter = array();

	$s_left_join  = 'LEFT JOIN `wp_mitarbeiter_funktionen` ON `wp_mitarbeiter_funktionen`.`wp_mitarbeiter_funktionen_id`=`wp_mitarbeiter`.`wp_mitarbeiter_funktionen_id`';
	$s_left_join2 = 'LEFT JOIN `wp_mitarbeiter_kategorien` ON `wp_mitarbeiter_kategorien`.`wp_mitarbeiter_kategorien_id`=`wp_mitarbeiter`.`wp_mitarbeiter_kategorien_id`';

	if ( $wp_mitarbeiter_id != '' ) {
		$s_query = "SELECT * FROM `wp_mitarbeiter` $s_left_join $s_left_join2 WHERE `wp_mitarbeiter_sichtbar`='1' AND `wp_mitarbeiter_id`='$wp_mitarbeiter_id';";
	} else {
		// alle
		$s_query = "SELECT * FROM `wp_mitarbeiter` $s_left_join  $s_left_join2 
			WHERE `wp_mitarbeiter_sichtbar`='1' 
			AND `wp_mitarbeiter_kategorien`.`wp_mitarbeiter_kategorien_sichtbar`=1
			ORDER BY `wp_mitarbeiter_kategorien_bezeichnung`,`wp_mitarbeiter_sortierung`;";
	}

	if ( $order_by != '' ) {
		// alle
		$s_query = "SELECT * FROM `wp_mitarbeiter` $s_left_join $s_left_join2 ORDER BY `$order_by`;";
	}

	include 'dbconnect.php';

	if ( $mysqli_result = $mysqli->query( $s_query ) ) {

		while ( $row = $mysqli_result->fetch_assoc() ) {
			$a_mitarbeiter[ $row['wp_mitarbeiter_id'] ]                             = $row;
			$a_mitarbeiter[ $row['wp_mitarbeiter_id'] ]['wp_mitarbeiter_funktion']  = $row['wp_mitarbeiter_funktionen_bezeichnung'];
			$a_mitarbeiter[ $row['wp_mitarbeiter_id'] ]['wp_mitarbeiter_kategorie'] = $row['wp_mitarbeiter_kategorien_bezeichnung'];

		}

			$mysqli_result->close();
	} else {
		echo $mysqli->error;
	}

		$mysqli->close();

		// pf($a_mitarbeiter);
		return $a_mitarbeiter;
}
/*
function blockLab_register_EC_Mitarbeiter_Einzeldarstellung_2_0_block() {
	$a_mitarbeiter = hole_wp_mitarbeiter_blocklab("","wp_mitarbeiter_name");

	//pf($a_mitarbeiter);

	if( ! empty( $a_mitarbeiter ) ){
		$options[0] = array("label" => "Bitte auswählen", 'value' => 0);
		foreach ( $a_mitarbeiter as $p ){
			$options[] = array("label" => $p['wp_mitarbeiter_name'].', '.$p['wp_mitarbeiter_vorname'].' ('.$p['wp_mitarbeiter_kategorie'].' - '.$p['wp_mitarbeiter_funktion'].')', 'value' => $p['wp_mitarbeiter_id']);
		}
	}

	block_lab_add_block(
		'ec-mitarbeiter-einzeldarstellung-20',
		array(
			'title'    => 'EC Mitarbeiter Einzeldarstellung 2.0',
			'category' => 'ec',
			'icon'     => 'waves',
			'excluded' => array( '' ),
			'keywords' => array( 'sad', 'glad', 'bad' ),
			'fields'   => array(
				'eme_mitarbeiter' => array(
					'label'   => 'Mitarbeiter',
					'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options
					,
				),
				'eme_beschreibung'  => array(
					'label'   => 'Beschreibung',
					'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',
					'control' => 'textarea',
					'width'   => '100%',
				),
			),
		)
	);
}

add_action( 'block_lab_add_blocks', 'blockLab_register_EC_Mitarbeiter_Einzeldarstellung_2_0_block' );
*/
function blockLab_register_EC_Posts_ID_2_0_block() {
	// beitraege holen
	$args = array(
		'numberposts' => 2000,
		/*'category'        => 4*/
	);

	$alle_posts = get_posts( $args );

	if ( ! empty( $alle_posts ) ) {
		$options[0] = array(
			'label' => 'Bitte auswählen',
			'value' => 0,
		);
		foreach ( $alle_posts as $p ) {
			$options[] = array(
				'label' => $p->post_title,
				'value' => $p->ID,
			);
		}
	}

	// pf($a_weitere_fields);
	/*
	$options[0] = array("label" => "Yellow", 'value' => 'yellow');
	$options[1] = array("label" => "Red", 'value' => 'red');
	$options[2] = array("label" => "Blue", 'value' => 'blue');
	*/
	block_lab_add_block(
		'ec-posts-id-20',
		array(
			'title'    => 'EC Posts ID 2.0',
			'category' => 'ec',
			/*
			'icon'     => 'waves',
			'excluded' => array( '' ),
			'keywords' => array( 'sad', 'glad', 'bad' ),*/
			'fields'   => array(
				'epi_ueberschrift'  => array(
					'label'   => 'Überschrift', /*sollte demnächst mal wegfallen, besser direkt im TExt die Überschrift definieren*/
					'control' => 'text',
					'width'   => '100%',
					'default' => '',
				),
				'epi_post_id_id_1'  => array(
					'label'   => 'Beitrag 1',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_2'  => array(
					'label'   => 'Beitrag 2',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_3'  => array(
					'label'   => 'Beitrag 3',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_4'  => array(
					'label'   => 'Beitrag 4',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_5'  => array(
					'label'   => 'Beitrag 5',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_6'  => array(
					'label'   => 'Beitrag 6',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_7'  => array(
					'label'   => 'Beitrag 7',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_8'  => array(
					'label'   => 'Beitrag 8',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_9'  => array(
					'label'   => 'Beitrag 9',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),
				'epi_post_id_id_10' => array(
					'label'   => 'Beitrag 10',
					/*'help'   => 'STRG Taste gedrückt halten für Mehrfachauswahl',*/
					'control' => 'select',
					'width'   => '100%',
					'options' =>
					$options,
				),

			),
		)
	);
}

add_action( 'block_lab_add_blocks', 'blockLab_register_EC_Posts_ID_2_0_block' );
