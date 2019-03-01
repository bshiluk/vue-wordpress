<?php
$p = get_query_var( 'vw_post' ); 
$author = RADL::get( 'state.users', $p['author'] ); ?>

<div class="post-meta">

    <?php
    set_query_var( 'vw_archive_link', $author );
    get_template_part( 'template-parts/archive-link' ); ?>

    <time><?php echo date( 'M j', strtotime( $p['date'] ) ); ?></time>

    <span><?php echo vue_wordpress_min_read( $p['content']['rendered'] ) ?></span>

</div>