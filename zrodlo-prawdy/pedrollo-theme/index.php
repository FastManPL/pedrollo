<?php
/**
 * Szablon minimalny (fallback).
 */
get_header();
?>
<main class="pedrollo-content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
	?>
</main>
<?php
get_footer();
