<?php
/**
 * Treść strony FAQ (z faq.html – tylko sekcja frame-20 + faq-6).
 * Header i footer ładowane globalnie.
 */
$t = get_template_directory_uri();
?>
<div class="frame-20">
	<img class="ellipse-2" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-24.svg" alt="" />
	<div class="konsultacja">
		<h1 class="title">FAQ</h1>
		<div class="najczciej-zadawane-pytania">Najczęściej zadawane pytania</div>
		<div class="arrow-1 arrow-2">
			<div class="frame-76"><img class="line-8" src="<?php echo esc_url( $t ); ?>/img/line-8-29.svg" alt="" /></div>
		</div>
	</div>
</div>
<div class="faq-6">
	<div class="frame-65-29 frame-65">
		<div id="accordion-faq-6" class="frame-6502-5 frame-6502">
			<?php
			// Accordion FAQ – treść z faq.html (artykuły)
			$faq_items = array(
				array(
					'q' => 'Co oznacza określenie pompy "plug & play"?',
					'a' => 'Określenie "plug & play" (z ang. "podłącz i używaj") oznacza, że pompa jest gotowa do pracy od razu po wyjęciu z pudełka. Wystarczy ją podłączyć do prądu i umieścić w studni – nie wymaga dodatkowych urządzeń sterujących ani skomplikowanej konfiguracji. Wszystkie niezbędne elementy, w tym zabezpieczenia, są już fabrycznie zintegrowane z pompą.',
				),
				array(
					'q' => 'Jak działa pompa głębinowa Pedrollo 4SR-S®?',
					'a' => 'Choć pompy to urządzenia o skomplikowanej budowie, ich działanie można wyjaśnić w prosty sposób. Wyobraź sobie rurę sięgającą głęboko w ziemię, tam gdzie znajduje się woda. Na dnie tej rury umieszczona jest pompa, która dzięki odpowiedniej mocy jest w stanie "wyssać" wodę i przesłać ją rurami do Twojego domu, ogrodu czy gospodarstwa.<br /><br />Działanie pompy głębinowej można podzielić na kilka kluczowych etapów: Zasysanie wody, Sprężanie i transport wody, Dostarczanie wody do systemu. Pompy głębinowe Pedrollo 4SR dodatkowo wyposażone są w zawór zwrotny, który zapobiega cofaniu się wody po wyłączeniu pompy.',
				),
				array(
					'q' => 'Czy jedna pompa do wody do studni głębinowej wystarczy w moim przypadku?',
					'a' => 'Zazwyczaj tak. Dobiera się pompę tak, aby zapewniła zapotrzebowanie gospodarstwa domowego. Jeśli masz jakąkolwiek wątpliwość – zadzwoń, dopasujemy odpowiednie rozwiązanie.',
				),
				array(
					'q' => 'Ile punktów poboru wody obsłuży jedna pompa głębinowa do studni?',
					'a' => 'Każda pompa może obsłużyć wiele punktów odbioru. Najważniejsze, aby wiedzieć, jakie konkretnie są to punkty. Możemy optymalnie dobrać pompę do wymagań. Zadzwoń lub napisz do nas.',
				),
				array(
					'q' => 'Jak dobrać odpowiednią wydajność pompy do studni głębinowej?',
					'a' => 'Wydajność pompy określa, ile wody może dostarczyć w określonym czasie. Im więcej osób w domu i punktów poboru wody używanych jednocześnie, tym większa powinna być wydajność. Napisz do nas – chętnie pomożemy.',
				),
				array(
					'q' => 'Co się stanie, jeśli w studni zabraknie wody?',
					'a' => 'Pompa posiada zabezpieczenie przed suchobiegiem. Gdy w studni zabraknie wody, czujnik automatycznie wyłączy pompę. Po powrocie wody urządzenie samoczynnie wznowi pracę.',
				),
				array(
					'q' => 'Czy warto oszczędzać na pompie?',
					'a' => 'Na rynku można znaleźć tańsze pompy, ale najważniejsza jest jakość. Pedrollo to marka, która od lat stawia na trwałość i innowacyjne rozwiązania.',
				),
			);
			foreach ( $faq_items as $item ) :
				?>
			<article class="faq_pytanie-6">
				<div class="faq-accordion-header">
					<div class="frame-102 frame">
						<p class="co-oznacza-okreleni-3 manrope-medium-cod-gray-23px-2"><?php echo esc_html( $item['q'] ); ?></p>
						<div class="arrow-22">
							<div class="frame-76-7 frame-76">
								<img class="line-8-16" src="<?php echo esc_url( $t ); ?>/img/line-8-13.svg" alt="" />
							</div>
						</div>
					</div>
				</div>
				<div class="faq-accordion-content">
					<p class="faq-odpowiedz"><?php echo wp_kses_post( $item['a'] ); ?></p>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</div>
