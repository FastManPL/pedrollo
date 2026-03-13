<?php
/**
 * Pedrollo Polska – funkcje motywu.
 * Zasoby (css/, img/, js/) muszą być skopiowane z zrodlo-prawdy/ do katalogu motywu.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PEDROLLO_THEME_URI', get_template_directory_uri() );

/**
 * Wyłączenie stylów bloków WordPress (Gutenberg) – motyw używa własnego HTML/CSS.
 * Bez tego WP dodaje marginesy, paddingi i typografię, które psują layout.
 */
function pedrollo_dequeue_block_styles() {
	if ( is_admin() ) {
		return;
	}
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'pedrollo_dequeue_block_styles', 100 );

/**
 * Reset layoutu WP – usuwa domyślne style WP, które kłócą się z szablonem.
 * Wywołane z priorytetem 15, po enqueue naszych stylów (10), przed dequeue bloków (100).
 */
function pedrollo_add_layout_reset() {
	if ( is_admin() ) {
		return;
	}
	$reset = 'body.pedrollo-body{margin:0!important;padding:0!important}body.pedrollo-body .page{max-width:none!important}body.pedrollo-body .site,body.pedrollo-body .entry-content{margin:0!important;padding:0!important;max-width:none!important}';
	wp_add_inline_style( 'pedrollo-main', $reset );
}
add_action( 'wp_enqueue_scripts', 'pedrollo_add_layout_reset', 15 );

/**
 * Klasa na body – do scopowania resetu i ewentualnych nadpisań.
 */
function pedrollo_body_class( $classes ) {
	$classes[] = 'pedrollo-body';
	return $classes;
}
add_filter( 'body_class', 'pedrollo_body_class' );

/**
 * Enqueue stylów i skryptów.
 */
