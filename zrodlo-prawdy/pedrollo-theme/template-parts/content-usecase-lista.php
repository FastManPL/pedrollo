<?php
/**
 * Treść strony Use case lista – dynamiczna lista wpisów CPT usecase (analogicznie do Blog).
 */
$t = get_template_directory_uri();

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ), isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 0 );
$usecase_query = new WP_Query(
	array(
		'post_type'      => 'usecase',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'paged'          => $paged,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>
      <div class="frame-20">
        <img class="ellipse-2" src="<?php echo esc_url( $t ); ?>/img/ellipse-2-80.svg" alt="Ellipse 2" />
        <div class="konsultacja">
          <h1 class="title manrope-semi-bold-concrete-90px">Use Case</h1>
          <p class="sprawd-na-konkretny manrope-semi-bold-white-23px-2">
            <span class="span manrope-semi-bold-white-23px">Sprawdź na konkretnych przykładach rozwiązań</span
            ><span class="span manrope-semi-bold-silver-chalice-23px"
              >, jak pompa Pedrollo 4SR-S® może pracować dla Ciebie.</span
            >
          </p>
          <div class="arrow">
            <div class="frame-76"><img class="line-8" src="<?php echo esc_url( $t ); ?>/img/line-8-28.svg" alt="Line 8" /></div>
          </div>
        </div>
      </div>
      <div class="frame-6581">
<?php
$posts = $usecase_query->posts;
$placeholder = $t . '/img/rectangle-1106-2.png';
if ( ! empty( $posts ) ) :
	for ( $i = 0; $i < count( $posts ); $i += 2 ) :
?>
        <div class="frame-3684">
<?php
		foreach ( array( 0, 1 ) as $col ) {
			if ( ! isset( $posts[ $i + $col ] ) ) {
				continue;
			}
			$post = $posts[ $i + $col ];
			setup_postdata( $post );
			$card_class   = ( $col === 0 ) ? 'frame-6602' : 'frame-6603';
			$inner_class  = ( $col === 0 ) ? 'frame-6598' : 'frame-6598-1';
			$img_class    = ( $col === 0 ) ? 'rectangle-1106' : 'rectangle-1106-1';
			$thumb = get_the_post_thumbnail_url( $post->ID, 'medium_large' );
			if ( ! $thumb ) {
				$thumb = $placeholder;
			}
?>
          <div class="<?php echo esc_attr( $card_class ); ?>">
            <div class="<?php echo esc_attr( $inner_class ); ?> usecase-card">
              <div class="frame-660 usecase-card-content">
                <img class="<?php echo esc_attr( $img_class ); ?>" src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title( $post ) ); ?>" />
                <div class="frame">
                  <p class="usecase-card-title manrope-semi-bold-cod-gray-40px"><?php echo esc_html( get_the_title( $post ) ); ?></p>
                  <p class="usecase-card-desc manrope-medium-cod-gray-23px-2"><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
                </div>
              </div>
              <a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
                <div class="btn btn--white-blue">
                  <span class="geist-medium-cod-gray-19px">Więcej</span>
                  <img class="arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right-70.svg" alt="Arrow_right" />
                </div>
              </a>
            </div>
          </div>
<?php
		}
?>
        </div>
<?php
	endfor;
	if ( $usecase_query->max_num_pages > 1 ) :
		$temp_query = $GLOBALS['wp_query'];
		$GLOBALS['wp_query'] = $usecase_query;
?>
        <div class="frame-36842">
          <a href="<?php echo esc_url( get_next_posts_page_link() ); ?>">
            <div class="btn btn--white-blue">
              <span class="geist-medium-cod-gray-19px">Pokaż więcej</span>
              <img class="arrow_down-2" src="<?php echo esc_url( $t ); ?>/img/arrow-down-41.svg" alt="Arrow_down" />
            </div>
          </a>
        </div>
<?php
		$GLOBALS['wp_query'] = $temp_query;
	endif;
	wp_reset_postdata();
else :
?>
        <p class="usecase-lista-empty manrope-semi-bold-cod-gray-23px">Brak opublikowanych Use Case. Dodaj wpisy w panelu „Use Cases”.</p>
<?php endif; ?>
      </div>
