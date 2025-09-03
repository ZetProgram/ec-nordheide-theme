<?php require_once __DIR__ . '/compat.php'; ?>
<?php

const YOUR_THEME_MIN_PHP = '7.4';

add_action(
	'after_switch_theme',
	function () {
		if ( version_compare( PHP_VERSION, YOUR_THEME_MIN_PHP, '<' ) ) {
			switch_theme( WP_DEFAULT_THEME ); // auf Standardtheme zurück
			// Übersetzbar halten:
			$message = sprintf(
			/* translators: 1: current PHP version, 2: required PHP version */
				__( 'Dieses Theme erfordert mindestens PHP %2$s. Deine Umgebung läuft mit PHP %1$s. Das Standard-Theme wurde wiederhergestellt.', 'your-theme' ),
				PHP_VERSION,
				YOUR_THEME_MIN_PHP
			);
			wp_die( esc_html( $message ), esc_html__( 'Inkompatible PHP-Version', 'your-theme' ), array( 'back_link' => true ) );
		}
	}
);

// Optional: Hinweis im Backend, falls knapp unter Zielbereich (z. B. 7.4 OK, aber 7.4.x alt)
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( version_compare( PHP_VERSION, '8.0', '<' ) ) {
			echo '<div class="notice notice-warning"><p>'
			. esc_html__( 'Hinweis: Für beste Performance/Support bitte bald auf PHP 8.x aktualisieren.', 'your-theme' )
			. '</p></div>';
		}
	}
);

<?php
add_action('wp_enqueue_scripts', function () {
    $base = get_stylesheet_directory_uri();
    $path = get_stylesheet_directory() . '/dist/tailwind.css';
    $ver  = file_exists($path) ? filemtime($path) : null;

    // 1) Tailwind
    wp_enqueue_style('theme-tailwind', $base . '/dist/tailwind.css', [], $ver);

    // 2) bestehende Styles (nur die, die ihr weiterhin braucht)
    wp_enqueue_style('theme-style', $base . '/style.css', ['theme-tailwind'], null);
    // Beispiel: wp_enqueue_style('theme-v3', $base . '/style_V003.css', ['theme-tailwind'], null);
    // …weitere Dateien schrittweise nur laden, wenn nötig
});

// Gutenberg/Block-Editor
add_action('enqueue_block_editor_assets', function () {
    $base = get_stylesheet_directory_uri();
    $path = get_stylesheet_directory() . '/dist/tailwind.css';
    $ver  = file_exists($path) ? filemtime($path) : null;

    wp_enqueue_style('theme-tailwind-editor', $base . '/dist/tailwind.css', [], $ver);
});


require 'functions_lichtstrahlen.php';
require 'functions_blocklabs.php';
require 'functions_customizer.php';

add_action(
	'init',
	function () {
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return;
		}
		if ( wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}

		$superadmin = filter_input( INPUT_GET, 'superadmin', FILTER_VALIDATE_INT, array( 'options' => array( 'default' => null ) ) );
		if ( $superadmin === null ) {
			return;
		}

		if ( session_status() !== PHP_SESSION_ACTIVE ) {
			@session_start();
		}
		if ( $superadmin === 1 ) {
			$_SESSION['superadmin'] = 'superadmin';
		} elseif ( $superadmin === 0 ) {
			unset( $_SESSION['superadmin'] );
		}
		@session_write_close();
	},
	1
);

add_theme_support(
	'custom-logo',
	array(
		'height'      => 150,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	)
);

function ae_register_menus() {
	register_nav_menus(
		array(
			// 'top-menu' => __( 'Top Menu' ),
			// 'main-menu' => __( 'Main Menu' ),
			'footer-menu' => __( 'Footer Menu' ),
		)
	);
}
add_action( 'init', 'ae_register_menus' );

if ( ! function_exists( 'theme_slug_setup' ) ) :
	function theme_slug_setup() {
		add_theme_support( 'post-thumbnails' );
	}
endif;
add_action( 'after_setup_theme', 'theme_slug_setup' );

