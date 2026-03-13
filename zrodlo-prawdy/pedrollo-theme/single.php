<?php
/**
 * Szablon pojedynczego wpisu (blog). CSS: pedrollou95blogu95wpis.css (w functions.php).
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'blog-wpis' );
	}
}
get_footer();
