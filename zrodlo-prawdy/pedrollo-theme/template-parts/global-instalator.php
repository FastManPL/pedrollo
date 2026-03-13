<?php
/**
 * Globalna sekcja: wyszukiwanie instalatora („Znajdź instalatora z Twojej okolicy”).
 * Używana na stronie głównej, O nas, Kontakt.
 */
$t = get_template_directory_uri();
?>
<div class="frame-6566-3 global-sekcja-instalator">
  <img class="ellipse-2-96" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-103.svg" alt="Ellipse 2" />
  <div class="frame-6587-3">
    <div class="frame-6576-3">
      <div class="frame-6596-3">
        <div class="frame-6597-2">
          <img class="instalator-3" src="<?php echo esc_url( $t ); ?>/img/instalator.gif" alt="instalator" />
          <div class="frame-90 frame">
            <p class="znajd-instalatora-z-twojej-okolicy-3 manrope-semi-bold-cod-gray-60px">
              Znajdź instalatora <br />z Twojej okolicy
            </p>
            <p class="instalator-opis manrope-medium-silver-chalice-16px">Wolisz powierzyć montaż fachowcom? Montujemy na terenie całej Polski.</p>
          </div>
        </div>
        <div class="frame-6586-3">
          <label class="instalator-label manrope-medium-cod-gray-16px" for="instalator-kod">Wpisz kod pocztowy montażu.</label>
          <div class="frame-6574-3">
            <input type="text" id="instalator-kod" class="instalator-input text-23" value="00-010" placeholder="00-010" />
            <div class="btn btn--secondary">
              <div class="poznaj-nasz-zestaw geist-medium-white-19px">Szukaj</div>
              <img class="search-3" src="<?php echo esc_url( $t ); ?>/img/search.svg" alt="search" />
            </div>
          </div>
        </div>
      </div>
      <div class="u7761719182_httpss-14 u7761719182_httpss"></div>
    </div>
    <div class="instalator-wyniki">
      <p class="instalator-wyniki-tytul manrope-medium-cod-gray-16px">Wyniki wyszukiwania po kodzie pocztowym</p>
      <div class="frame-6480-8 frame-6480">
        <div class="frame-102 frame">
          <div class="pan-darek-3 manrope-semi-bold-cod-gray-30px">Pan Darek</div>
          <div class="frame-6-18 instalator-okolicy">
            <span class="instalator-check">✓</span>
            <span class="instalator-pomp-tekst manrope-medium-cod-gray-16px">Instalator pomp w Twojej okolicy.</span>
          </div>
          <a onclick="ShowOverlay('pop-up-instalator', 'animate-appear');"><div class="zapytaj-6 btn btn--cta-dark">
            <div class="zapytaj-o-produkt geist-medium-white-19px">Kontakt do instalatora</div>
            <div class="frame-4-21">
              <img class="arrow_right-17 arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right-11.svg" alt="Arrow_right">
            </div>
          </div></a>
        </div>
      </div>
    </div>
  </div>
</div>
