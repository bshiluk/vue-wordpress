<?php
$props = get_query_var('vw_responsive_image');
$image = RADL::get('state.media', $props['id']);
$image_class = empty( $props['class'] ) ? 'responsive-image' : $props['class'] . ' responsive-image';
$srcset = array_map( function ($size) {
    return $size['source_url'] . ' ' . $size['width'] . 'w';
}, $image['media_details']['sizes']); ?>

<div class="<?php echo $image_class; ?>">

    <img src="<?php echo $image['source_url']; ?>" srcset="<?php echo join(', ', $srcset); ?>"
        sizes="<?php echo $props['sizes']; ?>" alt="<?php echo $image['alt_text']; ?>"
        title="<?php echo $image['title']['rendered']; ?>" />

</div>