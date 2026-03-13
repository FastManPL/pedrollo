<?php
/**
 * Stopka globalna – wyłącznie klasy footer_* (globals.css), bez kolizji z .frame / .label z plików podstron.
 * Na stronie Use Case: zamykamy główny .page, otwieramy wrapper .page z klasami use case wokół stopki,
 * żeby #site-footer był wewnątrz .page (wymagane przez CSS).
 */
$pedrollo_theme_uri = get_template_directory_uri();
if ( is_singular( 'usecase' ) ) {
	echo '</div><!-- .page (header) -->';
	$screen_class = function_exists( 'pedrollo_screen_class' ) ? pedrollo_screen_class() : 'pedrollou95usecase-all-breakpoints';
	echo '<div class="page page--usecase ' . esc_attr( $screen_class ) . ' screen">';
}
?>
		<div class="footer_root global-footer" id="site-footer">
			<div class="footer_row">
				<div class="footer_brand">
					<div class="footer_brand_top">
						<img class="footer_logo" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/group-1-24@2x.png" alt="<?php bloginfo( 'name' ); ?>" />
						<div class="footer_country">Polska</div>
					</div>
					<p class="footer_desc">
						Tworzymy przyszłość systemów<br />wodnych, oferując niezawodne <br />pompy głębinowe i kompleksowe
						<br />wsparcie techniczne na terenie <br />całej Polski.
					</p>
				</div>
				<div class="footer_cta_box">
					<img class="footer_frame" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/frame-36737-13.svg" alt="" />
					<a href="<?php echo esc_url( home_url( '/program-partnerski/' ) ); ?>"><div class="footer_btn">
						<div class="footer_btn_label">Strefa partnera</div>
						<div class="footer_btn_icons">
							<img class="footer_btn_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/vector-276.svg" alt="" />
							<img class="footer_btn_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/vector-4.svg" alt="" />
						</div>
					</div></a>
				</div>
			</div>
			<div class="footer_content">
				<p class="footer_slogan">Raz kupujesz, bez końca pompujesz!</p>
				<div class="footer_columns">
					<div class="footer_columns_row">
						<div class="footer_column">
							<div class="footer_heading">Elektryczna pompa głębinowa</div>
							<div class="footer_links">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>#slider_zestawy" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Szybki przegląd pompy 4SR-S®</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Cechy pompy</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Modele</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Dobór pompy</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Jak działa?</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Montaż</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Gwarancja i finansowanie</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/usecase-lista/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Use Cases</span></div></article></a>
								<a href="#" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Serwis</span></div></article></a>
							</div>
						</div>
						<div class="footer_column">
							<div class="footer_heading">Na skróty</div>
							<div class="footer_links">
								<a href="<?php echo esc_url( home_url( '/dystrybutor/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Oferta dla dystrybutorów</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/program-partnerski/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Oferta dla instalatorów</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/o-nas/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">O nas</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Kontakt</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/laboratorium/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Laboratorium</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Blog</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/polityka-prywatnosci/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Polityka prywatności</span></div></article></a>
								<a href="<?php echo esc_url( home_url( '/regulamin/' ) ); ?>" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">Regulamin</span></div></article></a>
							</div>
						</div>
						<div class="footer_row">
							<div class="footer_column">
								<div class="footer_heading">Kontakt z nami</div>
								<div class="footer_contact_list">
									<a href="tel:+48464444112" class="footer-menu-link"><div class="footer_link"><div class="footer_link_inner"><span class="footer_label">Infolinia: +48 46 4444 11 2</span></div></div></a>
									<a href="mailto:biuro@pedrollopolska.pl" class="footer-menu-link"><div class="footer_link"><div class="footer_link_inner"><span class="footer_label">biuro@pedrollopolska.pl</span></div></div></a>
									<div class="footer_address">
										<div class="footer_address_text">Dachowa 43A<br />96-500 Sochaczew</div>
									</div>
								</div>
							</div>
							<div class="footer_column">
								<div class="footer_heading">Dobór pomp</div>
								<div class="footer_contact_list">
									<a href="tel:+48464444113" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">+48 46 4444 11 3</span></div></article></a>
									<a href="mailto:pompy@pedrollopolska.pl" class="footer-menu-link"><article class="footer_link"><div class="footer_link_inner"><span class="footer_label">pompy@pedrollopolska.pl</span></div></article></a>
								</div>
							</div>
							<div class="footer_social">
								<a href="#" class="footer-social-link"><img class="footer_social_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/instagram-13.svg" alt="Instagram" /></a>
								<a href="#" class="footer-social-link"><img class="footer_social_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/facebook-13.svg" alt="Facebook" /></a>
								<a href="#" class="footer-social-link"><img class="footer_social_icon" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/youtube-13.svg" alt="Youtube" /></a>
								<a href="#" class="footer-social-link"><div class="footer_social_icon_linkedin"><img class="footer_social_icon_svg" src="<?php echo esc_url( $pedrollo_theme_uri ); ?>/img/subtract.svg" alt="LinkedIn" /></div></a>
							</div>
							<a href="<?php echo esc_url( home_url( '/polityka-prywatnosci/' ) ); ?>" class="footer-menu-link"><div class="footer_copyright"><span class="footer_copyright_text">© 2025 Pedrollo. Polityka prywatności</span></div></a>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php
	if ( is_singular( 'usecase' ) ) {
		echo '</div><!-- .page (footer wrapper) -->';
	} else {
		echo "\t</div><!-- .page -->\n";
	}
	?>
	<?php wp_footer(); ?>
</body>
</html>
