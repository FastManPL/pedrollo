<?php
/**
 * Szablon pojedynczego wpisu bloga (używany w single.php w pętli).
 * Zawsze: hero (tytuł + excerpt), blok autora, treść wpisu (the_content), nawigacja poprzedni/następny.
 */
$t = get_template_directory_uri();
$subtitle = has_excerpt() ? get_the_excerpt() : 'Przewiń w dół, aby poznać wszystkie owocne sekcje artykułów, które możesz wykorzystywać w swoich publikacjach.';
$author_name = get_the_author();
$author_role = get_the_author_meta( 'description' );
if ( ! $author_role ) {
	$author_role = 'Stanowisko autora';
}
$hero_bg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$hero_style = $hero_bg ? ' style="background-image: url(' . esc_url( $hero_bg ) . ');"' : '';
?>
      <div class="frame-20 blog-wpis-hero<?php echo $hero_bg ? ' has-featured-image' : ''; ?>"<?php echo $hero_style; ?>>
        <img class="ellipse-2" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-2.svg" alt="" aria-hidden="true" />
        <div class="konsultacja">
          <h1 class="dobry-tytu-wietnej-treci manrope-semi-bold-concrete-90px"><?php the_title(); ?></h1>
          <p class="przewi-w-d-aby-p manrope-semi-bold-white-23px-2">
            <span class="span manrope-semi-bold-white-23px"><?php echo esc_html( $subtitle ); ?></span>
          </p>
          <div class="arrow">
            <div class="frame-76"><img class="line-8" src="<?php echo esc_url( $t ); ?>/img/line-8-29.svg" alt="" /></div>
          </div>
        </div>
      </div>
      <div class="frame-6581">
        <div class="frame-6598">
          <div class="frame-36868">
            <div class="frame-36867"><img class="vector-3" src="<?php echo esc_url( $t ); ?>/img/vector-8.svg" alt="" /></div>
            <div class="frame-36">
              <div class="autor-tekstu"><?php echo esc_html( $author_name ); ?></div>
              <div class="stanowisko-autora"><?php echo esc_html( $author_role ); ?></div>
            </div>
          </div>
            <?php the_content(); ?>
        </div>
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
