<?php
/**
 * Treść strony Rejestracja dystrybutora – krok 1 (z dystrybutor-rejestracja-krok1.html).
 * Slug: dystrybutor-rejestracja. Wrapper ma klasę page-registration (w functions.php).
 */
$t = get_template_directory_uri();
$next_step_url = home_url( '/dystrybutor-rejestracja-krok-2/' );
$polityka_url = home_url( '/polityka-prywatnosci/' );
$regulamin_url = home_url( '/regulamin/' );
?>
      <div class="frame-3673324 frame-3673324-1 frame-3673324-2 frame-20">
        <div class="rectangle-6-1"></div>
        <div class="konsultacja konsultacja-1 konsultacja-2 konsultacja-3">
          <img class="ellipse-2 ellipse-2-2 ellipse-2-4 ellipse-2-6" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-2.svg" alt="" aria-hidden="true" />
          <div class="frame-6483 frame-6483-1 frame-6483-2 frame-6484">
            <div class="frame-6482 frame-6482-1 frame-6482-2 frame-6482-3">
              <div class="frame-65">
                <div class="frame-6501">
                  <h1 class="rejestracja-dystrybu manrope-semi-bold-concrete-30px">
                    Rejestracja dystrybutora&nbsp;&nbsp;<br />do Programu Partnerskiego
                  </h1>
                </div>
                <div class="frame-36">
                  <p class="uzupenij-formularz manrope-semi-bold-white-14px-3">
                    <span class="span manrope-semi-bold-white-14px">Uzupełnij&nbsp;&nbsp;formularz</span><span class="span manrope-semi-bold-silver-chalice-14px">, aby dołączyć do Partnerów Pedrollo. Rejestracja jest darmowa.</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="frame-3673418 frame-36833 frame-36833-1 frame-36833-2">
            <div class="frame-36834 frame-36834-1 frame-36834-2 frame-36834-3">
              <div class="frame-36832 frame-36832-1 frame-36832-2 frame-36832-3">
                <div class="frame-36 frame-36731 frame-36731-1 frame-36731-2">
                  <div class="formularz manrope-semi-bold-cod-gray-30px">Formularz</div>
                  <div class="frame-6445 frame-6445-2 frame-6445-4 frame-6445-6">
                    <img class="krok" src="<?php echo esc_url( $t ); ?>/img/krok.png" alt="Krok" />
                    <div class="frame-6445-1 frame-6445-3 frame-6445-5 frame-6445-7">
                      <div class="frame-6441"><img class="x1" src="<?php echo esc_url( $t ); ?>/img/1.png" alt="1" /></div>
                      <div class="frame-6442"><img class="x2" src="<?php echo esc_url( $t ); ?>/img/2.png" alt="2" /></div>
                    </div>
                  </div>
                </div>
                <form action="<?php echo esc_url( $next_step_url ); ?>" method="get" class="frame-36 frame-1 frame-2 frame-7">
                  <div class="frame frame-1 frame-2 frame-7">
                    <div class="frame-36 frame-3683 frame-3683-1 frame-3683-2">
                      <div class="input input-1 input-2 input-3">
                        <div class="frame-36727">
                          <div class="label-1 label-5 manrope-normal-log-cabin-14px">Nazwa firmy</div>
                          <div class="star-4 manrope-normal-alizarin-crimson-14px">*</div>
                        </div>
                      </div>
                      <div class="input">
                        <div class="frame-36727">
                          <div class="label-2 label-5 manrope-normal-log-cabin-14px">NIP</div>
                          <div class="star-4 manrope-normal-alizarin-crimson-14px">*</div>
                        </div>
                      </div>
                      <div class="input">
                        <div class="frame-36727">
                          <div class="label-3 label-5 manrope-normal-log-cabin-14px">e-mail</div>
                          <div class="star-4 manrope-normal-alizarin-crimson-14px">*</div>
                        </div>
                      </div>
                      <div class="input_info input_info-1 input_info-2 input_info-3">
                        <div class="frame-36727 frame-36727-1 frame-36727-2 frame-36727-3 frame-36727-4 frame-36727-5 frame-36727-6 frame-36727-7">
                          <div class="label-4 label-5 manrope-normal-log-cabin-14px">Numer kontaktowy</div>
                          <div class="star-4 manrope-normal-alizarin-crimson-14px">*</div>
                        </div>
                        <div class="info_24dp_e3-e3-e3_f">
                          <img class="vector" src="<?php echo esc_url( $t ); ?>/img/vector-5.svg" alt="" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="frame-36735 frame-36735-1 frame-36735-2 frame-36735-3">
                    <div class="radio_select_2 radio_select_2-1 radio_select_2-2 radio_select_2-3">
                      <div class="group-62"></div>
                      <p class="akceptuj-polityk-p manrope-medium-cod-gray-13px">
                        <span class="manrope-medium-cod-gray-13px">Akceptuję </span><a href="<?php echo esc_url( $polityka_url ); ?>" class="span-2 manrope-medium-cod-gray-13px">politykę prywatności</a><span class="manrope-medium-cod-gray-13px"> i </span><a href="<?php echo esc_url( $regulamin_url ); ?>" class="span-2 manrope-medium-cod-gray-13px">regulamin</a>
                      </p>
                    </div>
                  </div>
                  <div class="frame-36835 frame-36835-1 frame-36835-2 frame-36835-3">
                    <button type="submit" class="btn btn--primary krok-4">
                      <span class="zarejestruj-si geist-medium-white-15px">Zarejestruj się</span>
                      <img class="arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right.svg" alt="" />
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