function pedrollo_enqueue_assets() {
	$v = '1.0.0';

	// Wspólne CSS (na wszystkich stronach)
	wp_enqueue_style( 'pedrollo-styleguide', PEDROLLO_THEME_URI . '/css/styleguide.css', array(), $v );
	wp_enqueue_style( 'pedrollo-styleguide-hff9f', PEDROLLO_THEME_URI . '/css/styleguide-hFF9f.css', array( 'pedrollo-styleguide' ), $v );
	wp_enqueue_style( 'pedrollo-globals', PEDROLLO_THEME_URI . '/css/globals.css', array( 'pedrollo-styleguide-hff9f' ), $v );
	wp_enqueue_style( 'pedrollo-globals-hff9f', PEDROLLO_THEME_URI . '/css/globals-hFF9f.css', array( 'pedrollo-globals' ), $v );
	wp_enqueue_style( 'pedrollo-main', PEDROLLO_THEME_URI . '/css/pedrollou95polskau95mainu953.css', array( 'pedrollo-globals-hff9f' ), $v );

	// Arkusz specyficzny dla strony (na podstawie szablonu / slug)
	$page_css = pedrollo_get_page_css();
	// Blog używa layoutu z use case lista + nadpisania z pedrollou95blog.css
	if ( is_page( 'blog' ) ) {
		wp_enqueue_style( 'pedrollo-page-usecase-lista', PEDROLLO_THEME_URI . '/css/pedrollou95useu95caseu95lista.css', array( 'pedrollo-main' ), $v );
	}
	if ( $page_css ) {
		wp_enqueue_style( 'pedrollo-page', PEDROLLO_THEME_URI . '/css/' . $page_css, array( 'pedrollo-main' ), $v );
	}

	// Flickity – jsDelivr (poprawny MIME); unpkg zwraca text/plain i jest blokowany przez nosniff
	if ( is_front_page() || is_page( 'onas' ) || is_page( 'o-nas' ) || is_page( 'dystrybutor' ) || is_page( 'kontakt' ) || is_page( 'produkt' ) ) {
		wp_enqueue_style( 'flickity', 'https://cdn.jsdelivr.net/npm/flickity@2.3.0/dist/flickity.min.css', array(), '2.3.0' );
	}
	if ( is_front_page() ) {
		wp_enqueue_style( 'jquery-ui-base', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css', array(), '1.13.2' );
	}

	// Skrypty – jQuery w WP jest wbudowany. Nie ładujemy launchpad.js (Anima) – używa $, w WP jest noConflict.
	wp_enqueue_script( 'jquery-ui-core', 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js', array( 'jquery' ), '1.13.2', true );
	if ( is_front_page() ) {
		wp_enqueue_script( 'flickity', 'https://cdn.jsdelivr.net/npm/flickity@2.3.0/dist/flickity.pkgd.min.js', array( 'jquery' ), '2.3.0', true );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'pedrollo-front-page', PEDROLLO_THEME_URI . '/js/pedrollo-front-page.js', array( 'flickity', 'jquery-ui-accordion' ), $v, true );
		wp_localize_script( 'pedrollo-front-page', 'pedrolloFrontPage', array( 'themeUri' => PEDROLLO_THEME_URI ) );
	}
	if ( ( is_page( 'onas' ) || is_page( 'o-nas' ) || is_page( 'dystrybutor' ) || is_page( 'kontakt' ) || is_page( 'produkt' ) ) && ! is_front_page() ) {
		wp_enqueue_script( 'flickity', 'https://cdn.jsdelivr.net/npm/flickity@2.3.0/dist/flickity.pkgd.min.js', array( 'jquery' ), '2.3.0', true );
		wp_enqueue_script( 'pedrollo-front-page', PEDROLLO_THEME_URI . '/js/pedrollo-front-page.js', array( 'flickity' ), $v, true );
		wp_localize_script( 'pedrollo-front-page', 'pedrolloFrontPage', array( 'themeUri' => PEDROLLO_THEME_URI ) );
	}
	// Menu (submenu) i mobile – skrypt z index.html, działa na wszystkich stronach
	wp_enqueue_script( 'pedrollo-menu', PEDROLLO_THEME_URI . '/js/pedrollo-menu.js', array(), $v, true );
	// FAQ – accordion (strona FAQ i sekcja FAQ na Dystrybutorze). Skrypt w stopce, żeby init był po DOM i UI.
	if ( is_page( 'faq' ) || is_page( 'dystrybutor' ) ) {
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'pedrollo-faq-accordion', PEDROLLO_THEME_URI . '/js/pedrollo-faq-accordion.js', array( 'jquery-ui-accordion' ), $v, true );
	}
	if ( is_page( 'faq' ) ) {
		wp_enqueue_style( 'jquery-ui-faq', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css', array(), '1.13.2' );
	}
}

add_action( 'wp_enqueue_scripts', 'pedrollo_enqueue_assets' );

/**
 * Zwraca nazwę pliku CSS dla bieżącej strony (np. pedrollou95faq.css).
 * Mapowanie: slug strony / front page → plik w css/.
 */
function pedrollo_get_page_css() {
	$map = array(
		'index'                            => 'pedrollou95polskau95mainu953.css', // już załadowany jako main
		'onas'                             => 'pedrollou95polskau95ou95nas-all-breakpoints.css',
		'o-nas'                            => 'pedrollou95polskau95ou95nas-all-breakpoints.css',
		'kontakt'                          => 'pedrollou95kontaktu951366px.css',
		'laboratorium'                     => 'pedrollou95laboratorium-all-breakpoints.css',
		'usecase'                          => 'pedrollou95usecase-all-breakpoints.css',
		'program-partnerski'               => 'pedrollou95program-partnerski-all-breakpoints.css',
		'produkt'                          => 'pedrollou95produkt-all-breakpoints.css',
		'dystrybutor'                      => 'pedrollou95dystrybutor-all-breakpoints.css',
		'blog'                             => 'pedrollou95blog.css',
		'faq'                              => 'pedrollou95faq.css',
		'polityka-prywatnosci'             => 'pedrollou95politykau95prywatnosci.css',
		'regulamin'                        => 'pedrollou95regulamin.css',
		'usecase-lista'                    => 'pedrollou95useu95caseu95lista.css',
		'blog-wpis'                        => 'pedrollou95blogu95wpis.css',
		'logowanie'                        => 'pedrollou95logowanie.css',
		'dystrybutor-rejestracja'          => 'pedrollou95dystrybutoru95rejestracjau95kroku9501-all-breakpoints.css',
		'dystrybutor-rejestracja-krok-2'   => 'pedrollou95dystrybutoru95rejestracjau95kroku9502.css',
		'dystrybutor-rejestracja-podziekowanie' => 'pedrollou95programu95partnerskiu95rejestracjau95podziekowanie.css',
	);

	if ( is_front_page() ) {
		// Strona główna – dodatkowo pop-up instalator
		wp_enqueue_style( 'pedrollo-popup-instalator', PEDROLLO_THEME_URI . '/css/pop-up-instalator.css', array( 'pedrollo-main' ), '1.0.0' );
		return null; // main już załadowany
	}

	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $map[ $slug ] ) ) {
			return $map[ $slug ];
		}
	}

	if ( is_singular( 'usecase' ) ) {
		return 'pedrollou95usecase-all-breakpoints.css';
	}

	// Domyślnie – np. single post (blog wpis)
	if ( is_single() ) {
		return 'pedrollou95blogu95wpis.css';
	}

	return null;
}

