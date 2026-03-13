<?php
/**
 * Szablon strony FAQ.
 * Treść z faq.html (bez header/footer – ładowane globalnie).
 */
get_header();
get_template_part( 'template-parts/content', 'faq' );
get_footer();