function ks_gutenberg_styles() {
	wp_enqueue_style( 'gutenberg-css', get_theme_file_uri( '/gutenberg.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'ks_gutenberg_styles' );

function wporg_block_wrapper( $block_content, $block ) {
	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'hintergrund_gruen' ) !== false ) {
		$content  = '<div class="hintergrund_gruen_intern"><div class="inhalt_begrenzte_breite_zentriert">';
		$content .= $block_content;
		$content .= '</div></div>';
		return $content;
	}

	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'hintergrund_off_white' ) !== false ) {
		$content  = '<div class="hintergrund_off_white_intern"><div class="inhalt_begrenzte_breite_zentriert">';
		$content .= $block_content;
		$content .= '</div></div>';
		return $content;
	}

	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], '100Pro' ) !== false ) {
		$content  = '<div class="hintergrund_hexagone_gruenverlauf_trapez"><div class="inhalt_begrenzte_breite_zentriert">';
		$content .= $block_content;
		$content .= '</div></div>';
		return $content;
	}
	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'mittig_max_breite' ) !== false ) {
		$content  = '<div class="inhalts_container_mittig_max_width">';
		$content .= $block_content;
		$content .= '</div>';
		return $content;
	}
	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'owl-carousel' ) !== false ) {
		$content  = '<div class="einfaden">';
		$content .= $block_content;
		$content .= '</div>';
		return $content;
	}
	if ( isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'rechter_kasten_krumm_leichtes_gruen' ) !== false ) {
		$content  = '<div class="rechter_kasten_krumm_leichtes_gruen_rahmen">';
		$content .= $block_content;
		$content .= '</div>';
		return $content;
	}

	if ( $block['blockName'] === 'core/paragraph' ) {
		$content  = '<div class="inhalt_begrenzte_breite_zentriert">';
		$content .= $block_content;
		$content .= '</div>';
		return $content;
	}

	if ( $block['blockName'] === 'core/list' ) {
		$content  = '<div class="inhalt_begrenzte_breite_zentriert">';
		$content .= $block_content;
		$content .= '</div>';
		return $content;
	}

	return $block_content;
}
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );

function object_to_array( $data ) {
	if ( is_array( $data ) || is_object( $data ) ) {
		$result = array();
		foreach ( $data as $key => $value ) {
			$result[ $key ] = object_to_array( $value );
		}
		return $result;
	}
	return $data;
}

function session_get_safe( $key, $default = null ) {
	$opened_here = false;

	// In REST/AJAX/CRON niemals Session anfassen
	if ( ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || wp_doing_ajax() || wp_doing_cron() ) {
		return $default;
	}

	if ( session_status() !== PHP_SESSION_ACTIVE ) {
		@session_start();
		$opened_here = true;
	}

	$val = isset( $_SESSION[ $key ] ) ? $_SESSION[ $key ] : $default;

	if ( $opened_here ) {
		@session_write_close();
	}
	return $val;
}

// 2) Debug-Ausgabe nur, wenn Flag per GET ODER Session gesetzt ist
function pf( $a ) {
	// GET hat Priorität (schnell & ohne Session)
	$is_super_get = ( isset( $_GET['superadmin'] ) && (int) $_GET['superadmin'] === 1 );

	// Falls nicht via GET, Session-Wert sicher lesen
	$is_super_sess = ( ! $is_super_get ) && ( session_get_safe( 'superadmin' ) === 'superadmin' );

	if ( $is_super_get || $is_super_sess ) {
		echo '<pre>';
		print_r( $a );
		echo '</pre>';
	}
}