/**
 * Klasa strony dla wrappera (.page--onas, .page--index itd.).
 * Slug WP (np. o-nas) mapowany na klasę CSS (np. onas).
 */
function pedrollo_page_class() {
	global $pedrollo_page_class;
	if ( isset( $pedrollo_page_class ) ) {
		return esc_attr( $pedrollo_page_class );
	}
	if ( is_front_page() ) {
		return 'index';
	}
	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		$map  = array( 'o-nas' => 'onas' ); // slug WP → klasa CSS
		return esc_attr( isset( $map[ $slug ] ) ? $map[ $slug ] : $slug );
	}
	if ( is_singular( 'usecase' ) ) {
		return 'usecase';
	}
	if ( is_single() ) {
		return 'blog-wpis';
	}
	return 'default';
}

/**
 * Klasa „ekranu” Anima dla wrappera – CSS podstrony jest scopowany np. .pedrollou95kontaktu951366px.
 * Bez tej klasy strona Kontakt (i inne) nie dostaje stylów z arkusza podstrony.
 */
function pedrollo_screen_class() {
	$map = array(
		'index'                                => 'pedrollou95polskau95mainu953',
		'kontakt'                              => 'pedrollou95kontaktu951366px',
		'onas'                                 => 'pedrollou95polskau95ou95nas-all-breakpoints',
		'o-nas'                                => 'pedrollou95polskau95ou95nas-all-breakpoints',
		'laboratorium'                         => 'pedrollou95laboratorium-all-breakpoints',
		'usecase'                              => 'pedrollou95usecase-all-breakpoints',
		'program-partnerski'                   => 'pedrollou95program-partnerski-all-breakpoints',
		'produkt'                              => 'pedrollou95produkt-all-breakpoints',
		'dystrybutor'                          => 'pedrollou95dystrybutor-all-breakpoints',
		'blog'                                 => 'pedrollou95useu95caseu95lista', // ten sam layout co use case lista; pedrollou95blog.css nadpisuje .page--blog.pedrollou95useu95caseu95lista
		'faq'                                  => 'pedrollou95faq',
		'polityka-prywatnosci'                 => 'pedrollou95politykau95prywatnosci',
		'regulamin'                            => 'pedrollou95regulamin',
		'usecase-lista'                        => 'pedrollou95useu95caseu95lista',
		'blog-wpis'                            => 'pedrollou95blogu95wpis',
		'logowanie'                            => 'pedrollou95logowanie',
		'dystrybutor-rejestracja'              => 'page-registration',
		'dystrybutor-rejestracja-krok-2'      => 'pedrollou95dystrybutoru95rejestracjau95kroku9502',
		'dystrybutor-rejestracja-podziekowanie' => 'pedrollou95programu95partnerskiu95rejestracjau95podziekowanie',
	);
	$page = pedrollo_page_class();
	return isset( $map[ $page ] ) ? $map[ $page ] : 'pedrollou95polskau95mainu953';
}

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

/**
 * Rejestracja CPT Use Cases (pojedyncze use case).
 */
function pedrollo_register_usecase_cpt() {
	register_post_type(
		'usecase',
		array(
			'labels'             => array(
				'name'               => 'Use Cases',
				'singular_name'      => 'Use Case',
				'menu_name'          => 'Use Cases',
				'add_new'            => 'Dodaj nowy',
				'add_new_item'       => 'Dodaj nowy Use Case',
				'edit_item'          => 'Edytuj Use Case',
				'new_item'           => 'Nowy Use Case',
				'view_item'          => 'Zobacz Use Case',
				'search_items'       => 'Szukaj Use Cases',
				'not_found'          => 'Nie znaleziono Use Cases',
				'not_found_in_trash' => 'Brak Use Cases w koszu',
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'usecase' ),
			'capability_type'     => 'post',
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-media-text',
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		)
	);
}
add_action( 'init', 'pedrollo_register_usecase_cpt' );

