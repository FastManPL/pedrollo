<?php
/**
 * Nagłówek globalny – <head>, otwarcie <body>, wrapper, menu (mobile + desktop).
 * Zasoby: partials/header.html (desktop), index.html (mobile header).
 */
$pedrollo_theme_uri = get_template_directory_uri();
$pedrollo_page     = function_exists( 'pedrollo_page_class' ) ? pedrollo_page_class() : 'default';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<?php
	$favicon = get_site_icon_url( 32 );
	if ( ! $favicon && file_exists( get_template_directory() . '/img/favicon.png' ) ) {
		$favicon = $pedrollo_theme_uri . '/img/favicon.png';
	}
	if ( $favicon ) {
		echo '<link rel="icon" type="image/png" href="' . esc_url( $favicon ) . '" />';
	}
	?>
	<meta name="og:type" content="website" />
	<meta name="twitter:card" content="photo" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> style="margin: 0; background: #0a0a0a">
	<div class="page page--<?php echo esc_attr( $pedrollo_page ); ?> <?php echo esc_attr( function_exists( 'pedrollo_screen_class' ) ? pedrollo_screen_class() : 'pedrollou95polskau95mainu953' ); ?> screen">
		<!-- Mobile header: logo + hamburger -->
		<header class="mobile-header" aria-hidden="true">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-header-logo">
				<img src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-1-23@2x.png" class="logo" alt="<?php bloginfo( 'name' ); ?>" />
			</a>
			<button type="button" class="mobile-header-hamburger" id="mobile-menu-open" aria-label="Otwórz menu">
				<span></span><span></span><span></span>
			</button>
		</header>

		<!-- Nawigacja desktop – wyłącznie klasy menu_* (globals.css), bez kolizji z .label / .frame-* z plików podstron -->
		<div class="menu_2-3 global-menu" id="main-menu">
			<div class="menu_bar">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-1-23@2x.png" class="menu_logo" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<div class="menu_nav_wrap">
					<div class="menu_items_row">
						<div class="menu-hover-1" data-submenu="elektryczna-pompa">
							<div class="menu_item_inner">
								<div class="menu_label">Elektryczna pompa głębinowa 4SR-S®</div>
								<div class="menu_arrow_wrap"><img class="menu_arrow" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/arrow-down-53.svg" alt="" /></div>
							</div>
						</div>
						<div id="elektryczna-pompa" class="submenu-panel" aria-hidden="true">
							<div class="menu_dropdown_bg">
								<div class="submenu-grid submenu-grid--cols-3">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>#slider_zestawy"><article class="menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/view-1.svg" alt="" /><div class="menu_label">Szybki przegląd pompy</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-9-3@2x.png" alt="" /><div class="menu_label">Cechy pompy</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-9-4@2x.png" alt="" /><div class="menu_label">Modele</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-9-5@2x.png" alt="" /><div class="menu_label">Dobór pompy</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/gears-1.svg" alt="" /><div class="menu_label">Jak działa?</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-2 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><div class="menu_icon_wrapper"><div class="menu_icon_install_bg"></div><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-16-1@2x.png" alt="" /></div><div class="menu_label">Montaż</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/guarantee-6.svg" alt="" /><div class="menu_label">Gwarancja i finansowanie</div></div></div></article></a>
									<a href="<?php echo esc_url( home_url( '/usecase-lista/' ) ); ?>"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/use-cases-2-1.svg" alt="" /><div class="menu_label">Use Cases</div></div></div></article></a>
									<a href="#"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/service-1.svg" alt="" /><div class="menu_label">Serwis</div></div></div></article></a>
								</div>
							</div>
						</div>
						<div class="menu-hover-1" data-submenu="oferta-dla-partnerow">
							<div class="menu_item_inner">
								<div class="menu_label">Oferta dla partnerów</div>
								<div class="menu_arrow_wrap"><img class="menu_arrow" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/arrow-down-53.svg" alt="" /></div>
							</div>
						</div>
						<div id="oferta-dla-partnerow" class="submenu-panel" aria-hidden="true">
							<div class="menu_dropdown_bg">
								<div class="submenu-grid submenu-grid--cols-2">
									<a href="<?php echo esc_url( home_url( '/dystrybutor/' ) ); ?>"><article class="menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/store-1.svg" alt="" /><div class="menu_label">Dla dystrybutorów i sklepów</div></div></div></article></a>
									<a href="<?php echo esc_url( home_url( '/program-partnerski/' ) ); ?>"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/instalator-6.svg" alt="" /><div class="menu_label">Dla instalatorów</div></div></div></article></a>
								</div>
							</div>
						</div>
						<div class="menu-hover-1" data-submenu="o-nas">
							<div class="menu_item_inner">
								<div class="menu_label">O nas</div>
								<div class="menu_arrow_wrap"><img class="menu_arrow" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/arrow-down-53.svg" alt="" /></div>
							</div>
						</div>
						<div id="o-nas" class="submenu-panel" aria-hidden="true">
							<div class="menu_dropdown_bg">
								<div class="submenu-grid submenu-grid--cols-2">
									<a href="<?php echo esc_url( home_url( '/o-nas/' ) ); ?>"><article class="menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/o-nas-1.svg" alt="" /><div class="menu_label">O nas</div></div></div></article></a>
									<a href="<?php echo esc_url( home_url( '/laboratorium/' ) ); ?>"><article class="menu_list_2-1 menu_list_2-3"><div class="menu_card"><div class="menu_card_inner"><img class="menu_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/lab-1.svg" alt="" /><div class="menu_label">Laboratorium</div></div></div></article></a>
								</div>
							</div>
						</div>
						<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="menu-hover-1">
							<div class="menu_item_inner"><div class="menu_label">Kontakt</div></div>
						</a>
						<a class="menu_btn_phone" href="tel:+48464444112">
							<div class="menu_btn_phone_inner">
								<img class="menu_phone_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/vector.svg" alt="" />
								<span class="menu_phone">+48 464 444 112</span>
							</div>
						</a>
						<a class="menu_btn_cta" href="<?php echo esc_url( home_url( '/' ) ); ?>#slider_zestawy">
							<span class="menu_cta_text">Dobierz pompę</span>
							<div class="menu_btn_cta_inner">
								<div class="menu_btn_cta_icons">
									<img class="menu_cta_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/vector-212.svg" alt="" />
									<img class="menu_cta_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/vector-2.svg" alt="" />
								</div>
							</div>
						</a>
					</div>
				</div>
				<button type="button" class="mobile-menu-close-btn" id="mobile-menu-close" aria-label="Zamknij menu">×</button>
			</div>
		</div>
		<div class="header-submenus">
			<div class="submenu-back-wrap" id="submenu-back-wrap" aria-hidden="true">
				<button type="button" class="submenu-back-btn" id="submenu-back" aria-label="Wstecz">← Wstecz</button>
			</div>
		</div>
