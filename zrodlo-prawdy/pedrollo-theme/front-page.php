<?php
/**
 * Szablon strony głównej – pełna treść z index.html (hero + reszta do stopki).
 */
$pedrollo_page_class = 'index';
get_header();
get_template_part( 'template-parts/content', 'hero' );
get_template_part( 'template-parts/content', 'front-page-full' );
get_footer();