/**
 * Przy aktywacji motywu: tworzy jeden przykładowy wpis bloga (jeśli jeszcze nie istnieje).
 * Treść z inc/sample-blog-post-content.html; tytuł i excerpt z projektu blog-wpis.
 *
 * @param bool $force Jeśli true, pomija sprawdzenie opcji i tworzy wpis (lub nadpisuje istniejący tytuł).
 * @return int|false ID wpisu lub false przy błędzie.
 */
function pedrollo_create_sample_blog_post( $force = false ) {
	$title = 'Dobry tytuł świetnej treści';
	if ( ! $force && get_option( 'pedrollo_sample_post_created' ) ) {
		return false;
	}
	$existing = get_page_by_title( $title, OBJECT, 'post' );
	if ( $existing && ! $force ) {
		update_option( 'pedrollo_sample_post_created', true );
		return (int) $existing->ID;
	}
	$file = get_template_directory() . '/inc/sample-blog-post-content.html';
	if ( ! file_exists( $file ) ) {
		return false;
	}
	$content = file_get_contents( $file );
	if ( $content === false ) {
		return false;
	}
	$content = str_replace( '{{THEME_URI}}', get_template_directory_uri(), $content );
	$admin = get_users( array( 'role' => 'administrator', 'number' => 1 ) );
	$author_id = ! empty( $admin[0] ) ? (int) $admin[0]->ID : 1;
	$post_data = array(
		'post_title'   => $title,
		'post_content' => $content,
		'post_excerpt' => 'Przewiń w dół, aby poznać wszystkie owocne sekcje artykułów, które możesz wykorzystywać w swoich publikacjach.',
		'post_status'  => 'publish',
		'post_author'  => $author_id,
		'post_type'    => 'post',
	);
	if ( $existing && $force ) {
		$post_data['ID'] = $existing->ID;
	}
	$post_id = wp_insert_post( $post_data );
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_option( 'pedrollo_sample_post_created', true );
		return (int) $post_id;
	}
	return false;
}
add_action( 'after_switch_theme', 'pedrollo_create_sample_blog_post' );
add_action( 'init', 'pedrollo_create_sample_blog_post', 20 );

/**
 * Sprawdza, czy wpis przykładowy (o tytule „Dobry tytuł świetnej treści”) już istnieje.
 */
function pedrollo_sample_post_exists() {
	$existing = get_page_by_title( 'Dobry tytuł świetnej treści', OBJECT, 'post' );
	return (bool) $existing;
}

/**
 * Ręczne utworzenie przykładowego wpisu: wp-admin/index.php?pedrollo_create_sample_post=1
 * Tylko administrator. Bez nonce – link jest stały, możesz go wkleić lub dodać do ulubionych.
 */
function pedrollo_handle_manual_create_sample_post() {
	if ( ! current_user_can( 'manage_options' ) || empty( $_GET['pedrollo_create_sample_post'] ) || $_GET['pedrollo_create_sample_post'] !== '1' ) {
		return;
	}
	$post_id = pedrollo_create_sample_blog_post( true );
	if ( $post_id ) {
		wp_safe_redirect( get_edit_post_link( $post_id, 'raw' ) );
		exit;
	}
	wp_safe_redirect( admin_url( 'edit.php?post_type=post&pedrollo_sample_error=1' ) );
	exit;
}
add_action( 'admin_init', 'pedrollo_handle_manual_create_sample_post' );

/**
 * Komunikat w panelu: pokazuj, gdy NIE MA wpisu o tytule „Dobry tytuł świetnej treści” (niezależnie od opcji).
 */
function pedrollo_admin_notice_sample_post() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( pedrollo_sample_post_exists() ) {
		return;
	}
	$url = admin_url( 'index.php?pedrollo_create_sample_post=1' );
	echo '<div class="notice notice-info"><p><strong>Motyw Pedrollo:</strong> Przykładowy wpis bloga nie został jeszcze utworzony. <a href="' . esc_url( $url ) . '">Utwórz przykładowy wpis</a> (możesz dodać ten link do ulubionych: <code>' . esc_html( $url ) . '</code>).</p></div>';
}
add_action( 'admin_notices', 'pedrollo_admin_notice_sample_post' );

