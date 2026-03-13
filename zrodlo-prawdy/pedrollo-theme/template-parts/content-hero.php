<?php
/**
 * Sekcja hero strony głównej (z index.html).
 */
$t = get_template_directory_uri();
?>
<section id="header">
	<img class="perfect_loop-1" src="<?php echo esc_url( $t ); ?>/img/perfect-loop-1.gif" alt="" />
	<div class="frame-20-5">
		<div class="ellipse-1-5"></div>
		<div class="ellipse-2-78"></div>
	</div>
	<div class="rectangle-6"></div>
	<div class="hero-content frame-34-3">
		<div class="hero-left">
			<img class="hero-header-img" src="<?php echo esc_url( $t ); ?>/img/header.png" alt="PEDROLLO 4SR-S®" />
			<p class="hero-subline">
				<span class="hero-subline-item">Pompa głębinowa</span>
				<span class="hero-subline-dot">•</span>
				<span class="hero-subline-item">plug &amp; play</span>
				<span class="hero-subline-dot">•</span>
				<span class="hero-subline-item">4-calowa</span>
			</p>
			<p class="hero-desc">Innowacyjna seria z opatentowanym układem hydraulicznym. Wydajność potwierdzona w najtrudniejszych warunkach użytkowania, w różnych zakątkach świata.</p>
			<a href="#slider_zestawy" class="btn btn--secondary">
				<span class="geist-medium-white-17px">Poznaj nasz zestaw</span>
			</a>
		</div>
		<div class="hero-right">
			<img class="hero-madeinitaly" src="<?php echo esc_url( $t ); ?>/img/madeinitaly.png" alt="Made in Italy" />
			<div class="hero-features-list">
				<div class="hero-feature"><img src="<?php echo esc_url( $t ); ?>/img/hico1.png" alt="" /><span>Do czystej wody</span></div>
				<div class="hero-feature"><img src="<?php echo esc_url( $t ); ?>/img/hico2.png" alt="" /><span>Do użytku domowego</span></div>
				<div class="hero-feature"><img src="<?php echo esc_url( $t ); ?>/img/hico3.png" alt="" /><span>W budownictwie mieszkaniowym</span></div>
				<div class="hero-feature"><img src="<?php echo esc_url( $t ); ?>/img/hico4.png" alt="" /><span>Dla rolnictwa</span></div>
			</div>
		</div>
	</div>
	<img class="anim_4-3" src="<?php echo esc_url( $t ); ?>/img/anim-4-3.svg" alt="" />
</section>