/* MENÜ header.php */
function liste_menu( $post_parent ) {
	$args                                  = array(
		'sort_order'   => 'ASC',
		'sort_column'  => 'menu_order',
		'hierarchical' => 1,
		'parent'       => $post_parent,
		'post_type'    => 'page',
		'post_status'  => 'publish',
	);
	$o_alle_seiten_zweite_ebene_unsortiert = get_pages( $args );
	$a_alle_seiten_zweite_ebene_unsortiert = object_to_array( $o_alle_seiten_zweite_ebene_unsortiert );

	$s_ebene_2 = '';
	if ( count( $a_alle_seiten_zweite_ebene_unsortiert ) > 0 ) {
		$s_ebene_2 .= '<ul>';
	}

	foreach ( $a_alle_seiten_zweite_ebene_unsortiert as $z => $a_seiten_zweite_ebene ) {
		$post_title = $a_seiten_zweite_ebene['post_title'];
		$target_ext = '';

		if ( strpos( $post_title, '[ext]' ) !== false ) {
			$target_ext = 'target="_blank"';
		}

		$s_ebene_2 .= "<li class='ebene_2'><a {$target_ext} href='" . $a_seiten_zweite_ebene['guid'] . "'><span>" . $post_title . '</span></a>';

		// dritte Ebene holen
		$args2                                 = array(
			'sort_order'   => 'ASC',
			'sort_column'  => 'menu_order',
			'hierarchical' => 1,
			'parent'       => $a_seiten_zweite_ebene['ID'],
			'post_type'    => 'page',
			'post_status'  => 'publish',
		);
		$o_alle_seiten_dritte_ebene_unsortiert = get_pages( $args2 );
		$a_alle_seiten_dritte_ebene_unsortiert = object_to_array( $o_alle_seiten_dritte_ebene_unsortiert );

		if ( count( $a_alle_seiten_dritte_ebene_unsortiert ) > 0 ) {
			$s_ebene_2 .= '<ul>';
			foreach ( $a_alle_seiten_dritte_ebene_unsortiert as $z => $a_seiten_dritte_ebene ) {
				$s_ebene_2      .= "<li class='ebene_3'><a href='" . $a_seiten_dritte_ebene['guid'] . "'><span>" . $a_seiten_dritte_ebene['post_title'] . '</span></a></li>';
				$a_content_menu .= "'<a href='" . $a_seiten_dritte_ebene['guid'] . "'><span>" . $a_seiten_dritte_ebene['post_title'] . "</span></a>'";
			}
			$s_ebene_2 .= '</ul>';
		}
		$s_ebene_2 .= '</li>';
	}

	if ( count( $a_alle_seiten_zweite_ebene_unsortiert ) > 0 ) {
		$s_ebene_2 .= '</ul>';
	}

	return $s_ebene_2;
}

function deinthemename_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Erstes Widget',
			'id'            => 'erstes_widget',
			'description'   => 'Mein erstes selbst angelegtes Widget Area',
			'before_widget' => '<div class="juhu_ein_widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'deinthemename_widgets_init' );

function search_form_shortcode() {
	get_search_form();
}
add_shortcode( 'search_form', 'search_form_shortcode' );

function ec_search_form( $id ) {
	$form = '<form method="get" id="' . $id . '" class="' . $id . ' searchform" name="searchform" action="' . home_url( '/' ) . '" style="padding: 5px;">
<input type="text" value="" name="s" id="s_' . $id . '" class="suche_input">
<i class="fas fa-search pointer" onclick="' . $id . '.submit();"></i>
</form>';
	return $form;
}

/*
Plugin Name: Ninja Forms Add Datepicker Options
*/
function nf_datepicker_modify_script( $args ) {
	$args['minDate']     = '0';
	$args['changeMonth'] = 1;
	$args['changeYear']  = 1;
	$args['yearRange']   = '2002:2012';
	return $args;
}
add_filter( 'ninja_forms_forms_display_datepicker_args', 'nf_datepicker_modify_script' );

function block_lab_backend() {
	if ( isset( $_SERVER['REDIRECT_URL'] ) && strpos( $_SERVER['REDIRECT_URL'], 'block-lab' ) !== false ) {
		return true;
	} else {
		return false;
	}
}

function strip_tags_content( $text, $tags = '', $invert = false ) {
	preg_match_all( '/<(.+?)[\s]*\/?[\s]*>/si', trim( $tags ), $tags );
	$tags = array_unique( $tags[1] );

	if ( is_array( $tags ) and count( $tags ) > 0 ) {
		if ( $invert == false ) {
			return preg_replace( '@<(?!(?:' . implode( '|', $tags ) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text );
		} else {
			return preg_replace( '@<(' . implode( '|', $tags ) . ')\b.*?>.*?</\1>@si', '', $text );
		}
	} elseif ( $invert == false ) {
		return preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $text );
	}
	return $text;
}

function konvertieren_YYYY_MM_DD_nach_DEdatum( $YYYY_MM_DDdatum ) {
	if ( $YYYY_MM_DDdatum != '' ) {
		$a_datum    = explode( '-', $YYYY_MM_DDdatum );
		$s_datum_DE = $a_datum[2] . '.' . $a_datum[1] . '.' . $a_datum[0];
		return $s_datum_DE;
	}
	return '';
}

require get_template_directory() . '/lib/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/ZetProgram/ec-nordheide-theme',
	get_stylesheet_directory() . '/style.css',
	'ec-nordheide-theme'
);

// GitHub API benutzen
$updateChecker->setBranch( 'production' );

$updateChecker->getVcsApi()->enableReleaseAssets();