/**
 * Tworzy jeden przykładowy wpis CPT usecase (Use Case).
 * Treść z inc/sample-usecase-content.html; tytuł i excerpt jak w statycznym use case.
 *
 * @param bool $force Jeśli true, pomija sprawdzenie opcji i tworzy wpis (lub nadpisuje istniejący tytuł).
 * @return int|false ID wpisu lub false przy błędzie.
 */
function pedrollo_create_sample_usecase_post( $force = false ) {
	$title = 'Jak pompa Pedrollo obniża koszty eksploatacji?';
	if ( ! $force && get_option( 'pedrollo_sample_usecase_created' ) ) {
		return false;
	}
	$existing = get_page_by_title( $title, OBJECT, 'usecase' );
	if ( $existing && ! $force ) {
		update_option( 'pedrollo_sample_usecase_created', true );
		return (int) $existing->ID;
	}
	$file = get_template_directory() . '/inc/sample-usecase-content.html';
	if ( ! file_exists( $file ) ) {
		return false;
	}
	$content = file_get_contents( $file );
	if ( $content === false ) {
		return false;
	}
	$content = str_replace( '{{THEME_URI}}', get_template_directory_uri(), $content );
	$admin = get_users( array( 'role' => 'administrator', 'number' => 1 ) );
	$author_id = ! empty( $admin[0] ) ? (int) $admin[0]->ID : 1;
	$post_data = array(
		'post_title'   => $title,
		'post_content' => $content,
		'post_excerpt' => 'Niższe zużycie prądu, mocniejsza konstrukcja i ponad dekada bezproblemowej pracy – to realne korzyści, które szybko się zwracają.',
		'post_status'  => 'publish',
		'post_author'  => $author_id,
		'post_type'    => 'usecase',
	);
	if ( $existing && $force ) {
		$post_data['ID'] = $existing->ID;
	}
	$post_id = wp_insert_post( $post_data );
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_option( 'pedrollo_sample_usecase_created', true );
		return (int) $post_id;
	}
	return false;
}
add_action( 'after_switch_theme', 'pedrollo_create_sample_usecase_post', 15 );
add_action( 'init', 'pedrollo_create_sample_usecase_post', 25 );

/**
 * Sprawdza, czy przykładowy Use Case (o tytule „Jak pompa Pedrollo obniża koszty eksploatacji?”) już istnieje.
 */
function pedrollo_sample_usecase_exists() {
	$existing = get_page_by_title( 'Jak pompa Pedrollo obniża koszty eksploatacji?', OBJECT, 'usecase' );
	return (bool) $existing;
}

/**
 * Ręczne utworzenie przykładowego Use Case: wp-admin/index.php?pedrollo_create_sample_usecase=1
 */
function pedrollo_handle_manual_create_sample_usecase() {
	if ( ! current_user_can( 'manage_options' ) || empty( $_GET['pedrollo_create_sample_usecase'] ) || $_GET['pedrollo_create_sample_usecase'] !== '1' ) {
		return;
	}
	$post_id = pedrollo_create_sample_usecase_post( true );
	if ( $post_id ) {
		wp_safe_redirect( get_edit_post_link( $post_id, 'raw' ) );
		exit;
	}
	wp_safe_redirect( admin_url( 'edit.php?post_type=usecase&pedrollo_sample_usecase_error=1' ) );
	exit;
}
add_action( 'admin_init', 'pedrollo_handle_manual_create_sample_usecase' );

/**
 * Komunikat w panelu: pokazuj, gdy NIE MA przykładowego Use Case.
 */
function pedrollo_admin_notice_sample_usecase() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( pedrollo_sample_usecase_exists() ) {
		return;
	}
	$url = admin_url( 'index.php?pedrollo_create_sample_usecase=1' );
	echo '<div class="notice notice-info"><p><strong>Motyw Pedrollo:</strong> Przykładowy Use Case nie został jeszcze utworzony. <a href="' . esc_url( $url ) . '">Utwórz przykładowy Use Case</a> (link: <code>' . esc_html( $url ) . '</code>).</p></div>';
}
add_action( 'admin_notices', 'pedrollo_admin_notice_sample_usecase' );
