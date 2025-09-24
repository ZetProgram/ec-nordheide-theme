<?php
require_once __DIR__ . '/compat.php';

const YOUR_THEME_MIN_PHP = '7.4';

/**
 * Nach Theme-Aktivierung PHP-Version prüfen
 */
add_action(
	'after_switch_theme',
	function () {
		if ( version_compare( PHP_VERSION, YOUR_THEME_MIN_PHP, '<' ) ) {
			switch_theme( WP_DEFAULT_THEME ); // auf Standardtheme zurück
			$message = sprintf(
				/* translators: 1: current PHP version, 2: required PHP version */
				__( 'Dieses Theme erfordert mindestens PHP %2$s. Deine Umgebung läuft mit PHP %1$s. Das Standard-Theme wurde wiederhergestellt.', 'ec-nordheide-theme' ),
				PHP_VERSION,
				YOUR_THEME_MIN_PHP
			);
			wp_die( esc_html( $message ), esc_html__( 'Inkompatible PHP-Version', 'ec-nordheide-theme' ), array( 'back_link' => true ) );
		}
	}
);

/**
 * Admin-Hinweis für PHP 8.x
 */
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		if ( version_compare( PHP_VERSION, '8.0', '<' ) ) {
			echo '<div class="notice notice-warning"><p>'
				. esc_html__( 'Hinweis: Für beste Performance/Support bitte bald auf PHP 8.x aktualisieren.', 'ec-nordheide-theme' )
				. '</p></div>';
		}
	}
);

add_action('after_setup_theme', function () {
  // Moderne Title-Ausgabe
  add_theme_support('title-tag');
  // Custom Logo
  add_theme_support('custom-logo', [
    'height'      => 80,
    'width'       => 240,
    'flex-height' => true,
    'flex-width'  => true,
  ]);
  // Menü-Locations
  register_nav_menus([
	'primary'   => __('Kopfzeile', 'ec-nordheide-theme'), // wenige Punkte im Header
    'mega'      => __('Großes Menü (Mega Panel)', 'ec-nordheide-theme'), // großes Panel auf Desktop/Tablet
  ]);
});

// ---- Admin-Hilfe: Menü-Beschreibung spalten (für Bild-URLs) ----
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {
	return $item_output;
}, 10, 4);

/**
 * Frontend-Styles & -Scripts
 * - Tailwind Build aus /dist/tailwind.css
 * - bestehende style.css (nur was ihr noch braucht)
 */
add_action('wp_enqueue_scripts', function () {
	$base = get_stylesheet_directory_uri();
	$path = get_stylesheet_directory() . '/assets/css/tailwind_minify.css'; // <-- hier!
	$ver  = file_exists($path) ? filemtime($path) : null;

	wp_enqueue_style('theme-tailwind', $base . '/assets/css/tailwind_minify.css', [], $ver);
	wp_enqueue_style('theme-style', $base . '/style.css', ['theme-tailwind'], null);
	wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', [], null, true);
	wp_script_add_data('alpine', 'defer', true);
});


/**
 * Gutenberg/Block-Editor: Tailwind auch dort laden
 */
add_action('enqueue_block_editor_assets', function () {
	$base = get_stylesheet_directory_uri();
	$path = get_stylesheet_directory() . '/assets/css/tailwind_minify.css';
	$ver  = file_exists($path) ? filemtime($path) : null;

	wp_enqueue_style('theme-tailwind-editor', $base . '/assets/css/tailwind_minify.css', [], $ver);
});

/**
 * Weitere Theme-Funktionsdateien
 */
require 'functions_lichtstrahlen.php';
require 'functions_blocklabs.php';
require 'functions_customizer.php';

/**
 * Superadmin-Session-Flag setzen/entfernen via GET
 */
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

function ae_register_menus() {
	register_nav_menus(
		array(
			'main-menu'    => __( 'Hauptmenü', 'ec-nordheide-theme' ),
			'header-links' => __( 'Header Links (max. 2 Punkte)', 'ec-nordheide-theme' ),
			'footer-menu'  => __( 'Footer Menü', 'ec-nordheide-theme' ),
		)
	);
}
add_action( 'init', 'ae_register_menus' );

function ec_register_footer_sidebars() {
  $wrappers = [
    'before_widget' => '<div id="%1$s" class="wp-widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="font-semibold text-white text-lg mb-3">',
    'after_title'   => '</h3>',
  ];

  register_sidebar(array_merge([
    'name' => __('Footer Spalte 1 (Kontakt)', 'ec-nordheide-theme'),
    'id'   => 'footer_col_1',
    'description' => __('Standardmäßig Kontakt – kann mit Widgets überschrieben werden.', 'ec-nordheide-theme'),
  ], $wrappers));

  register_sidebar(array_merge([
    'name' => __('Footer Spalte 2', 'ec-nordheide-theme'),
    'id'   => 'footer_col_2',
  ], $wrappers));

  register_sidebar(array_merge([
    'name' => __('Footer Spalte 3', 'ec-nordheide-theme'),
    'id'   => 'footer_col_3',
  ], $wrappers));
}
add_action('widgets_init', 'ec_register_footer_sidebars');


// 2.1: <li> Klassen erweitern (nur im 'primary')
add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
  if (($args->theme_location ?? '') === 'primary') {
    // Für alle <li> im Primary
    $classes[] = 'relative'; // Positionierungs-Kontext
    // Für Eltern mit Kindern: als Gruppe für :hover / :focus-within
    if (in_array('menu-item-has-children', $classes, true)) {
      $classes[] = 'group';
      $classes[] = 'has-children';
    }
  }
  return $classes;
}, 10, 4);

