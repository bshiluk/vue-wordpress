<div class="site-loading-wrap">

    <div class="site-loading">

        <?php 
        $logo = RADL::get('state.media', RADL::get('state.site')['logo']);
        if ( $logo ): ?>

        <img class="logo" src="<?php echo $logo['source_url']; ?>" alt="<?php echo $logo['alt_text']; ?>" />

        <?php else: ?>

        <span><?php echo RADL::get('state.site')['name'];?></span>

        <?php endif;?>

        <div></div>

    </div>

</div>