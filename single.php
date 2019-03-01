<?php
get_header();
$single = RADL::get( 'state.posts', get_the_ID() ); ?>

<main>

    <article>

        <header>

            <?php 
            if ( $single['featured_media']) {
                set_query_var('vw_responsive_image', array(
                'id'    => $single['featured_media'],
                'sizes' => '(max-width: 1200px) 100vw, 1200px'
                ));
                get_template_part('template-parts/responsive-image');
            } ?>

            <h1><?php echo $single['title']['rendered']; ?></h1>

            <?php
            set_query_var('vw_post', $single);
            get_template_part('template-parts/post-meta');
            get_template_part('template-parts/post-taxonomies'); ?>

        </header>

        <div><?php echo $single['content']['rendered']; ?></div>

    </article>

</main>

<?php
get_footer();