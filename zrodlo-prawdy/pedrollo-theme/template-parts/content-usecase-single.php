<?php
/**
 * Szablon pojedynczego Use Case (CPT usecase) – hero (tytuł, excerpt, obraz wyróżniający), treść, poprzedni/następny.
 */
$t = get_template_directory_uri();
$subtitle = has_excerpt() ? get_the_excerpt() : 'Niższe zużycie prądu, mocniejsza konstrukcja i ponad dekada bezproblemowej pracy – to realne korzyści, które szybko się zwracają.';
$hero_bg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$hero_style = $hero_bg ? ' style="background-image: url(' . esc_url( $hero_bg ) . ');"' : '';
?>
      <div class="usecase-single-content">
      <div class="frame-20 usecase-hero<?php echo $hero_bg ? ' has-featured-image' : ''; ?>"<?php echo $hero_style; ?>>
        <img class="ellipse-2" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-84.svg" alt="" aria-hidden="true" />
        <div class="konsultacja">
          <h1 class="jak-pompa-pedrollo-o jak-pompa-pedrollo"><?php the_title(); ?></h1>
          <p class="nisze-zuycie-prdu">
            <span class="span0"><?php echo esc_html( $subtitle ); ?></span>
          </p>
          <div class="arrow-2 arrow-3">
            <div class="frame-76"><img class="line-8-2" src="<?php echo esc_url( $t ); ?>/img/line-8-12.svg" alt="" /></div>
          </div>
        </div>
      </div>
      <div class="usecase-table-scroll">
        <?php the_content(); ?>
      </div>
      <div class="frame-36860">
        <div class="frame-6604">
          <?php
          $prev = get_previous_post();
          $next = get_next_post();
          if ( $prev ) :
            ?>
          <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="_case">
            <img class="arrow_stroke_on_white_blue" src="<?php echo esc_url( $t ); ?>/img/arrow-stroke-on-white-blue.svg" alt="" />
            <div class="frame-6608">
              <div class="frame-65">
                <div class="e-use-case">Poprzedni</div>
                <div class="jak-pompa-pedrollo-obnia"><?php echo esc_html( get_the_title( $prev ) ); ?></div>
              </div>
            </div>
          </a>
          <?php endif; ?>
          <?php if ( $next ) : ?>
          <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="_case">
            <div class="frame-6608">
              <div class="frame-65">
                <div class="e-use-case">Następny</div>
                <div class="dobry-tytu-wietnej-treci-1"><?php echo esc_html( get_the_title( $next ) ); ?></div>
              </div>
            </div>
            <img class="arrow_stroke_on_white_blue" src="<?php echo esc_url( $t ); ?>/img/arrow-stroke-on-white-blue-1.svg" alt="" />
          </a>
          <?php endif; ?>
        </div>
      </div>
      </div><!-- .usecase-single-content -->
