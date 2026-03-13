<?php
/**
 * Treść strony Blog – dynamiczna lista wpisów z paginacją (20 na stronę).
 */
$t = get_template_directory_uri();

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ), isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 0 );
$blog_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 20,
		'paged'          => $paged,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>
      <div class="frame-20">
        <div class="konsultacja">
          <h1 class="title manrope-semi-bold-concrete-90px">Zanurz się w świecie pomp</h1>
          <p class="sprawd-na-konkretny manrope-semi-bold-white-23px-2">
            Profesjonalne porady i wskazówki od naszych inżynierów.
          </p>
          <div class="arrow">
            <div class="frame-76"><img class="line-8" src="<?php echo esc_url( $t ); ?>/img/line-8-64.svg" alt="" /></div>
          </div>
        </div>
      </div>
      <div class="frame-6581">
<?php
$posts = $blog_query->posts;
$placeholder = $t . '/img/rectangle-1106-4.png';
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
                  <p class="usecase-card-desc manrope-semi-bold-cod-gray-23px"><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
                </div>
              </div>
              <a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
                <div class="btn btn--white-blue">
                  <span class="geist-medium-cod-gray-19px">Więcej</span>
                  <img class="arrow_right" src="<?php echo esc_url( $t ); ?>/img/arrow-right-70.svg" alt="" />
                </div>
              </a>
            </div>
          </div>
<?php
	}
?>
        </div>
<?php endfor; ?>
<?php
if ( $blog_query->max_num_pages > 1 ) :
	$temp_query = $GLOBALS['wp_query'];
	$GLOBALS['wp_query'] = $blog_query;
	?>
        <nav class="blog-pagination frame-36842" aria-label="<?php esc_attr_e( 'Paginacja wpisów', 'pedrollo' ); ?>">
          <?php
          the_posts_pagination(
            array(
              'mid_size'  => 2,
              'prev_text' => '&larr; ' . __( 'Nowsze', 'pedrollo' ),
              'next_text' => __( 'Starsze', 'pedrollo' ) . ' &rarr;',
            )
          );
          ?>
        </nav>
<?php
	$GLOBALS['wp_query'] = $temp_query;
endif;
wp_reset_postdata();
?>
      </div>
<?php get_template_part( 'template-parts/global', 'referencje' ); ?>
