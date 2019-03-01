<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$author_id = get_query_var( 'author' );
$author = RADL::get( 'state.users', $author_id );
$posts = RADL::get( 'state.posts', array( 'page' => $paged, 'per_page' => $per_page, 'author' => $author_id ) ); ?>

<main>

    <header>

      <h1>Posts by <?php echo $author['name']; ?></h1>
      
    </header>

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
