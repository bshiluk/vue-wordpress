<div class="site-branding">

    <?php 
    $logo = RADL::get( 'state.media', RADL::get( 'state.site' )['logo'] );
    if ( $logo ): ?>

    <img class="logo" src="<?php echo $logo['source_url']; ?>" alt="<?php echo $logo['alt_text']; ?>" />

    <?php endif;?>

    <span><?php echo RADL::get( 'state.site' )['name']; ?></span>

</div>