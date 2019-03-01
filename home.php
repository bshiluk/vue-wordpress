<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$posts = RADL::get( 'state.posts', array( 'page' => 1, 'per_page' => $per_page ) ); ?>

<main>

    <section>

        <?php
        foreach ( $posts as $p ) {
            set_query_var( 'vw_post', $p );
            get_template_part( 'template-parts/post-item' );
        } ?>

    </section>

    <?php
    get_template_part( 'template-parts/pagination' ); ?>

</main>

<?php
get_footer();