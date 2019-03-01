<?php

get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$per_page = RADL::get( 'state.site' )['posts_per_page'];
$tag_id = get_query_var('tag_id');
RADL::get( 'state.tags', $tag_id );
RADL::get( 'state.posts', array( 'page' => $paged, 'per_page' => $per_page, 'tags' => $tag_id ) );

get_footer();
