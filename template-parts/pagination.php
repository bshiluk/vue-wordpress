<?php
// these are just used to tell if there is a next/previous page
$previous = get_previous_posts_link();
$next = get_next_posts_link();
if ( $previous || $next ): ?>

<section class="pagination">

    <?php if ( $previous ): ?>

    <a class="pagination__previous" href="<?php echo get_previous_posts_page_link(); ?>" rel="previous">&lsaquo; Previous</a>

    <?php endif; ?>

    <?php if ( $next ): ?>

    <a class="pagination__previous" href="<?php echo get_next_posts_page_link(); ?>" rel="next">Next &rsaquo;</a>

    <?php endif; ?>

</section>

<?php
endif;