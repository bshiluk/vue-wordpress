<?php
$p = get_query_var( 'vw_post' );
$categories = $p['categories'];
$tags = $p['tags']; ?>

<div>

    <?php if ( count( $categories ) ): ?>

    <div class="categories">

        <span>Posted in:</span>

        <?php
        foreach( $categories as $cat_id ) {
            $cat = RADL::get( 'state.categories', $cat_id );
            set_query_var( 'vw_archive_link', $cat );
            get_template_part( 'template-parts/archive-link' );
        } ?>

    </div>

    <?php 
    endif;
    if ( count( $tags ) ): ?>

    <div class="tags">

        <span>Tagged:</span>

        <?php
        foreach( $tags as $tag_id ) {
            $tag = RADL::get( 'state.tags', $tag_id );
            set_query_var( 'vw_archive_link', $tag );
            get_template_part( 'template-parts/archive-link' );
        } ?>

    </div>

    <?php endif; ?>

</div>