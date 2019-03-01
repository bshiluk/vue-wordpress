<?php
get_header();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$category_id = get_query_var('cat');
$category = RADL::get( 'state.categories', $category_id );
$posts = RADL::get( 'state.posts', array( 'page' => $paged, 'per_page' => $per_page, 'categories' => $category_id ) ); ?>

<main>

    <header>

      <h1>Archive for <?php echo $category['name']; ?></h1>
      
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
