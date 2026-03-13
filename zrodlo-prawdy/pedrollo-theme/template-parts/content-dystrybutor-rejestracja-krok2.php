<?php
/**
 * Treść strony Rejestracja dystrybutora – krok 2 (kod weryfikacyjny SMS).
 * Slug: dystrybutor-rejestracja-krok-2. Z dystrybutor-rejestracja-krok2.html.
 */
$t = get_template_directory_uri();
$thankyou_url = home_url( '/dystrybutor-rejestracja-podziekowanie/' );
?>
      <div class="frame-20">
        <div class="rectangle-6"></div>
        <div class="konsultacja">
          <img class="ellipse-2" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-6.svg" alt="" aria-hidden="true" />
          <div class="frame-6484">
            <div class="frame-6482">
              <div class="frame">
                <div class="frame-6501">
                  <h1 class="rejestracja-dystrybu manrope-semi-bold-concrete-60px">
                    Rejestracja dystrybutora <br />do Programu Partnerskiego
                  </h1>
                </div>
              </div>
            </div>
          </div>
          <div class="frame-36833">
            <div class="frame-36834">
              <div class="frame-36832">
                <div class="frame-367">
                  <div class="frame-36837">
                    <div class="kod-weryfikacyjny manrope-semi-bold-cod-gray-50px">Kod weryfikacyjny</div>
                    <p class="wpisz-kod-wysany-w-wiadomoci-sms">Wpisz kod wysłany w wiadomości SMS</p>
                  </div>
                  <div class="frame-6445">
                    <img class="krok" src="<?php echo esc_url( $t ); ?>/img/krok-2.png" alt="Krok 2" />
                    <div class="frame-6445-1">
                      <div class="frame-6442"><img class="x1" src="<?php echo esc_url( $t ); ?>/img/1-2.png" alt="1" /></div>
                      <div class="frame-6441"><img class="x2" src="<?php echo esc_url( $t ); ?>/img/2-2.png" alt="2" /></div>
                    </div>
                  </div>
                </div>
                <form action="<?php echo esc_url( $thankyou_url ); ?>" method="get" class="frame-36732">
                  <div class="frame-36839">
                    <div class="frame-36838">
                      <article class="input_sms input_sms-2">
                        <div class="frame-36727"><div class="label-2 label-3">3</div></div>
                      </article>
                      <article class="input_sms-1 input_sms-2">
                        <div class="frame-36728"><div class="text-19">|</div></div>
                      </article>
                      <article class="input_sms input_sms-2"></article>
                      <article class="input_sms input_sms-2"></article>
                    </div>
                    <div class="frame-36835">
                      <button type="submit" class="krok-1">
                        <span class="dalej geist-medium-white-19px">Potwierdź kod</span>
                        <img class="arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right-4.svg" alt="" />
                      </button>
                    </div>
                  </div>
                  <div class="frame-36735">
                    <div class="radio_select_2">
                      <p class="kod-nie-dotar-wyl roboto-regular-normal-masala-18px">
                        <span class="roboto-regular-normal-masala-18px">Kod nie dotarł? </span><span class="span1 roboto-regular-normal-masala-18px">Wyślij ponownie SMS-a z kodem</span>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
