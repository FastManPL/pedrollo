<?php
/**
 * Globalna sekcja: CTA „Dołącz do programu” / „Oferta dla instalatorów”.
 * Link do strony program-partnerski. Używana na stronie głównej i Dystrybutor.
 */
$t = get_template_directory_uri();
$program_url = home_url( '/program-partnerski/' );
?>
<div class="frame-6599-3 global-sekcja-dolacz-do-programu">
  <div class="frame-6-19">
    <div class="frame-86 frame">
      <div class="frame-6501">
        <div class="oferta-dla-instalatorw manrope-semi-bold-white-40px">Oferta dla instalatorów</div>
      </div>
      <p class="pewne-zlecenia-w-two-3 manrope-semi-bold-white-23px-2">
        <span class="span-17 manrope-semi-bold-white-23px"
          >Pewne zlecenia w Twoim regionie. Dołącz do sieci</span
        ><span class="span-17 manrope-semi-bold-silver-chalice-23px">
          autoryzowanych instalatorów. Zyskaj dostęp do zleceń i prowizji.</span
        >
      </p>
    </div>
    <a href="<?php echo esc_url( $program_url ); ?>" class="btn btn--secondary">
      <div class="poznaj-nasz-zestaw geist-medium-white-19px">Sprawdź korzyści</div>
      <img class="arrow_right-16 arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right-8.svg" alt="Arrow_right" />
    </a>
  </div>
  <img class="image-14-3" src="<?php echo esc_url( $t ); ?>/img/image-14-3.png" alt="image 14" />
</div>