// 2.2: <ul class="sub-menu"> stylen (Panel)
add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
  if (($args->theme_location ?? '') === 'primary') {
    // Basisklassen für das Dropdown-Panel
    $panel = 'primary-submenu absolute left-0 top-full mt-2 z-49' .
             'min-w-[220px] rounded-xl bg-white shadow-2xl border border-gray-200 p-2 ' .
             // Startzustand (unsichtbar)
             'hidden opacity-0 translate-y-2 ' .
             // Nur auf Desktop sichtbar/steuerbar
             'lg:block ' .
             // Hover & Tastaturbedienung (öffnet Panel)
             'group-hover:block group-hover:opacity-100 group-hover:translate-y-0 ' .
             'group-focus-within:block group-focus-within:opacity-100 group-focus-within:translate-y-0 ' .
             // Animationen
             'transition ease-out duration-200';
    $classes[] = $panel;
  }
  return $classes;
}, 10, 3);

// 2.3: Link-Attribute in Submenüs schöner machen
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
  if (($args->theme_location ?? '') === 'primary' && $depth >= 1) {
    // Nur Submenu-Links (depth >= 1)
    $extra = 'block px-4 py-2 rounded-md text-[15px] text-gray-800 hover:bg-gray-100 hover:text-[#6C9941]';
    $atts['class'] = isset($atts['class']) ? $atts['class'] . ' ' . $extra : $extra;
  }
  return $atts;
}, 10, 4);

// 2.4: Kleiner Caret-Pfeil an Top-Level-Items mit Kindern
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {
  if (($args->theme_location ?? '') === 'primary' && $depth === 0 && in_array('menu-item-has-children', $item->classes ?? [], true)) {
    // Kleines SVG als Pfeil (übernimmt currentColor)
    $caret = '<svg aria-hidden="true" class="ml-1 inline-block w-3.5 h-3.5 align-middle text-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M5.3 7.3a1 1 0 0 1 1.4 0L10 10.6l3.3-3.3a1 1 0 1 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 0-1.4z"/></svg>';
    $title .= $caret;
  }
  return $title;
}, 10, 4);

/**
 * Weitere Theme-Supports
 */
if ( ! function_exists( 'theme_slug_setup' ) ) :
	function theme_slug_setup() {
		add_theme_support( 'post-thumbnails' );
	}
endif;
add_action( 'after_setup_theme', 'theme_slug_setup' );

/**
 * Editor-spezifische Styles (bestehend)
 */
function ks_gutenberg_styles() {
	wp_enqueue_style( 'gutenberg-css', get_theme_file_uri( '/assets/css/gutenberg.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'ks_gutenberg_styles' );

/**
 * Block-Wrapper für bestimmte Klassennamen
 */
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

/**
 * Helpers
 */
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

/**
 * Debug-Ausgabe nur, wenn superadmin aktiv
 */
function pf( $a ) {
	// GET hat Priorität
	$is_super_get = ( isset( $_GET['superadmin'] ) && (int) $_GET['superadmin'] === 1 );

	// Falls nicht via GET, Session-Wert sicher lesen
	$is_super_sess = ( ! $is_super_get ) && ( session_get_safe( 'superadmin' ) === 'superadmin' );

	if ( $is_super_get || $is_super_sess ) {
		echo '<pre>';
		print_r( $a );
		echo '</pre>';
	}
}

/**
 * Suche Shortcode
 */
function search_form_shortcode() {
  return get_search_form(false); // gibt String zurück
}
add_shortcode( 'search_form', 'search_form_shortcode' );

/**
 * Eigene Suchform
 */
function ec_search_form( $id ) {
	$form = '<form method="get" id="' . esc_attr($id) . '" class="' . esc_attr($id) . ' searchform" name="searchform" action="' . esc_url( home_url( '/' ) ) . '" style="padding: 5px;">'
		. '<input type="text" value="" name="s" id="s_' . esc_attr($id) . '" class="suche_input">'
		. '<i class="fas fa-search pointer" onclick="' . esc_attr($id) . '.submit();"></i>'
		. '</form>';
	return $form;
}

/**
 * Ninja Forms Datepicker Defaults
 */
function nf_datepicker_modify_script( $args ) {
	$args['minDate']     = '0';
	$args['changeMonth'] = 1;
	$args['changeYear']  = 1;
	$args['yearRange']   = '1980:2100';
	return $args;
}
add_filter( 'ninja_forms_forms_display_datepicker_args', 'nf_datepicker_modify_script' );

/**
 * Backend-Erkennung (Block Lab)
 */
function block_lab_backend() {
	if ( isset( $_SERVER['REDIRECT_URL'] ) && strpos( $_SERVER['REDIRECT_URL'], 'block-lab' ) !== false ) {
		return true;
	} else {
		return false;
	}
}

/**
 * strip_tags_content Helper
 */
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

/**
 * Datum konvertieren
 */
function konvertieren_YYYY_MM_DD_nach_DEdatum( $YYYY_MM_DDdatum ) {
	if ( $YYYY_MM_DDdatum != '' ) {
		$a_datum    = explode( '-', $YYYY_MM_DDdatum );
		$s_datum_DE = $a_datum[2] . '.' . $a_datum[1] . '.' . $a_datum[0];
		return $s_datum_DE;
	}
	return '';
}

/**
 * Plugin Update Checker (GitHub)
 */
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
