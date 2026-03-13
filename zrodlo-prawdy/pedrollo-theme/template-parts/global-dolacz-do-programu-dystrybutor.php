<?php
/**
 * Sekcja „Dołącz do Programu Partnerskiego” – ostatnia sekcja z program-partnerski.html.
 * Używana tylko na stronie Dystrybutor (po FAQ). Dwa przyciski: Dla dystrybutora, Dla instalatora.
 */
$t = get_template_directory_uri();
$url_dystrybutor = home_url( '/dystrybutor/' );
$url_instalator  = home_url( '/program-partnerski/' );
?>
<div class="doacz_program_partnerski_2-2 global-sekcja-dolacz-dystrybutor">
	<div class="frame-36820-2">
		<div class="frame-36828-2">
			<div class="frame-36829">
				<div class="docz-do-programu-partnerskiego-2">Dołącz do Programu<br />Partnerskiego</div>
				<p class="zosta-naszym-partne-1 manrope-semi-bold-white-23px-2">
					<span class="span-2 manrope-semi-bold-white-23px">Zostań naszym Partnerem</span
					><span class="span-2 manrope-semi-bold-silver-chalice-23px">
						i zyskaj dostęp do platformy z materiałami, szkoleń, wsparcia ekspertów i innych korzyści. </span
					><span class="span-2 manrope-semi-bold-white-23px">Rejestracja jest bezpłatna.</span>
				</p>
			</div>
		</div>
		<div class="frame-36824-2">
			<div class="frame-36822-2">
				<div class="frame-368">
					<a href="<?php echo esc_url( $url_dystrybutor ); ?>" class="frame-36818">
						<div class="btn btn--secondary">
							<div class="poznaj-nasz-zestaw geist-medium-white-19px">Dla dystrybutora</div>
							<img class="arrow_right-3" src="<?php echo esc_url( $t ); ?>/img/arrow-right-4.svg" alt="" />
						</div>
					</a>
				</div>
				<div class="frame-368">
					<a href="<?php echo esc_url( $url_instalator ); ?>" class="frame-36818">
						<div class="btn btn--secondary">
							<div class="poznaj-nasz-zestaw geist-medium-white-19px">Dla instalatora</div>
							<img class="arrow_right-3" src="<?php echo esc_url( $t ); ?>/img/arrow-right-4.svg" alt="" />
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="u7761719182_httpss-5 u7761719182_httpss">
		<img class="ellipse-2-11" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-77.svg" alt="" />
	</div>
	<img class="ellipse-2-12" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-76.svg" alt="" />
</div>
