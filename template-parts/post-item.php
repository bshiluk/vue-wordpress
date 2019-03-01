<?php
$p = get_query_var( 'vw_post' ); ?>

<article class="post">

    <?php
    if ( $p['featured_media']) {
        set_query_var('vw_responsive_image', array(
        'id'    => $p['featured_media'],
        'sizes' => '(max-width: 680px) 40vw, 400px',
        'class' => 'post__featured-media'
        ));
        get_template_part('template-parts/responsive-image');
    } ?>

    <div class="post__content">

        <h2>

            <a href="<?php echo $p['link']; ?>" title="<?php echo $p['title']['rendered']; ?>"><?php echo $p['title']['rendered']; ?>

        </h2>

        <?php get_template_part('template-parts/post-meta'); ?>

        <div><?php echo $p['excerpt']['rendered']; ?></div>

        <?php get_template_part('template-parts/post-taxonomies'); ?>
        
    </div>

</article>
